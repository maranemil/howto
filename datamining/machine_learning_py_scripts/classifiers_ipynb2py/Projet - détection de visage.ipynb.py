
# coding: utf-8

# # Détection de visage - SY32

# ### Import des librairies
# On définit également les chemins principaux et on charge le fichier de données.

# Les fenêtres étant de tailles différentes, il est nécessaire de connaître la taille de fenêtre la plus petite dont nous disposons afin que nous ne soyons pas contraints de zoomer une image. Nous pourrions également établir une limite afin de rejeter les images dont la taille de fenêtre est en dessous d'un certain seuil (il serait absurde de choisir une taille de fenêtre d'un pixel...).

# In[1]:


import numpy as np
from skimage import io
from skimage import util
from skimage.transform import resize
from skimage import color
#from skimage import feature
from sklearn import svm
import matplotlib.patches as patches
import matplotlib.pyplot as plt
from PIL import Image


absolutePath = "/Users/guillaume/Cloud/WORK/UTC/GI02/SY32/TDXu/Projet/"
pathTrain = absolutePath + "projetface/train/"
pathTest =  absolutePath + "projetface/test/"
pathFile = absolutePath + "projetface/label.txt"
data = np.loadtxt(pathFile)


# In[2]:


def minFace(data):
    return int(np.min(data[:,3:]))

newSize = minFace(data)
print("minFace =", newSize)


# La fonction suivante permet tout simplement d'afficher une image d'apprentissage en affichant dessus son rectangle correspondant.

# In[3]:


def afficherImgRect(n, data, pathTrain):
    # Charger l'image
    img = np.array(Image.open(pathTrain +"%04d"%(n)+".jpg"), dtype=np.uint8)
    # Créer la figure et les axes
    fig,ax = plt.subplots(1)
    # Afficher l'image
    ax.imshow(img)
    # Créer le rectangle 
    xcorner, ycorner, width, height = data[n-1][1:]
    rect = patches.Rectangle((xcorner, ycorner), width, height,linewidth=2,edgecolor='r', facecolor='none')
    # Ajouter le rectangle sur l'image
    ax.add_patch(rect)
    plt.show()

afficherImgRect(14, data, pathTrain)


# La fonction suivante permet de cropper l'image selon ce rectangle, ainsi que la redimensionner en carré à la taille $newsize$ si l'argument est renseigné.

# In[4]:


def cropImage(n, data, pathTrain, newsize=0):
    img = np.array(Image.open(pathTrain +"%04d"%(data[n,0])+".jpg"), dtype=np.uint8)
    x, y, w, h = map(int, data[n][1:])
    img = img[y:y+h, x:x+w]
    if newsize:
        img = resize(img, (newsize, newsize), mode='reflect')
    return img

image = cropImage(13,data,pathTrain)
fig,ax = plt.subplots(1)
ax.imshow(image)
plt.show()


# Pour des questions de simplicité, nous voudrions que les images croppées soient carrées de la taille minimale calculée précédemment. La fonction suivante modifie la variable data afin de transformer toutes les coordonnées et tailles de telle sorte qu'il s'agisse de carrés (centrés par rapport au rectangle fourni).

# In[5]:


def dataSquare(data):
    # Récupération des "rectangles"
    newData = np.array(data)
    # Récupération du minimum entre la largeur et la hauteur
    minwh = np.minimum(data[:,3], data[:,4])
    # Modification de la largeur
    newData[:,1] += (data[:,3]-minwh)//2
    # Modification de la hauteur
    newData[:,2] += (data[:,4]-minwh)//2
    # Transformation des rectangles en carrés
    newData[:,3:] = np.transpose(np.array([minwh, minwh]))
    return newData

# Calcul des nouvelles coordonnées
dataPositif = dataSquare(data)

# Affichage des coordonnées sur une images
afficherImgRect(14, dataPositif, pathTrain)

#Recadrement et redimensionnement de l'image
image = cropImage(13,dataPositif,pathTrain, newSize)
fig,ax = plt.subplots(1)
ax.imshow(image)
plt.show()


# Grâce à la fonction précédente, nous obtenons nos exemples positifs d'apprentissage. La fonction suivante retourne l'ensemble des exemples positifs en noir et blanc (cela allège la quantité de données en la divisant par trois, la composante couleur n'étant pas prise en compte dans notre analyse). On choisit également de prendre le symétrique (par rapport à l'axe vertical) dans la base d'exemples.
# 
# On décide d'utiliser comme vecteur descripteur le gradient de l'image en $x$ et en $y$ (Norme $\sqrt{g_x^2 + g_y^2}$ avec pour noyaux de convolution $G_x = [-1, 0, +1]$ et $G_y = [-1, 0, +1]^T$).

# In[24]:


def filtreLineaire(image):
    grad = np.gradient(image)
    return np.sqrt(grad[0]*grad[0]+grad[1]*grad[1])

def donneesImages(data, pathTrain, newsize):
    images = np.zeros((2*len(data),newsize,newsize))
    for i in range(len(data)):
        img = filtreLineaire(color.rgb2gray(cropImage(i, data, pathTrain, newsize)))
        images[2*i] = img
        images[2*i+1] = np.fliplr(img)
    return images

exemplesPositifs = donneesImages(dataPositif, pathTrain, newSize)


# In[34]:


fig,ax = plt.subplots(1)
ax.imshow(exemplesPositifs[26])
fig,ax = plt.subplots(1)
ax.imshow(exemplesPositifs[27])
plt.show()


# Il nous faut également générer des exemples négatifs de façon aléatoire, ceux-ci devant recouvrir au plus 50% de l'exemple positif. Écrivons donc une fonction permettant d'obtenir le taux de recouvrement relatif à deux fenêtres (entre 0 et 100%).

# In[35]:


def recouvrement(x1, y1, w1, h1, x2, y2, w2, h2):
    xinter = max(0, min(x1+w1,x2+w2) - max(x1,x2))
    yinter = max(0, min(y1+h1,y2+h2) - max(y1,y2));
    ainter = xinter * yinter;
    aunion = (w1*h1) + (w2*h2) - ainter
    return ainter/aunion

print("Recouvrement total:", recouvrement(10,10,30,30,10,10,30,30))
print("Recouvrement nul:", recouvrement(10,10,30,30,40,40,30,30))
print("Recouvrement partiel:", recouvrement(10,10,30,30,20,20,30,30))


# Considérons un exemple négatif si son recouvrement est inférieur à 0.5. Nous recherchons une fonction retournant l'ensemble des exemples négatifs en noir et blanc de la taille de la fenêtre minimale que nous allons utiliser pour l'apprentissage, ceux-ci étant tirés aléatoirement (aléas: échelle, $x$, $y$) de telle sorte qu'il y en ait n par image (généralement entre 10 et 20). 
# 
# Pour rappel, nous avons déterminé $newSize$ de telle sorte qu'il s'agisse de la plus petite fenêtre imaginable. La fenêtre doit donc être carrée et être de taille aléatoire supérieure à $newSize$, sans déborder de l'image. La fonction suivante retourne (sous le format d'une ligne "data") une fenêtre correspondant à un exemple négatif tiré aléatoirement dans la $n$ième image.

# In[36]:


def negatifRandom(data,pathTrain,newsize,n):
    while True:
        # Récupération de l'image
        img = np.array(Image.open(pathTrain +"%04d"%(n)+".jpg"), dtype=np.uint8)
        # Récupération de ses caractéristiques
        x1, y1, w1, h1 = map(int, data[n-1][1:])
        w, h = [len(img[0]), len(img)]
        # Choix aléatoire d'une taille de fenêtre
        taille = int(np.random.uniform(low=newsize, high=min(w,h)))
        # Choix aléatoire de la position de la fenêtre
        x = int(np.random.uniform(low=0, high=w-taille))
        y = int(np.random.uniform(low=0, high=h-taille))
        # Test du score de recouvrement de la fenêtre
        if recouvrement(x1,y1,w1,h1,x,y,taille,taille) < 0.5:
            return n, x, y, taille, taille

print(negatifRandom(data,pathTrain,newSize,14))


# La fonction suivante génère une nouvelle variable "data" décrivant les fenêtres de $n$ exemples négatifs tirés aléatoirement pour chaque image.

# In[37]:


def exemplesNegatifs(n, data, pathTrain, newsize):
    newData = np.zeros((len(data)*n, 5))
    # Pour chaque image
    for i in range(len(data)):
        # On cherche n exemples négatifs
        for j in range(n):
            newData[i*n+j,:] = negatifRandom(data,pathTrain,newsize,i+1)
    return newData

dataNegatif = exemplesNegatifs(10, data, pathTrain, newSize)


# On peut alors sans problème réutiliser la fonction $donneesImage$ pour retourner le gradient de l'ensemble des exemples négatifs de taille $newSize$ (ainsi que leur symétrique par rapport à l'axe vertical).

# In[38]:


exemplesNegatifs = donneesImages(dataNegatif, pathTrain, newSize)


# In[49]:


plt.figure(1)

for i in range(4):
    img = int(np.random.uniform(low=0, high=len(exemplesNegatifs)-1))
    plt.subplot(221+img%5)
    plt.imshow(exemplesNegatifs[img])

plt.show()


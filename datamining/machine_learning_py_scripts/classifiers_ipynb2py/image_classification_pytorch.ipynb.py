
# coding: utf-8

# In[9]:


import io
import requests
from PIL import Image
from torchvision import models, transforms
from torch.autograd import Variable


# In[10]:


# LABELS_URL is a JSON file that maps label indices to English descriptions of the ImageNet classes 
# IMG_URL can be any image you like. If it’s in one of the 1,000 ImageNet classes this code should correctly classify it.
LABELS_URL = 'https://s3.amazonaws.com/outcome-blog/imagenet/labels.json'
IMG_URL = 'https://s3.amazonaws.com/outcome-blog/wp-content/uploads/2017/02/25192225/cat.jpg'


# In[11]:


#Initialize the model
squeeze = models.squeezenet1_1(pretrained=True)


# In[12]:


normalize = transforms.Normalize(
   mean=[0.485, 0.456, 0.406],
   std=[0.229, 0.224, 0.225]
)
preprocess = transforms.Compose([
   transforms.Scale(256),
   transforms.CenterCrop(224),
   transforms.ToTensor(),
   normalize
])


# In[13]:


# Download the image and create a pillow Image
response = requests.get(IMG_URL)
img_pil = Image.open(io.BytesIO(response.content))


# In[14]:


img_pil


# In[15]:


# Preprocess the image
img_tensor = preprocess(img_pil)
img_tensor.unsqueeze_(0)


# In[16]:


img_variable = Variable(img_tensor)


# In[17]:


# Run a forward pass with the neural network
fc_out = squeeze(img_variable)


# In[18]:


#Download the labels.
labels = {int(key):value for (key, value)
          in requests.get(LABELS_URL).json().items()}


# In[19]:


labels


# In[20]:


print(labels[fc_out.data.numpy().argmax()])


# -*- coding: utf-8 -*-

"""
##################################################
#
#   Neural Style Transfer with Eager Execution
#
##################################################

https://colab.research.google.com/github/tensorflow/models/blob/master/research/nst_blogpost/4_Neural_Style_Transfer_with_Eager_Execution.ipynb#scrollTo=vSVMx4burydi
https://github.com/tensorflow/models/blob/master/research/nst_blogpost/4_Neural_Style_Transfer_with_Eager_Execution.ipynb

##################################################
#
#   We will follow the general steps to perform style transfer:
#
##################################################

1. Visualize data
2. Basic Preprocessing/preparing our data
3. Set up loss functions
4. Create model
5. Optimize for loss function
**Audience:** This post is geared towards intermediate users who are comfortable with basic machine learning concepts. To get the most out of this post, you should:
* Read [Gatys' paper](https://arxiv.org/abs/1508.06576) - we'll explain along the way, but the paper will provide a more thorough understanding of the task
* [Understand reducing loss with gradient descent](https://developers.google.com/machine-learning/crash-course/reducing-loss/gradient-descent)
**Time Estimated**: 1-30 min

##################################################
#
#   Resources
#
##################################################

http://www.cvc.uab.es/people/joans/slides_tensorflow/tensorflow_html/neural_art.html
https://gist.github.com/raymond-yuan/beb64629c3e88f34f241f9373fcc9079
https://github.com/anishathalye/neural-style/blob/master/neural_style.py
https://www.tensorflow.org/tutorials/images/hub_with_keras
https://github.com/edupard/csnet/blob/master/vgg_loss_static.py
https://github.com/jcjohnson/neural-style
https://github.com/titu1994/Fast-Neural-Style/blob/master/README.md
https://harangdev.github.io/practice/1/

##################################################
#
#   Setup Conda and TF
#
##################################################

wget https://repo.anaconda.com/archive/Anaconda3-2018.12-Linux-x86_64.sh
chmod +x Anaconda3-2018.12-Linux-x86_64.sh
bash Anaconda3-2018.12-Linux-x86_64.sh
export PATH=~/anaconda3/bin:$PATH
conda --version
conda create -n tensorflow pip python=3.6
activate tensorflow
pip install --ignore-installed --upgrade tensorflow
pip freeze
pip uninstall numpy
pip uninstall scipy
pip install numpy --upgrade
pip install scipy --upgrade

##################################################
#
# Download Images
#
##################################################
"""

import os

img_dir = '/home/emil/Git/nst/'
if not os.path.exists(img_dir):
    os.makedirs(img_dir)

# !wget --quiet -P /tmp/nst/ 'https://media-cdn.tripadvisor.com/media/photo-s/0f/6d/28/72/street-view-of-hotel.jpg'
# !wget  -P /tmp/nst/ 'https://images.pexels.com/photos/236636/pexels-photo-236636.jpeg'
# !wget --quiet -P /tmp/nst/ https://upload.wikimedia.org/wikipedia/commons/0/0a/The_Great_Wave_off_Kanagawa.jpg
# !wget --quiet -P /tmp/nst/ https://upload.wikimedia.org/wikipedia/commons/b/b4/Vassily_Kandinsky%2C_1913_-_Composition_7.jpg
# !wget --quiet -P /tmp/nst/ https://upload.wikimedia.org/wikipedia/commons/0/00/Tuebingen_Neckarfront.jpg
# !wget --quiet -P /tmp/nst/ 'https://upload.wikimedia.org/wikipedia/commons/6/68/Pillars_of_creation_2014_HST_WFC3-UVIS_full-res_denoised.jpg'
# !wget --quiet -P /tmp/nst/ https://upload.wikimedia.org/wikipedia/commons/thumb/e/ea/Van_Gogh_-_Starry_Night_-_Google_Art_Project.jpg/1024px-Van_Gogh_-_Starry_Night_-_Google_Art_Project.jpg


"""
##################################################
### Import and configure modules
##################################################
"""

import matplotlib.pyplot as plt
import matplotlib as mpl

mpl.rcParams['figure.figsize'] = (10, 10)
mpl.rcParams['axes.grid'] = False

import numpy as np
from PIL import Image
import time
import functools

import tensorflow as tf
import tensorflow.contrib.eager as tfe

from tensorflow.python.keras.preprocessing import image as kp_image
from tensorflow.python.keras import models
from tensorflow.python.keras import losses
from tensorflow.python.keras import layers
from tensorflow.python.keras import backend as K

"""We’ll begin by enabling [eager execution](https://www.tensorflow.org/guide/eager). Eager execution allows us to work through this technique in the clearest and most readable way."""

tf.enable_eager_execution()
print("Eager execution: {}".format(tf.executing_eagerly()))

"""
## Visualize the input
1024 -> 2019-02-15 14:29:11.158167: W tensorflow/core/framework/allocator.cc:124] Allocation of 185073664 exceeds 10% of system memory.
https://github.com/tensorflow/tensorflow/issues/18736
if set environment variable "TF_CPP_MIN_LOG_LEVEL=2", the message is not show

2019-02-15 15:03:58.753923: I tensorflow/compiler/xla/service/service.cc:158]   StreamExecutor device (0): <undefined>, <undefined>
WARNING:tensorflow:From /home/emil/anaconda3/lib/python3.7/site-packages/tensorflow/python/ops/resource_variable_ops.py:642: colocate_with (from tensorflow.python.framework.ops) is deprecated and will be removed in a future version.

"""


def load_img(path_to_img):
    max_dim = 64  # 64(7s) 128(17s) 256(69s) 512(294s/4m)  1024(1200s/20m)
    img = Image.open(path_to_img)
    long = max(img.size)
    scale = max_dim / long
    img = img.resize((round(img.size[0] * scale), round(img.size[1] * scale)), Image.ANTIALIAS)
    img = kp_image.img_to_array(img)
    # We need to broadcast the image array such that it has a batch dimension
    img = np.expand_dims(img, axis=0)
    return img


def imshow(img, title=None):
    # Remove the batch dimension
    out = np.squeeze(img, axis=0)
    # Normalize for display
    out = out.astype('uint8')
    plt.imshow(out)
    if title is not None:
        plt.title(title)
    plt.imshow(out)


"""## Prepare the data
"""


def load_and_process_img(path_to_img):
    img = load_img(path_to_img)
    img = tf.keras.applications.vgg19.preprocess_input(img)
    return img


"""In"""


def deprocess_img(processed_img):
    x = processed_img.copy()
    if len(x.shape) == 4:
        x = np.squeeze(x, 0)
    assert len(x.shape) == 3, ("Input to deprocess image must be an image of "
                               "dimension [1, height, width, channel] or [height, width, channel]")
    if len(x.shape) != 3:
        raise ValueError("Invalid input to deprocessing image")

    # perform the inverse of the preprocessiing step
    x[:, :, 0] += 103.939
    x[:, :, 1] += 116.779
    x[:, :, 2] += 123.68
    x = x[:, :, ::-1]

    x = np.clip(x, 0, 255).astype('uint8')
    return x


def get_model():
    """ Creates our model with access to intermediate layers.

    This function will load the VGG19 model and access the intermediate layers.
    These layers will then be used to create a new model that will take input image
    and return the outputs from these intermediate layers from the VGG model.

    Returns:
      returns a keras model that takes image inputs and outputs the style and
        content intermediate layers.
    """
    # Load our model. We load pretrained VGG, trained on imagenet data
    vgg = tf.keras.applications.vgg19.VGG19(include_top=False, weights='imagenet')
    vgg.trainable = False
    # Get output layers corresponding to style and content layers
    style_outputs = [vgg.get_layer(name).output for name in style_layers]
    content_outputs = [vgg.get_layer(name).output for name in content_layers]
    model_outputs = style_outputs + content_outputs
    # Build model
    return models.Model(vgg.input, model_outputs)


def get_content_loss(base_content, target):
    return tf.reduce_mean(tf.square(base_content - target))


"""
Computing style loss
Again, we implement our loss as a distance metric .
*
*
*
*
*
*
"""


def gram_matrix(input_tensor):
    # We make the image channels first
    channels = int(input_tensor.shape[-1])
    a = tf.reshape(input_tensor, [-1, channels])
    n = tf.shape(a)[0]
    gram = tf.matmul(a, a, transpose_a=True)
    return gram / tf.cast(n, tf.float32)  # float32 float64


def get_style_loss(base_style, gram_target):
    """Expects two images of dimension h, w, c"""
    # height, width, num filters of each layer
    # We scale the loss at a given layer by the size of the feature map and the number of filters
    height, width, channels = base_style.get_shape().as_list()
    gram_style = gram_matrix(base_style)

    return tf.reduce_mean(tf.square(gram_style - gram_target))  # / (4. * (channels ** 2) * (width * height) ** 2)


"""
## Apply style transfer to our images
### Run Gradient Descent 
*
*
*
*
*
"""


def get_feature_representations(model, content_path, style_path):
    """Helper function to compute our content and style feature representations.

    This function will simply load and preprocess both the content and style
    images from their path. Then it will feed them through the network to obtain
    the outputs of the intermediate layers.

    Arguments:
      model: The model that we are using.
      content_path: The path to the content image.
      style_path: The path to the style image

    Returns:
      returns the style features and the content features.
    """
    # Load our images in
    content_image = load_and_process_img(content_path)
    style_image = load_and_process_img(style_path)

    # batch compute content and style features
    style_outputs = model(style_image)
    content_outputs = model(content_image)

    # Get the style and content feature representations from our model
    style_features = [style_layer[0] for style_layer in style_outputs[:num_style_layers]]
    content_features = [content_layer[0] for content_layer in content_outputs[num_style_layers:]]
    return style_features, content_features


"""
### Computing the loss and gradients
*
*
*
*
*
"""


def compute_loss(model, loss_weights, init_image, gram_style_features, content_features):
    """This function will compute the loss total loss.

    Arguments:
      model: The model that will give us access to the intermediate layers
      loss_weights: The weights of each contribution of each loss function.
        (style weight, content weight, and total variation weight)
      init_image: Our initial base image. This image is what we are updating with
        our optimization process. We apply the gradients wrt the loss we are
        calculating to this image.
      gram_style_features: Precomputed gram matrices corresponding to the
        defined style layers of interest.
      content_features: Precomputed outputs from defined content layers of
        interest.

    Returns:
      returns the total loss, style loss, content loss, and total variational loss
    """
    style_weight, content_weight = loss_weights

    # Feed our init image through our model. This will give us the content and
    # style representations at our desired layers. Since we're using eager
    # our model is callable just like any other function!
    model_outputs = model(init_image)

    style_output_features = model_outputs[:num_style_layers]
    content_output_features = model_outputs[num_style_layers:]

    style_score = 0
    content_score = 0

    # Accumulate style losses from all layers
    # Here, we equally weight each contribution of each loss layer
    weight_per_style_layer = 1.0 / float(num_style_layers)
    for target_style, comb_style in zip(gram_style_features, style_output_features):
        style_score += weight_per_style_layer * get_style_loss(comb_style[0], target_style)

    # Accumulate content losses from all layers
    weight_per_content_layer = 1.0 / float(num_content_layers)
    for target_content, comb_content in zip(content_features, content_output_features):
        content_score += weight_per_content_layer * get_content_loss(comb_content[0], target_content)

    style_score *= style_weight
    content_score *= content_weight

    # Get total loss
    loss = style_score + content_score
    return loss, style_score, content_score


"""
Then computing the gradients is easy:
*
*
*
*
*
*
"""


def compute_grads(cfg):
    with tf.GradientTape() as tape:
        all_loss = compute_loss(**cfg)
    # Compute gradients wrt input image
    total_loss = all_loss[0]
    return tape.gradient(total_loss, cfg['init_image']), all_loss


"""
### Optimization loop
*
*
*
*
*
*
"""
import IPython.display


def run_style_transfer(content_path,
                       style_path,
                       num_iterations=100,
                       content_weight=1e3,
                       style_weight=1e-2):
    # We don't need to (or want to) train any layers of our model, so we set their
    # trainable to false.
    model = get_model()
    for layer in model.layers:
        layer.trainable = False

    # Get the style and content feature representations (from our specified intermediate layers)
    style_features, content_features = get_feature_representations(model, content_path, style_path)
    gram_style_features = [gram_matrix(style_feature) for style_feature in style_features]

    # Set initial image
    init_image = load_and_process_img(content_path)
    init_image = tfe.Variable(init_image, dtype=tf.float32)  # float32 float64
    # Create our optimizer
    opt = tf.train.AdamOptimizer(learning_rate=5, beta1=0.99, epsilon=1e-1)

    # For displaying intermediate images
    iter_count = 1

    # Store our best result
    best_loss, best_img = float('inf'), None

    # Create a nice config
    loss_weights = (style_weight, content_weight)
    cfg = {
        'model': model,
        'loss_weights': loss_weights,
        'init_image': init_image,
        'gram_style_features': gram_style_features,
        'content_features': content_features
    }

    # For displaying
    num_rows = 2
    num_cols = 5
    display_interval = num_iterations / (num_rows * num_cols)
    start_time = time.time()
    global_start = time.time()

    norm_means = np.array([103.939, 116.779, 123.68])
    min_vals = -norm_means
    max_vals = 255 - norm_means

    imgs = []
    for i in range(num_iterations):
        grads, all_loss = compute_grads(cfg)
        loss, style_score, content_score = all_loss
        opt.apply_gradients([(grads, init_image)])
        clipped = tf.clip_by_value(init_image, min_vals, max_vals)
        init_image.assign(clipped)
        end_time = time.time()

        if loss < best_loss:
            # Update best loss and best image from total loss.
            best_loss = loss
            best_img = deprocess_img(init_image.numpy())

        if i % display_interval == 0:
            start_time = time.time()

            # Use the .numpy() method to get the concrete numpy array
            plot_img = init_image.numpy()
            plot_img = deprocess_img(plot_img)
            imgs.append(plot_img)
            IPython.display.clear_output(wait=True)
            IPython.display.display_png(Image.fromarray(plot_img))
            print('Iteration: {}'.format(i))
            print('Total loss: {:.4e}, '
                  'style loss: {:.4e}, '
                  'content loss: {:.4e}, '
                  'time: {:.4f}s'.format(loss, style_score, content_score, time.time() - start_time))
    print('Total time: {:.4f}s'.format(time.time() - global_start))
    IPython.display.clear_output(wait=True)
    plt.figure(figsize=(14, 4))
    for i, img in enumerate(imgs):
        plt.subplot(num_rows, num_cols, i + 1)
        plt.imshow(img)
        plt.xticks([])
        plt.yticks([])

    return best_img, best_loss


"""
## Visualize outputs
"""


def show_results(best_img, content_path, style_path, show_large_final=True):
    plt.figure(figsize=(10, 5))
    content = load_img(content_path)
    style = load_img(style_path)

    plt.subplot(1, 2, 1)
    imshow(content, 'Content Image')

    plt.subplot(1, 2, 2)
    imshow(style, 'Style Image')

    if show_large_final:
        plt.figure(figsize=(10, 10))

        plt.imshow(best_img)
        plt.title('Output Image')
        plt.show()


"""
########################################################################
#
# start here thre custom
#
########################################################################
"""

# Set up some global values here
content_path = img_dir + 'street-view-of-hotel.jpg'
style_path = img_dir + 'The_Great_Wave_off_Kanagawa.jpg'

"""
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
"""

plt.figure(figsize=(10, 10))

content = load_img(content_path).astype('uint8')
style = load_img(style_path).astype('uint8')

plt.subplot(1, 2, 1)
imshow(content, 'Content Image')

plt.subplot(1, 2, 2)
imshow(style, 'Style Image')
plt.show()

"""
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
### Define content and style representations
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
"""
# Content layer where will pull our feature maps
content_layers = ['block5_conv2']

# Style layer we are interested in
style_layers = ['block1_conv1',
                'block2_conv1',
                'block3_conv1',
                'block4_conv1',
                'block5_conv1'
                ]

num_content_layers = len(content_layers)
num_style_layers = len(style_layers)

"""
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
## Show results
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
"""

"""
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
CONTENT_WEIGHT = 5e0 / 1e3 / 8.5E-5
STYLE_WEIGHT = 5e2 / 1e-2 / 8.5E-2
TV_WEIGHT = 1e2 / 
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
"""
best, best_loss = run_style_transfer(img_dir + 'street-view-of-hotel.jpg', img_dir + 'The_Great_Wave_off_Kanagawa.jpg',
                                     5, 1e-2, 1)
Image.fromarray(best)
show_results(best, content_path, style_path)

"""To download the image from Colab uncomment the following code:"""
# from google.colab import files
# files.download('wave_turtle.png')


"""## Try it on other images
Image of Tuebingen 

Photo By: Andreas Praefcke [GFDL (http://www.gnu.org/copyleft/fdl.html) or CC BY 3.0  (https://creativecommons.org/licenses/by/3.0)], from Wikimedia Commons

### Starry night + Tuebingen
"""
# best_starry_night, best_loss = run_style_transfer( img_dir +'street-view-of-hotel.jpg',  img_dir +'The_Great_Wave_off_Kanagawa.jpg',500)
# show_results(best_starry_night, img_dir +'street-view-of-hotel.jpg',  img_dir +'The_Great_Wave_off_Kanagawa.jpg')

"""### Pillars of Creation + Tuebingen"""

# best_poc_tubingen, best_loss = run_style_transfer('/tmp/nst/Tuebingen_Neckarfront.jpg', '/tmp/nst/Pillars_of_creation_2014_HST_WFC3-UVIS_full-res_denoised.jpg')
# show_results(best_poc_tubingen,  '/tmp/nst/Tuebingen_Neckarfront.jpg', '/tmp/nst/Pillars_of_creation_2014_HST_WFC3-UVIS_full-res_denoised.jpg')

"""### Kandinsky Composition 7 + Tuebingen"""

# best_kandinsky_tubingen, best_loss = run_style_transfer('/tmp/nst/Tuebingen_Neckarfront.jpg', '/tmp/nst/Vassily_Kandinsky,_1913_-_Composition_7.jpg')
# show_results(best_kandinsky_tubingen, '/tmp/nst/Tuebingen_Neckarfront.jpg', '/tmp/nst/Vassily_Kandinsky,_1913_-_Composition_7.jpg')

"""### Pillars of Creation + Sea Turtle"""
# best_poc_turtle, best_loss = run_style_transfer('/tmp/nst/Green_Sea_Turtle_grazing_seagrass.jpg', '/tmp/nst/Pillars_of_creation_2014_HST_WFC3-UVIS_full-res_denoised.jpg')
# show_results(best_poc_turtle,  '/tmp/nst/Green_Sea_Turtle_grazing_seagrass.jpg', '/tmp/nst/Pillars_of_creation_2014_HST_WFC3-UVIS_full-res_denoised.jpg')

"""## Key Takeaways
### What we covered:
* We built several different loss functions and used backpropagation to transform our input image in order to minimize these losses
  * In order to do this we had to load in a **pretrained model** and use its learned feature maps to describe the content and style representation of our images.
    * Our main loss functions were primarily computing the distance in terms of these different representations
* We implemented this with a custom model and **eager execution**
  * We built our custom model with the Functional API 
  * Eager execution allows us to dynamically work with tensors, using a natural python control flow
  * We manipulated tensors directly, which makes debugging and working with tensors easier. 
* We iteratively updated our image by applying our optimizers update rules using **tf.gradient**. The optimizer minimized a given loss with respect to our input image.
**[Image of Tuebingen](https://commons.wikimedia.org/wiki/File:Tuebingen_Neckarfront.jpg)** 
Photo By: Andreas Praefcke [GFDL (http://www.gnu.org/copyleft/fdl.html) or CC BY 3.0  (https://creativecommons.org/licenses/by/3.0)], from Wikimedia Commons
**[Image of Green Sea Turtle](https://commons.wikimedia.org/wiki/File:Green_Sea_Turtle_grazing_seagrass.jpg)**
By P.Lindgren [CC BY-SA 3.0 (https://creativecommons.org/licenses/by-sa/3.0)], from Wikimedia Commons
"""

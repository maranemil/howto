import tensorflow as tf
import cv2
import numpy as np

li=[]
Y_in=[]
num_images=500
num_test=11
image_dim=64
for i in range(0,num_images):
	if(i%2==0):
		name='data/train/cat.'+str(i/2)+'.jpg'
		img=cv2.imread(name)
		img=cv2.resize(img,(image_dim,image_dim))
		li.append(img)
		Y_in.append(0)
	else:
		name='data/train/dog.'+str((i-1)/2)+'.jpg'
		img=cv2.imread(name)
		img=cv2.resize(img,(image_dim,image_dim))
		li.append(img)
		Y_in.append(1)
		# cv2.imshow('img'+str(i),img)

li_test=[]
for i in range(1,num_test):
	name='data/test/'+str(i)+'.jpg'
	img=cv2.imread(name)
	img=cv2.resize(img,(image_dim,image_dim))
	li_test.append(img)

X_test=np.array(li_test)
print X_test.shape
X_test=np.reshape(X_test,(num_test-1,X_test.shape[1]*X_test.shape[2]*X_test.shape[3]))

X_in=np.array(li)
X_in=np.reshape(X_in,(num_images,X_in.shape[1]*X_in.shape[2]*X_in.shape[3]))
print X_test.shape
Y_in=np.array(Y_in)
Y_in=np.reshape(Y_in,(num_images,1))
# print Y_test.shape 

def conv2d(X,W):
	return tf.nn.conv2d(X,W,strides=[1,1,1,1],padding='SAME')

def max_pool_2x2(X):
	return tf.nn.max_pool(X,ksize=[1,2,2,1],strides=[1,2,2,1],padding='SAME')

W_conv1=tf.Variable(tf.random_normal([5,5,3,64],stddev=0.1)*0.01)
b_conv1=tf.Variable(tf.constant(0.1,shape=[64]))

X=tf.placeholder(tf.float32,[None,X_in.shape[1]])
Y=tf.placeholder(tf.float32,[None,1])

X_image=tf.reshape(X,[-1,image_dim,image_dim,3])

h_conv1=tf.nn.tanh(conv2d(X_image,W_conv1)+b_conv1)
h_pool1=max_pool_2x2(h_conv1)

W_conv2=tf.Variable(tf.random_normal([5,5,64,128]))
b_conv2=tf.Variable(tf.constant(0.1,shape=[128]))

h_conv2=tf.nn.tanh(conv2d(h_pool1,W_conv2)+b_conv2)
h_pool2=max_pool_2x2(h_conv2)

W_dcl1=tf.Variable(tf.random_normal([image_dim*image_dim*128/16,1024],stddev=0.1)*0.01)
b_dcl1=tf.Variable(tf.constant(0.1,shape=[1024]))

h_pool2_flat=tf.reshape(h_pool2,[-1,image_dim*image_dim*128/16])
h_dcl=tf.nn.tanh(tf.matmul(h_pool2_flat,W_dcl1)+b_dcl1)

W_dcl2=tf.Variable(tf.random_normal([1024,1])*0.01)
b_dcl2=tf.Variable(tf.constant(0.1,shape=[1]))

y_conv=tf.sigmoid(tf.matmul(h_dcl,W_dcl2)+b_dcl2)

cost=tf.reduce_mean(-1*Y*tf.log(y_conv)-(1-Y)*tf.log(1-y_conv))
cost_new=tf.reduce_sum(Y*(1-y_conv)+(1-Y)*y_conv)
train_step=tf.train.AdamOptimizer(1e-4).minimize(cost)
# predicted=Y if ((y_conv>0.5 and Y==1) or (y_conv<0.5 and Y==0)) else (1-Y)
# correct_prediction=tf.equal(predicted,Y)
# accuracy=tf.reduce_mean(tf.cast(correct_prediction,tf.float32))*100
with tf.Session() as sess:
	sess.run(tf.global_variables_initializer())
	saver=tf.train.Saver()
	# *****Training******
	# for i in range(0,10000):
	# 	train_step.run(feed_dict={X:X_in,Y:Y_in})
	# 	if(i%10==0):
	# 		print i
	# 	if(i%500==0):
	# 		print(sess.run(cost_new,feed_dict={X:X_test,Y: [[1],[1],[1],[1],[0],[0],[0],[0],[0],[0]]}))
	# 	if(i%2000==0):
	# 		save_path=saver.save(sess,"./save/restore")
	# 		print("saved in"+save_path)
	# print(sess.run(y_conv,feed_dict={X:X_test}))
	# save_path=saver.save(sess,"./save/restore")
	# print("saved in"+save_path)

	#****Restoring***
	saver.restore(sess,"./save/restore")
	print "restored"

	img=cv2.imread("test2.jpg")
	img=cv2.resize(img,(image_dim,image_dim))
	prob=sess.run((y_conv*100),feed_dict={X:np.reshape(np.array(img),(-1,img.shape[0]*img.shape[1]*img.shape[2]))})
	if(prob<40):
		print "It is cat with probability "+str(100-prob[0][0])
	if(prob>60):
		print "It is dog with probability "+str(prob[0][0])
	if(prob>=40 and prob <=60):
		print "Confusing data, can be dog with probability "+str(prob[0][0])
		
############################################
#
#  numpy matrix arrays
#
############################################

import numpy as np
a = np.zeros((5, 5))
a[2, 2] = 1
print(a)

print(",,,,,,,,,,,,,,,,,,,,,,")

np.random.seed(2)
im = np.zeros((32, 32))
x, y = (31*np.random.random((2, 8))).astype(np.int)
im[x, y] = np.arange(8)
print(im)

print(",,,,,,,,,,,,,,,,,,,,,,")

square = np.zeros((8, 8))
square[4:-4, 4:-4] = 1
print(square)

print(",,,,,,,,,,,,,,,,,,,,,,")

square = np.zeros((32, 32))
square[10:-10, 10:-10] = 1
np.random.seed(2)
x, y = (32*np.random.random((2, 20))).astype(np.int)
square[x, y] = 1
print(square)

print(",,,,,,,,,,,,,,,,,,,,,,")

im = np.zeros((256, 256))
im[64:-64, 64:-64] = 1
print(im)

print(",,,,,,,,,,,,,,,,,,,,,,")

n = 10
l = 256
im = np.zeros((l, l))
np.random.seed(1)
points = l*np.random.random((2, n**2))
im[(points[0]).astype(np.int), (points[1]).astype(np.int)] = 1
print(im)



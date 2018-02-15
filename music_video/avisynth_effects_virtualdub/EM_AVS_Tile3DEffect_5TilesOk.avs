####################################################
##
## Tile 3D Effect based on 3droundabout.com Example created with Virtualdub and AviSynth Script
##
## Maran Emil
## Published on Jul 17, 2013
##
####################################################

a=AVIsource("e:\Video\original4.avi").ConvertToYUY2().BicubicResize(1280,720)
b=AVIsource("e:\Video\original4.avi").ConvertToYUY2().Crop(240, 240, 640, 640).Tweak(hue=0, bright=-10, cont=1.2,sat=0.75 ).BicubicResize(640,720)
c=AVIsource("e:\Video\original4.avi").ConvertToYUY2().Crop(0, 0, 440, 440).BicubicResize(640,360)
d=AVIsource("e:\Video\original4.avi").ConvertToYUY2().Crop(230, 230, 340, 340).BicubicResize(640,360)
e=AVIsource("e:\Video\original4.avi").ConvertToYUY2().Crop(310, 310, 340, 340).BicubicResize(640,360)


st = StackVertical(StackHorizontal(a,b),StackHorizontal(c,d,e)).BicubicResize(1920,1080)
return st

#Big Size Container Vid: 1920 x 1080
#Vid 1: 1280 x 720
#Vid 2: 640 x 720
#Vid 3: 640 x 360
#Vid 4: 640 x 360
#Vid 5: 640 x 360


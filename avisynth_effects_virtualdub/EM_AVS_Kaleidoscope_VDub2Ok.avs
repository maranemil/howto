####################################################
##
## Another Kaleidoscope Effect created with Virtualdub and AviSynth Script
##
## Maran Emil
## Published on Jul 17, 2013
##
####################################################

a=AVIsource("e:\Video\original4.avi").ConvertToRGB32().Crop(4, 0, 152, 240).BicubicResize(290,185)
b=AVIsource("e:\Video\original4.avi").ConvertToRGB32().Crop(4, 0, 152, 240).FlipHorizontal().BicubicResize(290,185)
c=AVIsource("e:\Video\original4.avi").ConvertToRGB32().Crop(4, 0, 152, 240).BicubicResize(290,185).FlipVertical()
d=AVIsource("e:\Video\original4.avi").ConvertToRGB32().Crop(4, 0, 152, 240).FlipHorizontal().FlipVertical().BicubicResize(290,185)

bg1 = StackVertical(StackHorizontal(a,b),StackHorizontal(c,d)).BicubicResize(480,270)
bgall = StackVertical(StackHorizontal(bg1,bg1,bg1,bg1),StackHorizontal(bg1,bg1,bg1,bg1),StackHorizontal(bg1,bg1,bg1,bg1)).BicubicResize(960,540)
return bgall
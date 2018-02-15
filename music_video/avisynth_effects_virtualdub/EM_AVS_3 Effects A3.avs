####################################################
#3. Avisynth Split FX
##
## Maran Emil
## Uploaded on Jan 2, 2012
####################################################

a = AVIsource("e:\Video\original4.avi).ConvertToYUY2().BicubicResize(220,120)
b = AVIsource("e:\Video\original4.avi).ConvertToYUY2().BicubicResize(220,120)
st = StackVertical(StackHorizontal(a,b,a),StackHorizontal(b,a,b),StackHorizontal(a,a,b)).BicubicResize(500,288)
return st
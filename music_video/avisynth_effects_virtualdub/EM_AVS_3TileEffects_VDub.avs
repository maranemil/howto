####################################################
## 3 Tile Effects created with Virtualdub and AviSynth Scripts
##
## Maran Emil
## Published on Jul 17, 2013
####################################################

#------------------------
#1. Example Tile 1+2
#------------------------

#a = AVIsource("e:\Video\original4.avi).ConvertToYUY2().BicubicResize(440,120)
#b = AVIsource("e:\Video\original4.avi).ConvertToYUY2().BicubicResize(220,120)
#c = AVIsource("e:\Video\original4.avi).ConvertToYUY2().BicubicResize(220,120)

#st = StackVertical(a,StackHorizontal(c,b)).BicubicResize(720,460)
#Return st

#------------------------
#2. Example Tile 2+1
#------------------------

a=AVIsource("e:\Video\original4.avi").ConvertToYUY2().BicubicResize(240,120)
b=AVIsource("e:\Video\original4.avi").ConvertToYUY2().BicubicResize(240,120)
c=AVIsource("e:\Video\original4.avi").ConvertToYUY2().BicubicResize(480,240)

st = StackHorizontal(StackVertical(a,b),c).BicubicResize(720,460)
return st

#------------------------
#3. Example Tile + Blur + Loop + Sharpen + Reverse +subtitle
#------------------------

#a = AVIsource("e:\Video\original4.avi).ConvertToYUY2().BicubicResize(440,120).Blur(0.58).Loop(20,20,39).Reverse().subtitle("original4.avi", font="georgia", size=12, text_color=$E9E9E9, align=1)
#b = AVIsource("e:\Video\original4.avi).ConvertToYUY2().AddBorders(0, 126, 0, 126, $000000).Loop(20,20,39).BicubicResize(220,120).Sharpen(0.5).subtitle("original4.avi", font="georgia", size=12, text_color=$E9E9E9, align=1)
#c = AVIsource("e:\Video\original4.avi).ConvertToYUY2().BicubicResize(220,120).Sharpen(0.5).Loop(20,20,39).subtitle("original4.avi", font="georgia", size=12, text_color=$E9E9E9, align=1)

#st = StackVertical(a,StackHorizontal(c,b)).BicubicResize(720,460)
#st = StackVertical(a,StackHorizontal(c,b)).BilinearResize(720,460)
#return st



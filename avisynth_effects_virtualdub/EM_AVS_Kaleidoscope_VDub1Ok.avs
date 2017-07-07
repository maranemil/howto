####################################################
##
## Creating Kaleidoscope Effect with Virtualdub/AviSynth and AviSynth Rotation Plugins
##
## Maran Emil
## Published on Jul 25, 2013
##
####################################################

#loadplugin("c:\Video\rotate.dll&qu�ot;)  #Fizick's AviSynth plugins

#####################
##
## EffectsMany.dll
##
## http://www.avisynth.nl/users/vcmohan/EffectsMany/EffectsMany_index.html
##
#####################

loadplugin("e:\Video\EffectsMany.dll")    #vcmohan's Plugin Filters For AviSynth



a=AVIsource("e:\Video\original4.avi").ConvertToRGB32().BicubicResize(240,185)
b=AVIsource("e:\Video\original4.avi").ConvertToRGB32().FlipHorizontal().BicubicResize(240,185)
c=AVIsource("e:\Video\original4.avi").ConvertToRGB32().BicubicResize(240,185).FlipVertical()
d=AVIsource("e:\Video\original4.avi").ConvertToRGB32().FlipHorizontal().FlipVertical().BicubicResize(240,185)

bg1 = StackVertical(StackHorizontal(a,b),StackHorizontal(c,d)).BicubicResize(480,270)

cd1 = bg1
cd2 = bg1.FlipHorizontal()
cd3 = bg1.FlipVertical()
cd4 = bg1.FlipHorizontal().FlipVertical()

bg2 = StackVertical(StackHorizontal(cd1,cd2),StackHorizontal(cd3,cd4)).BicubicResize(960,540)

#dd1 = bg2.Rotate(35).BicubicResize(960,540)
dd1 = bg2.EffectRotation(last ,last, 350, 45).BicubicResize(960,540)

dd2 = bg2.EffectRotation(last ,last, 350, 45).FlipHorizontal().BicubicResize(960,540)
dd3 = bg2.EffectRotation(last ,last, 350, 45).FlipVertical().BicubicResize(960,540)
dd4 = bg2.EffectRotation(last ,last, 350, 45).FlipHorizontal().FlipVertical().BicubicResize(960,540)

bg3 = StackVertical(StackHorizontal(dd1,dd2),StackHorizontal(dd3,dd4)).BicubicResize(960,540)
return bg3

#1920 x 1080 / 960 x 540 / 480 x 270 / 240 x 185
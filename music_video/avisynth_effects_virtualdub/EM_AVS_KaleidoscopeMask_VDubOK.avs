########################################
## Kaleidoscope Effect created with Virtualdub and AviSynth Script + Mask Image
##
## Maran Emil
## Published on Jul 17, 2013
########################################

a=AVIsource("e:\Video\original4.avi").ConvertToRGB32().Crop(4, 0, 352, 440).BicubicResize(460,540)
b=AVIsource("e:\Video\original4.avi").ConvertToRGB32().Crop(4, 0, 352, 440).FlipHorizontal().BicubicResize(460,540)
c=AVIsource("e:\Video\original4.avi").ConvertToRGB32().Crop(4, 0, 352, 440).BicubicResize(460,540).FlipVertical()
d=AVIsource("e:\Video\original4.avi").ConvertToRGB32().Crop(4, 0, 352, 440).FlipHorizontal().FlipVertical().BicubicResize(460,540)

#.Levels(24,1.251,135,199,24,true)-- invert colors

mk = Imagesource("e:\Video\mask.png").ConvertToRGB32().BilinearResize(854,480) # load the image mask
bg = StackVertical(StackHorizontal(a,b),StackHorizontal(c,d)).BicubicResize(854,480)
top = AviSource("e:\Video\original4.avi").ConvertToRGB32().BilinearResize(854,480).Mask(mk).Invert() # white mask + bg

Layer(bg,top).Sharpen(0.76)
#Subtitle("AviSynth Shake Invert Effect", font="georgia", size=18, text_color=$E9E9E9, align=1)
#.Levels(24,1.251,135,199,24,true)

#1920,1080

# youtube video formats
#1080p: 1920x1080
#720p: 1280x720
#480p: 854x480
#360p: 640x360
#240p: 426x240

# EffectsMany
# http://www.avisynth.nl/users/vcmohan/EffectsMany/EffectsMany_index.html

# Fizick's AviSynth plugins
# http://avisynth.org.ru/fizick.html

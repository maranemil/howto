####################################################
##
## Mixing 2 videos using Virtualdub and AviSynth Scripts
##
## Maran Emil
## Published on Jul 17, 2013
##
####################################################


a=DirectShowSource("e:\Video\original4.avi",fps=60,convertfps=true).ConvertToYUY2().Tweak(hue=0, bright=-10, cont=1.2,sat=0.75 ).BicubicResize(1920,1080)
b=DirectShowSource("e:\Video\original4.avi",fps=60,convertfps=true).ConvertToYUY2().Tweak(hue=0, bright=-10, cont=1.2,sat=0.75 ).BicubicResize(1920,1080)

sm = a.BicubicResize(1920,1080)
sn = b.BicubicResize(1920,1080)

st = Dissolve( SelectEvery(sm, 12, 20) ,SelectEvery(sn, 12, 20) , 30).BicubicResize(1920,1080) # mix
return st.SpatialSoften(2,3,3)



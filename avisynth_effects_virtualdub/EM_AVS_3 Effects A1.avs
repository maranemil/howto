####################################################
#1. Avisynth Shake Invert FX
##
## Maran Emil
## Uploaded on Jan 2, 2012
####################################################

DirectShowSource("e:\Video\original4.avi")
Sharpen(0.76)
Levels(24,1.251,135,199,24,true)
fadein(25)
fadeout(35)
loop(12,189,190)
Subtitle("AviSynth Shake Invert Effect", font="georgia", size=18, text_color=$E9E9E9, align=1)
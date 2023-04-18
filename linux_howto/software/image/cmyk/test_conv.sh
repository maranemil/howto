
rm cmyk4.pdf

# C0, M0, Y0, K100
# C100, M76, Y0, K38 - CMYKA

#gs -o cmyk4.eps \
#      -sDEVICE=eps2write \
#      -dFitPage \
#      -dPDFSETTINGS=/prepress  \
#      -sProcessColorModel=DeviceCMYK  -sColorConversionStrategy=CMYK  -dProcessColorModel=/DeviceCMYK -sColorConversionStrategyForImages=CMYK \
#      VisitenKarte_Emil_Maran_RGB.pdf

gs -o cmyk4.eps -sDEVICE=ps2write \
-c "/osetcolor {/setcolor} bind def /setcolor {pop [0.9 0.7 0] osetcolor} def" \
-f RGB.pdf

identify -verbose cmyk4.eps > cmyk4.txt
#gs -o - -sDEVICE=inkcov RGB.pdf
gs -o - -sDEVICE=inkcov cmyk4.eps

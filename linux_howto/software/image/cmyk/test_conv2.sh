
# diff --color export/input.txt export/output.txt
cd export || exit
rm *.txt
rm log.log

#convert rgb.jpg rgb.pdf

gs -o gray.pdf -sDEVICE=pdfwrite  -dPDFSETTINGS=/prepress -r72 \
 -dProcessColorModel=/DeviceGray -sProcessColorModel=DeviceGray \
 -sColorConversionStrategy=Gray  -sColorConversionStrategyForImages=Gray \
  -f rgb.pdf

#convert -density 1200 -channel CMYK -threshold 75% -strip gray.pdf bw.pdf
convert -threshold 50% -strip -channel cmyk -flatten -alpha Activate gray.pdf bw.pdf

gs -o cmyk.pdf -sDEVICE=pdfwrite -r72 \
 -dProcessColorModel=/DeviceCMYK -sProcessColorModel=DeviceCMYK \
 -sColorConversionStrategy=CMYK -sColorConversionStrategyForImages=CMYK \
 -f bw.pdf

  # \
  #
  #
  # shellcheck disable=SC2215

for i in *.pdf; do identify -verbose "$i" > "$i".txt; done
#identify -verbose export/output3.pdf | grep -i 'color' >> log.txt
#echo '--------------------------------' >> log.txt
for s in *.pdf; do identify -verbose "
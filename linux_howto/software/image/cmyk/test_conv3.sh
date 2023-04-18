######################################################
# test.sh
# C0, M0, Y0, K100
# C100, M46, Y0, K78
######################################################

cd export || exit

# gs -q  -o - -sDEVICE=inkcov gray.pdf
# 0.00000  0.00000  0.00000  0.99801 CMYK OK
# gs -q  -o - -sDEVICE=inkcov bw.pdf
# 0.00000  0.00000  0.00000  0.42295 CMYK OK
# gs -o - -sDEVICE=inkcov cmyk.pdf
# 0.00000  0.00000  0.00000  0.42295 CMYK OK

##convert cmyk.pdf -threshold 85% -strip -channel cmyk -monochrome  -flatten cmyk2.pdf
#convert cmyk.pdf  -strip -channel cmyk -monochrome -colorspace CMYK -flatten cmyk2.pdf # OK CMYK
#gs -o - -sDEVICE=inkcov cmyk2.pdf
#0.00000  0.00000  0.00000  1.00000 CMYK OK - 0,0,0,100 - C0, M0, Y0, K100
#0.00000  0.00000  0.00000  0.42266 CMYK OK - Colorspace: CMYK
#identify -verbose cmyk2.pdf | grep -i colorspace
#identify -verbose cmyk2.pdf | grep -i Colors:
# identify -verbose cmyk2.pdf > cmyk2.txt
# -profile /usr/share/color/icc/colord/Crayons.icc

convert cmyk2.pdf -strip  -colorspace CMYK cmyk3.pdf
identify -verbose cmyk3.pdf | grep -i colorspace
identify -verbose cmyk3.pdf | grep -i Colors:
identify -verbose cmyk3.pdf > cmyk3.txt
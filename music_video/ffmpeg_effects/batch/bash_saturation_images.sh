
##############################################
# batch saturation photos
##############################################

#ffplay -i IMG_20230326_121955.jpg -vf eq=brightness=0.06:saturation=1.9:gamma=0.915,curves=all='0/0 0.9/1 1/1'

mkdir -p conv && for i in *.*; do ffmpeg -i $i -vf eq=brightness=0.06:saturation=1.9:gamma=0.915 conv/$i.png; done
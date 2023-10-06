
##############################################
#   batch enhance image
##############################################

#https://superuser.com/questions/370920/auto-image-enhance-for-ubuntu

#mkdir -p conv && for file in *.*; do convert -enhance -equalize -contrast $file conv/"${file%.jpg}_new.png";done
#mkdir -p conv && for file in *.*; do convert -enhance $file conv/"${file%.jpg}_new.png";done

mkdir -p conv && for file in *.*; do convert -auto-gamma -auto-level -normalize $file conv/"${file%.jpg}_new.png";done

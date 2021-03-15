# https://ffmpeg.org/ffmpeg-filters.html#rgbashift

# rgbashift
ffplay -i in.mp4 -vf "scale=-2:480,bbox=min_val=2,pad=iw+0:ih+5:0:5:#ffffff,rgbashift=rh=50:rv=-50:gh=-1:bh=-1:bv=-50:edge=smear"

# rgbashift
ffplay -i in.mp4 -vf "scale=-2:480,bbox=min_val=2,pad=iw+0:ih+5:0:5:#ffffff,rgbashift=rh=50:rv=-50:gh=-1:bh=-1:bv=-50:av=10"


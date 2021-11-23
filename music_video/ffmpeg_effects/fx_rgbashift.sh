# https://ffmpeg.org/ffmpeg-filters.html#rgbashift

# rgbashift
ffplay -i in.mp4 -vf "scale=-2:480,bbox=min_val=2,pad=iw+0:ih+5:0:5:#ffffff,rgbashift=rh=50:rv=-50:gh=-1:bh=-1:bv=-50:edge=smear"

# rgbashift
ffplay -i in.mp4 -vf "scale=-2:480,bbox=min_val=2,pad=iw+0:ih+5:0:5:#ffffff,rgbashift=rh=50:rv=-50:gh=-1:bh=-1:bv=-50:av=10"

#fx
ffplay -i in.mp4 -vf rgbashift=rv=5:bv=-5
ffplay -i in.mp4 -vf rgbashift=rv=0:gv=0:bv=0
ffplay -i in.mp4 -vf rgbashift=gh=20:bh=10:bv=10
ffplay -i in.mp4 -vf rgbashift=rh=15:bv=15:gh=-15
ffplay -i in.mp4 -vf rgbashift=rh=-10
ffplay -i in.mp4 -vf rgbashift=rh=-25:rv=250:gh=-250:gv=5:bh=-250:bv=250:ah=-25:av=250


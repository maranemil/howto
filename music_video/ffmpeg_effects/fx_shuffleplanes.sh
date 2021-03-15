# shuffleframes + shuffleplanes + rgbashift
ffplay -i in.mp4 -vf "scale=-2:480,bbox=min_val=2,pad=iw+0:ih+5:0:5:#ffffff,rgbashift=rh=50:rv=-50:gh=-1:bh=-1:bv=-50:av=10,shuffleframes=3 2 1 0,shuffleplanes=0:2:1:3,smartblur=lr=0.5,stereo3d=ar:al"

# shuffleframes + shuffleplanes + rgbashift
ffplay -i in.mp4 -vf "scale=-2:480,rgbashift=rh=1:rv=-1:gh=-1:bh=-1:bv=-1:av=1,shuffleframes=4 3 2 1 0,shuffleplanes=0:2:1:3"

# shuffleframes + shuffleplanes + rgbashift
ffplay -i in.mp4 -vf "scale=-2:480,rgbashift=rh=2:rv=-10:gh=-1:bh=-10:bv=-1:av=1,shuffleframes=4 3 2 1 0,shuffleplanes=0:2:1:3"

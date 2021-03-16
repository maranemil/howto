
# star wars text perspective
ffplay -f lavfi -i testsrc -vf pad="iw+4:ih+4:2:2:0x00000000",perspective=x0=W/4:y0=H/4:x1=3*W/4:y1=H/4:sense=destination

# perspective twist
ffplay -f lavfi -i testsrc -vf perspective=x0=200:y0=100:x1=200:y1=200:sense=destination

# perspective distorsion
ffplay -f lavfi -i testsrc -vf perspective=x0=-800:y0=-800:x2=+500:y2=H+100:sense=destination

# perspective + overlay
ffmpeg -i in.mp4 -i in.mp4 -filter_complex  "[1:v] fade=in:10:1:alpha=1, fade=out:5000:1:alpha=1, scale=480:480, perspective=x0=0:y0=0:x1=W:y1=40, rotate=-0.45:c=none [ov]; [0:v][ov] overlay=100:100 [v]" -map "[v]" -y out.mp4

ffmpeg -i in.mp4 -i in.mp4 -filter_complex  "[1] fade=in:10:1:alpha=1, fade=out:5000:1:alpha=1, scale=480:480, perspective=x0=0:y0=0:x1=W:y1=40, rotate=-0.45:c=none [ov1];[1] fade=in:10:1:alpha=1, fade=out:5000:1:alpha=1, scale=480:480, perspective=x0=0:y0=0:x1=W:y1=40, rotate=0.45:c=none [ov2]; [0][ov1] overlay=100:100 [v1]; [v1][ov2] overlay=W-680:100 [v] " -map "[v]" out.mp4

# postcard perspective
ffmpeg -y -i in.mp4 -i in.mp4 -filter_complex "[0]format=bgra[v0]; [1]colorkey=color=black,perspective=x0=0:y0=0:x1=W:y1=180, scale=-1:420, rotate=-0.1745:c=none:ow=rotw(-0.1745):oh=roth(-0.1745)[v1];  [v0][v1] overlay=100:100:eof_action=pass [v]" -map "[v]" out.mp4

# perspective + Flip Horizontal + Interpolate Between
ffplay -i in.mp4 -vf "hflip,perspective=60:90:889:147:50:615:882:618:enable='not(between(n,1,40)+between(n,70,130))'"

# lenscorrection
ffplay -i in.mp4 -vf lenscorrection=k1=-0.86:k2=0.5
ffplay -i in.mp4 -vf lenscorrection=k1=-0.56:k2=0.3
ffplay -i in.mp4 -vf lenscorrection=k1=-0.227:k2=-0.022
ffplay -i in.mp4 -vf lenscorrection=k1=-0.08101:k2=0

# saturate
ffplay -i in.mp4 -vf "hue=s=4:h=3,eq=saturation=1.2:gamma=0.8:brightness=0.1:contrast=1.8" -an

# perspective fx
ffplay -i in.mp4 -vf "perspective=660:690:88:147:150:615:982:868,rgbashift=rh=5:rv=-5:gh=-1:bh=-1:bv=-5,shuffleframes=4 3 2 1 0,shuffleplanes=0:2:1:3,hue=s=4:h=3,eq=saturation=1.2:gamma=0.8:brightness=0.1:contrast=1.8"

# perspective fx
ffplay -i in.mp4 -vf "perspective=660:690:118:147:150:615:982:868,rgbashift=rh=5:rv=-5:gh=-1:bh=-1:bv=-5,shuffleframes=4 3 2 1 0,shuffleplanes=0:2:1:3,hue=s=4:h=3,eq=saturation=1.2:gamma=0.8:brightness=0.1:contrast=1.8"

# perspective fx
ffplay -i in.mp4 -vf "perspective=860:1160:881:817:915:1315:782:868,hue=s=10:h=10,eq=gamma=0.5:brightness=0.4:contrast=0.6,vflip"





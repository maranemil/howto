ffplay -i in.mp4 -vf "scale=iw*4:ih*4,zoompan=z='if(lte(mod(on,40),20),zoom+0.018,zoom-0.018)':x='iw/2-(iw/zoom)/2':y='ih/2-(ih/zoom)/2':d=5*2:fps=29.97,hue=s=1,shuffleframes=2 1 0,shuffleplanes=0:2:1:3"

ffplay -i in.mp4 -vf "scale=iw*4:ih*4,zoompan=z='if(lte(mod(on,40),20),zoom+0.018,zoom-0.018)':x='iw/2-(iw/zoom)/2':y='ih/2-(ih/zoom)/2':d=2*2:fps=25,hue=s=3,shuffleframes=1 0,shuffleplanes=0:2:1:3"

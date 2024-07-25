

ffmpeg -i in.mp3 -filter:a arnndn=model=bd.rnnn -codec:a pcm_s24le nrd.wav

#https://github.com/richardpl/arnndn-models
#https://github.com/GregorR/rnnoise-models
#https://www.youtube.com/watch?v=qPrAtVG-u3E

##########################
Mandebrot Sequence 4K@60 rendered with FFMPEG
##########################

# https://www.youtube.com/watch?v=Wb038_pTsx4

ffplay -f lavfi -i mandelbrot=s=3840x2160:rate=60:outer=iteration_count:start_x=0.2550075:start_y=-0.495006

ffplay -f lavfi -i mandelbrot=s=1920x1080:rate=30:outer=iteration_count:start_x=0.36455:start_y=-0.316
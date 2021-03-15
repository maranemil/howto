#https://stackoverflow.com/questions/54547061/ffmpeg-animation-zoom-in-and-zoom-out
#https://superuser.com/questions/684747/zoom-video-using-ffmpeg-commands
#https://www.reddit.com/r/ffmpeg/comments/j320ul/how_to_zoom_in_and_out_video_every_x_second/

# zoom in x2
ffplay -i in.mp4 -vf "scale=2*iw:-1, crop=iw/2:ih/2"

# zoom in x2
ffplay -i in.mp4  -vf "zoompan=z='if(lte(mod(time,10),3),2,1)':d=1:x=iw/2-(iw/zoom/2):y=ih/2-(ih/zoom/2):fps=29.97"

# zoom in x2
ffplay -i in.mp4  -vf "zoompan=z='if(gte(time,ld(1)+10),st(1,time)*0,if(ld(1),if(lt(time,ld(1)+3),2,1)))':d=1:x=iw/2-(iw/zoom/2):y=ih/2-(ih/zoom/2):fps=29.97"

#zoom in and out
ffplay -i in.mp4 -vf "scale=iw*4:ih*4,zoompan=z='if(lte(mod(on,60),30),zoom+0.002,zoom-0.002)':x='iw/2-(iw/zoom)/2':y='ih/2-(ih/zoom)/2':d=25*5"



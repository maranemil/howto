# import numpy as np
import cv2, pafy
# from pprint import pprint



"""
# https://www.youtube.com/watch?v=j3a-ZaVtyRc
# https://www.youtube.com/watch?v=u9DzwcptbrM
# https://www.youtube.com/watch?v=ZvHXpd9uzN4


# youtube-dl -F  https://www.youtube.com/watch?v=ZvHXpd9uzN4

249          webm       audio only DASH audio   49k , opus @ 50k, 6.23MiB                                                                                                                                
250          webm       audio only DASH audio   59k , opus @ 70k, 7.02MiB                                                                                                                                
171          webm       audio only DASH audio   86k , vorbis@128k, 10.59MiB                                                                                                                              
251          webm       audio only DASH audio  102k , opus @160k, 12.79MiB                                                                                                                               
140          m4a        audio only DASH audio  128k , m4a_dash container, mp4a.40.2@128k, 17.38MiB                                                                                                       
278          webm       256x144    144p  107k , webm container, vp9, 30fps, video only, 13.31MiB                                                                                                         
160          mp4        256x144    144p  115k , avc1.4d400c, 30fps, video only, 15.05MiB                                                                                                                 
242          webm       426x240    240p  245k , vp9, 30fps, video only, 30.49MiB                                                                                                                         
133          mp4        426x240    240p  251k , avc1.4d4015, 30fps, video only, 33.57MiB                                                                                                                 
243          webm       640x360    360p  586k , vp9, 30fps, video only, 57.03MiB                                                                                                                         
134          mp4        640x360    360p  646k , avc1.4d401e, 30fps, video only, 80.36MiB                                                                                                                 
244          webm       854x480    480p  969k , vp9, 30fps, video only, 104.67MiB                                                                                                                        
135          mp4        854x480    480p 1171k , avc1.4d401f, 30fps, video only, 152.82MiB                                                                                                                
247          webm       1280x720   720p 2221k , vp9, 30fps, video only, 210.58MiB                                                                                                                        
136          mp4        1280x720   720p 2349k , avc1.4d401f, 30fps, video only, 308.00MiB                                                                                                                
248          webm       1920x1080  1080p 4023k , vp9, 30fps, video only, 372.24MiB
137          mp4        1920x1080  1080p 4414k , avc1.640028, 30fps, video only, 577.03MiB
264          mp4        2560x1440  1440p 10644k , avc1.640032, 30fps, video only, 1.34GiB
271          webm       2560x1440  1440p 11464k , vp9, 30fps, video only, 1.19GiB
313          webm       3840x2160  2160p 21990k , vp9, 30fps, video only, 2.38GiB
17           3gp        176x144    small , mp4v.20.3, mp4a.40.2@ 24k
36           3gp        320x180    small , mp4v.20.3, mp4a.40.2
43           webm       640x360    medium , vp8.0, vorbis@128k
18           mp4        640x360    medium , avc1.42001E, mp4a.40.2@ 96k
22           mp4        1280x720   hd720 , avc1.64001F, mp4a.40.2@19

 youtube-dl     --format 133  https://www.youtube.com/watch?v=ZvHXpd9uzN4 


 https://stackoverflow.com/questions/21983062/in-python-opencv-is-there-a-way-to-quickly-scroll-through-frames-of-a-video-all
http://answers.opencv.org/question/94012/is-opencvs-videocaptureread-function-skipping-frames/



"""
"""
url = "https://www.youtube.com/watch?v=ZvHXpd9uzN4"
videoPafy = pafy.new(url)
best = videoPafy.getbest(preftype="mp4")
video = cv2.VideoCapture(best.url)
pprint(best)
exit()
"""

frame_count = 0
video = "Dri.mp4";
cap = cv2.VideoCapture(video)
# find fps of video file
fps = cap.get(cv2.CAP_PROP_FPS)
spf = 2 / fps
print "Frames per second using cap.get(cv2.CAP_PROP_FPS) : {0}".format(fps)
print "Seconds per frame using 1/fps :", spf

# https://www.programcreek.com/python/example/72134/cv2.VideoWriter
# https://docs.opencv.org/2.4/modules/highgui/doc/reading_and_writing_images_and_video.html
# https://scottontechnology.com/flip-image-opencv-python/
# https://docs.opencv.org/3.1.0/dd/d43/tutorial_py_video_display.html

# cv2.VideoWriter_fourcc(*'MJPG')
# cv2.cv.CV_FOURCC(*'mp42')
# VideoWriter_fourcc(*'DIVX')

# fourcc = cv2.VideoWriter_fourcc(*'DIVX')
# out = cv2.VideoWriter('output.avi',fourcc, 10.0, (640,480),True)
# out = cv2.VideoWriter("output.avi", fourcc, float(spf), (640, 480))
# vid = VideoWriter(outvid, fourcc, float(fps), size, is_color)

while (cap.isOpened()):
    ret, frame = cap.read()
    frame_count = frame_count + 1

    if ret == False:
        break

    else:
        frame = cv2.flip(frame, 1)

        # out.write(frame)

        gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
        ret, thresh = cv2.threshold(gray, 127, 227, 1)  # 127,255,1
        _, contours, h = cv2.findContours(thresh, 1, 2)

        for cnt in contours:
            if cv2.contourArea(cnt) > 290:
                #    approx = cv2.approxPolyDP(cnt,0.01*cv2.arcLength(cnt,True),True)
                approx = cv2.approxPolyDP(cnt, 0.02 * cv2.arcLength(cnt, True), True)
                # print len(approx)
                if len(approx) == 4:
                    # print "square"
                    cv2.drawContours(gray, [cnt], -1, (255, 0, 0), -1)  # classic overlay without transparency

                """
                # make a copy
                imblur = gray.copy()
                # get position square
                M = cv2.moments(cnt)
                cX = int(M["m10"] / M["m00"])
                cY = int(M["m01"] / M["m00"])
                x, y, w, h = cv2.boundingRect(cnt)
                # add shape
                cv2.rectangle(imblur, (cX-40, cY), (cX+65, cY+1), (255, 255, 255), 20, -1)
                # cv2.rectangle(imblur, (420, 205), (595, 385), (0, 0, 255), -1)
                # add overlay with transparency
                cv2.addWeighted(gray, 0.6, imblur, 0.9, 0, gray)
                """
                cv2.imshow('frame', gray)
            else:
                cv2.imshow('frame', gray)

        if cv2.waitKey(1) & 0xFF == ord('q'):
            break

cap.release()
# out.release()
cv2.destroyAllWindows()
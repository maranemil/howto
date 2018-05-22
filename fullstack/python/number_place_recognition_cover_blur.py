import numpy as np
import cv2

img = cv2.imread('test0.jpg')
gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

ret, thresh = cv2.threshold(gray, 127, 255, 1)  # 127,255,1
_, contours, h = cv2.findContours(thresh, 1, 2)

for cnt in contours:
    if cv2.contourArea(cnt) > 2290:
        #    approx = cv2.approxPolyDP(cnt,0.01*cv2.arcLength(cnt,True),True)
        approx = cv2.approxPolyDP(cnt, 0.02 * cv2.arcLength(cnt, True), True)
        print len(approx)
        if len(approx) == 5:
            print "pentagon"
            # cv2.drawContours(img,[cnt],0,255,-1)
        elif len(approx) == 3:
            print "triangle"
            # cv2.drawContours(img,[cnt],0,(0,255,0),-1)
        elif len(approx) == 4:
            print "square"
            #cv2.drawContours(img, [cnt], 0, (127, 127, 127), -1) // classic overlay without transparency

            # make a copy
            imblur = img.copy()
            # get position square
            M = cv2.moments(cnt)
            cX = int(M["m10"] / M["m00"])
            cY = int(M["m01"] / M["m00"])
            x, y, w, h = cv2.boundingRect(cnt)
            # add shape
            cv2.rectangle(imblur, (cX-40, cY), (cX+65, cY+1), (255, 255, 255), 20, -1)
            # cv2.rectangle(imblur, (420, 205), (595, 385), (0, 0, 255), -1)
            # add overlay with transparency
            cv2.addWeighted(img, 0.6, imblur, 0.9, 0, img)

            #bounding = cv2.boundingRect(cnt)
            #mask = np.zeros((img.shape[0], img.shape[1]), np.uint8)
            #mask = np.zeros(img.shape, np.uint8)
            #cv2.drawContours(mask, [cnt], -1, (127, 127, 127), -1)

        elif len(approx) == 9:
            print "half-circle"
            # cv2.drawContours(img,[cnt],0,(255,255,0),-1)
        elif len(approx) > 15:
            print "circle"
            # cv2.drawContours(img,[cnt],0,(0,255,255),-1)

cv2.imshow('img', img)
cv2.waitKey(0)
cv2.destroyAllWindows()


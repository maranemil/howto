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

# https://readthedocs.org/projects/pyserial/downloads/pdf/latest/
# https://pyserial.readthedocs.io/en/latest/pyserial_api.html

import sys ,os
import time
# from serial import Serial
from io import StringIO
import itertools
import serial

print(serial.VERSION)
ser = serial.Serial("/dev/pts/2", 9600, timeout=None)
ser.write('hello'.encode('utf-8'))
"""
while True:
    # Read a line and convert it from b'xxx\r\n' to xxx
    line = ser.readline().decode('utf-8')[:-1]
    if line:  # If it isn't a blank line
        print(line)
        #break
ser.close()
exit()
"""

ser.flushInput()
print("connected to: " + ser.portstr)
print("----------------------------------------------------------------------------")
seq = []
list = []

while True:
    for c in ser.read():
        seq.append(chr(c))
        joined_seq = ''.join(str(v) for v in seq)
        if chr(c) == '\n':
            buf = StringIO(str(joined_seq).replace('\r\n', ''))
            # -------------------------------------------------------------------------
            for x in buf.readlines():
                value = x.split(':')
                index_of_interest = 1
                rest_of_file = itertools.islice(value, index_of_interest, None, 3)
                all_values = ''
                # -------------------------------------------------------------------------
                for line in rest_of_file:
                    output = ' '.join(line.split())
                    if output[0:1:1].isdigit():
                        all_values = output.split()[0]
                    else:
                        if value[1].split()[0] == 'No':
                            all_values = value[2].split()[0]
                        else:
                            all_values = output
                            list.append(all_values)

                final = ';'.join(list)
                print(final)
                # seq = []
                break
                ser.close()

# -------------------------------------------------------------------------





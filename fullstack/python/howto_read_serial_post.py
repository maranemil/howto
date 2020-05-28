
# pip3 install pyserial
import sys ,os
# import serial, time
import serial
# from serial import Serial
from io import StringIO
import itertools

# COM1 COM3 /dev/ttyUSB0 /dev/ttyUSB0
# ls -l /dev/tty*
# ls /dev/tty*
# dmesg
# dmesg | grep -i tty -> printk: console [tty0] enabled
# groups ${USER}
# sudo gpasswd --add ${USER} dialout
# sudo adduser $USER dialout
# newgrp dialout
# sudo adduser $USER  tty

# sudo usermod -a -G dialout $USER
# sudo usermod -a -G tty $USER
# lsusb
# dmesg|tail
# lsusb -v -d 1307:0310

# sudo apt install screen
# sudo screen /dev/ttyUSB0
# lsusb
# ls /dev/ttyUSB*
# usb-devices
# udevadm trigger
# udevadm control --reload-rules
# dmesg | egrep --color 'serial|ttyS'
# sudo stty -F /dev/ttyS0 57600 parodd
# setserial -g /dev/ttyS0
# sudo chmod a+rw /dev/ttyACM0
# chmod g+w /dev/ttyS0

# cat /dev/ttyS0
# echo -e "\x7E\x03\xD0\xAF und normaler Text" > /dev/ttyS0

"""
stty -speed 19200 < /dev/ttyS0 # sets the speed of the port
exec 99<>/dev/ttyS0 (or /dev/ttyUSB0...etc)
printf "AT\r" >&99
read answer <&99  # this reads just a CR
read answer <&99  # this reads the answer OK
exec 99>&-
"""

"""
stty -F /dev/ttyUSB0 115200 raw -echo   #CONFIGURE SERIAL PORT
exec 3</dev/ttyUSB0                     #REDIRECT SERIAL OUTPUT TO FD 3
  cat <&3 > /tmp/ttyDump.dat &          #REDIRECT SERIAL OUTPUT TO FILE
  PID=$!                                #SAVE PID TO KILL CAT
    echo "R" > /dev/ttyUSB0             #SEND COMMAND STRING TO SERIAL PORT
    sleep 0.2s                          #WAIT FOR RESPONSE
  kill $PID                             #KILL CAT PROCESS
  wait $PID 2>/dev/null                 #SUPRESS "Terminated" output

exec 3<&-                               #FREE FD 3
cat /tmp/ttyDump.dat                    #DUMP CAPTURED DATA
"""

# https://pyserial.readthedocs.io/en/latest/pyserial_api.html
# https://www.cyberciti.biz/hardware/5-linux-unix-commands-for-connecting-to-the-serial-console/
# https://pyserial.readthedocs.io/en/latest/shortintro.html
# sudo apt install setserial
# setserial -g /dev/ttyS[0123]
# ls -l /dev/ttyS0


# os.system('clear')
# /dev/tty2

ser = serial.Serial(
    port='/dev/ttyS1', \
    baudrate=9600, \
    parity=serial.PARITY_NONE, \
    stopbits=serial.STOPBITS_ONE, \
    bytesize=serial.EIGHTBITS, \
    timeout=5)

# ser.open()
# time.sleep(1)

# ser.write("Hello world")
# x = ser.readline()
# print(x)

time.sleep(1)  # give the connection a second to settle
msg = "Hello from Python";
ser.write(msg.encode())
while True:
    data = ser.readline()
    if data:
        print (data.rstrip('\n'))
        ser.close()


exit();

ser.flushInput()
print("connected to: " + ser.portstr)
print("----------------------------------------------------------------------------")
seq = []
list = []
buf = ""
while True:
    for c in ser.read():
        seq.append(chr(c))
        joined_seq = ''.join(str(v) for v in seq)
        if chr(c) == '\n':
            buf = StringIO(str(joined_seq).replace('\r\n' ,''))
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
            seq = []
            print(final)
            break
# -------------------------------------------------------------------------
ser.close()
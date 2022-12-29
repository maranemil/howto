### Installing NordVPN on 
#### Debian, Ubuntu, Raspberry Pi, Elementary OS & Linux Mint 2022
~~~
https://support.nordvpn.com/Connectivity/Linux/1047409422/How-can-I-connect-to-NordVPN-using-Linux-Terminal.htm
https://support.nordvpn.com/Connectivity/Linux/1325531132/Installing-and-using-NordVPN-on-Debian-Ubuntu-Raspberry-Pi-Elementary-OS-and-Linux-Mint.htm
https://techrobot.com/how-to-set-up-and-use-nordvpn-on-linux/
https://support.nordvpn.com/Connectivity/Linux/1322207652/Troubleshooting-connectivity-Linux.htm
~~~
~~~
sudo dpkg -i nordvpn-release_1.0.0_all.deb

sh <(wget -qO - https://downloads.nordcdn.com/apps/linux/install.sh)

sudo usermod -aG nordvpn $USER

sudo nordvpn login
sudo nordvpn connect


sudo apt update
sudo apt-get install nordvpn
sudo usermod -aG nordvpn $USER
sudo nordvpn login
nordvpn connect

sudo apt-get install openvpn
cd /etc/openvpn
sudo wget https://downloads.nordcdn.com/configs/archives/servers/ovpn.zip
sudo apt-get install ca-certificates
sudo apt-get install unzip
sudo unzip ovpn.zip
sudo rm ovpn.zip

UDP: cd /etc/openvpn/ovpn_udp/
TCP: cd /etc/OpenVPN/ovpn_tcp/


sudo openvpn [file name]
~~~


######
#
###   OpenVPN  NordVPN
####   https://nordvpn.com/de/
####  https://nordvpn.com/de/tutorials/linux/openvpn/
######
~~~
sudo apt-get install openvpn
cd /etc/openvpn
sudo wget https://downloads.nordcdn.com/configs/archives/servers/ovpn.zip
sudo apt-get install ca-certificates
sudo apt-get install unzip
sudo unzip ovpn.zip
sudo rm ovpn.zip
cd /etc/openvpn/ovpn_udp/
# cd /etc/openvpn/ovpn_tcp/
ls -al
# sudo openvpn [file name]
sudo openvpn us842.nordvpn.com.udp.ovpn
sudo openvpn /etc/openvpn/ovpn_udp/us842.nordvpn.com.udp.ovpn

# GUI
sudo apt-get install network-manager-openvpn-gnome
sudo add-apt-repository universe
sudo apt-get update
sudo service network-manager restart

# speed
https://thebestvpn.com/fastest-vpns/
https://www.expressvpn.com/de/what-is-vpn/vpn-speed-test
~~~



######
###	NordVPN install
######
~~~
https://ucp.nordvpn.com/login/
https://nordvpn.com/de/download/linux/
https://nordvpn.com/de/tutorials/linux/openvpn/
https://repo.nordvpn.com/deb/nordvpn/debian/pool/main/nordvpn-release_1.0.0_all.deb
https://repo.nordvpn.com/deb/nordvpn/debian/pool/main/nordvpn-release_1.0.0_all.deb
sudo dpkg -i nordvpn-release_1.0.0_all.deb

sudo apt-get install openvpn
cd /etc/openvpn
sudo wget https://downloads.nordcdn.com/configs/archives/servers/ovpn.zip
sudo apt-get install ca-certificates
sudo apt-get install unzip
sudo unzip ovpn.zip
sudo rm ovpn.zip
cd /etc/openvpn/ovpn_udp/
cd /etc/openvpn/ovpn_tcp/
ls -al
sudo openvpn [file name]
sudo openvpn [file name]
sudo openvpn /etc/openvpn/ovpn_udp/[file name]

Enter Auth Username: user@example.com
Enter Auth Password: ************

----------------------------
select random vpn file
----------------------------
ls | shuf -n 1
ls . | shuf -n 1
find . -type f | shuf -n 1
ls |sort -R |tail -$N |while read file; do echo $file; done
~~~




### NordVPN 2022
######
~~~
https://askubuntu.com/questions/1130740/cant-connect-using-nordvpn
https://support.nordvpn.com/Connectivity/Linux/1322207652/Troubleshooting-connectivity-Linux.htm
https://nordvpn.com/de/download/linux/#
https://support.nordvpn.com/Connectivity/Linux/1325531132/Installing-and-using-NordVPN-on-Debian-Ubuntu-Raspberry-Pi-Elementary-OS-and-Linux-Mint.htm


sudo apt-get --purge remove nordvpn*
sudo dpkg -P nordvpn && sudo dpkg -P nordvpn-release 

sudo dpkg -i /pathToFile/nordvpn-release_1.0.0_all.deb

sudo apt update 
sudo apt install nordvpn
nordvpn login
nordvpn connect
~~~


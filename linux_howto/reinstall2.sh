#!/bin/bash

###############################################################
#
# Restore Ubuntu Software/Settings after new Install
# fresh install ubuntu 18.04
#
###############################################################

sudo apt install chromium-browser -y
sudo apt install gimp -y
sudo apt install filezilla -y
sudo apt install gnome-commander -y
sudo apt install git -y

##### Config Git on new location
git config --global user.name "Administrator"
git config --global user.email "admin@example.com"


sudo apt install virtualbox -y
sudo apt install keepass2 -y
sudo apt install ffmpeg -y
sudo apt install mysql-workbench -y

sudo apt-get install htop -y
sudo apt-get install p7zip -y
sudo apt-get install audacity -y
sudo apt-get install openshot -y
sudo apt-get install gnome-mpv -y

# sublime-text
wget https://download.sublimetext.com/sublime-text_build-3083_amd64.deb
sudo dpkg -i sublime-text_build-3083_amd64.deb

# dbeaver
wget https://dbeaver.jkiss.org/files/dbeaver-ce_latest_amd64.deb
sudo dpkg -i dbeaver-ce_latest_amd64.deb

# Sqlectron
wget https://github.com/sqlectron/sqlectron-gui/releases/download/v1.29.0/Sqlectron_1.29.0_amd64.deb
sudo dpkg -i Sqlectron_1.29.0_amd64.deb

#https://downloads.mysql.com/archives/get/file/mysql-workbench-community-6.3.9-1ubuntu16.04-amd64.deb
#https://downloads.mysql.com/archives/get/file/mysql-workbench-community-6.3.9-1ubuntu16.10-amd64.deb

# Visual Studio Code
wget https://packages.microsoft.com/repos/vscode/pool/main/c/code/code_1.23.1-1525968403_amd64.deb
sudo dpkg -i code_1.23.1-1525968403_amd64.deb

# Peek Gif Screen Resorder
# https://github.com/phw/peek#ubuntu
sudo add-apt-repository ppa:peek-developers/stable
sudo apt update
sudo apt install peek -y
sudo apt --fix-broken install
sudo apt install peek -y

# https://confluence.jetbrains.com/display/PhpStorm/Previous+PhpStorm+Releases
# https://www.jetbrains.com/phpstorm/download/#section=linux
# https://www.jetbrains.com/pycharm/download/#section=linux
# pycharm-community-2018.2.tar.gz
# PhpStorm-2018.1.5.zip
# https://download.jetbrains.com/python/pycharm-community-2018.2.1.tar.gz
# http://download.jetbrains.com/webide/PhpStorm-2018.1.6.tar.gz


# install nvidia
sudo apt-get update
sudo apt-get install nvidia-390 # ubuntu 18.10
sudo apt-get install nvidia-384 # ubuntu 18.04


exit









# ------------------------------------- extra -------------------------------

#############################################
#
#	Config Bash
#
#############################################


# add in /home/emil/.bashrc
alias deo1ssh='ssh -Ax emil@mm.example.org'
alias deo1='sudo mount -v -o noatime -t nfs 192.168.1.1:/home/emil/ dev_mount/'

cd ~/
mkdir dev_mount


#############################################
#
#	Generating a new SSH key
#
#############################################

# https://help.github.com/articles/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent/
# https://help.github.com/articles/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent/
# https://help.github.com/articles/checking-for-existing-ssh-keys/

ssh-keygen -t rsa -b 4096 -C "your_email@example.com"

eval "$(ssh-agent -s)"
# Agent pid 59566

# Reimport SSH KEY
cp /path/to/my/key/id_rsa ~/.ssh/id_rsa
cp /path/to/my/key/id_rsa.pub ~/.ssh/id_rsa.pub

chmod 400 ~/.ssh/id_rsa
ssh-add ~/.ssh/id_rsa

#############################################
#
#	Install NFS for mount
#
#############################################

# https://wiki.ubuntuusers.de/NFS/
# https://kerneltalks.com/troubleshooting/mount-nfs-requested-nfs-version-or-transport-protocol-is-not-supported/
# https://help.ubuntu.com/community/SettingUpNFSHowTo

sudo apt install -y nfs-server
sudo apt-get install nfs-common
sudo apt-get install nfs-kernel-server

sudo systemctl enable nfs-kernel-server
sudo systemctl enable rpcbind.service
sudo systemctl enable nfs-kernel-server.service
sudo systemctl restart rpcbind
sudo systemctl restart nfs-kernel-server

sudo service nfs-kernel-server restart
sudo service nfs status
sudo service nfs start
# Failed to start nfs.service: Unit nfs.service not found

systemctl status nfs-kernel-server.service
sudo systemctl restart nfs-kernel-server.service

sudo mount -v -o noatime -t nfs 192.168.1.1:/home/emil/ dev_mount/
# mount.nfs: requested NFS version or transport protocol is not supported

sudo ps -A | grep nfs

find /etc/systemd/ -name nfs-server.service
/etc/systemd/system/multi-user.target.wants/nfs-server.service

sudo systemctl nfs-server start
Unknown operation nfs-server.

sudo systemctl unmask idmapd
Unit idmapd.service does not exist, proceeding anyway.

sudo apt-get update
sudo apt-get install --reinstall nfs-common nfs-kernel-server

# sudo apt-get purge nfs-common nfs-kernel-server
# sudo apt-get install nfs-common nfs-kernel-server

systemctl status nfs.service
Unit nfs.service could not be found.

sudo systemctl start nfs-server.service

systemctl list-dependencies nfs-kernel-server
nfs-kernel-server.service
● ├─auth-rpcgss-module.service
● ├─nfs-config.service
● ├─nfs-idmapd.service
● ├─nfs-mountd.service
● ├─proc-fs-nfsd.mount
● ├─rpc-svcgssd.service
● ├─rpcbind.socket
● ├─system.slice
● └─network.target

systemctl list-dependencies nfs-mountd.service
nfs-mountd.service
● ├─nfs-config.service
● ├─nfs-server.service
● ├─proc-fs-nfsd.mount
● └─system.slice


lsb_release -rd

# Description:	Ubuntu 18.04.1 LTS
# Release:	18.04

apt-cache policy nfs-kernel-server
nfs-kernel-server:
  Installed: 1:1.3.4-2.1ubuntu5
  Candidate: 1:1.3.4-2.1ubuntu5
  Version table:
 *** 1:1.3.4-2.1ubuntu5 500
        500 http://de.archive.ubuntu.com/ubuntu bionic/main amd64 Packages
        100 /var/lib/dpkg/status



sudo dpkg --configure nfs-kernel-server

# dpkg: error processing package nfs-kernel-server (--configure):
#  package nfs-kernel-server is already installed and configured
# Errors were encountered while processing:
#  nfs-kernel-server

dpkg -l | grep nfs-kernel-server

# ii  nfs-kernel-server                                           1:1.3.4-2.1ubuntu5                  amd64        support
# for NFS kernel server



##########################################################
#
#   Install GNOME_Tweak_Tool
#
###########################################################

https://wiki.ubuntuusers.de/GNOME_Tweak_Tool/

sudo apt-get install gnome-tweak-tool
sudo apt install gnome-tweak-tool
gnome-tweaks

gnome-shell --version
GNOME Shell 3.28.2

sudo apt install gnome-shell-extensions

gsettings set org.gnome.shell.extensions.dash-to-dock dock-position BOTTOM
gsettings set org.gnome.shell.extensions.dash-to-dock isolate-workspaces true
gsettings set org.gnome.shell.extensions.dash-to-dock isolate-workspaces true

# https://www.ubuntupit.com/19-best-gnome-shell-extensions-ubuntu-gnome-desktop/
# https://extensions.gnome.org/extension/602/window-list/
https://wiki.gnome.org/Projects/GnomeShellIntegrationForChrome/Installation


##########################################################################
#
#   Find Linux / UNIX Kernel Version Command
#   https://www.cyberciti.biz/faq/howto-find-out-what-kernel-version-running/
#   https://www.cyberciti.biz/faq/find-print-linux-unix-kernel-version/
#   https://www.tecmint.com/find-linux-kernel-version-distribution-name-version-number/
#
##########################################################################

uname -a
uname -r
uname -mrsn
cat /proc/version
cat /etc/os-release

  -a, --all                print all information
  -s, --kernel-name        print the kernel name
  -n, --nodename           print the network node hostname
  -r, --kernel-release     print the kernel release
  -v, --kernel-version     print the kernel version
  -m, --machine            print the machine hardware name
  -p, --processor          print the processor type or "unknown"
  -i, --hardware-platform  print the hardware platform or "unknown"
  -o, --operating-system   print the operating system

##########################################################################
#
#  Debian install VBoxLinuxAdditions in virtualbox - howto
#
##########################################################################

Installing Guest Additions on Debian
https://virtualboxes.org/doc/installing-guest-additions-on-debian/

Follow these steps to install the Guest Additions on your Debian virtual machine:

    Login as root;
    Update your APT database with apt-get update;
    Install the latest security updates with apt-get upgrade;
    Install required packages with apt-get install build-essential module-assistant;
    Configure your system for building kernel modules by running m-a prepare;
    Click on Install Guest Additions… from the Devices menu, then run mount /media/cdrom.
    Run sh /media/cdrom/VBoxLinuxAdditions.run, and follow the instructions on screen.

------------

https://unix.stackexchange.com/questions/286934/how-to-install-virtualbox-guest-additions-in-a-debian-virtual-machine

apt-get update
apt-get upgrade
apt-get install virtualbox-guest-dkms virtualbox-guest-x11 linux-headers-$(uname -r)

FIX:

# Login as root
su

# edit nano /etc/apt/sources.list
# comment out following
deb cdrom:[Debian GNU/Linux 9.5.0 _Stretch_ - Official amd64 xfce-CD Binary-1 20180714-10:25]/ stre$

# run update and install
apt-get update
apt-get updgrade
apt-get install virtualbox-guest-dkms virtualbox-guest-x11 linux-headers-$(uname -r)

#########################################################
#
# add new user in mysql mariadb
#
#########################################################

https://dev.mysql.com/doc/refman/8.0/en/default-privileges.html

sudo mysql -u root -p
use mysql;
show tables;
describe user;

GRANT ALL PRIVILEGES ON *.* TO 'blabla'@'localhost' IDENTIFIED BY 'blabla';
SET PASSWORD FOR 'blabla'@'localhost' = PASSWORD('blabla');
ALTER USER 'blabla'@'localhost' IDENTIFIED BY 'blabla';
update user set authentication_string=password('blabla') where user='blabla';
flush privileges;
quit

#########################################################
#
# Add symlink
#
#########################################################

sudo ln -s /home/blabla/WWW/  /var/www/html/wwweb
http://localhost/wwweb/


#########################################################
#
# php change config
#
#########################################################

php -i | grep ini
sudo nano /etc/php/7.2/cli/php.ini
sudo nano /etc/php/7.2/apache2/php.ini

sudo find / -name php.ini
/etc/php/7.2/cli/php.ini
/etc/php/7.2/apache2/php.ini

sudo nano /etc/php/7.2/apache2/php.ini

upload_max_filesize=64M
post_max_size=64M

sudo service apache2 restart

#########################################################
#
#   module music format decoder ubuntu FIX s3m mod xm it
#   https://wiki.ubuntuusers.de/Codecs/
#
#########################################################

sudo apt-get install libxvidcore4 gstreamer1.0-plugins-base gstreamer1.0-plugins-good gstreamer1.0-plugins-ugly gstreamer1.0-plugins-bad gstreamer1.0-alsa gstreamer1.0-fluendo-mp3 gstreamer1.0-libav


#########################################################
#
# Install LAMP
#
#########################################################

#---------------------
sudo apt install php7.2 php7.2-cli php7.2-common php7.2-curl php7.2-json php7.2-opcache php7.2-gd php7.2-soap php7.2-mbstring php7.2-mysql php7.2-xml php7.2-zip php7.2-intl php7.2-readline php7.2-sqlite3 -y
#---------------------
sudo apt install apache2 libapache2-mod-php7.2  -y
sudo apt -y install curl -y
sudo apt -y install mysql-server mysql-client -y
sudo apt install -y mongodb mongodb-clients mongodb-server -y
#---------------------
sudo mysql -u root -p
use mysql;
show tables;
describe user;
GRANT ALL PRIVILEGES ON *.* TO 'blabla'@'localhost' IDENTIFIED BY 'blabla';
SET PASSWORD FOR 'blabla'@'localhost' = PASSWORD('blabla');
ALTER USER 'blabla'@'localhost' IDENTIFIED BY 'blabla';
update user set authentication_string=password('blabla') where user='blabla';
flush privileges;
quit
---------------------
# search php ini
php -i | grep 'php.ini'
#Configuration File (php.ini) Path => /etc/php/7.2/cli
#Loaded Configuration File => /etc/php/7.2/cli/php.ini

find /etc/ -name 'php.ini'
#/etc/php/7.2/cli/php.ini
#/etc/php/7.2/apache2/php.ini
#---------------------
sudo service mysql restart
sudo service apache2 restart
#---------------------
mkdir /home/blabla/wweb/
sudo ln -s /home/blabla/wweb/  /var/www/html/wwweb

#ln -s /realpath  /aliaspath
#rm aliaspath
#---------------------
for z in *.zip; do unzip $z; done
for i in */; do zip -r "${i%/}.zip" "$i"; done
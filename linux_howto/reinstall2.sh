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
sudo apt install virtualbox -y
sudo apt install keepass2 -y
sudo apt install ffmpeg -y
sudo apt install mysql-workbench -y

sudo apt-get install htop -y
sudo apt-get install p7zip -y
sudo apt-get install audacity -y
sudo apt-get install openshot -y

# sublime-text
wget http://c758482.r82.cf2.rackcdn.com/sublime-text_build-3083_amd64.deb
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





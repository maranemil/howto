#!/bin/bash


sudo apt-get update  # To update package lists

sudo apt-get install google-chrome-stable -y
sudo apt-get install htop -y
sudo apt-get install firefox -y
sudo apt-get install midori -y

sudo apt-get install p7zip -y
sudo apt-get -y install git git-core
sudo apt-get -y install zsh
sudo apt-get -y install rar unrar p7zip

#sudo apt-get -y install unace 	#Ace
sudo apt-get -y install rar 	#Rar
sudo apt-get -y install unrar 	#Rar
#sudo apt-get -y install unrar-free #Rar
#sudo apt-get -y install p7zip-rar  #7Zip

sudo apt-get -y install tmux
sudo apt-get -y install vim
sudo apt-get -y install rsync rsnapshot


sudo apt-get -y install mc #Midnight Commander
sudo apt-get -y install krusader
sudo apt-get -y install gnome-commander

sudo apt-get -y install ffmpeg
sudo apt-get -y install milkytracker
sudo apt-get -y install keepassx
sudo apt-get -y install mysql-workbench
sudo apt-get -y install gimp
sudo apt-get -y install pinta
sudo apt-get -y install bluefish

#sudo apt-get install caffeine -y
#sudo apt-get install okular -y
#sudo apt-get install weechat -y
#sudo apt-get -y install unity-tweak-tool -y
#sudo apt-get -y install fluxgui -y
#sudo apt-get -y install vlc
#sudo apt-get -y install deluge # BitTorrent
#sudo apt-get -y install exuberant-ctags

sudo apt-get -y install curl
sudo apt-get -y install apache2
sudo apt-get -y install php5 php5-cli
sudo apt-get -y install proftpd
sudo apt-get -y install php5-curl 	 # install php-curl
sudo apt-get -y install php5 libapache2-mod-php5 php5-mcrypt
sudo apt-get -y install php-soap
sudo apt-get -y install php5-gd
sudo apt-get -y install mysql-server mysql-client
sudo apt-get -y install  php5-dev
sudo apt-get -y install php7.0 php5.6 php5.6-mysql
sudo apt-get -y install php-gettext php5.6-mbstring php-xdebug
sudo apt-get -y install libapache2-mod-php5.6 libapache2-mod-php7.0
sudo apt-get install -y php5-dev
sudo apt-get install -y php7.0-dev
sudo apt-get install -y mongodb-org
sudo apt-get install -y mongodb-10gen
sudo apt-get install -y php-apc


sudo apt-get -y install vagrant
sudo apt-get -y install docker
sudo apt-get -y install docker.io
sudo apt-get -y install docker-engine


# redis
sudo apt-add-repository -y ppa:chris-lea/redis-server
sudo apt-get -y update
sudo apt-get -y install redis-server
sudo aptitude -y install php5-redis


# simplescreenrecorder
#sudo apt-get -y install libavcodec-extra
#sudo apt-get -y install simplescreenrecorder
#sudo apt-get -y install simplescreenrecorder-lib:i386
sudo apt-get -y install libavcodec-extra
sudo add-apt-repository -y ppa:maarten-baert/simplescreenrecorder
sudo apt-get -y update
sudo apt-get -y install simplescreenrecorder simplescreenrecorder-lib


sudo apt-get install virtualbox virtualbox-qt virtualbox-dkms -y
sudo apt-get install virtualbox-guest-dkms virtualbox-guest-utils -y
sudo apt-get install virtualbox-guest-x11 virtualbox-guest-additions -y

#sudo apt-get install compizconfig-settings-manager -y

# sublime-text
sudo add-apt-repository -y ppa:webupd8team/sublime-text-3
sudo apt-get -y update
sudo apt-get -y install sublime-text-installer

# numix
#sudo add-apt-repository -y ppa:numix/ppa
#sudo apt-get -y update
#sudo apt-get -y install numix-gtk-theme numix-icon-theme-circle -y

# oracle-java8-installer
#sudo add-apt-repository -y ppa:webupd8team/java
#sudo apt-get -y update
#sudo apt-get -y install oracle-java8-installer


# install pip3
sudo apt-get -y install build-essential python-dev
sudo apt-get -y install python-pip
sudo apt-get -y install python3-pip
sudo apt-get -y install python-pip
pip3 install --upgrade pip -y

#sudo apt-get -y install nodejs #NodeJS
#sudo apt-get -y install postgresql #postgresql
#sudo apt-get -y install wondershaper
#sudo apt-get -y install tcpdump

#sudo apt-get -y install unity-tweak-tool
#sudo apt-get -y install gnome-tweak-tool
#sudo apt-get -y install indicator-multiload
#sudo apt-get -y install classicmenu-indicator
#sudo apt-get -y install libreoffice libreoffice-l10n-de libreoffice-help-de

# audacity
#sudo add-apt-repository -y ppa:audacity-team/daily
#sudo apt-get -y update
#sudo apt-get -y install audacity

# openoffice
#sudo add-apt-repository -y ppa:upubuntu-com/openoffice
#sudo apt-get -y update
#sudo apt-get -y install apache-openoffice

# java
sudo add-apt-repository -y ppa:webupd8team/java
sudo apt-get -y update
#sudo apt-get -y install oracle-java6-installer
#sudo apt-get -y install oracle-java7-installer
sudo apt-get -y install oracle-java8-installer
#sudo apt-get -y install oracle-java9-installer


# avidemux
sudo add-apt-repository -y ppa:rebuntu16/avidemux+unofficial
sudo apt-get -y update
sudo apt-get -y install avidemux2.6


# How to reinstall software in Ubuntu after new Ubuntu Installation
# Referece

#https://github.com/lovromazgon/ubuntu-reinstall-scripts
#https://github.com/colinstern/ubuntu-startup-script/blob/master/install.sh
#https://github.com/dineshadepu/start_apps/blob/master/install.sh
#https://github.com/gjh33/ReInstall
#https://github.com/joaosousa1/boot-iso-grub #  Shell script to update (sync) and boot Ubuntu-daily-live.ISO from GRUB2
#https://github.com/mrwillams/grub-reparo/blob/master/grub_reparo.sh # grub repair
#https://github.com/mhf-ir/ubuntu-overssh-reinstallation # Ubuntu Overssh Reinstallation

#https://github.com/LearningRegistry/LearningRegistry/wiki/Linux-Installation-Guide
#https://github.com/Singular/Sources/wiki/Installation-from-GitHub-on-Debian

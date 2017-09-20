#!/bin/bash

##################################################################################
#PHP 7.0.22-0ubuntu0.16.04.1 (cli) ( NTS )
#Copyright (c) 1997-2017 The PHP Group
#Zend Engine v3.0.0, Copyright (c) 1998-2017 Zend Technologies
#    with Zend OPcache v7.0.22-0ubuntu0.16.04.1, Copyright (c) 1999-2017, by Zend Technologies
#mysql  Ver 14.14 Distrib 5.7.19, for Linux (x86_64) using  EditLine wrapper
##################################################################################

#sudo apt install virtualbox-guest-dkms virtualbox-guest-utils
#sudo apt install xfce4


sudo apt-get purge libapache2-mod-php7.0 php7.0 php7.0-cli php7.0-common php7.0-json -y
sudo apt-get install php libapache2-mod-php php-mcrypt php-mysql -y
sudo apt install php7.0-intl -y
sudo apt install curl -y
sudo apt install git -y
sudo apt install mysql-server mysql-common mysql-client -y

sudo apt install php7.0-intl php7.0-mbstring php7.0-cli php7.0-common  php7.0-curl  php7.0-cgi php7.0-xml php7.0-mcrypt -y

sudo a2enmod php7.0
sudo a2enmod rewrite
sudo a2dismod userdir

#sudo systemctl restart apache2
#sudo systemctl restart mysql

#sudo dpkg --configure -a

#sudo a2enmod rewrite
#sudo mkdir -p /var/run/apache2
#sudo chown -R www-data /var/run/apache2
#sudo a2enmod actions
#sudo /etc/init.d/apache2 force-reload


#sudo nano /etc/apache2/sites-enabled/000-default.conf
#sudo service apache2 restart
#sudo nano /etc/apache2/sites-available/000-default.conf
#sudo chown -R www-data:www-data /var/www/html
#sudo a2ensite 000-default.conf
#sudo a2dissite 000-default.conf


echo "----------------------------------------------------------------------------"
php -v
mysql --version
echo "----------------------------------------------------------------------------"

php -i | grep -i  "php/7.0/cli/conf"

echo "/////////////////////////////////////////////////////////////////////////////"

#mysql -u root -p
#SHOW DATABASES;
#exit;

#sudo touch /etc/apache2/sites-available/000-default.conf
sudo touch /etc/apache2/sites-available/default
sudo chmod 0777   /etc/apache2/sites-available/default

# ---------------------------------------
# Write Apache Config
# ---------------------------------------

destdir=/etc/apache2/sites-available/default

if [ -f "$destdir" ]
then
    echo "DocumentRoot /var/www" > "$destdir"
    echo "<Directory /var/www/>" >> "$destdir"
    echo "RewriteEngine on" >> "$destdir"
    echo "Options Indexes FollowSymLinks MultiViews" >> "$destdir"
    echo "AllowOverride all" >> "$destdir"
    echo "Order allow,deny" >> "$destdir"
    echo "allow from all" >> "$destdir"
    echo "</Directory>" >> "$destdir"
fi

ls -la /etc/apache2/sites-available/default

sudo service apache2 restart

#sudo apt-get update -y
#sudo apt-get upgrade -y
#sudo apt-get autoremove -y
#sudo apt-get dist-upgrade -y
#sudo reboot
#sudo dpkg --configure -a

# ---------------------------------------
# CAKEPHP Install or Laravel Install
# ---------------------------------------

#sudo chmod -R 0777 /var/www/html
#cd /var/www/html

#git clone https://github.com/laravel/laravel.git
#git clone https://github.com/cakephp/app.git

#curl -sS https://getcomposer.org/installer | php
#php composer.phar install
#php composer.phar update

#  - Installing cakephp/plugin-installer (1.0.0): Downloading (100%)
#  - Installing aura/intl (3.0.0): Downloading (100%)
#  - Installing psr/http-message (1.0.1): Downloading (100%)
#  - Installing zendframework/zend-diactoros (1.6.0): Downloading (100%)
#  - Installing psr/log (1.0.2): Downloading (100%)
#  - Installing cakephp/chronos (1.1.2): Downloading (100%)
#  - Installing cakephp/cakephp (3.5.2): Downloading (100%)
#  - Installing symfony/polyfill-mbstring (v1.5.0): Downloading (100%)
#  - Installing symfony/yaml (v3.3.9): Downloading (100%)
#  - Installing symfony/debug (v3.3.9): Downloading (100%)
#  - Installing symfony/console (v3.3.9): Downloading (100%)
#  - Installing symfony/filesystem (v3.3.9): Downloading (100%)
#  - Installing symfony/config (v3.3.9): Downloading (100%)
#  - Installing robmorgan/phinx (v0.8.1): Downloading (100%)
# .....

#sudo systemctl restart apache2

#sudo cp config/app.default.php config/app.php

# https://www.digitalocean.com/community/questions/can-t-get-mod_rewrite-to-work-on-my-ubuntu-14-04-server
# https://www.digitalocean.com/community/tutorials/how-to-rewrite-urls-with-mod_rewrite-for-apache-on-ubuntu-16-04

# Add in /var/www/html/.htaccess

# Apache Rewrite Rules
#<IfModule mod_rewrite.c>
#Options +FollowSymLinks
#RewriteEngine On
#RewriteBase /
# End of Apache Rewrite Rules
</IfModule>





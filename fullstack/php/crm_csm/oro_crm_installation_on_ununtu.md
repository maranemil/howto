######
### Install ORO CRM
######
```
cd /var/www/html/OroCrm					                # go to your install OroCrm folder

git clone https://github.com/orocrm/crm.git		        # clone packages to be installer
#git clone https://github.com/orocrm/platform.git	    # optional
#git clone -b 1.4.1 https://github.com/orocrm/crm-application.git # clone specific version from github
git clone http://github.com/orocrm/crm-application.git	# clone packages to be installer

# You may find useful some info from composer during installation
# https://getcomposer.org/doc/03-cli.md#install
# https://getcomposer.org/doc/03-cli.md#require

cd crm							                        # go on new cloned folders
curl -sS https://getcomposer.org/installer | php 	    # get composer
#sudo apt-get update					                # if curl not installed, then install it
#sudo apt-get install php5-curl. 			            # php php-curl not installed, then install it
#php composer.phar install				                # because this way brings errors on dependency i use "required"
#php composer.phar install --prefer-dist --no-dev	    # recomandaton from oro git
php composer.phar update				                # update composer
php composer.phar require besimple/soap-client "~0.2" --prefer-dist  # intall dependencies
# Set on composer installation driver "mysqli".
```

### In case case of providing wrong Doctrine driver by install, repeat install operation:
```
rm -rf crm-application/					                # delete folder
git clone http://github.com/orocrm/crm-application.git	# clone again
cd crm-application					                    # go to install folder
curl -s https://getcomposer.org/installer | php		    # get composer
php composer.phar require besimple/soap-client "~0.2" --prefer-dist # intall again
# Set on composer installation driver "mysqli".
```

### Install mcrypt
```
sudo apt-get install php5-mcrypt			            # get php5-mcrypt
sudo php5enmod mcrypt					                # enable module mcrypt
sudo service apache2 restart				            # restart apache


php --ini						                        # check php extensions config files
env		
					                            ```# check envoirement
```

### Add your timezone in php.ini (both) and memory limit to 512Mb :
```
find / -type f -iname 'php.ini' -exec grep -i 'timezone' {} +	# check data.timezone in php.ini(s)
sudo nano /etc/php5/apache2/php.ini 				    # to modify data.timezone
sudo nano /etc/php5/cli/php.ini    				        # to modify data.timezone
```

### Add ORO_PHP_PATH in env:
```
export ORO_PHP_PATH=$PATH:/usr/bin/php			        # set path
echo $ORO_PHP_PATH					                    # check path

php app/console cache:clear 				            # clear symfony cache
```



######
### Extra Checks if Installation does not work well
######
```
sudo a2enmod env					                    # check if env is enabled
locate php5 						                    # locate php on machine
------------------------------------------------
php -i | grep -i soap  					                # check soap status
php -i |grep php\.ini					                # check soap status so
sudo apt-get install php-soap 				            # install soap if not found
------------------------------------------------
sudo apt-get install curl				                # install curl
sudo apt-get install php5-intl				            # install php-intl
sudo apt-get install php5-curl				            # install php-curl
apt-get autoremove					                    # remove unused packages
------------------------------------------------
# NodeJs
curl -sL https://deb.nodesource.com/setup | sudo bash - # Download Node with Ubuntu
sudo apt-get install -y nodejs				            # Then install with Ubuntu
# Optional: install build tools
#To compile and install native addons from npm you may also need to install build tools:
apt-get install -y build-essential
------------------------------------------------
# Composer
php composer.phar install --prefer-dist --no-dev
php composer.phar install
php composer.phar update
php composer.phar require ext-intl:*
php composer.phar require sensio/generator-bundle:~2.3
------------------------------------------------
If composer intl error Installing PHP extensions using PECL.

# sudo pear upgrade -f pear
# sudo pear install pecl/intl
# sudo pecl install apc
# sudo pecl install intl
# install-pear-nozlib.phar
# file at found http://www.filewatcher.com/p/php-5.2.11.tar.bz2.9030787/php-5.2.11/pear/install-pear-nozlib.phar.html

sudo mkdir /usr/lib/php
cd /usr/lib/php
sudo wget ftp://ftp.mirrorservice.org/sites/distfiles.macports.org/pear-install-phar-20130325/install-pear-nozlib.phar

sudo php install-pear-nozlib.phar
sudo pear channel-update pear.php.net
sudo pecl channel-update pecl.php.net
sudo pear upgrade-all
sudo pear config-set auto_discover 1
------------------------------------------------
# Create the database  "oro_crm"

# What kind of drivers Doctrine suports:
pdo_mysql, pdo_sqlite, pdo_pgsql, pdo_oci, oci8, ibm_db2, pdo_ibm, pdo_sqlsrv, mysqli, drizzle_pdo_mysql, sqlsrv

# Install application and admin user with Installation Wizard by opening install.php in the browser or from CLI:
php app/console oro:install --env prod

# Enable WebSockets messaging
php app/console clank:server --env prod

# Configure crontab or scheduled tasks execution to run command below every minute:
php app/console oro:cron --env prod
------------------------------------------------
# Install GD if missing
sudo apt-get update
sudo apt-get install php5-curl
sudo apt-get install php5-gd
sudo service apache2 restart
debiant: sudo apt-get -y install php5-gd
sudo gedit /etc/php5/apache2/conf.d/gd.ini
; configuration for php GD module
;extension=gd.so
sudo service apache2 reload

# Increate memory_limit in command-line
php -d memory_limit=-1 composer.phar update --no-dev --prefer-dist symfony/symfony -vv
------------------------------------------------
# Check for the package with:
dpkg --get-selections | grep php5-curl

# Install the php5-mysql package if you do not have it.
sudo apt-get install php5-curl
```
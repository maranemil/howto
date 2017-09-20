#!/bin/bash

#sudo apt install virtualbox-guest-dkms virtualbox-guest-utils
#sudo apt install xfce4
#sudo apt-get purge libapache2-mod-php7.0 php7.0 php7.0-cli php7.0-common php7.0-json -y

sudo apt-get install php php-mcrypt php-mysql php7.0-intl php7.0-intl php7.0-mbstring php7.0-cli php7.0-common  php7.0-curl  php7.0-cgi php7.0-xml php7.0-mcrypt -y
sudo apt install curl git  -y
sudo apt install mysql-server mysql-common mysql-client -y

echo "-------------------------------------------------------------------"
php -v
echo "-------------------------------------------------------------------"

#PHP 7.0.22-0ubuntu0.16.04.1 (cli) ( NTS )
#Copyright (c) 1997-2017 The PHP Group
#Zend Engine v3.0.0, Copyright (c) 1998-2017 Zend Technologies
#    with Zend OPcache v7.0.22-0ubuntu0.16.04.1, Copyright (c) 1999-2017, by Zend Technologies

echo "-------------------------------------------------------------------"

mysql --version
#mysql  Ver 14.14 Distrib 5.7.19, for Linux (x86_64) using  EditLine wrapper

echo "-------------------------------------------------------------------"

# ---------------------------------------------- ----------------------------------------------


sudo apt-get update
#sudo apt-get install nginx -y

sudo apt-get -y install nginx
sudo service nginx start # Welcome to nginx! on http://localhost/

sudo apt-get -y install php7.0-fpm
sudo nano /etc/nginx/nginx.conf # keepalive_timeout   2;

# End of bash script!!!!
# Will exit with status of last command.

exit

# ---------------------------------------------- ----------------------------------------------
# ---------------------------------------------- ----------------------------------------------



# ----------------------------------------------
# Manual Config
# ----------------------------------------------

sudo nano /etc/nginx/sites-available/default

 location ~ \.php$ {
	include snippets/fastcgi-php.conf;
	# With php7.0-cgi alone:
	#fastcgi_pass 127.0.0.1:9000;
	# With php7.0-fpm:
	fastcgi_pass unix:/run/php/php7.0-fpm.sock;
}

sudo service nginx reload # sudo systemctl status nginx.service
sudo nano /etc/php/7.0/fpm/php.ini # set cgi.fix_pathinfo=0:
sudo service php7.0-fpm reload

nano /var/www/html/info.php
<?php phpinfo(); ?>

# nginx rendering PHP as plain text

sudo nano /etc/php/7.0/fpm/php.ini
sudo service php7.0-fpm restart
sudo service php7.0-fpm restart && sudo service nginx restart

# http://localhost/info.php -> PHP Version 7.0.22-0ubuntu0.16.04.1

----------------------------

OPTIONAL

apt-cache search php7.0
apt-get -y install php7.0-mysql php7.0-curl php7.0-gd php7.0-intl php-pear php-imagick php7.0-imap php7.0-mcrypt php-memcache  php7.0-pspell php7.0-recode php7.0-sqlite3 php7.0-tidy php7.0-xmlrpc php7.0-xsl php7.0-mbstring php-gettext
apt-get -y install php-apcu
service php7.0-fpm reload

------------------

nano /etc/php/7.0/fpm/pool.d/www.conf # add

;listen = /var/run/php5-fpm.sock
listen = 127.0.0.1:9000

php7.0-fpm reload

-----------------

sudo nano /etc/nginx/sites-available/default


location ~ \.php$ {
	 include snippets/fastcgi-php.conf;
	 # With php7.0-cgi alone:
	 fastcgi_pass 127.0.0.1:9000;
	 # With php7.0-fpm:
	 # fastcgi_pass unix:/run/php/php7.0-fpm.sock;
 }

sudo service nginx reload

#https://www.howtoforge.com/tutorial/installing-nginx-with-php7-fpm-and-mysql-on-ubuntu-16.04-lts-lemp/
#https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-in-ubuntu-16-04
#https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-on-debian-8

#####################################
#
# cakephp install
#
#####################################

#sudo chmod -R 0777 /var/www/html
#cd /var/www/html

#git clone https://github.com/laravel/laravel.git
#git clone https://github.com/cakephp/app.git

#curl -sS https://getcomposer.org/installer | php
#php composer.phar install
#php composer.phar update

cp config/app.default.php config/app.php

# http://localhost/app/index.php -> Welcome to CakePHP 3.5.2 Red Velvet. Build fast. Grow solid.

nginx -V

nginx version: nginx/1.10.3 (Ubuntu)
built with OpenSSL 1.0.2g  1 Mar 2016
TLS SNI support enabled
configure arguments: --with-cc-opt='-g -O2 -fPIE -fstack-protector-strong -Wformat -Werror=format-security -Wdate-time -D_FORTIFY_SOURCE=2' --with-ld-opt='-Wl,-Bsymbolic-functions -fPIE -pie -Wl,-z,relro -Wl,-z,now' --prefix=/usr/share/nginx --conf-path=/etc/nginx/nginx.conf --http-log-path=/var/log/nginx/access.log --error-log-path=/var/log/nginx/error.log --lock-path=/var/lock/nginx.lock --pid-path=/run/nginx.pid --http-client-body-temp-path=/var/lib/nginx/body --http-fastcgi-temp-path=/var/lib/nginx/fastcgi --http-proxy-temp-path=/var/lib/nginx/proxy --http-scgi-temp-path=/var/lib/nginx/scgi --http-uwsgi-temp-path=/var/lib/nginx/uwsgi --with-debug --with-pcre-jit --with-ipv6 --with-http_ssl_module --with-http_stub_status_module --with-http_realip_module --with-http_auth_request_module --with-http_addition_module --with-http_dav_module --with-http_geoip_module --with-http_gunzip_module --with-http_gzip_static_module --with-http_image_filter_module --with-http_v2_module --with-http_sub_module --with-http_xslt_module --with-stream --with-stream_ssl_module --with-mail --with-mail_ssl_module --with-threads



#####################################
#
# nginx mode reweite enable
#
#####################################

sudo nano /etc/nginx/sites-available/default

location / {
       #root   /home/mywebsite/public;
       index index.php index.html index.htm;
       try_files $uri $uri/ /index.php;
}

https://www.nginx.com/blog/converting-apache-to-nginx-rewrite-rules/
https://www.nginx.com/blog/creating-nginx-rewrite-rules/
http://nginx.org/en/docs/http/ngx_http_core_module.html#try_files
http://nginx.org/en/docs/http/ngx_http_rewrite_module.html#rewrite
https://www.digitalocean.com/community/questions/enabling-nginx-mod_rewrite
http://nginx.org/en/docs/http/ngx_http_rewrite_module.html
https://docs.phalconphp.com/en/latest/webserver-setup#nginx


server {

    listen           80;
    listen           [::]:80;
    server_name      localhost;

    root             /path/to/root;
    index            index.php;

    location / {
        try_files    $uri    $uri/    /index.php?$args;
    }

    # For processesing PHP scripts and serving their output
    location ~* \.php$ {
        fastcgi_pass  unix:/var/run/php5-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi.conf;
    }

    # For serving static files
    location ^~ /static/ {
        root            /path/to/static;
    }
}

---or

location / {
	root   /usr/share/nginx/html;
	index  index.html index.htm;
	try_files $uri $uri/ /index.php?$args;
}

#####################################
#
# Phalcon configuration - setup Nginx with Phalcon:
#
#####################################

server {
    # Port 80 will require Nginx to be started with root permissions
    # Depending on how you install Nginx to use port 80 you will need
    # to start the server with `sudo` ports about 1000 do not require
    # root privileges
    # listen      80;

    listen        8000;
    server_name   default;

    ##########################
    # In production require SSL
    # listen 443 ssl default_server;

    # ssl on;
    # ssl_session_timeout  5m;
    # ssl_protocols  SSLv2 SSLv3 TLSv1;
    # ssl_ciphers  ALL:!ADH:!EXPORT56:RC4+RSA:+HIGH:+MEDIUM:+LOW:+SSLv2:+EXP;
    # ssl_prefer_server_ciphers   on;

    # These locations depend on where you store your certs
    # ssl_certificate        /var/nginx/certs/default.cert;
    # ssl_certificate_key    /var/nginx/certs/default.key;
    ##########################

    # This is the folder that index.php is in
    root /var/www/default/public;
    index index.php index.html index.htm;

    charset utf-8;
    client_max_body_size 100M;
    fastcgi_read_timeout 1800;

    # Represents the root of the domain
    # http://localhost:8000/[index.php]
    location / {
        # Matches URLS `$_GET['_url']`
        try_files $uri $uri/ /index.php?_url=$uri&$args;
    }

    # When the HTTP request does not match the above
    # and the file ends in .php
    location ~ \.php$ {
        try_files $uri =404;

        # Ubuntu and PHP7.0-fpm in socket mode
        # This path is dependent on the version of PHP install
        fastcgi_pass  unix:/var/run/php/php7.0-fpm.sock;

        # Alternatively you use PHP-FPM in TCP mode (Required on Windows)
        # You will need to configure FPM to listen on a standard port
        # https://www.nginx.com/resources/wiki/start/topics/examples/phpfastcgionwindows/
        # fastcgi_pass  127.0.0.1:9000;

        fastcgi_index /index.php;

        include fastcgi_params;
        fastcgi_split_path_info       ^(.+\.php)(/.+)$;
        fastcgi_param PATH_INFO       $fastcgi_path_info;
        fastcgi_param PATH_TRANSLATED $document_root$fastcgi_path_info;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }

    location ~ /\.ht {
        deny all;
    }

    location ~* \.(js|css|png|jpg|jpeg|gif|ico)$ {
        expires       max;
        log_not_found off;
        access_log    off;
    }
}

# check cakephp root
# http://localhost/app/ -> Welcome to CakePHP 3.5.2 Red Velvet. Build fast. Grow solid. - URL rewriting is not properly configured on your server.

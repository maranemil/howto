```
 [backups checklist]
```
```
    - desktop files
    - sublime text
    - db mariadb
    - web projects
    - pass db
    - etc host & bashrc
    - list installed software
    - all user folders
    - IDE settings ( Vscode + PyCharm Intellij)
```

--------------------------------------------
```
    [apt]
```
```
sudo apt install htop -y
sudo apt install doublecmd-qt -y
sudo apt install keepass2 -y
sudo apt install gimp -y
sudo apt install filezilla -y
sudo apt install git -y
sudo apt install virtualbox -y
sudo apt install ffmpeg -y
sudo apt install p7zip p7zip-full p7zip-rar -y
sudo apt install audacity -y
sudo apt install gnome-mpv -y
# sudo apt install gnome-tweak-tool -y
sudo apt install gnome-tweaks -y
sudo apt install milkytracker -y
sudo apt install curl -y
sudo apt install kdenlive -y
```
```
    [nvidia]
```
```
ubuntu-drivers devices
sudo ubuntu-drivers autoinstall
#sudo apt install nvidia-390
```
```
    [firmware-linux-nonfree]
```
```
sudo apt-get update
sudo apt-get install firmware-linux-nonfree
```

```
    [snap]
```
```
sudo snap install code --classic
sudo snap install chromium-browser --classic
sudo snap install pycharm-community --classic
sudo snap install intellij-idea-community --classic
```


### Config Git on new location 
```
git config --global user.name "Administrator"
git config --global user.email "admin@example.com"
```

### sublime-text
```
wget https://download.sublimetext.com/sublime-text_build-3083_amd64.deb
sudo dpkg -i sublime-text_build-3083_amd64.deb
```


```
sudo dpkg -i google-chrome-stable_current_amd64.deb
```


### Add symlink DEPRECATED
sudo ln -s /home/abcd/WWW/  /var/www/html/wwweb
http://localhost/wwweb/

--------------------------------------------

### lamp
```


sudo apt install mariadb-server mariadb-client
sudo service mysqld start

sudo apt install mariadb-server -y
sudo mysql_secure_installation

sudo apt install composer  -y
sudo apt install php7.4 php7.4-cli php7.4-common php7.4-curl php7.4-json php7.4-opcache php7.4-gd php7.4-soap php7.4-mbstring php7.4-mysql php7.4-xml php7.4-zip php7.4-intl php7.4-readline php7.4-sqlite3 -y
sudo apt install php-mysql

# sudo apt autoremove
```



```
--------------------------------------------
# lamp
DEPRECATED:
# sudo apt install apache2 libapache2-mod-php7.4  -y
# sudo service apache2 restart
# lamp
--------------------------------------------
```

### mysql mariadb
```
--------------------------------------------
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
```


### php server
```
php -S localhost:8000
```

```
ERROR for php -S localhost:8000
Failed to listen on localhost:8000


DEBUG

ps -ef | grep php
ps aux | grep -i port

sudo apt install net-tools
sudo netstat -aon | more
sudo netstat -plnt
sudo netstat -lntu
sudo netstat -tln | grep 8000
sudo netstat -plnt | grep 8000

killall -9 php

sudo apt remove php
sudo apt remove php7.4-*
sudo apt install composer php-cli


/usr/bin/php -S localhost:80 -t /home/bann/web
ping localhost

FIX: check etc/hosts for 127.0.0.1 localhost
```

----------------------------------------------
```
ERROR: Failed opening required 'vendor/autoload.php'


FIX:
composer install
```


```
ERROR: Phpmyadmin Error, Incorrect Format Parameter
phpMyAdmin - Fehler


FIX:
php.ini
upload_max_filesize=64M
post_max_size=64M
```


```
ERROR: The requested resource / was not found on this server PHP

FIX: index.php

if ($handle = opendir('.')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            echo "<a href='$entry'> $entry\n</a><br>";
        }
    }
    closedir($handle);
}

/*
$dir    = '.';
$files = scandir($dir);
$files = array_diff(scandir($dir), array('.', '..'));
*/

```
----------------------------------------------

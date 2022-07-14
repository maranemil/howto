###################################################################
## Deployment Upload to failed. Failed to transfer 1 files
###################################################################
```
https://www.jetbrains.com/help/phpstorm/troubleshooting-deployment.html#general-troubleshooting
https://www.jetbrains.com/help/pycharm/uploading-and-downloading-files.html
https://www.jetbrains.com/help/phpstorm/uploading-and-downloading-files.html
https://www.jetbrains.com/help/idea/commit-and-push-changes.html
https://www.jetbrains.com/help/idea/scratches.html
https://www.jetbrains.com/help/phpstorm/configuring-synchronization-with-a-remote-host.html#server-access-config
https://www.shortcutfoo.com/app/dojos/intellij-idea-win/cheatsheet
https://www.jetbrains.com/help/phpstorm/excluding-files-and-folders-from-deployment.html
https://docs.gradle.org/current/userguide/idea_plugin.html
https://docs.databricks.com/dev-tools/databricks-connect.html
```


```
Settings Logs
-----------------
idea.log file (Help | Show Log in Explorer) 
IDE logs (Help | Collect Logs and Diagnostic Data) 
Help -> Collect Logs and Diagnostic Data in Gateway.

Tools -> Deployment -> Configuration -> Advanced options -> [FTP-server/FTP] -> enable "Passive mode" checkbox!

Failed to upload content of remote file
could not write to


grep sftp /etc/ssh/sshd_config 
Subsystem sftp /usr/lib/openssh/sftp-server


sudo usermod -a -G www-data your_username
sudo chgrp -R www-data /var/www/html/test
sudo chmod -R g+w /var/www/html/test

sudo chown -R  your_username:sudo /var/www/html/test
sudo chmod -R 755 /var/ww/html/test/

chmod -R 777 /var/www/test/
chgrp www-data /var/www/test/
chown -R www-data /var/www/test/
useradd -G {www-data} your_username

sudo chown -R $(whoami) /var/www/test
```

###################################################################
## FIX NoPermisisons filesystemerror Error EACESS permission denided
###################################################################
```
FIX 100% OK: set remote chmod www-data folder as remote /home/<user-name>

sudo chown -R <user-name> <web-directory-name>
sudo usermod -a -G www-data $(whoami)


https://stackoverflow.com/questions/38980338/eacces-permission-denied-in-vs-code-mac/65710222
https://ss64.com/bash/syntax-permissions.html
https://ss64.com/bash/chmod.html

sudo usermod -a -G www-data $(whoami)

# save old permisions info
ls -lR <project_dir_name> > old_permissions.txt


# give new permissions
sudo chown -R <user-name> <directory-name>
sudo chmod -R 777 <project_dir_name>
sudo chown -R $(whoami) /Users/$(whoami)/.vscode
```



###################################################################
## phpstorm Pycharm cannot save unable to create a backup file . Cannot save files
###################################################################
```
https://www.jetbrains.com/help/phpstorm/system-settings.html

disable Back up files before savin
 the 'safe writing' in Settings > Appearance and Behavior > System Settings.

[Back up files before saving]

Before saving the file, create a backup. If the save operation is successful, PhpStorm deletes the backup. If not, it restores the contents of the original file from backup. This behavior is known as "safe write", and it prevents losing your file in case of a faulty save operation.


Download Remote
-------------------------------
chown
	local  - <local-user>
	remote - www-data
	
remote grp	
sudo chown www-data:www-data test.php


		
Upload Remote
-------------------------------
chown
	local  - <local-user>
	remote - <remote-user>
	
remote grp
sudo chown <remote-user>:<remote-user> test.php
sudo chown -R <remote-name> <remote.directory-name>
```


###################################################################
## How to Fix npm EACCESS Permission Denied Error
#### npm install Error: EACCES: permission denied, access '/var/www/html'
###################################################################

```
https://docs.npmjs.com/resolving-eacces-permissions-errors-when-installing-packages-globally
https://medium.com/illumination/how-to-fix-npm-eaccess-permission-denied-error-4d6d7240c28e
https://askubuntu.com/questions/1255872/cant-edit-mounted-drive-from-vscode

echo $USER
whoami

sudo chown -R $USER /var/www/html
sudo chown -R www-data:www-data /var/www/html/project


sudo find /var/www/mysite.com/blog/* -type d -exec chmod 775 {} \;
sudo find /var/www/mysite.com/blog/* -type f -exec chmod 664 {} \;
sudo chown -R ghost:ghost /var/www/mysite.com/blog/*

sudo chmod a+rw ~/src
sudo mount -o uid=$(id -u),gid=$(id -g),umask=0000 /dev/sda1 ~/src
```


###################################################################
### Linux list all environment variables command
###################################################################

```
https://www.cyberciti.biz/faq/linux-list-all-environment-variables-env-command/
https://www.cyberciti.biz/faq/unix-linux-print-environment-variable-comamnd/

ENV list:
printenv
printenv | less
printenv | more
printenv | grep -i "user"
```


###################################################################
###Debug user info - mode group info linux
###################################################################
```
https://www.cyberciti.biz/faq/linux-show-groups-for-user/
https://www.cyberciti.biz/faq/linux-check-existing-groups-users/
https://www.kernel.org/doc/html/v5.9/virt/uml/user_mode_linux.html
https://askubuntu.com/questions/1124674/why-is-my-gid-environment-variable-empty

groups 
groups www-data

id -Gn
id -Gn www-data
id -nG

getent group www-data
getent group demo

id -u     => 1000
id -g     => 1000
echo $UID => 1000

bash -c 'echo $GID'
cat /etc/group | grep ^your_group_name | cut -d: -f3
```


###################################################################
### A command line client for MySQL
###################################################################
```
https://github.com/xo/usql
https://github.com/dbcli/mycli
https://github.com/prompt-toolkit/python-prompt-toolkit

https://dev.mysql.com/downloads/shell/
https://mariadb.com/kb/en/mysql-command-line-client/

pip install -U mycli
sudo pip install mycli

sudo apt-get install mycli # Only on debian or ubuntu

mycli --help
```
###################################################################
### MySQL Pretty Print in Command Line
###################################################################
```
https://techtldr.com/my-sql-pretty-print-in-command-line/
https://dev.mysql.com/doc/mysql-shell/8.0/en/mysql-shell-output-formats.html
https://hp-huang-tw.github.io/posts/mysql-pretty-print/
https://dba.stackexchange.com/questions/40656/how-to-properly-format-sqlite-shell-output
https://techtldr.com/my-sql-pretty-print-in-command-line/
https://wp.huangshiyang.com/mysql-pretty-print-in-command-line
https://dev.mysql.com/doc/mysql-shell/8.0/en/mysqlsh.html
https://dev.mysql.com/doc/mysql-shell/8.0/en/mysql-shell-configuring-options.html
https://mariadb.com/kb/en/mysql-command-line-client/
http://books.gigatux.nl/mirror/mysqladminguide/0672328704/ch07lev1sec5.html
https://man7.org/linux/man-pages/man1/mysql.1.html
https://stackoverflow.com/questions/924729/how-to-best-display-in-terminal-a-mysql-select-returning-too-many-fields
https://dev.mysql.com/doc/mysql-shell/8.0/en/mysql-shell-commands.html


mysql> pager less -SFX
mysql> SELECT * FROM sometable;
mysql> SELECT * FROM sometable \G

pager less -SFX
select * from user\G

# to reset page use
nopager

```









































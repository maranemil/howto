######
###   git pull master main
######
```
https://www.git-tower.com/learn/git/faq/git-pull-origin-master
https://stackoverflow.com/questions/2883840/differences-between-git-pull-origin-master-git-pull-origin-master
https://git-scm.com/docs/git-pull
https://www.atlassian.com/git/tutorials/syncing/git-pull
```
```
git pull
git pull origin master
```
```
# By default, this integration will happen through a "merge", but you can also choose a "rebase":
# git pull origin master --rebase

# If you don't want to integrate new changes directly, then you can instead use git fetch:
# this will only download new changes, but leave your HEAD branch and working copy files untouched.
# git fetch origin

# git pull = git fetch + git merge origin/branch
```

######
###   git diff
######
```
git diff branch..master
git diff branch master
```

######
###  get current branch
######
```
git branch
git branch --show-current
git rev-parse --abbrev-ref HEAD
git symbolic-ref --short HEAD
```

######
### restore file
######
```
git restore file
git checkout file
```

######
### desktop ubuntu budgie  1440x900 screen vbox
######
```
apt install ubuntu-budgie-desktop ubuntu-budgie-themes
apt install xfce4
```

######
### docker xdebug wordpress
######

https://www.wpdiaries.com/wordpress-with-xdebug-for-docker/

######
### [keycloak]
######
```
https://www.keycloak.org/getting-started
https://www.keycloak.org/documentation
https://www.keycloak.org/getting-started/getting-started-docker
https://www.keycloak.org/docs/6.0/server_installation/
https://www.keycloak.org/docs/7.0/server_admin/
https://hub.docker.com/r/jboss/keycloak/
https://hub.docker.com/r/jboss/keycloak/


sudo su
sudo -i

tests conn for 127.0.0.1
https://pythonspeed.com/articles/docker-connection-refused/

curl http://localhost:8080 -v

python3 -m http.server --bind 127.0.0.1
python3 -m http.server 8888

docker run -p 8000:8000 -it --entrypoint=bash python:3.7-slim
# python3 --version
# Python 3.7.12

docker run --rm -it busybox
docker run --rm example
docker run --rm -p 5000:5000 example
docker run -p 8000:8000 -it python:3.7-slim python3 -m http.server --bind 0.0.0.0
```


### get keycloak image

```
# quay.io/keycloak/keycloak:12.0.2
# quay.io/keycloak/keycloak:15.0.2
# jboss/keycloak
```

```
docker run jboss/keycloak
docker run -p 8080:8080 jboss/keycloak
docker run -e KEYCLOAK_USER=<USERNAME> -e KEYCLOAK_PASSWORD=<PASSWORD> jboss/keycloak
docker exec <CONTAINER> /opt/jboss/keycloak/bin/add-user-keycloak.sh -u <USERNAME> -p <PASSWORD>
docker restart <CONTAINER>


docker run -it -p 8080:8080 -e KEYCLOAK_USER=admin -e KEYCLOAK_PASSWORD=admin quay.io/keycloak/
docker run -it -p 8080:8080 -e KEYCLOAK_USER=admin -e KEYCLOAK_PASSWORD=admin jboss/keycloak
docker run -it -p 8443:8443 -e KEYCLOAK_USER=admin -e KEYCLOAK_PASSWORD=admin --name keycloak jboss/keycloak


docker run keycloak
docker exec -it keycloak bash
```

-------------------------------------------------

### K8S with Keycloak: 127.0.0.1:8443 connection refused  (0)
```
https://stackoverflow.com/questions/49859066/keycloak-docker-https-required###
https://stackoverflow.com/questions/66376617/keycloak-container-kcadmin-error-connect-to-localhost8080-localhost-127-0-0-1
https://github.com/docker/for-mac/issues/5310
https://github.com/chvndb/keycloak-spring-vaadin-demo/issues/3
https://keycloak.discourse.group/t/keycloack-standalone-works-fine-on-terminal-but-on-ip-8080-i-get-this-site-can-t-be-reached/7100/12
https://keycloak.discourse.group/t/keycloack-standalone-works-fine-on-terminal-but-on-ip-8080-i-get-this-site-can-t-be-reached/7100/15
https://github.com/docker/for-mac/issues/5310
https://blog.jaimyn.dev/how-to-build-multi-architecture-docker-images-on-an-m1-mac/#tldr
https://quarkus.io/guides/security-openid-connect
https://developers.redhat.com/blog/2017/10/31/docker-authentication-keycloak
```


```
docker run --name key -d -p 8080:8080 -e KEYCLOAK_USER=admin -e KEYCLOAK_PASSWORD=admin jboss/keycloak
docker exec -it key bash

docker exec <container_id> /opt/jboss/keycloak/bin/kcadm.sh update realms/master -s sslRequired=NONE --server http://localhost:8080/auth --realm master --user <admin_username> --password <admin_password>

./kcadm.sh config credentials --server http://localhost:8080/auth --realm master --user admin
./kcadm.sh update realms/master -s sslRequired=NONE
```
------------------------------------------------------
### Keycloak User Roles missing in REST API
```
https://stackoverflow.com/questions/48458138/keycloak-user-roles-missing-in-rest-api

Getting the associated realm roles:
GET /auth/admin/realms/{realm}/users/{user-uuid}/role-mappings/realm
Getting the associated role of a specific client:
GET /auth/admin/realms/{realm}/users/{user-uuid}/role-mappings/clients/{client-uuid}

https://gt.com/auth/admin/realms/MyRealm/users/53e3ce8a-f8ff-66dd-a8c9-161cc7c3a822/role-mappings/realm
```

------------------------------------------------------

https://www.janua.fr/howto-docker-with-keycloak/
```
docker run -e KEYCLOAK_USER=admin -e KEYCLOAK_PASSWORD=admin -e DB_VENDOR=H2 -p 8080:8080 --name sso jboss/keycloak-examples

https://localhost:8080/auth
docker stop sso
docker start sso
docker logs sso
docker exec -it sso bash
docker inspect sso
docker exec -it sso bash
```
------------------------------------------------------

```
# https://developers.redhat.com/blog/2017/10/31/docker-authentication-keycloak#configure_the_keycloak_client_and_a_docker_registry
https://developers.redhat.com/blog/2017/10/31/docker-authentication-keycloak#test_authentication

docker run -p 8080:8080 -e KEYCLOAK_USER=admin -e KEYCLOAK_PASSWORD=password jboss/keycloak -Dkeycloak.profile.feature.docker=enabled -b 0.0.0.0
docker pull localhost:5000/busybox
docker login -u admin localhost:5000
docker pull localhost:5000/busybox
```

------------------------------------------------------
```
[MacBook]
docker buildx ls
docker buildx create --use
docker buildx —-platform linux/amd64,linux/arm64 -t <remote image repository> --push .

docker run --rm -e DB_ADDR=localhost --platform linux/amd64 -p 8080:8080 -e KEYCLOAK_USER=admin -e KEYCLOAK_PASSWORD=admin quay.io/keycloak/keycloak:13.0.1

docker run --rm -e DB_ADDR=localhost -p 8080:8080 -e KEYCLOAK_USER=admin -e KEYCLOAK_PASSWORD=admin quay.io/keycloak/keycloak:13.0.1

docker build -t jboss/keycloak:13.0.1 .
```
------------------------------------------------------
```
[bash install]

#/bin/zsh

VERSION=14.0.0 # set version here

cd /tmp
git clone git@github.com:keycloak/keycloak-containers.git
cd keycloak-containers/server
git checkout $VERSION
docker build -t "jboss/keycloak:${VERSION}" .
docker build -t "quay.io/keycloak/keycloak:${VERSION}" .
```


######
###   obsolete html5 attributes
######

https://dev.w3.org/html5/pf-summary/obsolete.html

######
###   yii framework projects
######
```
https://github.com/LimeSurvey/LimeSurvey
https://www.yiiframework.com/doc/blog/1.1/en/start.overview
https://code.google.com/archive/p/yii-user/downloads
```

######
### docker image rm <image_id>
######
```
https://stackoverflow.com/questions/51188657/image-is-being-used-by-stopped-container/51189547
https://stackoverflow.com/questions/63074477/unable-to-delete-docker-images
https://www.thegeekdiary.com/docker-troubleshooting-conflict-unable-to-delete-image-is-being-used-by-running-container/
https://docs.docker.com/engine/reference/commandline/container_ls/

Error response from daemon: conflict: unable to delete <image_id> (must be forced) - image is being used by stopped container

#use --force , -f Force removal of the image
docker image rmi <image_id> -f
docker image rm <image-name> --force

# stopped containers that are causing the lock
docker stop $(docker ps -aq)
docker rm $(docker ps -q -a)
docker rm $(docker ps -aq)

#Remove all images
docker rmi $(docker images -q)

docker image rm <image_id>

# You must remove container first.
#check container
docker ps -a

#remove container
docker rm containerID

# delete all stopped containers
docker container prune

# list containers
docker container ls
docker container ls --all
```

-----
```
Get running containers
docker ps

Get all running and stopped container
docker ps -a

Stop single container
docker stop <container_id>

Stop all containers
docker stop $(docker ps -aq)

Remove single container
docker rm <container_id>

Remove all containers
docker rm $(docker ps -aq)

Remove single image
docker rmi <image_id>

Remove all images
docker rmi $(docker images -q)

Remove everything from Docker
docker system prune
docker image prune -f

WARNING! This will remove:
	- all stopped containers
	- all volumes not used by at least one container
	- all networks not used by at least one container
	- all dangling images


# list and delete all dangling images (untagged images)
docker images -f "dangling=true" -q
docker rmi $(docker images -f "dangling=true" -q)
docker rmi $(docker images --filter "dangling=true" -q --no-trunc)

docker image ls
docker image ls --all
docker image prune -fa

https://docs.docker.com/engine/reference/commandline/images/
https://forums.docker.com/t/how-to-remove-none-images-after-building/7050/14
https://newbedev.com/c-docker-remove-image-with-none-tag-code-example
https://www.freecodecamp.org/news/docker-remove-image-how-to-delete-docker-images-explained-with-examples/
https://docker-py.readthedocs.io/en/stable/images.html
https://apidocs.joyent.com/docker/commands/images

docker images --all  --digests -filter "dangling=true" --no-trunc --quiet
docker images java
docker images java:8
docker images --no-trunc
docker images --digests
docker images --filter "dangling=true"
docker rmi $(docker images -f "dangling=true" -q)
```


######
###   celluloid speed
######
```
[ and ] Decrease/increase current playback speed by 10%.
{ and } Halve/double current playback speed.
BACKSPACE  Reset playback speed to normal.
```

######
###   Valgrind
######
```
https://valgrind.org/docs/manual/quick-start.html
https://valgrind.org/docs/manual/quick-start.html
https://www.youtube.com/watch?v=ULvLmUqJoi0

valgrind  php -n index.php 2>&1 |  less
```

######
###   Install PHP 8.0
######
```
https://www.cloudbooklet.com/how-to-upgrade-php-version-to-php-8-0-on-ubuntu/
https://devanswers.co/how-to-upgrade-from-php-7-x-to-php-8-on-ubuntu-apache/

php -v
sudo apt-get purge php7.*
sudo apt-get autoclean
sudo apt-get autoremove


sudo apt install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt update

sudo apt install php8.0

sudo apt install php8.0-common php8.0-mysql php8.0-xml php8.0-xmlrpc php8.0-curl php8.0-gd php8.0-imagick php8.0-cli php8.0-dev php8.0-imap php8.0-mbstring php8.0-opcache php8.0-soap php8.0-zip php8.0-intl php8.0-bcmath php8.0-ldap php8.0-mcrypt -y

php -v
```

######
###   Debug session was finished without being paused
###   It may be caused by path mappings misconfiguration or not synchronized local and remote projects.
######
```
https://github.com/drud/ddev/issues/2643
https://stackoverflow.com/questions/50166118/annoying-warnings-debug-session-was-finished-without-being-paused-in-phpstorm
https://intellij-support.jetbrains.com/hc/en-us/community/posts/360000019119-Help-Please-Debug-session-was-finished-without-being-paused-Acquia-Dev-Desktop-2

The "break at first line" probably prevents PhpStorm from issuing you the warning, but otherwise it does exactly the same.
```

######
###   xdebug 504 Gateway Time-out
######
```
https://stackoverflow.com/questions/18229757/nginx-php-fpm-xdebug-netbeans-can-start-only-one-debug-session
https://community.localwp.com/t/timeouts-during-nginx-xdebug-session/716/5
https://github.com/geerlingguy/drupal-vm/issues/903
https://github.com/humanmade/altis-local-server/issues/223

# composer server start --xdebug

sudo nano /etc/nginx/nginx.conf
set nginx option "fastcgi_read_timeout" > fastcgi_read_timeout 600;
set > xdebug.remote_autostart=0;

vi /etc/php.d/xdebug.ini
xdebug.remote_cookie_expire_time = 3600
```


######
###   set docker rights
######
```
echo $USER
sudo adduser $USER docker
id

docker --version
docker-compose --version
docker-compose version

echo -e "UID=$(id -u)\nGID=$(id -g)"

.env
UID=1000
GID=1000

https://github.com/mazgi/dockerfiles
https://github.com/mazgi/ansible-galaxy.gentoo-systemd-remote
https://discuss.linuxcontainers.org/t/container-fails-to-restart-after-setting-raw-idmap/4333/5
https://superuser.com/questions/1174344/syntax-for-setting-lxd-container-raw-idmap

rm -f .env
test $(uname -s) = 'Linux' && echo "UID=$(id -u)\nGID=$(id -g)" >> .env
cat<<EOE >> .env
DOCKER_GID=$(getent group docker | cut -d : -f 3)
EOE

```

######
###	DEBUG Docker port 80 in use
###	ERROR... driver failed programming external connectivity on endpoint ...
###	Error starting userland proxy: listen tcp4 0.0.0.0:80: bind: address already in use
######
```
https://github.com/docker/compose/issues/3277
https://stackoverflow.com/questions/37971961/docker-error-bind-address-already-in-use
https://stackoverflow.com/questions/30156862/running-a-docker-container-that-accept-traffic-from-the-host/36991832
https://askubuntu.com/questions/1090544/error-starting-userland-proxy-listen-tcp-0-0-0-080-bind-address-already-in-u
https://github.com/laradock/laradock/issues/16
https://github.com/docker/for-mac/issues/3522
https://www.compulsivecoders.com/debug/fixing-on-mac-os-tcp-80-bind-address-already-in-use
https://forums.docker.com/t/why-in-docker-adminer-failed-with-port-address-already-in-use-error/101718
```
```
sudo apt install net-tools

sudo netstat -tulpen
sudo netstat -nl -p tcp
sudo netstat -nl -p tcp  | head
sudo netstat -pna | head -n60
docker ps -a
sudo lsof -i:80

sudo service --status-all
sudo service apache2 stop

# sudo /etc/init.d/apache2 stop
# sudo service apache2 stop;
# sudo service nginx stop;
# sudo nginx -s stop;
# docker-compose down --rmi all
# kill -9 myPID
```

######
###	add adminer in docker services
######
```
https://forums.docker.com/t/why-in-docker-adminer-failed-with-port-address-already-in-use-error/101718

adminer:
      container_name: project_name_adminer
      image: adminer
      restart: always
      ports:
        - 8089:8080
      links:
        - db

```

######
###       Replacing Docker with Podman
######
```
https://marcusnoble.co.uk/2021-09-01-migrating-from-docker-to-podman/
https://podman.io/
https://docs.podman.io/en/latest/Introduction.html
https://podman.io/getting-started/installation

# Ubuntu 20.10 and newer
sudo apt-get -y update
sudo apt-get -y install podman

podman machine init
podman machine start
```


######
###       Read Diff Git File
######
```
https://git-scm.com/docs/git-difftool

This message is displayed because 'diff.tool' is not configured.
See 'git difftool --tool-help' or 'git help config' for more details.
'git difftool' will now attempt to use one of the following tools:
meld opendiff kdiff3 tkdiff xxdiff kompare gvimdiff diffuse diffmerge ecmerge p4merge araxis bc codecompare smerge emerge vimdiff nvimdiff

Viewing (1/5): 'file.php'
Launch 'bc' [Y/n]?

sudo apt install meld -y

git-difftool
```

#######################################################################
### PHPStorm plugins
#######################################################################
```
Asciidoc
GitToolBox
Monokai Pro Theme
Php Inspections (EA Extended)
Docker
CodeGlance
.env files support
.ignore
EduTools - for IDEA + PyCharm + GoLand

String Manipulation - PHPStorm Plugin for UpperCase LowerCase


https://plugins.jetbrains.com/plugin/2162-string-manipulation
https://plugins.jetbrains.com/plugin/7499-gittoolbox
https://plugins.jetbrains.com/plugin/7391-asciidoc
https://plugins.jetbrains.com/plugin/13643-monokai-pro-theme
https://plugins.jetbrains.com/plugin/7622-php-inspections-ea-extended-
https://plugins.jetbrains.com/plugin/7724-docker

https://www.jetbrains.com/help/idea/docker.html

```

######
### how to fix "ERROR: Version in "./docker-compose.yml" is unsupported"
######
```
ERROR: Version in "/home/user/Git/myproject/docker-compose.yml" is unsupported.
You might be seeing this error because you're using the wrong Compose file version. Either specify a supported version (e.g "2.2" or "3.3") and
place your service definitions under the `services` key, or omit the `version` key and place your service definitions at the root of the file to use version 1.
For more on the Compose file format versions, see https://docs.docker.com/compose/compose-file/

Compose and Docker compatibility matrix
https://docs.docker.com/compose/compose-file/
https://docs.docker.com/engine/install/linux-postinstall/
https://docs.docker.com/compose/install/#uninstallation
https://github.com/bigbluebutton/greenlight/issues/228


docker-compose --version
docker-compose version

https://stackoverflow.com/questions/42139982/version-in-docker-compose-yml-is-unsupported-you-might-be-seeing-this-error

# FIX OK
sudo apt remove docker-compose
sudo curl -L "https://github.com/docker/compose/releases/download/1.29.1/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
reboot



https://github.com/docker/compose/releases/

1.29.2
1.29.1

$ sudo apt-get remove docker-compose
$ sudo curl -L "https://github.com/docker/compose/releases/download/1.29.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
$ sudo chmod +x /usr/local/bin/docker-compose
$ sudo ln -s /usr/local/bin/docker-compose /usr/bin/docker-compose
```


######
### check out a remote Git branch
######
```
https://stackoverflow.com/questions/1783405/how-do-i-check-out-a-remote-git-branch
https://www.git-tower.com/learn/git/faq/checkout-remote-branch
https://www.freecodecamp.org/news/git-checkout-remote-branch-tutorial/
https://www.loginradius.com/blog/async/git-fetch-remote-branch/
https://stackify.com/git-checkout-remote-branch/
https://git-scm.com/book/de/v2/Git-Branching-Remote-Branches

# With One Remote
-------------------------
git fetch
git checkout test/1.0.0

# git checkout -b test <name of remote>/test
# git checkout -t <name of remote>/test

# With >1 Remotes
-------------------------
git fetch origin
git branch -v -a
git checkout -b test origin/test

# check diff local remote
git diff local-branch-3..origin/test/1.0.0
```


######
### git restore
######
```
https://git-scm.com/book/en/v2/Git-Basics-Undoing-Things
https://git-scm.com/docs/git-restore

git restore .
git checkout -- .
```


######
###   install pdf acrobat ubuntu
######
```
https://linuxways.net/ubuntu/how-to-install-adobe-acrobat-reader-in-ubuntu-20-04/
https://vander.host/knowledgebase/application-software/how-to-install-adobe-acrobat-reader-on-ubuntu-linux/
https://linuxconfig.org/how-to-install-adobe-acrobat-reader-on-ubuntu-20-04-focal-fossa-linux

sudo apt update
sudo dpkg --add-architecture i386
sudo apt install libxml2:i386 libcanberra-gtk-module:i386 gtk2-engines-murrine:i386 libatk-adaptor:i386
wget -O ~/adobe.deb ftp://ftp.adobe.com/pub/adobe/reader/unix/9.x/9.5.5/enu/AdbeRdr9.5.5-1_i386linux_enu.deb
sudo dpkg -i ../adobe.deb
acroread
```


######
### Generate a diagram for a database object
######

https://www.jetbrains.com/help/phpstorm/creating-diagrams.html


######
### Valgrind memcheck
######
```
https://www.jetbrains.com/help/clion/memory-profiling-with-valgrind.html
https://prajankya.me/valgrind-on-linux/

sudo apt-get install valgrind
valgrind ./hello
valgrind --leak-check=full --show-leak-kinds=all ./hello
```

######
### Awesome Compose
######
```
https://github.com/docker/awesome-compose

Samples of Docker Compose applications with multiple integrated services.
Single service samples.
Basic setups for different platforms (not production ready - useful for personal use).
```


--------------------------------------------------------------------------------

### Git Remove files from
```
Changes to be committed:
  (use "git restore --staged <file>..." to unstage)
```
--------------------------------------------------------------------------------

### Obsolete package: libxml2
```
sudo apt-get install libxml2-dev
```

--------------------------------------------------------------------------------
```
https://stackoverflow.com/questions/10557650/how-can-i-get-php-working-again-in-the-command-line
https://superuser.com/questions/1057529/usr-bin-env-php-no-such-file-or-directory

cannot access '/usr/local/bin/php': No such file or directory

/usr/bin/env php -v

find /usr -name php
/usr/include/php
/usr/share/php
/usr/lib/php
/usr/bin/php

Fatal error: Uncaught TypeError: flock(): Argument #1 ($stream) must be of type resource, bool given
```

######
### ERROR sh: bash: not found - docker
######
```
https://stackoverflow.com/questions/27959011/why-does-docker-say-it-cant-execute-bash
https://mkyong.com/docker/docker-exec-bash-executable-file-not-found-in-path/
https://www.oreilly.com/library/view/using-docker/9781491915752/ch04.html

FIX: Your image is based on busybox, which doesn't have a bash shell. It does have a shell at /bin/sh.

docker ps
sudo docker exec -it <container> sh
sudo docker run -it busybox /bin/sh

# https://gist.github.com/mitchwongho/11266726

docker run -it 								# stands for docker run --interactive --tty.
docker run -it --entrypoint bash <image>  	# does not save any changes
docker run -it --entrypoint /bin/sh 		#

(none alpine has bash)
docker exec -it <name> bash

(alpine has sh)
docker exec -it <name> sh
```



######
### alpine docker
######
```
https://hub.docker.com/_/alpine

# A minimal Docker image based on Alpine Linux with a complete package index and only 5 MB in size!

http://dl-cdn.alpinelinux.org/alpine/v3.10/releases/x86/alpine-standard-3.10.0-x86.iso
https://dl-cdn.alpinelinux.org/alpine/v3.14/releases/x86_64/alpine-standard-3.14.2-x86_64.iso
https://dl-cdn.alpinelinux.org/alpine/v3.14/releases/x86_64/alpine-extended-3.14.2-x86_64.iso

https://wiki.alpinelinux.org/wiki/Alpine_Install:_from_a_disc_to_a_virtualbox_machine_single_only
https://alpinelinux.org/downloads/
https://wiki.alpinelinux.org/wiki/Alpine_newbie_install_manual
https://wiki.alpinelinux.org/wiki/Installation
```


######
### Compose and Docker compatibility matrix
######
```
https://docs.docker.com/compose/install/
https://docs.docker.com/compose/release-notes/
https://docs.docker.com/compose/compose-file/
https://docs.docker.com/compose/compose-file/compose-versioning/
```

######
###	All Roads Lead to Philosophy (on Wikipedia)
######
```
https://github.com/controversial/wikipedia-map
https://xefer.com/wikipedia
https://medium.com/@jacoblee628/all-roads-lead-to-philosophy-on-wikipedia-35d647b232b2
```

######
### 	docker stats
######

```
https://docs.docker.com/engine/reference/commandline/stats/

docker stats
docker stats --all
docker ps -a
docker stats CONTAINER ID
docker stats CONTAINER NAME
```

######
### Runtime options with Memory, CPUs, and GPUs
######
```
https://docs.docker.com/config/containers/resource_constraints/
https://phoenixnap.com/kb/docker-memory-and-cpu-limit
https://stackoverflow.com/questions/55168075/composer-memory-limit-docker
https://serverfault.com/questions/917506/why-is-my-docker-symfony-project-with-composer-consuming-so-much-memory
https://github.com/nextcloud/docker/issues/1413
https://www.baeldung.com/ops/docker-memory-limit
https://linuxhint.com/docker_compose_memory_limits/


--memory=2g
--memory="1g"
--memory-swappiness=50
--cpus="1.5"
--cpuset-cpus=1,3
--cpuset-cpus=0-3

sudo docker run -it --memory="1g" ubuntu
sudo docker run -it --memory="1g" --memory-swap="2g" ubuntu
sudo docker run -it --memory="1g" --memory-reservation="750m" ubuntu
sudo docker run -it --cpus="1.0" ubuntu
sudo docker run -m 512m nginx
sudo docker run --cpus=2 nginx

docker run -it --cpus=".5" ubuntu /bin/bash
docker run -it --cpu-period=100000 --cpu-quota=50000 ubuntu /bin/bash

docker run -it \
    --cpu-rt-runtime=950000 \
    --ulimit rtprio=99 \
    --cap-add=sys_nice \
    debian:jessie


services:
  php-fmp: //the name of your container (as per your question)
    environment:
      - COMPOSER_MEMORY_LIMIT=-1 //-1 means unlimited



docker exec nextcloud su - www-data -s /bin/bash -c 'PHP_MEMORY_LIMIT=512M php -f /var/www/html/cron.php'

docker exec nextcloud su --whitelist-environment=PHP_MEMORY_LIMIT - www-data -s /bin/bash -c 'PHP_MEMORY_LIMIT=512M php -f /var/www/html/cron.php'

sudo docker exec nextcloud /bin/bash -c 'env' | grep PHP_MEMORY_LIMIT
PHP_MEMORY_LIMIT=512M


Versions 3
services:
  service:
    image: nginx
    deploy:
        resources:
            limits:
              cpus: 0.50
              memory: 512M
            reservations:
              cpus: 0.25
              memory: 128M



Version 2
services:
    service:
      image: nginx
      mem_limit: 512m
      mem_reservation: 128M
      cpus: 0.5
      ports:
        - "80:80"


```

######
###   error handling mysqli_sql_exception
######
```
https://www.php.net/manual/en/class.mysqli-sql-exception.php
https://www.php.net/manual/en/function.mysqli-report.php
https://codereview.stackexchange.com/questions/234405/php-mysqli-connection-file
https://github.com/WebsiteBeaver/Simple-MySQLi/blob/master/simple-mysqli.php
https://hotexamples.com/examples/-/-/mysqli_report/php-mysqli_report-function-examples.html
https://stackoverflow.com/questions/18457821/how-to-make-mysqli-throw-exceptions-using-mysqli-report-strict
https://phpdelusions.net/mysqli/error_reporting

mysqli_report(MYSQLI_REPORT_STRICT);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

$result      = mysql_query($sql);

if ( $result === false ){
	print_r(mysql_error());
}

if (mysql_errno()) {
	print_r(mysql_error());
}

[reproduce]
---------------------------------------
ini_set('display_errors',1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$db = $mysqli = new mysqli($host, $user, $pass, $database);
$res = $db->query("apparently not a valid SQL statement");
$res->fetch_assoc();
---------------------------------------
```


######
###   Connection failed: SQLSTATE[HY000] [2002] php_network_getaddresses:
###   getaddrinfo failed: Name does not resolve
######
```
# check status and memory

docker stats
docker-compose ps
docker-compose logs mysql
docker-compose logs redis

FIX: restart container
```

######
###   Git History
######
```
https://git-scm.com/book/en/v2/Git-Basics-Viewing-the-Commit-History
https://git-scm.com/docs/git-log


git log --oneline
git log --oneline --date=short --pretty=format:"%H %an %ad"
git log --pretty=format:"%h %s" --graph
```


######
###   foundation sass icons
######
```

https://github.com/zaiste/foundation-icons-sass-rails
https://github.com/zaiste/foundation-icons-sass-rails/blob/master/app/assets/stylesheets/foundation-icons.scss
```


######
###   set unset
######
```
https://www.codegrepper.com/code-examples/php/php+define+multiple+variables+in+one+row
https://www.php.net/manual/en/function.unset.php

 $foo1 = $foo2 = 'A';
 [$foo1, $foo2] = array(1, 2);
 unset($foo1, $foo2);
```


######
###   css replace cell-padding old tag
######

```
https://stackoverflow.com/questions/6048913/what-replaces-cellpadding-cellspacing-valign-and-align-in-html5-tables
https://stackoverflow.com/questions/5394785/can-i-replace-table-border-1-with-table-css-table
https://www.w3schools.com/css/css_table_align.asp
https://stackoverflow.com/questions/14286597/css-alternative-to-center
https://developer.mozilla.org/en-US/docs/Web/CSS/text-align
https://www.w3.org/Style/Examples/007/center.en.html
https://www.w3docs.com/snippets/css/how-to-vertically-center-text-with-css.html

v1


th, td { padding: 5px; } /* cellpadding */
table { border-collapse: separate; border-spacing: 5px; } /* cellspacing="5" */ /* cellspacing */
table { border-collapse: collapse; border-spacing: 0; }   /* cellspacing="0" */ /* cellspacing */
th, td { vertical-align: top; } /* valign */
table { margin: 0 auto; } /* align (center) */

v2

table { border-collapse: collapse }
td { border: 1px solid #000 }

...

div.container { text-align: center }
element { display: table;   margin: 0 auto; }
.element { display: block; margin-left: auto; margin-right: auto }
section { display: flex; width: 50%; height: 200px; margin: auto; border-radius: 10px; border: 0; align-items:center; justify-content:center; }
```

######
### Switch Statements Code Smells: If Statements Trisha Gee
######
```
https://refactoring.guru/smells/switch-statements
https://dev.to/ben/i-ve-never-become-overly-convinced-that-switch-statements-are-that-much-cleaner-than-if-else-if-else-if-else-if-else-81l
https://blog.jetbrains.com/idea/2017/09/code-smells-if-statements/
https://makolyte.com/refactoring-the-switch-statement-code-smell/
https://blog.jetbrains.com/phpstorm/2016/05/working-with-switch-and-if-statements-in-phpstorm-2016-1/
https://www.jetbrains.com/help/phpstorm/code-inspections-in-php.html
https://blog.jetbrains.com/idea/2017/09/code-smells-too-many-problems/
https://blog.jetbrains.com/idea/2020/12/3-ways-to-refactor-your-code-in-intellij-idea/
https://www.youtube.com/watch?v=HgWU25YwDfc
https://blog.jetbrains.com/idea/2017/08/code-smells-mutation/
https://blog.jetbrains.com/idea/2017/08/code-smells-deeply-nested-code/
https://blog.jetbrains.com/idea/2017/09/code-smells-multi-responsibility-methods/
https://phpstorm.tips/tips/45-if-to-switch/
```

######
#   xdebug
######
```
https://stackoverflow.com/questions/65255516/how-does-the-new-xdebug-3-configuration-work
https://xdebug.org/docs/install#mode
https://xdebug.org/docs/develop
https://deliciousbrains.com/xdebug-advanced-php-debugging/
https://www.youtube.com/watch?v=1nryJL3kCx0
https://www.jetbrains.com/help/phpstorm/profiling-with-xdebug.html#enable-profiling-with-xdebug
https://confluence.jetbrains.com/pages/viewpage.action?pageId=57289189
https://www.jetbrains.com/help/phpstorm/troubleshooting-php-debugging.html#no-mappings

string xdebug.mode = develop
# off, develop, coverage, debug, gcstats, profile, trace

xdebug.mode = debug,profile
xdebug.start_with_request=trigger
```

######
### FIX for nginx xdebug "504 Gateway timeout error"
######
```
https://stackoverflow.com/questions/18229757/nginx-php-fpm-xdebug-netbeans-can-start-only-one-debug-session
https://github.com/geerlingguy/drupal-vm/issues/903

fastcgi_read_timeout 600;
xdebug.remote_autostart=0
```


######
###	MailCatcher
######
```
https://bestofphp.com/repo/sj26-mailcatcher-php-web-applications
https://btihen.me/post_tech_notes/docker_intro_with_mail_catcher/
https://github.com/sj26/mailcatcher
https://hub.docker.com/r/sj26/mailcatcher

https://hub.docker.com/r/schickling/mailcatcher
https://hub.docker.com/r/dockage/mailcatcher
https://hub.docker.com/r/tophfr/mailcatcher/
https://hub.docker.com/r/yappabe/mailcatcher
https://hub.docker.com/r/rordi/docker-mailcatcher/

Settings

gem install mailcatcher
mailcatcher
Go to http://127.0.0.1:1080/ or http://localhost:1080
Send mail through smtp://127.0.0.1:1025

PHP

sendmail_path = /usr/bin/env catchmail -f some@from.address
sendmail_path = /usr/bin/env catchmail --smtp-ip 192.160.0.1 --smtp-port 10025 -f some@from.address
php_admin_value sendmail_path "/usr/bin/env catchmail -f some@from.address"


Docker

docker build -t btihen/ruby/mailcatcher:ruby_2.6 .
docker build -t btihen/ruby/mailcatcher:latest .
docker run -d -p 1025:1025 -p 1080:1080 --name mailcatcher btihen/ruby/mailcatcher:latest
docker run -d -p 1025:1025 -p 1080:1080 --name mailcatcher 21e0de2bdd68

docker ps -a
docker kill mailcatcher
docker start mailcatcher
```

######
###	adoc paragraphs
######
```
https://docs.asciidoctor.org/asciidoc/latest/blocks/hard-line-breaks/
https://asciidoctor.org/docs/asciidoc-writers-guide/
https://discuss.asciidoctor.org/Getting-blank-lines-in-AsciiDoc-td47.html
https://docs.asciidoctor.org/asciidoc/latest/syntax-quick-reference/
https://docs.asciidoctor.org/asciidoc/latest/text/


non-breaking space to start the line:

{nbsp} +
{nbsp} +

or a regular space:

{sp} +
{sp} +


or

{empty} +
{empty} +

:blank: {empty} +
:blank: {empty} +
```


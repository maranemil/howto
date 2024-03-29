
######
###   phpstorm license register
######
```
https://account.jetbrains.com/change-password

If you use non-latest JetBrains products and it isn't prompting you to enter a one-time password,
use App Password instead of your regular password for sign in.
```

######
###   ubuntu nvidia install
######
```
sudo ubuntu-drivers autoinstall
xrandr --output DP-3 --brightness 0.7
```

######
### test webcam outout
######
```
https://webcamtests.com/

sudo apt install v4l-utils
v4l2-ctl -d /dev/video0 --set-ctrl=brightness=40,gamma=10,sharpness=3,hue=1,saturation=60
```

######
###   resolvconf - install  before WireGuard
######
```
apt install openresolv  # version 3.12.0-1, or
apt install resolvconf  # version 1.84ubuntu1

https://wiki.ubuntuusers.de/resolvconf/
http://manpages.ubuntu.com/manpages/trusty/man8/resolvconf.8.html
https://wiki.ubuntuusers.de/resolvconf/
https://wiki.ubuntuusers.de/systemd/networkd/#systemd-resolved
https://wiki.ubuntuusers.de/DNS-Konfiguration/
```

######
###   WireGuard Key Generation
######
```
https://www.wireguard.com/quickstart/
https://www.wireguard.com/install/
https://www.wireguard.com/quickstart/

sudo apt install wireguard -y

# new interface can be added via
ip link add dev wg0 type wireguard
ip address add dev wg0 192.168.2.1/24
ip address add dev wg0 192.168.2.1 peer 192.168.2.2
wg setconf wg0 myconfig.conf

#  interface can then be activated
ip link set up dev wg0

# wg genkey > privatekey
# wg pubkey < privatekey > publickey

wg genkey | tee privatekey | wg pubkey > publickey


```
######
###   How to get started with WireGuard VPN
https://upcloud.com/community/tutorials/get-started-wireguard-vpn/
######
```
sudo apt-get update && sudo apt-get upgrade -y
sudo apt-get install wireguard

sudo nano /etc/sysctl.conf
net.ipv4.ip_forward=1

sudo sysctl -p # net.ipv4.ip_forward=1

# Configuring firewall rules
sudo apt install ufw
sudo ufw allow ssh
sudo ufw allow 51820/udp
sudo ufw enable
sudo ufw status

sudo ls /etc/wireguard/
cd /etc/wireguard
umask 077
wg genkey | tee privatekey | wg pubkey > publickey


sudo nano /etc/wireguard/wg0.conf

[Interface]
PrivateKey = <contents-of-server-privatekey>
Address = 10.0.0.1/24
PostUp = iptables -A FORWARD -i wg0 -j ACCEPT; iptables -t nat -A POSTROUTING -o eth0 -j MASQUERADE
PostDown = iptables -D FORWARD -i wg0 -j ACCEPT; iptables -t nat -D POSTROUTING -o eth0 -j MASQUERADE
ListenPort = 51820

[Peer]
PublicKey = <contents-of-client-publickey>
AllowedIPs = 10.0.0.2/32

sudo cat /etc/wireguard/publickey
sudo cat /etc/wireguard/privatekey

# Starting WireGuard and enabling it at boot

wg-quick up wg0			        # start your configuration
wg show				            # check your configuration
systemctl enable wg-quick@wg0 	# start automatically at system boot

sudo apt-get update && sudo apt-get upgrade -y
sudo modprobe wireguard
sudo reboot

# Client configuration
sudo nano /etc/wireguard/wg0.conf

sudo wg-quick up wg0
sudo systemctl start wg-quick@wg0

#  disconnect
sudo wg-quick down wg0
sudo systemctl stop wg-quick@wg0

# Adding more clients

sudo nano /etc/wireguard/wg0.conf
sudo systemctl restart wg-quick@wg0

# test check connection
sudo wg show
sudo watch wg show
sudo wg show all dump

# wg admins
https://www.procustodibus.com/blog/2021/01/how-to-monitor-wireguard-activity/
https://github.com/wg-dashboard/wg-dashboard


ERROR bash: cd: /etc/wireguard/: Permission denied

FIX
sudo su
cd /etc/wireguard/
wg show
watch wg show

#check last handshake time?


ERROR:
Job for wg-quick@wg0.service failed because the control process exited with error code.
sudo systemctl start wg-quick@wg0
# check
systemctl status wg-quick@wg0.service
journalctl -xe



Available subcommands:
  show: Shows the current configuration and device information
  showconf: Shows the current configuration of a given WireGuard interface, for use with `setconf'
  set: Change the current configuration, add peers, remove peers, or change peers
  setconf: Applies a configuration file to a WireGuard interface
  addconf: Appends a configuration file to a WireGuard interface
  syncconf: Synchronizes a configuration file to a WireGuard interface
  genkey: Generates a new private key and writes it to stdout
  genpsk: Generates a new preshared key and writes it to stdout
  pubkey: Reads a private key from stdin and writes a public key to stdout

sudo wg-quick up wg0
sudo wg-quick down wg0

apt update && apt install curl
curl ifconfig.io


systemctl start wg-quick@wg0
systemctl stop wg-quick@wg0
systemctl status wg-quick@wg0
```
######
###   GUI openvpn
######
```
https://askubuntu.com/questions/508250/openvpn-gui-client-for-udp-tcp

sudo apt-get install openvpn
sudo apt-get install network-manager-openvpn
sudo apt-get install network-manager-openvpn-gnome
sudo apt install openvpn network-manager-openvpn -y

sudo openvpn --config
sudo openvpn --config '/home/someuser/Desktop/vpnbook-us1-tcp443.ovpn'
```

######
###   ftp ubuntu isos
######
```
http://ftp-stud.hs-esslingen.de/Mirrors/ftp.debian.org/debian-cd/11.0.0-live/amd64/iso-hybrid/
http://ftp-stud.fht-esslingen.de/Mirrors/releases.ubuntu.com/21.04/
```

######
###   tips phpstorm
######
```
Ctrl + Alt + Shift + U 	= diagram
Ctrl + Shift + Space 	= type-matching completion
Ctrl + Alt + Shift + N 	= Open any class
Ctrl + Q = Dokumentation
```

######
###   ssh-keygen
######
```
https://docs.github.com/en/authentication/connecting-to-github-with-ssh
https://docs.github.com/en/authentication/connecting-to-github-with-ssh/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent
https://docs.github.com/en/authentication/connecting-to-github-with-ssh/testing-your-ssh-connection


#ssh-keygen -t ed25519 -C "your_email@example.com"
ssh-keygen -t rsa -b 4096 -C "your_email@example.com"
eval "$(ssh-agent -s)"
ssh-add ~/.ssh/id_ed25519

# Generating a new SSH key for a hardware security key
ssh-keygen -t ed25519-sk -C "your_email@example.com"
ssh-keygen -t ecdsa-sk -C "your_email@example.com"


Testing your SSH connection
ssh -T git@github.com

```

######
###   docker
######
```
https://docs.docker.com/compose/gettingstarted/
https://docs.docker.com/compose/
https://docs.docker.com/compose/reference/
https://docs.docker.com/get-started/08_using_compose/
https://towardsdatascience.com/connect-to-mysql-running-in-docker-container-from-a-local-machine-6d996c574e55

sudo apt install docker docker.io docker-compose
sudo docker-compose up
sudo docker-compose up -f file.yml

ip addr show docker0
ping 12.17.0.1

sudo docker ps

# access mysql container by sh
sudo docker exec -it mk-mysql bash
sudo docker exec -it 0a0a92fef642 bash

# sudo docker exec -i 0a0a92fef642 mysql -uroot -psecret mysql < db.sql
# docker run --name=mk-mysql -p3306:3306 -v mysql-volume:/var/lib/mysql -e MYSQL_ROOT_PASSWORD=my-secret-pw -d mysql/mysql-server:8.0.20
# docker run --rm -it --network=host mysql mysql -h 127.0.0.1 -uroot -p
# docker run --name src -p 8081:8081 -d test -e MYSQL_PASSWORD=12345678 -e MYSQL_DATABASE=testdb -e MYSQL_USER=root -e MYSQL_HOST=192.168.0.1

https://nickjanetakis.com/blog/docker-tip-35-connect-to-a-database-running-on-your-docker-host
https://stackoverflow.com/questions/33001750/connect-to-mysql-in-a-docker-container-from-the-host
https://gist.github.com/geraldvillorente/4c60e7fdb5562f443f16ad2bbe4235ce
```

######
###   tar gz compress
######
```
tar -czvf x.sql.gz x.sql
tar -czvf x-of-archive.tar.gz  x-of-archive
```


######
###    xdebug
######
```
https://xdebug.org/docs/install
https://xdebug.org/docs/upgrade_guide

sudo apt-get install php-xdebug -y
sudo apt-get install php7.4-xdebug

# Installing with PECL
pecl install xdebug

in docker
https://veselin.dev/blog/xdebug-3-in-docker
https://medium.com/@sirajul.anik/install-and-configure-xdebug-3-in-a-docker-container-and-integrate-step-debugging-with-phpstorm-5e135bc3290a
https://stackoverflow.com/questions/65107145/docker-php-with-xdebug-3-env-xdebug-mode-doesnt-work
https://github.com/cicnavi/dockers/blob/master/dap/80/Dockerfile
https://github.com/cicnavi/dockers/blob/master/dap/80/php-config/custom.ini
https://www.jetbrains.com/help/phpstorm/configuring-xdebug.html
https://www.srijan.net/resources/how-to-run-xdebug-using-phpstorm-in-docker
https://matthewsetter.com/setup-step-debugging-php-xdebug3-docker/

RUN docker-php-ext-enable xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

```


######
### Dell PDFs
######
```
https://topics-cdn.dell.com/pdf/xps-13-9370-laptop_setup-guide_en-us.pdf
https://dl.dell.com/topicspdf/xps-13-9360-laptop_setup-guide_en-us.pdf
```

######
https://ubuntu.com/server/docs/security-firewall
######
```
sudo ufw enable
sudo ufw disable
sudo ufw status
```

######
### Copy Directories on Linux Recursive
######
```
https://devconnected.com/how-to-copy-directory-on-linux/
https://devconnected.com/how-to-copy-directory-on-linux/

cp -R <source_folder> <destination_folder>
cp -R /etc/* .
```

######
### set Permanent DNS Nameservers in Ubuntu and Debian
https://www.tecmint.com/set-permanent-dns-nameservers-in-ubuntu-debian/
https://www.digitalocean.com/community/questions/how-do-i-switch-my-dns-resolvers-away-from-google
######
```
sudo nano /etc/resolvconf/resolv.conf.d/head

nameserver 8.8.8.8
nameserver 8.8.4.4

sudo systemctl start resolvconf.service
cat /etc/resolv.conf
```


######
### How To Get Intel Graphics Control Panel In Ubuntu
######
```
https://askubuntu.com/questions/1205892/how-to-get-intel-graphics-control-panel-in-ubuntu
https://www.intel.com/content/www/us/en/support/articles/000005520/graphics.html

sudo apt-get -y install driconf ?

How to Find Graphics Drivers for Linux*
lshw -c video
lspci -k | grep -EA3 ‘VGA|3D|Display’

-----
https://bbs.archlinux.org/viewtopic.php?id=269951

xrandr --setprovideroutputsource modesetting NVIDIA-0
xrandr --auto


# this is in /etc/X11/xorg.conf.d/20-nvidia.conf
Section "Device"
        Identifier "Nvidia Card"
        Driver "nvidia"
        VendorName "NVIDIA Corporation"
        BoardName "GeForce GTX 3050 Ti"
	Option	"ForceFullCompositionPipeline"	"true"
EndSection

/etc/X11/xorg.conf.d/10-nvidia-drm-outputclass.conf
----
Section "OutputClass"
    Identifier "intel"
    MatchDriver "i915"
    Driver "modesetting"
EndSection

Section "OutputClass"
    Identifier "nvidia"
    MatchDriver "nvidia-drm"
    Driver "nvidia"
    Option "AllowEmptyInitialConfiguration"
    Option "PrimaryGPU" "yes"
    Option "AllowIndirectGLXProtocol" "off"
    Option "TripleBuffer" "on"
    Option "ForceFullCompositionPipeline" "true"
    ModulePath "/usr/lib/nvidia/xorg"
    ModulePath "/usr/lib/xorg/modules"
EndSection

.xinitrc
----
xrandr --setprovideroutputsource modesetting NVIDIA-0
xrandr --auto

/etc/default/grub
----
# GRUB boot loader configuration

GRUB_DEFAULT=0
GRUB_TIMEOUT=5
GRUB_DISTRIBUTOR="Arch"
#GRUB_CMDLINE_LINUX_DEFAULT="loglevel=3"
GRUB_CMDLINE_LINUX_DEFAULT="loglevel=3 nvidia-drm.modeset=1 usbcore.autosuspend=-1"
[...]


/etc/mkinitcpio.conf
----
# vim:set ft=sh
# MODULES
# The following modules are loaded before any boot hooks are
# run.  Advanced users may wish to specify all system modules
# in this array.  For instance:
#     MODULES=(piix ide_disk reiserfs)
#MODULES=(crc32c-intel vmd)
MODULES=(crc32c-intel vmd nvidia nvidia_modeset nvidia_uvm nvidia_drm)
[...]
```


######
### Correct file permissions for WordPress [closed]
https://stackoverflow.com/questions/18352682/correct-file-permissions-for-wordpress
######
```
chown www-data:www-data  -R * # Let Apache be owner
find . -type d -exec chmod 755 {} \;  # Change directory permissions rwxr-xr-x
find . -type f -exec chmod 644 {} \;  # Change file permissions rw-r--r--
```

######
### webcam for ubuntu
######
```
sudo apt-get install cheese
cheese
```

######
###   Get Hardware Info
https://askubuntu.com/questions/258922/how-to-display-notebook-model-number
######
```
# get config
sudo dmidecode |grep Version

# get laptop name and type
sudo dmidecode | grep -A 9 "System Information"
sudo dmidecode | less
sudo dmidecode -t 1
```

######
###   docker wordpress
#########################################

https://www.wpdiaries.com/wordpress-with-xdebug-for-docker/

######
###  wordpress error logs
#########################################
```
https://www.wpbeginner.com/wp-tutorials/how-to-set-up-wordpress-error-logs-in-wp-config/
https://kinsta.com/blog/wordpress-debug/
https://codex.wordpress.org/WP_DEBUG
https://www.wpwhitesecurity.com/complete-guide-wordpress-debug-mode/
https://wpadvancedads.com/finding-errors-with-wp_debug/
https://wordpress.org/plugins/query-monitor/####
https://wordpress.stackexchange.com/questions/47123/how-to-define-wp-debug-as-true-outside-of-wp-config-php

in your wp-config.php

define( 'WP_DEBUG', true ); 			# Enable debugging
define( 'WP_DEBUG_LOG', true ); 		# saved to a debug.log
define( 'WP_DEBUG_DISPLAY', false ); 	# shown inside the HTML
define( 'SAVEQUERIES', true );

#define( 'SCRIPT_DEBUG', true ); # Use dev of core JS and CSS files

@ini_set('display_errors',1);
error_reporting(E_ALL);

check /wp-content/debug.log
```


######
### git diff
#########################################
```
https://stackoverflow.com/questions/4099742/how-to-compare-files-from-two-different-branches

git log --oneline
git diff mybranch master -- myfile.cs
git diff mybranch..master -- myfile.cs
```


######
### ERROR: ASCII ‘\0’
#########################################
```
ERROR: ASCII ‘\0’ appeared in the statement, but this is not allowed unless option –binary-mode
is enabled and mysql is run in non-interactive mode. Set –binary-mode to 1 if ASCII ‘\0’ is expected.
Query:

gunzip myfile.sql.gz
```



### pull request
https://www.gitkraken.com/

```
git push --set-upstream origin your-feature
```



### git strategy - merge / rebase

```
# merge
git checkout master
git pull
git checkout branch
git merge master
git checkout master
git merge branch
git status

# rebase
git checkout master
git pull
git checkout branch
git rebase master
git checkout master
git rebase branch
git status
```









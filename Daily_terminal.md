## Daily CMDs

### Check repo file Sizes
~~~~
* find . -name '*' -size +1M -exec ls -lh {} \; | awk '{ print $9 ": " $5 }'
~~~~


### Find files by date 
~~~~
find . -type f  -name *.xm
find . -maxdepth 5 -type f  -mtime -25 -name *.xm
find ~/  -maxdepth 5 -type f  -mtime -25 -name *.xm
find ~/  -maxdepth 5 -type f  -mtime -25 -name *.mmpz  -exec ls  {} \;
find ~/  -maxdepth 5 -depth -type f -atime +13 -name *.xm
find ~/  -maxdepth 5 -depth -type f -mtime -13 -name *.xm
find ~/ -type f -newermt 2018-02-28 -not -newermt 2018-03-28
find ~/ -name *.xm -type f -mtime -25
find ~/ -name *.xm -type f -ctime -15
find ~/ -type f -newermt 2015-05-16 | xargs ls -l
~~~~


### rename
```
* // rename incremental 000 - 999
* num=0; for i in *; do mv "$i" "$(printf '%04d' $num).${i#*.}"; ((num++)); done

* // rename incremental 000.xi - 999.xi
* num=0; for i in *.xi; do mv "$i" "$(printf '%04d' $num).xi"; ((num++)); done

* // rename random 000 - 999
* for i in *; do mv "$i" $(($RANDOM % 1000000000)).${i#*.}; done

# files 0001
num=0; for i in *; do mv "$i" "$(printf '%04d' $num).${i#*.}"; ((num++)); done

# folders 0001
num=0; for i in $(find * -type d); do mv "$i" "$(printf '%04d' $num)"; ((num++)); done

for i in $(ls -d */); do echo ${i%%/}; done
num=0; for i in $(ls -d */); do mv "$i" "$(printf '%04d' $num)"; ((num++)); done
```

### rename remove file name spaces
```
sudo apt install rename
rename 's/ /_/g' *
rename 's/\t/_/g' *

####################################################
Rename Files and Directories (Add Prefix)
####################################################

https://stackoverflow.com/questions/4787413/rename-files-and-directories-add-prefix
https://unix.stackexchange.com/questions/47367/bulk-rename-change-prefix
https://askubuntu.com/questions/878940/how-to-rename-a-certain-prefix-in-multiple-files


for f in * ; do mv -- "$f" "PRE_$f" ; done
for f in TestSR*; do mv "$f" "CL${f#TestSR}"; done
for i in TestSR*; do mv "$i" "${i/#TestSR/CL}"; done

rename 's/^/PRE_/' *
rename TestSR CL TestSR*

ls | xargs -I {} mv {} PRE_{}
ls | xargs -I {} mv {} {}_SUF

find * -maxdepth 0 -exec mv {} PRE_{} \;

ls *.{h,m} | while read a; do n=CL$(echo $a | sed -e 's/^Test//'); mv $a $n; done


for f in TestSR*.m; do mv $f CL$(echo $f | cut -c7-); done;
for f in TestSR*.h; do mv $f CL$(echo $f | cut -c7-); done;


####################################################
create multi level dirs and files
####################################################

https://superuser.com/questions/1787603/find-and-rename-base-directory-and-files-under-each-basedir-add-a-prefix

mkdir TesT; cd TesT
mkdir -p G{1,2}_root/level_1/bin.{1,2}
touch G{1,2}_root/level_1/bin.{1,2}/{ab.txt,cd.txt}
tree

├── G1_root
│   └── level_1
│       ├── bin.1
│       │   ├── ab.txt
│       │   └── cd.txt
│       └── bin.2
│           ├── ab.txt
│           └── cd.txt
└── G2_root
    └── level_1
        ├── bin.1
        │   ├── ab.txt
        │   └── cd.txt
        └── bin.2
            ├── ab.txt
            └── cd.txt


```

### Umount force
```
sudo service nfs-kernel-server stop
sudo umount -f ~/path
sudo umount -l -f ~/path
```

### Surf web
```bash
lynx t3n.de -accept_all_cookies  -justify
```

### List 
```
> list first 30 folders
* ll -t | head -30 
> list all folders from last 24 hours
* find folder/ -maxdepth 2 -type f -name "*.json" -mtime -1 -exec grep -i 'string' {} \; 
  ```

### Generate Random Pass Ubuntu
```
* date +%s | sha256sum | base64 | head -c 24 ; echo "@%&";
* date +%s | sha1sum | base64 | head -c 12; echo "@%&";

# gen random number 1 - 300
echo $((RANDOM % 300)); 
```

### Zipping Unzipping multiple Folders

| cmd            | example                                        | 
|----------------|------------------------------------------------| 
| unzip          | for z in *.zip; do unzip $z; done              |
| zip folders    | for i in */; do zip -r "${i%/}.zip" "$i"; done |
| zip only files | for i in *.*; do zip "${i}.zip" "$i"; done     |


### Tar Untar 


|  cmd  | example                                        | 
|:------|:-----------------------------------------------| 
| tar   | tar -czvf archive.tar.gz folderpath1           |
| untar | tar -xzvf archive.tar.gz                       |


### Change date modified created file
```
 * -a = accessed / -m = modified / -t = timestamp
 ```

| desc          | cmd                                             | 
|:--------------|:------------------------------------------------| 
| generate file | touch {1..19}.jpg                               | 
| change date   | touch -d "October 31"  filename.txt             | 
| change date   | touch -d '14:24' file.txt                       | 
| change date   | touch -d "2 hours ago" filename                 | 


### Convert Imagick
```
* for i in *.png; do convert "$i" "${i%.png}.jpg" && rm "$i" && echo "$i is converted."; done
* for i in *.png; do convert "$i" "${i%.*}.jpg" ; done
```

### Timestamp
```
* date +%s > 1552925792
```

### Users management
```
# add user
+ sudo adduser newuser

# remove user
+ sudo deluser newuser
+ sudo deluser --remove-home newuser

# change passwd
+ sudo passwd username

-------

sudo apt-get install adduser

sudo adduser username
sudo adduser username --shell /bin/sh
sudo adduser username --groups sudo,admin

sudo adduser --gecos "" username
sudo adduser --gecos "" --shell /bin/zsh --disabled-password username
sudo adduser username sudo
sudo adduser --disabled-password --gecos "" username
sudo adduser username www-data 
sudo adduser --group admin 

sudo useradd --create-home --shell /bin/bash --user-group username
sudo useradd -m -p <encryptedPassword> -s /bin/bash <user>

sudo usermod -a -G group1,group2 username
sudo usermod -aG sudo username
sudo usermod -s /bin/bash $USER
sudo useradd -d /home/$USER -s /bin/bash -G group -m $USER

sudo passwd username 

sudo userdel -r username
sudo userdel -f username

sudo rm -r /home/username
```

### Hostname management
```
+ sudo nano /etc/hosts
+ sudo nano /etc/hostname
```

###  [Manage SWAP]

##### Add temporary Swap file on Ubuntu 18.04
```
* sudo fallocate -l 6G /swapfile2 && sudo chmod 600 /swapfile2 && sudo mkswap /swapfile2 && sudo swapon /swapfile2 && sudo sysctl vm.swappiness=20
* sudo swapoff -a && sudo fallocate -l 4G /swapfile3 && sudo chmod 600 /swapfile3 && sudo mkswap /swapfile3 && sudo swapon /swapfile3 -a && swapon -s && swapon --show
* sudo sudo rm /swapfile3 
```

##### Expand Swap file in Ubuntu to 4GB or more
```
* sudo swapoff -a && sudo dd if=/dev/zero of=/swapfile bs=500M count=8 && sudo mkswap /swapfile && sudo swapon /swapfile -a && swapon -s && swapon --show 
* echo "vm.swappiness=10" | sudo tee -a /etc/sysctl.conf
* echo 3 | sudo tee /proc/sys/vm/drop_caches
* sudo sh -c "/usr/bin/echo 3 > /proc/sys/vm/drop_caches"
* size="4G" && file_swap=/swapfile_$size.img && sudo touch $file_swap && sudo fallocate -l $size /$file_swap && sudo mkswap /$file_swap && sudo swapon -p 20 /$file_swap

```

####  [Manage RamDisk]
```
* sudo mkdir /tmp/ramdisk
* sudo chmod 777 /tmp/ramdisk
```

##### allocate 1G for the RAM disk
```
* sudo mount -t tmpfs -o size=1024m myramdisk /tmp/ramdisk	
```


### [Clean and Boost OS]

##### Utiles Daily
```
> chrome chromium light loading
* /usr/lib/chromium-browser/chromium-browser --disable-new-tab-first-run --enable-user-scripts --flag-switches-begin  --disable-accelerated-2d-canvas --disable-gpu-vsync --disable-threaded-animation --disable-webgl --js-flags=--harmony  --flag-switches-end --disable-gpu-process-prelaunch --no-sandbox

* /usr/lib/chromium-browser/chromium-browser  --enable-user-scripts --flag-switches-begin --disable-accelerated-2d-canvas --disable-gpu-vsync --disable-threaded-animation --disable-webgl --js-flags=--harmony --flag-switches-end --disable-gpu-process-prelaunch --process-per-site --enable-low-end-device-mode --no-sandbox

* /usr/lib/chromium-browser/chromium-browser  --enable-user-scripts --flag-switches-begin --disable-accelerated-2d-canvas --disable-gpu-vsync --disable-threaded-animation --disable-webgl --js-flags=--harmony --flag-switches-end --disable-gpu-process-prelaunch --enable-low-end-device-mode --no-sandbox --enable-low-res-tiling --process-per-site

* /usr/lib/chromium-browser/chromium-browser  --enable-user-ripts --flag-switches-begin --disable-accelerated-2d-canvas --disable-gpu-vsync --disable-threaded-animation --disable-webgl --js-flags=--harmony --flag-switches-end --disable-gpu-process-prelaunch  --no-experiments --disable-notifications --no-referrers --new-window --enable-low-end-device-mode --restore-last-session --no-sandbox

* /usr/lib/chromium-browser/chromium-browser  --enable-user-scripts --flag-switches-begin --disable-accelerated-2d-canvas --disable-gpu-vsync --disable-threaded-animation --disable-webgl --js-flags=--harmony --flag-switches-end --disable-gpu-process-prelaunch  --no-experiments --disable-notifications --no-referrers --new-window --enable-low-end-device-mode --restore-last-session  --no-sandbox --disable-gpu  --disable-software-rasterizer --enable-gpu-rasterization

* chromium-browser --enable-user-scripts --flag-switches-begin --disable-accelerated-2d-canvas --disable-gpu-vsync --disable-threaded-animation --disable-webgl --js-flags=--harmony --flag-switches-end --disable-gpu-process-prelaunch --no-experiments --disable-notifications --no-referrers --new-window --enable-low-end-device-mode --restore-last-session  --disable-gpu --disable-software-rasterizer --enable-gpu-rasterization --new-window --aggressive-cache-discard --disable-notifications --disable-remote-fonts --disable-reading-from-canvas --disable-remote-playback-api --disable-shared-workers --disable-voice-input --enable-aggressive-domstorage-flushing --disable-application-cache 

* chromium --process-per-site --no-sandbox --args --js-flags="--max_old_space_size=2192" --purge-memory-button
* google-chrome --process-per-site --no-sandbox --args --js-flags="--max_old_space_size=2192"  --purge-memory-button

* chromium --process-per-site --purge-memory-button --enable-low-end-device-mode --enable-low-res-tiling --disable-notifications --no-referrers --new-window
* google-chrome --process-per-site --enable-low-res-tiling --no-referrers --new-window 
* chromium --process-per-site --no-sandbox --args --js-flags="--max_old_space_size=2192" --purge-memory-button
* google-chrome --process-per-site --no-sandbox --args --js-flags="--max_old_space_size=2192" --max-old-space-size=2048

* google-chrome --wm-window-animations-disabled --autoplay-policy=no-user-gesture-required --animation-duration-scale=0 --disable-threaded-animation --no-experiments --disable-notifications --no-referrers --new-window --enable-low-end-device-mode --restore-last-session --disable-remote-fonts --disable-remote-playback-api --disable-voice-input

* chromium-browser --bound-session-cookie-rotation-delay --disable-partitioned-cookies --disable-notifications --disable-ipc-flooding-protection --disable-print-preview --disable-remote-fonts  --disable-renderer-accessibilit --disable-threaded-animation  --disable-virtual-keyboard

* google-chrome  --bound-session-cookie-rotation-delay --disable-partitioned-cookies --disable-notifications --disable-ipc-flooding-protection --disable-print-preview --disable-remote-fonts  --disable-renderer-accessibilit --disable-threaded-animation  --disable-virtual-keyboard --disable-print-preview



```
```
* chromium --process-per-site
* google-chrome 
* brave 
```
```
> chrome://flags
* --no-sandbox --site-per-process --process-per-site --enable-low-end-device-mode --disk-cache-size=104857600
* --process-per-site-instance --process-per-site --process-per-tab --single-process --args  –disk-cache-size=10 
> firefox
* firefox -no-remote -new-tab -console -purgecaches
* firefox -no-remote -new-window -p sidekick  -new-instance -P 
* firefox -no-remote -allow-downgrade -private -purgecaches -safe-mode -p sidekick -P
```
```
> open multiple tabs 
* Chromium:
* xargs google-chrome --new-tab < urls.txt
* xargs chromium-browser --new-tab < urls.txt
* Firefox:
* xargs -L1 firefox -new-tab < urls.txt
* create online clickable list https://www.linkrr.com/
* create online bookmark https://atkinsio.com/bookmarks-html-generator/
```
```
> boost cpu
* for i in {0..7}; do echo performance | sudo tee /sys/devices/system/cpu/cpu"$i"/cpufreq/scaling_governor ; done
> manage cpu performance
> http://manpages.ubuntu.com/manpages/bionic/man8/x86_energy_perf_policy.8.html
* sudo apt install linux-tools-5.4.0-31-generic linux-tools-generic linux-cloud-tools-generic linux-tools-common -y
* sudo x86_energy_perf_policy -v balance-performance
```

##### vm settings
```
* sudo sysctl -w vm.swappiness=20
* sudo sysctl -w vm.swappiness=20 && sudo sysctl vm.vfs_cache_pressure=50 && sudo sysctl -w net.ipv4.ip_forward=1
* sudo sysctl -w vm.swappiness=10 && sudo sysctl -w vm.vfs_cache_pressure=50 && sudo sysctl -w vm.dirty_ratio=10 && sudo sysctl -w vm.dirty_background_ratio=5 && sudo sync && sudo sysctl -w vm.drop_caches=3
```

##### wlan mtu
```
* ip link show | grep mtu
* sudo ip link set wlp3s0 mtu 1400 up
* ping -c 3 -M do -s 400 google.com
```

##### Drop cache
```
* cat /proc/sys/vm/swappiness
* sync && echo 3 | sudo tee /proc/sys/vm/drop_caches
* echo 3 | sudo tee /proc/sys/vm/drop_caches && sudo /etc/init.d/networking restart 
* sudo swapoff -a && sudo swapon -a && printf '\n%s\n' 'Swap Cleared'
```

##### DNS Flush networking
```
* sudo /etc/init.d/dns-clean restart && sudo /etc/init.d/networking force-reload && sudo /etc/init.d/nscd restart && sudo service network-manager restart
```

##### Disable services
```
* sudo service apache2 status
* sudo update-rc.d -f apache2 disable
* sudo update-rc.d apache2 enable
* sudo update-rc.d apache2 disable
* service --status-all
* sudo systemctl disable apache2
* sudo systemctl disable mysql
```


##### clean DNS 
```
* sudo /etc/init.d/dns-clean reload && echo 2 | sudo tee /proc/sys/vm/drop_caches && sudo service network-manager reload 
```

##### clear Browsers Cache Data 
```
* chrome://settings/clearBrowserData
* ll ~/.cache/chromium/Default/
* rm -rf ~/.cache/chromium
* rm -rf ~/.cache/google-chrome
* rm ~/.cache/google-chrome
* rm ~/.config/google-chrome/Default/
* rm ~/.mozilla/firefox/*.default/cookies.sqlite
* rm -r ~/.cache/mozilla/firefox/*.default/*
* rm -r ~/.cache/chromium/Default/Cache/*
```

##### stop Services
```
* service --status-all
* sudo service network-manager reload 
* sudo service bluetooth stop && sudo service virtualbox stop
* sudo service whoopsie stop && sudo service cups stop && sudo service cups-browsed stop
* sudo service mysql stop &&  sudo service apache2 stop &&  sudo service openvpn stop && sudo service virtualbox stop 
* service --status-all
```

##### Accessing local data on VM using python SimpleHTTPServer
```
* python -m SimpleHTTPServer (deprecated python2)
* python3 -m http.server 8888
* http://localhost:8000
* php -S localhost:4000
* PHP_CLI_SERVER_WORKERS=8 php -S localhost:8000 -t htdocs


sudo apt install net-tools
ifconfig
ip addr show
python3 -m http.server 8888


```

##### list packages
```
* dpkg --get-selections | grep -v deinstall
* dpkg -l
* dpkg-query -l | less
* apt list --installed
* apt list --installed | less
* apt list
* snap list
* pip list
* pip3 list
* aptitude search '~i!~M'
```

##### snap packages
```
snap list

sudo snap install code --classic
sudo snap install rider --classic
sudo snap install clion --classic
sudo snap install pycharm-community --classic
sudo snap install phpstorm --classic
sudo snap install intellij-idea-community --classic

sudo snap save
snap saved
sudo sh -c 'rm -rf /var/lib/snapd/cache/*'
sudo rm -rf /var/lib/snapd/cache/*
sudo snap remove --purge clion
snap list --all
sudo snap set system refresh.retain=2
snap refresh
snap remove pycharm-community --revision=500
du -sh /var/lib/snapd/snaps
ls -lh /var/lib/snapd/snaps


////////// remove snapshots //////////

snap saved
snap forget 6  # id listed
sudo ls /var/lib/snapd/snapshots

```



##### remove packages
```
* dpkg -r <package> 
* apt remove --purge <package> 
* snap remove <package>
* pip uninstall <package>
```

##### clean install update
```
* https://wiki.ubuntuusers.de/apt/apt-get/
* pip install --upgrade pip
* sudo apt-get autoremove
* sudo apt-get autoclean
```

##### clean cache folder
```
* sudo rm -rf .cache/pip/http/*
* find ~/.cache/ -type f -atime +365 -delete
* find ~/.cache/pip/http/ -depth -type f -atime +365 
* find ~/.cache/pip/ -depth -type f -atime +3
* ? ~/.local/lib/pythonX.X/site-packages
```

#####  system  monitoring
```
* gnome-system-monitor
* baobab [GNOME Disk Usage Analyzer]
```

##### ubuntu optimisation - disable tracking and clear journalctl file
```
* gsettings set org.freedesktop.Tracker.Miner.Files low-disk-space-limit 1
* gsettings set org.freedesktop.Tracker.Miner.Files enable-monitors false
* gsettings set org.freedesktop.Tracker.Miner.Files crawling-interval -2
* tracker daemon pause
* sudo journalctl --vacuum-size=20M && du -hs /var/log/journal/
* ps aux | grep zeitgeist
* zeitgeist-daemon -r --log-level=DEBUG
* zeitgeist-daemon --quit --vacuum
* pkill -c zeitgeist-daemon
* kill <zeitgeist-daemon-PID>
* sudo find / -name '*' -size +1G
* sudo find / -type f -name '*.log' -size +20M
* sudo truncate -s0 error_log
```


### DNS Settings Google and Cloudflare

### For IPv4:
```
* nameserver 8.8.8.8,8.8.4.4,1.1.1.1,1.0.0.1

sudo apt update
sudo apt install resolvconf
sudo nano /etc/resolvconf/resolv.conf.d/head

nameserver 8.8.8.8
nameserver 8.8.4.4
nameserver 1.1.1.1
nameserver 1.1.1.2
nameserver 1.1.1.3
nameserver 1.0.0.1
nameserver 1.0.0.2
nameserver 1.0.0.3


sudo resolvconf --enable-updates
sudo resolvconf -u
sudo nano /etc/resolv.conf
```

#### For IPv6:
```
* nameserver 2001:4860:4860::8888,2001:4860:4860::8844,2606:4700:4700::1111,2606:4700:4700::1001
```

#### Cloudflare + Google

```

Cloudflare
https://en.wikipedia.org/wiki/1.1.1.1
https://1.1.1.1/dns/

For IPv4: 1.1.1.1 and 1.0.0.1
For IPv6: 2606:4700:4700::1111,2606:4700:4700::1001

Quad9 is a free service that replaces your default ISP or enterprise Domain Name Server (DNS) configuration.
DNS 9.9.9.9

Via IPv4	
1.1.1.1
1.0.0.1
1.1.1.2
1.0.0.2
1.1.1.3
1.0.0.3

Via IPv6	
2606:4700:4700::1111
2606:4700:4700::1001	
2606:4700:4700::1112
2606:4700:4700::1002	
2606:4700:4700::1113
2606:4700:4700::1003

Google Public DNS IP addresses
https://developers.google.com/speed/public-dns/docs/using

8.8.8.8
8.8.4.4

2001:4860:4860:0:0:0:0:8888
2001:4860:4860:0:0:0:0:8844
```


#### Fast VM install 
```
* sudo apt install vagrant

* vagrant init ubuntu/trusty64 -f -m --output Ubuntu1404LTS; vagrant up --provider virtualbox
* vagrant init ubuntu/xenial64 -f -m --output Ubuntu1604LTS; vagrant up --provider virtualbox
* vagrant init ubuntu/bionic64 -f -m --output Ubuntu1804LTS; vagrant up --provider virtualbox
* vagrant init ubuntu/focal64 -f -m --output Ubuntu2004LTS; vagrant up --provider virtualbox
* vagrant init ubuntu/hirsute64 -f -m --output Ubuntu2104LTS; vagrant up --provider virtualbox
* vagrant init debian/stretch64 -f -m --output Debian9stretch64; vagrant up --provider virtualbox

* vagrant init opensuse/Leap-15.2.x86_64 -f -m; vagrant up --provider virtualbox
* vagrant init opensuse/Tumbleweed.x86_64 -f -m; vagrant up --provider virtualbox
* vagrant init generic/opensuse42 # opensuse42 -f -m; vagrant up --provider virtualbox
* vagrant init Sabayon/spinbase-amd64  # gento -f -m; vagrant up --provider virtualbox
* vagrant init generic/devuan3 -f -m; vagrant up --provider virtualbox
* vagrant init generic/devuan2 -f -m; vagrant up --provider virtualbox

* user pass: vagrant vagrant
* https://app.vagrantup.com/ubuntu/boxes/focal64
* https://app.vagrantup.com/debian/boxes/buster64
* sudo apt install xfce4
* apt get install xinit
* apt get update --fix-missing
* systemctl poweroff
* rm Vagrantfile
* rm -r .vagrant
```


### Sync folders from drives
```
* rsync --ignore-existing --recursive --progress /home/user/folder_sync/ /media/user/external_drive/folder_sync/
```

### Generate Current Dir Structure 
```
sudo snap install tree 
sudo apt  install tree -y
tree -Ld 3 > FolderStructure.txt
```


######
### Format json
######
```
compact json data
jq . -c data.json > data_zip.json

prettify json data
jq . data_zip.json > data.json
```


### Browser Plugins
```
Ghostery
Privacy Badger
uBlock Origin
DuckDuckGo
NoScript
```


### Access localhost on remote server
```
start locally [ python3 -m http.server.8080 with page index.html]
go on [ localhost.run website ]
copy [ ssh -R 80:localhost:8080 nokey@localhost.run ] on local machine
get link from temrinal and run it on browser
```


### Find string in files
```
https://www.cyberciti.biz/faq/howto-use-grep-command-in-linux-unix/
https://www.cyberciti.biz/faq/unix-linux-grep-include-file-pattern-recursive-example/
https://unix.stackexchange.com/questions/694796/how-to-grep-multiple-strings-when-using-with-another-command
https://www.warp.dev/terminus/grep-exclude
https://www.warp.dev/terminus/make-grep-case-insensitive

find ./folder -type f -name "*.php" -print0 | xargs -0 grep -i 'protected function'
grep -ir 'protected function' --include='*.php' ./folder | grep -v 'exclude string'

sudo find . -type f -iname "*.txt" -exec grep -H 'String' {} + 
sudo find . -type f -iname "*.txt" -exec grep -i "String" {} +
sudo find . -name "*.php" -exec grep -Hni "String" --color {} \;

cd /usr/src/linux && egrep -ir "String" # search in files
cd /usr/ && egrep -ir "String"
cd /usr && egrep -ir -w "String" # print first line
cd /usr && egrep -iIrnH -w "String"
```


### generate new ssh key
```
ssh-keygen -t rsa -b 4096 -C "somemail@outlook.com"
eval "$(ssh-agent -s)"

# debug
ssh -vvv git@bitbucket.org -p 29420
ssh-keygen -l -f ~/.ssh/id_rsa
```


### Post-installation steps for Linux
```
https://docs.docker.com/engine/install/linux-postinstall/

sudo apt install docker.io docker-compose
sudo groupadd docker
sudo usermod -aG docker $USER
sudo systemctl enable docker.service
sudo systemctl enable containerd.service
reboot
```

### Install VBoxGuestAdditions iso
~~~shell
reboot
wget https://download.virtualbox.org/virtualbox/6.1.2/VBoxGuestAdditions_6.1.2.iso
mkdir /media/iso
sudo mount ~/Downloads/VBoxGuestAdditions_6.1.2.iso /media/iso -o loop
/media/iso/VBoxLinuxAdditions.run
yes
reboot
~~~


### Install p7zip
~~~
sudo apt-get install p7zip p7zip-full p7zip-rar
~~~


### move first 1000 files - split folder files in subfolders
~~~
ls | wc -l
mv -v `ls | head -5000` ./sub1

strace -vf ls -l 
~~~


### move files by odd number - par impair
~~~
mkdir -p odd1 && for f in *[02468]*.jpeg; do mv "$f" odd1/"$f"; done
mkdir -p odd2 && for f in *[13579]*.jpeg; do mv "$f" odd2/"$f"; done

for f in *[02468]*.jpeg; do echo "$f"; done
for f in *[13579]*.jpeg; do echo "$f"; done
~~~



### Debian Ubuntu mirrors
~~~
https://cdimage.kali.org/kali-2024.4/
https://devuan-cd.bio.lmu.de/devuan_daedalus/installer-iso/
https://distrowatch.com/
https://downloads.getsol.us/isos/2024-10-14/
https://ftp-stud.hs-esslingen.de/Mirrors/
https://ftp-stud.hs-esslingen.de/Mirrors/cdimage.ubuntu.com/
https://ftp-stud.hs-esslingen.de/Mirrors/cdimage.ubuntu.com/kubuntu/releases/18.04/release/
https://ftp-stud.hs-esslingen.de/Mirrors/cdimage.ubuntu.com/lubuntu/releases/16.04/release/
https://ftp-stud.hs-esslingen.de/Mirrors/cdimage.ubuntu.com/lubuntu/releases/18.04.5/release/
https://ftp-stud.hs-esslingen.de/Mirrors/cdimage.ubuntu.com/lubuntu/releases/18.04.5/release/
https://ftp-stud.hs-esslingen.de/Mirrors/cdimage.ubuntu.com/lubuntu/releases/20.04/release/
https://ftp-stud.hs-esslingen.de/Mirrors/cdimage.ubuntu.com/lubuntu/releases/24.04/release/
https://ftp-stud.hs-esslingen.de/Mirrors/cdimage.ubuntu.com/ubuntu/releases/23.04/release/
https://ftp-stud.hs-esslingen.de/Mirrors/cdimage.ubuntu.com/xubuntu/releases/18.04/release/
https://ftp-stud.hs-esslingen.de/debian-cd/current-live/amd64/iso-hybrid/
https://ftp.fau.de/
https://rhlx01.hs-esslingen.de/Mirrors/cdimage.ubuntu.com/xubuntu/releases/noble/release/
https://rhlx01.hs-esslingen.de/Mirrors/cdimage.ubuntu.com/kubuntu/releases/22.04/release/
https://rhlx01.hs-esslingen.de/Mirrors/cdimage.ubuntu.com/lubuntu/releases/22.04/release/
https://rhlx01.hs-esslingen.de/Mirrors/releases.ubuntu.com/22.04/
https://ftp.fau.de/devuan-cd/devuan_chimaera/desktop-live/
https://ftp.fau.de/devuan-cd/devuan_chimaera/desktop-live/
https://ftp.fau.de/devuan-cd/devuan_daedalus/desktop-live/
https://ftp.fau.de/ubuntu-releases/14.04/
https://ftp.fau.de/ubuntu-releases/16.04/
https://ftp.fau.de/ubuntu-releases/22.04/
https://ftp.fau.de/ubuntu-releases/22.04/
https://iso.builds.garudalinux.org/iso/latest/garuda/kde-lite/
https://old-releases.ubuntu.com/releases/16.04.4/
https://releases.ubuntu.com/
https://releases.ubuntu.com/23.10.1/
https://releases.ubuntu.com/23.10/
https://releases.ubuntu.com/jammy/
https://releases.ubuntu.com/mantic/
https://repo-default.voidlinux.org/live/current/
https://rhinolinux.org/download
https://www.bunsenlabs.org/installation.html
https://www.debian.org/CD/http-ftp/
https://www.debian.org/releases/bullseye/amd64/ch08s01.en.html
https://www.devuan.org/get-devuan
https://releases.ubuntu.com/noble/
https://ftp.fau.de/ubuntu-releases/24.04.1/
~~~


### PDF Merge Ubuntu
~~~
convert input1.jpg input1.pdf
convert input2.jpg input2.pdf
gs -dQUIET -dBATCH -dNOPAUSE -sDEVICE=pdfwrite -sOutputFile=output.pdf input1.pdf input2.pdf

# multiple files
for i in *.jpg; do convert $i $i.pdf; done
gs -dQUIET -dBATCH -dNOPAUSE -sDEVICE=pdfwrite -sOutputFile=output.pdf *.pdf

# compress
gs -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=/ebook   -dNOPAUSE -dQUIET -dBATCH -sOutputFile=output.pdf input.pdf
~~~


### after login
~~~
sudo sysctl -w vm.swappiness=20
echo 3 | sudo tee /proc/sys/vm/drop_caches
sudo systemctl reload-or-restart networkd-dispatcher.service
~~~


### generate new file
~~~
touch  web_journey/search_$(date +%s).txt
~~~

### clear swap
~~~
sudo swapoff -a; sleep 15; sudo swapon -a 
~~~

### How to convert .webp images to .png on Linux
~~~
sudo apt update
sudo apt install webp
for i in *.webp; do dwebp $i -o $i.out.png; done;
~~~


### clear swap chrome
~~~
rm -rf ~/.cache/google-chrome/

sudo swapoff -a; sudo swapon -a
sudo swapoff -a; sleep 15; sudo swapon -a 

sudo sysctl vm.swappiness=10
sudo sync && echo 3 | sudo tee /proc/sys/vm/drop_caches
free && sync && echo 3 | sudo tee /proc/sys/vm/drop_caches && free
free -m && sync && echo 3 > /proc/sys/vm/drop_caches && free -m

export LANGUAGE=en-US && google-chrome --lang=en-US,en --disable-translate --ash-force-desktop --disable-3d-apis --disable-background-mode --disable-preconnect --dns-prefetch-disable --no-experiments --purge-memory-button --no-referrers --no-pings --start-maximized --disable-default-apps -disable-features=Translate --aggressive-cache-discard --disable-notifications --new-window --disable-dev-shm-usage --block-new-web-contents

export LANGUAGE=en-US && google-chrome  --bound-session-cookie-rotation-delay --disable-partitioned-cookies --disable-notifications --disable-ipc-flooding-protection --disable-print-preview --disable-remote-fonts  --disable-renderer-accessibilit --disable-threaded-animation  --disable-virtual-keyboard --disable-print-preview --block-new-web-contents --new-window --no-pings --start-maximized --disable-default-apps --no-experiments --no-referrers -disable-preconnect --dns-prefetch-disable --bwsi

chrome://restart 
chrome://gpu
chrome://flags/

systemd-run -p CPUQuota=20% chrome
ps ax | wc -l

https://peter.sh/experiments/chromium-command-line-switches/

--no-sandbox
--disable-gpu-sandbox
--enable-webgl 
--ignore-gpu-blacklist
--disable-gpu
--isolate-origins --disable-site-isolation-trials -enable-low-end-device-mode

chromium-browser --single-process --enable-low-end-device-mode --memory-model=low --process-per-tab
export LANGUAGE=en-US && brave  --single-process --enable-low-end-device-mode  --process-per-tab
export LANGUAGE=en-US && chromium-browser  --single-process --enable-low-end-device-mode  --process-per-tab
export LANGUAGE=en-US && google-chrome  --disable-features=ScriptStreaming -enable-low-end-device-mode --process-per-tab

~~~


###  grub-repair ***
~~~
https://help.ubuntu.com/community/Boot-Repair

sudo add-apt-repository ppa:yannubuntu/boot-repair && sudo apt update
sudo apt install -y boot-repair && boot-repair
~~~

###  boot-repair *** exfat ext3 ext4
~~~
sudo lsblk -f

sudo apt-get install ntfs-3g

sudo ntfsfix -n /dev/sda1 # dry run
sudo ntfsfix -b /dev/sda1 # -b or --clear-bad-sectors
sudo ntfsfix -d /dev/sda1 # clearing the volume dirty flag if the volume can be fixed and mounted.

sudo fdisk -l
sudo badblocks -sv /dev/mmcblk0

sudo badblocks -sv /dev/mmcblk0  > bad-blocks-result
sudo fsck -t ext4 -l bad-blocks-result /dev/mmcblk0

sudo badblocks -b 4096 -c 4096 -s /dev/mmcblk0
sudo fsck -r /dev/mmcblk0
sudo fsck -t ext3 -l bad-blocks-result /dev/mmcblk0

gnome-disks
sudo dd if=/dev/zero of=/dev/mmcblk0 count=10000

sudo ntfsfix -b /dev/mmcblk0
sudo ntfsfix -d /dev/mmcblk0 

sudo apt-get install smartmontools
sudo smartctl -i -d /dev/mmcblk0

sudo apt install exfatprogs
sudo fsck.exfat -r /dev/mmcblk0

sudo e2fsck -b 8193 /dev/mmcblk0
sudo e2fsck -b 32768 /dev/mmcblk0
~~~


###  wget get files

~~~
wget --no-clobber --mirror -p -l1 --convert-links -P . --wait=2 --limit-rate=50K --user-agent="Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0" <url>
~~~

###  get ubuntu debian version

~~~
cat /etc/debian_version
lsb_release -a
uname -r -a
~~~

###  tasksel and taskset

~~~
sudo apt-get install tasksel
tasksel --list-tasks
tasksel --task-desc web-server 
tasksel --task-desc ssh-server 

------

# taskset

taskset -c 0,1 firefox -turbo

taskset -c 0,1 google-chrome --disable-notifications --no-pings --no-referrers  --no-default-browser-check --process-per-tab

taskset -c 0,1 google-chrome --lang=en-US,en --disable-translate --disable-dev-shm-usage --block-new-web-contents --no-experiments --disable-default-apps --disable-notifications --new-window --log-level=1

taskset -c 0,1 chromium-browser --single-process --enable-low-res-tiling --enable-low-end-device-mode --disable-default-apps

taskset -c 0,1  google-chrome --process-per-tab --disable-ipc-flooding-protection

taskset -c 0,1  pycharm-community

taskset -c 0,1  chromium-browser --single-process --disable-site-isolation-trials --isolate-origins --renderer-process-limit=2 --enable-low-end-device-mode

# get cpu count
nproc --all
lscpu
lscpu --online --parse=Core,Socket
lscpu -ap
grep -c 'cpu[0-9]' /proc/stat
lscpu -e

# limit cpu usage 

systemd-run -p CPUQuota=25% google-chrome 
systemd-run -p CPUQuota=25% pycharm-community
systemd-run -p CPUQuota=30% chromium-browser
systemd-run -p "CPUQuota=50" brave

sudo apt install cpulimit
#cpulimit brave -l 50 -b -k -r
#cpulimit brave -l 50 -k
cpulimit brave -l 80 -z


sudo cgcreate -a $USER:$USER -t $USER:$USER -g memory:groupChromiumMemLimit
sudo cgset -r memory.limit_in_bytes=$((1024*1024*1024)) groupChromiumMemLimit
cgexec -g memory:groupChromiumMemLimit chromium-browser

cpulimit

taskset -c 0,1,2,3 google-chrome --lang=en-US,en --disable-translate --disable-dev-shm-usage --block-new-web-contents --no-experiments --disable-default-apps --disable-notifications --new-window --log-level=1 --renderer-process-limit=2  --isolate-origins --disable-dev-shm-usage --no-pings

taskset -c 0,1 google-chrome --lang=en-US,en --disable-translate --disable-dev-shm-usage --block-new-web-contents --no-experiments --disable-default-apps --disable-notifications --new-window --log-level=1 --renderer-process-limit=2 --no-referrers --no-pings --start-maximized

taskset -c 0,1 google-chrome --lang=en-US,en --disable-translate --disable-dev-shm-usage --block-new-web-contents --no-experiments --disable-default-apps --disable-notifications --new-window --log-level=1 --no-ping --disable-background-processes --disable-picture-in-picture --process-per-tab --purge-memory-button

taskset -c 0,1 google-chrome --lang=en-US,en --disable-translate --disable-dev-shm-usage --block-new-web-contents --no-experiments --disable-default-apps --disable-notifications --new-window --log-level=1 --no-ping --disable-background-processes --disable-picture-in-picture --process-per-tab --purge-memory-button  --disable-features=UseEcoQoSForBackgroundProcess --disable-histogram-customizer --disable-in-process-stack-traces --disable-low-end-device-mode --disable-low-res-tiling --disable-print-preview  --disable-breakpad --noerrdialogs --use-fake-device-for-media-stream --disable-features=StreamScripting  --disable-remote-fonts  --new-window --aggressive-cache-discard --disable-notifications --disable-remote-fonts --disable-reading-from-canvas --disable-remote-playback-api --disable-shared-workers --disable-voice-input --enable-aggressive-domstorage-flushing


taskset -c 0,1 brave --lang=en-US,en --disable-translate --disable-dev-shm-usage --block-new-web-contents --no-experiments --disable-default-apps --disable-notifications --new-window --log-level=1 --no-ping --disable-background-processes --disable-picture-in-picture --process-per-tab --purge-memory-button  --disable-features=UseEcoQoSForBackgroundProcess --disable-histogram-customizer --disable-in-process-stack-traces --disable-low-end-device-mode --disable-low-res-tiling --disable-print-preview  --disable-breakpad --noerrdialogs --use-fake-device-for-media-stream --disable-features=StreamScripting  --disable-remote-fonts --disk-cache-dir=/dev/null --new-window --aggressive-cache-discard --disable-notifications --disable-remote-fonts --disable-reading-from-canvas --disable-remote-playback-api --disable-shared-workers --disable-voice-input --enable-aggressive-domstorage-flushing --disable-http-cache



--disable-extensions
--disable-notifications
--disable-sync
--disable-software-rasterizer
--disable-site-isolation-trials

--js-flags="--max_old_space_size=80 --max_semi_space_size=80"
--single-process
--aggressive-tab-discard
--aggressive-cache-discard
--ui-compositor-memory-limit-when-visible-mb
--disk-cache-dir  # Use a specific disk cache location, rather than one derived from the UserDatadir.
--disk-cache-size  # Forces the maximum disk space to be used by the disk cache, in bytes.
--force-gpu-mem-available-mb  # Sets the total amount of memory that may be allocated for GPU resources
--gpu-program-cache-size-kb  # Sets the maximum size of the in-memory gpu program cache, in kb
--mem-pressure-system-reserved-kb  # Some platforms typically have very little 'free' memory, but plenty is available in buffers+cached. For such platforms, configure this amount as the portion of buffers+cached memory that should be treated as unavailable. If this switch is not used, a simple pressure heuristic based purely on free memory will be used.
--renderer-process-limit  # Overrides the default/calculated limit to the number of renderer processes. Very high values for this setting can lead to high memory/resource usage or instability.


# https://peter.sh/experiments/chromium-command-line-switches/
# https://kapeli.com/cheat_sheets/Chromium_Command_Line_Switches.docset/Contents/Resources/Documents/index

taskset -c 0,1 google-chrome --lang=en-US,en --disable-translate --disable-dev-shm-usage --block-new-web-contents --no-experiments --disable-default-apps --disable-notifications --new-window --log-level=1 --no-ping --disable-background-processes --disable-picture-in-picture --process-per-tab --purge-memory-button  --disable-features=UseEcoQoSForBackgroundProcess --disable-histogram-customizer --disable-in-process-stack-traces --disable-low-end-device-mode --disable-low-res-tiling --disable-print-preview

~~~

###  check and repair disk

~~~

sudo apt-get install smartmontools
sudo smartctl -a /dev/sda | less
smartctl -i /dev/sda

# check drive sectors
sudo badblocks -v /dev/sda -s 
sudo badblocks -v /dev/sda1 > ~/bad_sectors.txt

sudo apt-get install gsmartcontrol
gnome-disks


# list disk
lsblk 
lsblk | grep disk
sudo lshw -class disk
lsblk -io KNAME,TYPE,SIZE,MODEL
lshw -class disk
hwinfo --disk
hdparm -i /dev/sda
sfdisk -l  
fdisk -l  

sudo gparted
sudo e2fsck -fccky /dev/sda1 

sudo apt install lsscsi
lsscsi
~~~

###  boot uefi update

~~~
sudo fwupdmgr update
efibootmgr -v
~~~

###  firefox alternative

~~~
sudo apt update && sudo apt install extrepo -y
sudo extrepo enable librewolf
sudo apt update && sudo apt install librewolf -y
~~~

### ifconfig

~~~
https://ubuntu.com/blog/if-youre-still-using-ifconfig-youre-living-in-the-past
https://wiki.ubuntuusers.de/ip/

sudo apt install net-tools
sudo apt-get install -y iputils-ping
ifconfig
ip address show
ip link show
ip link set DEVICE up or ip link set DEVICE down
ip -c a
ip route show | grep 'default' 

service --status-all
apt list -i
apt list -i | grep docker
sudo apt remove docker.io docker-compose
~~~


### when linux system was installed

~~~
stat -c %w /
stat --format=%w /
stat /
dumpe2fs /dev/sda1 | grep 'Filesystem created:'
~~~


### ulimit linux  

~~~
https://unix.stackexchange.com/questions/560064/chromium-browser-exceed-data-ulimit
https://phoenixnap.com/kb/ulimit-linux-command
https://stackoverflow.com/questions/14844304/how-to-limit-google-chrome-from-consuming-all-available-memory-while-uploading-l
https://unix.stackexchange.com/questions/749840/is-there-a-way-to-set-a-hard-cap-limit-on-how-much-ram-chrome-can-use
https://superuser.com/questions/48505/how-to-find-virtual-memory-size-and-cache-size-of-a-linux-system


ulimit -v 2192000 && chromium-browser && sleep 1

# Display all current limits
ulimit -a
ulimit -Sa  # Soft Limit
ulimit -Ha # Hard Limit

# Set a maximum file size of 10MB
ulimit -f 10240  # File size is in KB, so 10MB = 10 * 1024 KB

# Display the maximum number of open files
ulimit -n

# limit the process number to 10:
ulimit -u 10

# sets the maximum file size that a user can make 50KB
ulimit -f 50
ls -lh file

# Limit Maximum Virtual Memory to 1k
ulimit -v 1000

# Limit the Number of Open Files
ulimit -n 5

#  Limit Maximum Virtual Memory to 4.2GB
ulimit -Sv 4352000000
/usr/bin/chromium

# or 0.42GB, it works but the browser may crash
#ulimit -Sv 435200000 #0.42GB
#/usr/bin/chromium

# limits the resident set size of the process 1gb - no longer works
ulimit -m 3000000

# limits the amount of virtual memory 1gb
ulimit -v  1000000

#!/bin/sh
ulimit -Sv 10240000 #amount of memory available in bytes 10gb
/usr/bin/google-chrome-stable

# Chrome Ulimit Limit 8GB
ulimit -Sv 8192000; ulimit -Hv 8192000; google-chrome
ulimit -n 4096

# Chrome Ulimit Limit 8GB
ulimit -Sv 8192000; ulimit -Hv 8192000; google-chrome & sleep 2
PID=$(pgrep google-chrome)
ps -o pid,rss,vsz -p $PID

# Virtual memory
ulimit -v 8192000 && google-chrome & sleep 1
PID=$(pgrep google-chrome)
ulimit -aH | grep "virtual memory"
ulimit -aS | grep "virtual memory"
cat /proc/$PID/limits | grep "Max address space"


Virtual memory size Use swapon -s or free
swapon -s
free
cat /proc/cpuinfo
sudo dmidecode --type processor
cat /proc/pal/cpu0/cache_info
vmstat

ulimit -a
real-time non-blocking time  (microseconds, -R) unlimited
core file size              (blocks, -c) 0
data seg size               (kbytes, -d) unlimited
scheduling priority                 (-e) 0
file size                   (blocks, -f) unlimited
pending signals                     (-i) 14608
max locked memory           (kbytes, -l) 477992
max memory size             (kbytes, -m) unlimited
open files                          (-n) 1024
pipe size                (512 bytes, -p) 8
POSIX message queues         (bytes, -q) 819200
real-time priority                  (-r) 0
stack size                  (kbytes, -s) 8192
cpu time                   (seconds, -t) unlimited
max user processes                  (-u) 14608
virtual memory              (kbytes, -v) unlimited
file locks                          (-x) unlimited

~~~
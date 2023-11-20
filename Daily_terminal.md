## Daily CMDs

### Check repo file Sizes
~~~~
* find . -name '*' -size +1M -exec ls -lh {} \; | awk '{ print $9 ": " $5 }'
~~~~

### rename
```
* // rename incremental 000 - 999
* num=0; for i in *; do mv "$i" "$(printf '%04d' $num).${i#*.}"; ((num++)); done

* // rename incremental 000.xi - 999.xi
* num=0; for i in *.xi; do mv "$i" "$(printf '%04d' $num).xi"; ((num++)); done

* // rename random 000 - 999
* for i in *; do mv "$i" $(($RANDOM % 1000000000)).${i#*.}; done
```

### rename remove file name spaces
```
sudo apt install rename
rename 's/ /_/g' *

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
+ sudo adduser newuser
+ sudo deluser newuser
+ sudo deluser --remove-home newuser
+ sudo passwd username
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


## DNS Settings Google and Cloudflare

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


### Debian Ubuntu mirrors
~~~
https://www.debian.org/CD/http-ftp/
https://www.debian.org/releases/bullseye/amd64/ch08s01.en.html
https://ftp-stud.hs-esslingen.de/debian-cd/current-live/amd64/iso-hybrid/
https://releases.ubuntu.com/mantic/
https://releases.ubuntu.com/
https://releases.ubuntu.com/23.10/
https://releases.ubuntu.com/23.10.1/
https://releases.ubuntu.com/jammy/
https://ftp.fau.de/ubuntu-releases/22.04/
https://ftp-stud.hs-esslingen.de/Mirrors/cdimage.ubuntu.com/ubuntu/releases/23.04/release/
~~~




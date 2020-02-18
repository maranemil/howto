### [Daily CMDs] 

#### [Misc]

##### Config Git on new location
- [x] git config --global user.name "Administrator"
- [x] git config --global user.email "admin@example.com"
- [ ] ...

##### Check repo file Sizes
* find . -name '*' -size +1M -exec ls -lh {} \; | awk '{ print $9 ": " $5 }'

##### Check pack
* git verify-pack -v ./.git/objects/pack/pack-......ea.pack

##### Surf web
* lynx t3n.de -accept_all_cookies  -justify

##### List 
> list first 30 folders
* ll -t | head -30 
> list all folders from last 24 hours
* find folder/ -maxdepth 2 -type f -name "*.json" -mtime -1 -exec grep -i 'string' {} \; 
  
##### Generate Random Pass Ubuntu
* date +%s | sha256sum | base64 | head -c 24 ; echo "@%&";
* date +%s | sha1sum | base64 | head -c 12; echo "@%&";

##### Ziping Unziping multiple Folders
cmd     | example
--------|---------
unzip   | for z in *.zip; do unzip $z; done
zip     | for i in */; do zip -r "${i%/}.zip" "$i"; done


##### Change date modified created file
 * -a = accessed / -m = modified / -t = timestamp
 
desc|cmd
-----|-----
generate file| touch {1..19}.jpg
change date |touch -d "October 31"  filename.txt
change date |touch -d '14:24' file.txt
change date |touch -d "2 hours ago" filename

##### Convert Imagick
* for i in *.png; do convert "$i" "${i%.png}.jpg" && rm "$i" && echo "$i is converted."; done
* for i in *.png; do convert "$i" "${i%.*}.jpg" ; done

##### Timestamp
* date +%s > 1552925792

##### Add git ignore
* echo ".idea/*" >> .gitignore
* git commit -am "remove .idea"

##### Users management
+ sudo adduser newuser
+ sudo deluser newuser
+ sudo deluser --remove-home newuser




#### [Audio Video]

##### Split audio file in 1 sec pieces FFMPEG
* ffmpeg -i in.wav -map 0 -f segment -segment_time 1 -af "volume=6dB,equalizer=f=40:width_type=o:width=2:g=-7,areverse" -y dir/out%03d.wav

##### Cut Video
* ffmpeg -i movie.mp4 -ss 00:00:03 -t 00:00:08 -async 1 cut.mp4

##### Record Screen Ubuntu
* ffmpeg -v warning -an -video_size 1366x768 -framerate 5 -f x11grab -i :0.0 myvid_$(date +%s).mp4*
* ffmpeg -v warning -video_size 1920x1080 -framerate 5 -f x11grab -i :0.0  myvid_$(date +%s).mov
* ffmpeg -f x11grab  -follow_mouse centered -show_region 1 -framerate 5 -video_size 4cif -i :0.0 xmvid_$(date +%s).mov

##### Copy Audio and compress video
* ffmpeg -i file.mp4 -crf 18 -acodec copy file_compressed.mp4 




####  [Manage SWAP]

##### Add temporary Swap file on Ubuntu 18.04
* sudo fallocate -l 6G /swapfile2 && sudo chmod 600 /swapfile2 && sudo mkswap /swapfile2 && sudo swapon /swapfile2 && sudo sysctl vm.swappiness=20
* sudo swapoff -a && sudo fallocate -l 4G /swapfile3 && sudo chmod 600 /swapfile3 && sudo mkswap /swapfile3 && sudo swapon /swapfile3 -a && swapon -s && swapon --show
* sudo sudo rm /swapfile3 

##### Expand Swap file in Ubuntu to 4GB or more
* sudo swapoff -a && sudo dd if=/dev/zero of=/swapfile bs=500M count=8 && sudo mkswap /swapfile && sudo swapon /swapfile -a && swapon -s && swapon --show 
* echo "vm.swappiness=10" | sudo tee -a /etc/sysctl.conf
* echo 3 | sudo tee /proc/sys/vm/drop_caches





#### [Clean and Boost OS]


##### Utiles Daily
> chrome chromium light loading
* /usr/lib/chromium-browser/chromium-browser --disable-new-tab-first-run --enable-user-scripts --flag-switches-begin  --disable-accelerated-2d-canvas --disable-gpu-vsync --disable-threaded-animation --disable-webgl --js-flags=--harmony  --flag-switches-end --disable-gpu-process-prelaunch --no-sandbox
* /usr/lib/chromium-browser/chromium-browser  --enable-user-scripts --flag-switches-begin --disable-accelerated-2d-canvas --disable-gpu-vsync --disable-threaded-animation --disable-webgl --js-flags=--harmony --flag-switches-end --disable-gpu-process-prelaunch --process-per-site --enable-low-end-device-mode --no-sandbox
* /usr/lib/chromium-browser/chromium-browser  --enable-user-scripts --flag-switches-begin --disable-accelerated-2d-canvas --disable-gpu-vsync --disable-threaded-animation --disable-webgl --js-flags=--harmony --flag-switches-end --disable-gpu-process-prelaunch --enable-low-end-device-mode --no-sandbox --enable-low-res-tiling --process-per-site
* /usr/lib/chromium-browser/chromium-browser  --enable-user-ripts --flag-switches-begin --disable-accelerated-2d-canvas --disable-gpu-vsync --disable-threaded-animation --disable-webgl --js-flags=--harmony --flag-switches-end --disable-gpu-process-prelaunch  --no-experiments --disable-notifications --no-referrers --new-window --enable-low-end-device-mode --restore-last-session --no-sandbox
* /usr/lib/chromium-browser/chromium-browser  --enable-user-scripts --flag-switches-begin --disable-accelerated-2d-canvas --disable-gpu-vsync --disable-threaded-animation --disable-webgl --js-flags=--harmony --flag-switches-end --disable-gpu-process-prelaunch  --no-experiments --disable-notifications --no-referrers --new-window --enable-low-end-device-mode --restore-last-session  --no-sandbox --disable-gpu  --disable-software-rasterizer --enable-gpu-rasterization

> chrome://flags
* --no-sandbox --site-per-process --process-per-site --enable-low-end-device-mode --disk-cache-size=104857600
> firefox
* firefox -purgecaches  -no-remote -new-tab -console

> boost cpu
* for i in {0..7}; do echo performance | sudo tee /sys/devices/system/cpu/cpu"$i"/cpufreq/scaling_governor ; done


##### vm settings
* sudo sysctl -w vm.swappiness=20
* sudo sysctl -w vm.swappiness=20 && sudo sysctl vm.vfs_cache_pressure=50 && sudo sysctl -w net.ipv4.ip_forward=1
* sudo sysctl -w vm.swappiness=10 && sudo sysctl -w vm.vfs_cache_pressure=50 && sudo sysctl -w vm.dirty_ratio=10 && sudo sysctl -w vm.dirty_background_ratio=5 && sudo sync && sudo sysctl -w vm.drop_caches=3


##### Drop cache
* cat /proc/sys/vm/swappiness
* sync && echo 3 | sudo tee /proc/sys/vm/drop_caches
* echo 3 | sudo tee /proc/sys/vm/drop_caches && sudo /etc/init.d/networking restart 
* sudo swapoff -a && sudo swapon -a && printf '\n%s\n' 'Swap Cleared'

##### DNS Flush networking
* sudo /etc/init.d/dns-clean restart && sudo /etc/init.d/networking force-reload && sudo /etc/init.d/nscd restart && sudo service network-manager restart
  
##### Disable services
* sudo service apache2 status
* sudo update-rc.d -f apache2 disable
* sudo update-rc.d apache2 enable
* sudo update-rc.d apache2 disable
* service --status-all
* sudo systemctl disable apache2
* sudo systemctl disable mysql

##### clean DNS 
* sudo /etc/init.d/dns-clean reload && echo 2 | sudo tee /proc/sys/vm/drop_caches && sudo service network-manager reload 

##### clear Browsers Cache Data 
* chrome://settings/clearBrowserData
* ll ~/.cache/chromium/Default/
* rm -rf ~/.cache/chromium
* rm -rf ~/.cache/google-chrome
* rm ~/.cache/google-chrome
* rm ~/.config/google-chrome/Default/
* rm ~/.mozilla/firefox/*.default/cookies.sqlite
* rm -r ~/.cache/mozilla/firefox/*.default/*
* rm -r ~/.cache/chromium/Default/Cache/*

##### stop Services
* service --status-all
* sudo service network-manager reload 
* sudo service bluetooth stop && sudo service virtualbox stop
* sudo service whoopsie stop && sudo service cups stop && sudo service cups-browsed stop
* sudo service mysql stop &&  sudo service apache2 stop &&  sudo service openvpn stop && sudo service virtualbox stop 
* service --status-all

##### Accessing local data on VM using python SimpleHTTPServer
* python -m SimpleHTTPServer
* http://localhost:8000

##### list packages
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

##### remove packages
* dpkg -r <package> 
* apt remove --purge <package> 
* snap remove <package>
* pip uninstall <package>

##### clean install update
* https://wiki.ubuntuusers.de/apt/apt-get/
* pip install --upgrade pip
* sudo apt-get autoremove
* sudo apt-get autoclean

##### clean cache folder
* sudo rm -rf .cache/pip/http/*
* find ~/.cache/ -type f -atime +365 -delete
* find ~/.cache/pip/http/ -depth -type f -atime +365 
* find ~/.cache/pip/ -depth -type f -atime +3
* ? ~/.local/lib/pythonX.X/site-packages

#####  system  monitoring
* gnome-system-monitor
* baobab [GNOME Disk Usage Analyzer]

##### ubuntu optimisation - disable tracking and clear journalctl file
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

### markup reference

https://guides.github.com/features/mastering-markdown/
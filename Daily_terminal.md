
##### Config Git on new location
git config --global user.name "Administrator"
git config --global user.email "admin@example.com"


##### Check repo file Sizes
find . -name '*' -size +1M -exec ls -lh {} \; | awk '{ print $9 ": " $5 }'


##### Check pack
git verify-pack -v ./.git/objects/pack/pack-......ea.pack


##### Utiles Daily

* /usr/lib/chromium-browser/chromium-browser --disable-new-tab-first-run --enable-user-scripts --flag-switches-begin  --disable-accelerated-2d-canvas --disable-gpu-vsync --disable-threaded-animation --disable-webgl --js-flags=--harmony  --flag-switches-end --disable-gpu-process-prelaunch --no-sandbox

* /usr/lib/chromium-browser/chromium-browser  --enable-user-scripts --flag-switches-begin --disable-accelerated-2d-canvas --disable-gpu-vsync --disable-threaded-animation --disable-webgl --js-flags=--harmony --flag-switches-end --disable-gpu-process-prelaunch --process-per-site --enable-low-end-device-mode --no-sandbox

* /usr/lib/chromium-browser/chromium-browser  --enable-user-scripts --flag-switches-begin --disable-accelerated-2d-canvas --disable-gpu-vsync --disable-threaded-animation --disable-webgl --js-flags=--harmony --flag-switches-end --disable-gpu-process-prelaunch --enable-low-end-device-mode --no-sandbox --enable-low-res-tiling --process-per-site

* /usr/lib/chromium-browser/chromium-browser  --enable-user-ripts --flag-switches-begin --disable-accelerated-2d-canvas --disable-gpu-vsync --disable-threaded-animation --disable-webgl --js-flags=--harmony --flag-switches-end --disable-gpu-process-prelaunch  --no-experiments --disable-notifications --no-referrers --new-window --enable-low-end-device-mode --restore-last-session --no-sandbox

* sudo /etc/init.d/dns-clean reload && echo 2 | sudo tee /proc/sys/vm/drop_caches && sudo service network-manager reload && sudo sysctl -w vm.swappiness=20 && sudo sysctl vm.vfs_cache_pressure=70


* /usr/lib/chromium-browser/chromium-browser  --enable-user-scripts --flag-switches-begin --disable-accelerated-2d-canvas --disable-gpu-vsync --disable-threaded-animation --disable-webgl --js-flags=--harmony --flag-switches-end --disable-gpu-process-prelaunch  --no-experiments --disable-notifications --no-referrers --new-window --enable-low-end-device-mode --restore-last-session  --no-sandbox --disable-gpu  --disable-software-rasterizer --enable-gpu-rasterization

* chrome://flags
--no-sandbox --site-per-process --process-per-site --enable-low-end-device-mode --disk-cache-size=104857600

* firefox -purgecaches  -no-remote -new-tab -console

* for i in {0..7}; do echo performance | sudo tee /sys/devices/system/cpu/cpu"$i"/cpufreq/scaling_governor ; done


* sudo sysctl vm.swappiness=20
* sudo sysctl -w vm.swappiness=20 && sudo sysctl vm.vfs_cache_pressure=50 && sudo sysctl -w net.ipv4.ip_forward=1

##### Surf web
* lynx t3n.de -accept_all_cookies  -justify

##### Drop cache
* sudo /etc/init.d/dns-clean restart && echo 3 | sudo tee /proc/sys/vm/drop_caches && sudo service network-manager restart
* cat /proc/sys/vm/swappiness
* sync && echo 3 | sudo tee /proc/sys/vm/drop_caches
* sudo /etc/init.d/dns-clean restart && sudo service network-manager reload
* sudo /etc/init.d/dns-clean restart && sudo service network-manager reload && echo 3 | sudo tee /proc/sys/vm/drop_caches && sudo /etc/init.d/networking restart 


##### DNS Flush
* sudo /etc/init.d/dns-clean restart && sudo /etc/init.d/networking force-reload && sudo /etc/init.d/nscd restart && sudo service network-manager restart


##### Record Screen Ubuntu
* ffmpeg -v warning -an -video_size 1366x768 -framerate 5 -f x11grab -i :0.0 myvid_$(date +%s).mp4*
* ffmpeg -v warning -video_size 1920x1080 -framerate 5 -f x11grab -i :0.0  myvid_$(date +%s).mov
* ffmpeg -f x11grab  -follow_mouse centered -show_region 1 -framerate 5 -video_size 4cif -i :0.0 xmvid_$(date +%s).mov
 
 
##### Generate Random Pass Ubuntu
* date +%s | sha256sum | base64 | head -c 24 ; echo "@%&";
* date +%s | sha1sum | base64 | head -c 12; echo "@%&";


##### Ziping Unziping multiple Folders
* for z in *.zip; do unzip $z; done
* for i in */; do zip -r "${i%/}.zip" "$i"; done


##### Convert Imagick
* for i in *.png; do convert "$i" "${i%.png}.jpg" && rm "$i" && echo "$i is converted."; done
* for i in *.png; do convert "$i" "${i%.*}.jpg" ; done


##### Timestamp
date +%s > 1552925792


##### Add temporary Swap file on Ubuntu 18.04
* sudo fallocate -l 6G /swapfile2 && sudo chmod 600 /swapfile2 && sudo mkswap /swapfile2 && sudo swapon /swapfile2 && sudo sysctl vm.swappiness=20
* sudo swapoff -a && sudo fallocate -l 4G /swapfile3 && sudo chmod 600 /swapfile3 && sudo mkswap /swapfile3 && sudo swapon /swapfile3 -a && swapon -s && swapon --show
* sudo sudo rm /swapfile3 


##### Expand Swap file in Ubuntu to 4GB or more
* sudo swapoff -a && sudo dd if=/dev/zero of=/swapfile bs=500M count=8 && sudo mkswap /swapfile && sudo swapon /swapfile -a && swapon -s && swapon --show 
* echo "vm.swappiness=10" | sudo tee -a /etc/sysctl.conf
* echo 3 | sudo tee /proc/sys/vm/drop_caches


##### Stop Services 
sudo service mysql stop &&  sudo service apache2 stop &&  sudo service openvpn stop && sudo service virtualbox stop && service --status-all


##### Split audio file in 1 sec pieces FFMPEG
* ffmpeg -i in.wav -map 0 -f segment -segment_time 1 -af "volume=6dB,equalizer=f=40:width_type=o:width=2:g=-7,areverse" -y dir/out%03d.wav


##### Cut Video
* ffmpeg -i movie.mp4 -ss 00:00:03 -t 00:00:08 -async 1 cut.mp4


##### Add git ignore
* echo ".idea/*" >> .gitignore
* git commit -am "remove .idea"


##### Remove chromium Cache
* rm -r ~/.cache/chromium/Default/Cache/*


##### Users management
+ sudo adduser newuser
+ sudo deluser newuser
+ sudo deluser --remove-home newuser


##### Disable services
* sudo service apache2 status
* sudo update-rc.d -f apache2 disable
* sudo update-rc.d apache2 enable
* sudo update-rc.d apache2 disable

* service --status-all
* sudo systemctl disable apache2
* sudo systemctl disable mysql


##### clear Browser Data
chrome://settings/clearBrowserData

ll ~/.cache/chromium/Default/
rm -rf ~/.cache/chromium
rm -rf ~/.cache/google-chrome
rm ~/.cache/google-chrome
rm ~/.config/google-chrome/Default/
rm ~/.mozilla/firefox/*.default/cookies.sqlite
rm -r ~/.cache/mozilla/firefox/*.default/*


##### stop Services
* service --status-all
* sudo service network-manager reload && sudo service bluetooth stop && sudo service virtualbox stop

##### list packages

dpkg --get-selections | grep -v deinstall
sudo dpkg-query -l | less
apt list --installed
sudo apt list --installed | less
apt list
dpkg -l
snap list
pip list
pip install --upgrade pip
aptitude search '~i!~M'
sudo apt-get autoremove

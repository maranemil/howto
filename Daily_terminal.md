### [Daily CMDs] 

#### [Misc]

##### Config Git on new location
- [x] git config --global user.name "Administrator"
- [x] git config --global user.email "admin@example.com"
- [ ] ...

##### Check repo file Sizes
* find . -name '*' -size +1M -exec ls -lh {} \; | awk '{ print $9 ": " $5 }'

##### rename
* // rename incremental 000 - 999
* num=0; for i in *; do mv "$i" "$(printf '%04d' $num).${i#*.}"; ((num++)); done

* // rename incremental 000.xi - 999.xi
* num=0; for i in *.xi; do mv "$i" "$(printf '%04d' $num).xi"; ((num++)); done

* // rename random 000 - 999
* for i in *; do mv "$i" $(($RANDOM % 1000000000)).${i#*.}; done

##### Umount force
sudo service nfs-kernel-server stop
sudo umount -f ~/path
sudo umount -l -f ~/path

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
+ sudo passwd username

##### Hostname management
+ sudo nano /etc/hosts
+ sudo nano /etc/hostname

#### [Audio Video]

##### Push volume up +4dB
* ffmpeg -i input.wav -af "volume=4dB" -c:v copy -y  out.wav

##### Split audio file in 1 sec pieces FFMPEG
* ffmpeg -i in.wav -map 0 -f segment -segment_time 1 -af "volume=6dB,equalizer=f=40:width_type=o:width=2:g=-7,areverse" -y dir/out%03d.wav

##### Cut Video
* ffmpeg -i movie.mp4 -ss 00:00:03 -t 00:00:08 -async 1 cut.mp4

##### Record Screen Ubuntu
* ffmpeg -v warning -an -video_size 1366x768 -framerate 5 -f x11grab -i :0.0 myvid_$(date +%s).mp4*
* ffmpeg -v warning -video_size 1920x1080 -framerate 5 -f x11grab -i :0.0  myvid_$(date +%s).mov
* ffmpeg -f x11grab  -follow_mouse centered -show_region 1 -framerate 5 -video_size 4cif -i :0.0 xmvid_$(date +%s).mov

##### Record Screen Ubuntu with Sound Lenovo
* ffmpeg -v warning -video_size 1920x1080 -framerate 30 -f x11grab -i :1.0  -f alsa -ac 2 -i default  myvid_$(date +%s).mp4

##### Record Screen Ubuntu with Sound ASUS
* ffmpeg -v warning -video_size 1366x768 -framerate 30 -f x11grab -i :0.0 -f alsa -ac 2 -ar 44100 -i default -probesize 42M -preset ultrafast -pix_fmt yuv420p -vcodec libx264 myvid_$(date +%s).mp4
 
##### Copy Audio and compress video
* ffmpeg -i file.mp4 -crf 18 -acodec copy file_compressed.mp4 

##### Create Test Video
* ffmpeg -y -f lavfi -i testsrc=duration=5:size=1920x1080:rate=30 testsrc.mp4

##### Create showspectrum + text from audio file
* ffmpeg -y -f lavfi -i "amovie=input.wav, asplit [a][out1]; [a] showspectrum="mode=separate:s=1920x1080:color=rainbow:legend=1" [out0]" -vf "drawtext=text='input (15 sec)': start_number=1: x=(w/3): y=(h/2): fontcolor=yellow: fontsize=72" -b:v 8M -c:a ac3 -b:a 320k out_$(date +%s).mp4

##### Create wave + text from audio file
* ffmpeg -i INPUT.wav -filter_complex "[0:a]showwaves=mode=line:s=hd480:colors=White[v]" -map "[v]" -map 0:a -pix_fmt yuv420p -b:a 360k -r:a 44100  OUTPUT.mp4

##### Create wave + text from audio file
* ffmpeg -i INPUT.wav -filter_complex "[0:a]showwaves=mode=line:s=hd480:colors=Yellow@0.5|Blue@0.5:scale=sqrt[v];[v]drawtext=text='Rudi Rudi - Still Standing':fontcolor=White@0.5:fontsize=30:font=Arvo:x=(w-text_w)/5:y=(h-text_h)/5[out]"  -map "[out]" -map 0:a -pix_fmt yuv420p  -b:a 360k -r:a 44100  OUTPUT.mp4

##### invert
* ffmpeg -i input.mp4 -vf lutrgb="r=negval:g=negval:b=negval" output3.avi

##### crop square
* ffplay -i 046white.mp4 -vf "crop=in_h/1:in_h/1"
* ffplay -i in.mp4  -vf "crop=820:640:570:350" 

##### speed up
ffplay -i in.mp4 -vf "setpts=1/4*PTS"

##### merge 4 videos in one - 2 by row with overlay

* repeat 2x to merge horizontally 800x600 * 2 = 1600x600
* ffmpeg -i in.mp4  -i in2.mp4  -filter_complex "[0:v:0]pad=iw*2:ih[bg]; [bg][1:v:0]overlay=w" -t 53 -y out.mp4

* merge vertically - 1600x1200
* ffmpeg -i in.mp4  -i in2.mp4  -filter_complex "[0]pad=iw:ih*2[bg]; [bg][1] overlay=40:600"  -t 53 -y out.mp4

##### add logo top left padding 10
* ffmpeg -y -i VIDEO.mp4 -i subscribe.png -filter_complex "overlay=10:10" OUT_1.mp4







####  [Manage SWAP]

##### Add temporary Swap file on Ubuntu 18.04
* sudo fallocate -l 6G /swapfile2 && sudo chmod 600 /swapfile2 && sudo mkswap /swapfile2 && sudo swapon /swapfile2 && sudo sysctl vm.swappiness=20
* sudo swapoff -a && sudo fallocate -l 4G /swapfile3 && sudo chmod 600 /swapfile3 && sudo mkswap /swapfile3 && sudo swapon /swapfile3 -a && swapon -s && swapon --show
* sudo sudo rm /swapfile3 

##### Expand Swap file in Ubuntu to 4GB or more
* sudo swapoff -a && sudo dd if=/dev/zero of=/swapfile bs=500M count=8 && sudo mkswap /swapfile && sudo swapon /swapfile -a && swapon -s && swapon --show 
* echo "vm.swappiness=10" | sudo tee -a /etc/sysctl.conf
* echo 3 | sudo tee /proc/sys/vm/drop_caches

#### Mix showwaves Video with Overlay 

##### generate wave
* ffmpeg -i in.wav -filter_complex "[0:a]showwaves=mode=line:s=hd1080:colors=yellow[v]" -map "[v]" -map 0:a -pix_fmt yuv420p -b:a 360k -r:a 44100  out_$(date +%s).mp4

##### mix wave + bg
* ffmpeg -i in.mp4 -i input.png   -filter_complex "[0]colorkey=color=black,crop=1920:400,scale=1920:100,pad=iw*200:ih:0:0[keyed];[1][keyed]overlay=y=770" -t 10  out_$(date +%s).mp4


####  [Manage RamDisk]

* sudo mkdir /tmp/ramdisk
* sudo chmod 777 /tmp/ramdisk

##### allocate 1G for the RAM disk
* sudo mount -t tmpfs -o size=1024m myramdisk /tmp/ramdisk	


#### [Clean and Boost OS]


##### Utiles Daily
> chrome chromium light loading
* /usr/lib/chromium-browser/chromium-browser --disable-new-tab-first-run --enable-user-scripts --flag-switches-begin  --disable-accelerated-2d-canvas --disable-gpu-vsync --disable-threaded-animation --disable-webgl --js-flags=--harmony  --flag-switches-end --disable-gpu-process-prelaunch --no-sandbox

* /usr/lib/chromium-browser/chromium-browser  --enable-user-scripts --flag-switches-begin --disable-accelerated-2d-canvas --disable-gpu-vsync --disable-threaded-animation --disable-webgl --js-flags=--harmony --flag-switches-end --disable-gpu-process-prelaunch --process-per-site --enable-low-end-device-mode --no-sandbox

* /usr/lib/chromium-browser/chromium-browser  --enable-user-scripts --flag-switches-begin --disable-accelerated-2d-canvas --disable-gpu-vsync --disable-threaded-animation --disable-webgl --js-flags=--harmony --flag-switches-end --disable-gpu-process-prelaunch --enable-low-end-device-mode --no-sandbox --enable-low-res-tiling --process-per-site

* /usr/lib/chromium-browser/chromium-browser  --enable-user-ripts --flag-switches-begin --disable-accelerated-2d-canvas --disable-gpu-vsync --disable-threaded-animation --disable-webgl --js-flags=--harmony --flag-switches-end --disable-gpu-process-prelaunch  --no-experiments --disable-notifications --no-referrers --new-window --enable-low-end-device-mode --restore-last-session --no-sandbox

* /usr/lib/chromium-browser/chromium-browser  --enable-user-scripts --flag-switches-begin --disable-accelerated-2d-canvas --disable-gpu-vsync --disable-threaded-animation --disable-webgl --js-flags=--harmony --flag-switches-end --disable-gpu-process-prelaunch  --no-experiments --disable-notifications --no-referrers --new-window --enable-low-end-device-mode --restore-last-session  --no-sandbox --disable-gpu  --disable-software-rasterizer --enable-gpu-rasterization

* chromium-browser --enable-user-scripts --flag-switches-begin --disable-accelerated-2d-canvas --disable-gpu-vsync --disable-threaded-animation --disable-webgl --js-flags=--harmony --flag-switches-end --disable-gpu-process-prelaunch --no-experiments --disable-notifications --no-referrers --new-window --enable-low-end-device-mode --restore-last-session  --disable-gpu --disable-software-rasterizer --enable-gpu-rasterization --new-window --aggressive-cache-discard --disable-notifications --disable-remote-fonts --disable-reading-from-canvas --disable-remote-playback-api --disable-shared-workers --disable-voice-input --enable-aggressive-domstorage-flushing --disable-application-cache 

* chromium --process-per-site --no-sandbox --args --js-flags="--max_old_space_size=2192" --purge-memory-button
* google-chrome --process-per-site --no-sandbox --args --js-flags="--max_old_space_size=2192"  --purge-memory-button


* google-chrome 
* brave 

> chrome://flags
* --no-sandbox --site-per-process --process-per-site --enable-low-end-device-mode --disk-cache-size=104857600
> firefox
* firefox -no-remote -new-tab -console -purgecaches
* firefox -no-remote -new-window -p sidekick  -new-instance -P 

> boost cpu
* for i in {0..7}; do echo performance | sudo tee /sys/devices/system/cpu/cpu"$i"/cpufreq/scaling_governor ; done
> manage cpu performance
> http://manpages.ubuntu.com/manpages/bionic/man8/x86_energy_perf_policy.8.html
* sudo apt install linux-tools-5.4.0-31-generic linux-tools-generic linux-cloud-tools-generic linux-tools-common -y
* sudo x86_energy_perf_policy -v balance-performance

##### vm settings
* sudo sysctl -w vm.swappiness=20
* sudo sysctl -w vm.swappiness=20 && sudo sysctl vm.vfs_cache_pressure=50 && sudo sysctl -w net.ipv4.ip_forward=1
* sudo sysctl -w vm.swappiness=10 && sudo sysctl -w vm.vfs_cache_pressure=50 && sudo sysctl -w vm.dirty_ratio=10 && sudo sysctl -w vm.dirty_background_ratio=5 && sudo sync && sudo sysctl -w vm.drop_caches=3

##### wlan mtu
* ip link show | grep mtu
* sudo ip link set wlp3s0 mtu 1400 up
* ping -c 3 -M do -s 400 google.com

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
* python -m SimpleHTTPServer (deprecated python2)
* python3 -m http.server 8888
* http://localhost:8000
* php -S localhost:4000

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

* https://guides.github.com/features/mastering-markdown/
* https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet#youtube-videos

### HDMI brightness

* xrandr -q | grep " connected"
* xrandr --output HDMI-1 --brightness 0.5

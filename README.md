
Howto
=====
 
### Knowledge Base Repo

#### Index

##### AviSynth FX

* Kaleidoscope Effects, * Use Image Mask in videos, * Mix videos, * Add subtitle, * Cut and Loop videos

##### commandlinefu.com 

- terminal commands collection

##### CSS 

- animation effects

##### Data Mining

* resources, * weka usage, * tenserflow usage and installation, * php ann examples
* python scipy usage and installation, * data mining tools, * data mining examples

##### Linux Usage

* installation, configuration and settings on 
* Ubuntu 14.04 LTS
* Ubuntu 15.04 LTS
* Ubuntu 16.04 LTS

- distros iso ftp addresses, - ubuntu installation on macbook pro 13,  
- musik software trackers milkytracker, - antivirus sophos, - lampp xampp installation 
- backup linux, - apache caching, - ffmpeg convert examples mp4 mp3 mkv mpeg avi
- rsync examples, - cpu real time logs, - cyberciti tutorials, 
- daily commands in ubuntu, - disable startup services, - how to install elasticsearch
- how to edit efi boot mac , - get dir size ubuntu, - hdd defrag examples
- zsh install, - asus wifi config, - htop cpug install, - docker installation
- git installation, - mfc-j265 printeer installation, - mongodb redis instalaltion
- aptana phpstorm installation, - sugarcrm7.8 in lubuntu vps installation, - upgrade java
- install vagrant docker, - install xammp, - cpu limit how to, - php7 installation
- manjaro package menagement, - how to repair elasticsearch, - split merge files in ubuntu
- tar unzip zip gzip how to, - tmux how to, - traffic monitoring how to, - symlink howt to
- fsck howto, - wget how to, - cheatsheet linux, - speedtest example, - menu indicators
- iso files for virtualbox

##### My gist files

 - backup from gist.github.com
 
##### PHP 5.X - 7.X - tutorials 
 
 - configuration and settings PHP 5.X - 7.X
  
 
##### SugarCRM 7.X - tutorials 
 
 - configuration and settings on SugarCRM 7.X,  - create handelbars helper,  - create audit logic hook,  - create scheduled job
 - create custom filter,  - disable subpanel action buttons,  - disable password rules,  - get key from dropdown by value
 - set link as bwc,  - team manipulation,  - API examples,  - SQL reports,  - chinese font install,  - repair from terminal examples
 - workflows examples,  - run scheduler from root - test case,  - email template example,  - activity steam activation
 - tuning and performance boost examples,  - config override example,  - crud js Backbone examples      
 
##### Utiles

* PHPStorm colors themes, * autocomplete typeahead.js example, * database tools
* firefox settings , * gcc compiler usage, * tree command usage 
* google search query usage, * geogle api key howto, * mysql import export
* postgres installation, * phpstorm settings, * elasticsearch install
* iot apps integration, * online tools for testing, * productivity tools
* python scrapping tools, * generate random sound in linux howto, * ubuntu software list
* ubuntu wallpapers, * tech magazines on web, * xdebug settings


##### Config Git on new location
git config --global user.name "Administrator"
git config --global user.email "admin@example.com"

##### Check repo file Sizes
find . -name '*' -size +1M -exec ls -lh {} \; | awk '{ print $9 ": " $5 }'


##### Check pack
git verify-pack -v ./.git/objects/pack/pack-......ea.pack


##### Utiles Daily

* /usr/lib/chromium-browser/chromium-browser --disable-new-tab-first-run --enable-user-scripts --flag-switches-begin  --disable-accelerated-2d-canvas --disable-gpu-vsync --disable-threaded-animation --disable-webgl --js-flags=--harmony  --flag-switches-end --disable-gpu-process-prelaunch
* for i in {0..7}; do echo performance | sudo tee /sys/devices/system/cpu/cpu"$i"/cpufreq/scaling_governor ; done
* lynx t3n.de -accept_all_cookies  -justify
* sudo sysctl vm.swappiness=20
* cat /proc/sys/vm/swappiness
* sync && echo 3 | sudo tee /proc/sys/vm/drop_caches
* sudo /etc/init.d/dns-clean restart && sudo service network-manager reload
* sudo /etc/init.d/dns-clean restart && sudo service network-manager reload && echo 3 | sudo tee /proc/sys/vm/drop_caches && sudo /etc/init.d/networking restart 

##### Record Screen Ubuntu

* ffmpeg -v warning -video_size 1920x1080 -framerate 5 -f x11grab -i :0.0  myvid_$(date +%s).mov
* ffmpeg -f x11grab  -follow_mouse centered -show_region 1 -framerate 5 -video_size 4cif -i :0.0 xmvid_$(date +%s).mov
 
 



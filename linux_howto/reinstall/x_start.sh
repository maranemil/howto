
cat /proc/sys/vm/swappiness
sudo sysctl -w vm.swappiness=30
sudo service virtualbox stop
#service --status-all
sudo service bluetooth  stop
sudo service cups stop
sudo service cups-browsed stop



sudo swapoff -a;  sudo swapon -a
echo 3 | sudo tee /proc/sys/vm/drop_caches
sudo sh -c "sync; echo 3 > /proc/sys/vm/drop_caches"

# export LANGUAGE=en-US && google-chrome --lang=en-US,en
# google-chrome --disable-gpu --use-gl=desktop
# google-chrome --wm-window-animations-disabled --autoplay-policy=no-user-gesture-required --disable-threaded-animation --disable-notifications --new-window --enable-low-end-device-mode

# sudo swapoff -a && sudo fallocate -l 4G /swapfile3 && sudo chmod 600 /swapfile3 && sudo mkswap /swapfile3 && sudo swapon /swapfile3 -a && swapon -s && swapon --show

# export LANGUAGE=en-US && google-chrome --lang=en-US,en --disable-translate --ash-force-desktop --disable-3d-apis --disable-background-mode --disable-preconnect --dns-prefetch-disable --no-experiments --purge-memory-button --no-referrers --no-pings --start-maximized --disable-default-apps -disable-features=Translate --aggressive-cache-discard --disable-notifications --new-window --disable-dev-shm-usage --block-new-web-contents

# chromium-browser --bound-session-cookie-rotation-delay --disable-partitioned-cookies --disable-notifications --disable-ipc-flooding-protection --disable-print-preview --disable-remote-fonts  --disable-renderer-accessibilit --disable-threaded-animation  --disable-virtual-keyboard

# google-chrome  --bound-session-cookie-rotation-delay --disable-partitioned-cookies --disable-notifications --disable-ipc-flooding-protection --disable-print-preview --disable-remote-fonts  --disable-renderer-accessibilit --disable-threaded-animation  --disable-virtual-keyboard --disable-print-preview

#!/bin/sh

# crop jumping effect trembling
ffmpeg -i in1.mp4 -vf "crop=in_w/2:in_h/2:(in_w-out_w)/2+((in_w-out_w)/2)*sin(n/10):(in_h-out_h)/2 +((in_h-out_h)/2)*sin(n/7)" -y output.mp4

# add saturation
ffmpeg -i output.mp4 -vf eq=saturation=1.5 -y output2.mp4



# Cropping
# sudo apt install flatpak
# flatpak install flathub org.kde.kdenlive
# 
# flatpak remote-add --if-not-exists flathub https://dl.flathub.org/repo/flathub.flatpakrepo
# sudo apt install gnome-software-plugin-flatpak
# flatpak install flathub <app-id>
# flatpak run <app-id>
# flatpak update
# flatpak uninstall <app-id>
# 
# sudo apt update
# sudo apt install ffmpeg
# ffmpeg -i input.mp4 -vf "crop=out_w:out_h:x:y" output.mp4
# ffplay -i input.mp4 -vf "crop=570:440:619:463" 
# ffmpeg -i input.mp4 -vf "crop=570:440:619:463" out.mp4

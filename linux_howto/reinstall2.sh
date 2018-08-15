# fresh install ubuntu 18.04

sudo apt install chromium-browser -y
sudo apt install gimp -y
sudo apt install filezilla -y
sudo apt install gnome-commander -y
sudo apt install git -y
sudo apt install virtualbox -y
sudo apt install keepass2 -y
sudo apt install ffmpeg -y
sudo apt install mysql-workbench -y

sudo apt-get install htop -y
sudo apt-get install p7zip -y
sudo apt-get install audacity -y
sudo apt-get install openshot -y

# sublime-text
wget http://c758482.r82.cf2.rackcdn.com/sublime-text_build-3083_amd64.deb
sudo dpkg -i sublime-text_build-3083_amd64.deb

# dbeaver
wget https://dbeaver.jkiss.org/files/dbeaver-ce_latest_amd64.deb
sudo dpkg -i dbeaver-ce_latest_amd64.deb

# Sqlectron
wget https://github.com/sqlectron/sqlectron-gui/releases/download/v1.29.0/Sqlectron_1.29.0_amd64.deb
sudo dpkg -i Sqlectron_1.29.0_amd64.deb

#https://downloads.mysql.com/archives/get/file/mysql-workbench-community-6.3.9-1ubuntu16.04-amd64.deb
#https://downloads.mysql.com/archives/get/file/mysql-workbench-community-6.3.9-1ubuntu16.10-amd64.deb

# Visual Studio Code
wget https://packages.microsoft.com/repos/vscode/pool/main/c/code/code_1.23.1-1525968403_amd64.deb
sudo dpkg -i code_1.23.1-1525968403_amd64.deb

# Peek Gif Screen Resorder
# https://github.com/phw/peek#ubuntu
sudo add-apt-repository ppa:peek-developers/stable
sudo apt update
sudo apt install peek -y
sudo apt --fix-broken install
sudo apt install peek -y

# https://confluence.jetbrains.com/display/PhpStorm/Previous+PhpStorm+Releases
# https://www.jetbrains.com/phpstorm/download/#section=linux
# https://www.jetbrains.com/pycharm/download/#section=linux
# pycharm-community-2018.2.tar.gz
# PhpStorm-2018.1.5.zip
# https://download.jetbrains.com/python/pycharm-community-2018.2.1.tar.gz
# http://download.jetbrains.com/webide/PhpStorm-2018.1.6.tar.gz
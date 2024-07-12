usage
bash face-swap.sh && python3 face-swap.py

install 
docker run -d -p 5000:5000 r8.im/codeplugtech/face-swap@sha256:278a81e7ebb22db98bcba54de985d22cc1abeead2754eb1f2af717247be69b34

https://replicate.com/codeplugtech/face-swap?input=docker

save img
docker save -o face-swap.tar r8.im/codeplugtech/face-swap

import img
docker load -i face-swap.tar 

----

Distributor ID: Ubuntu
Description:    Ubuntu 23.04
Release:        23.04
Codename:       lunar

7GB

--


sudo apt install docker.io docker docker-compose
sudo apt install curl wget git
sudo groupadd docker
sudo usermod -aG docker $USER
docker run hello-world
sudo apt-get install jq

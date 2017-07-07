###############################################
#
# Clean Lamp Log File on Ubuntu 14.10
#
###############################################

sudo find / -name '*' -size +1G
sudo truncate -s0 error_log
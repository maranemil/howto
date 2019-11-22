#!/bin/bash

# check last 30 files ordered by date
# ll -t | head -30

# find log files
# find . -type f -iname *file.log > list.txt

# copy log files
input="list.txt"
while IFS= read -r line
do
	#echo $line | sed -r 's/\.//' # add /g for recursive
	LINE=${line/./} # remove .
	echo $LINE
	scp user@server:~/path_backupfiles$LINE $(date +%s).log
	sleep 2
done < "$input"

# show fist and last line from log files
#for i in *.log; do cat $i | head -n 1; cat $i | tail -n 1 ;echo "...................." ;done


# https://www.cyberciti.biz/faq/linux-unix-sleep-bash-scripting/
# http://tldp.org/LDP/Bash-Beginners-Guide/html/sect_09_05.html
# https://www.tldp.org/LDP/abs/html/loopcontrol.html
# http://matt.might.net/articles/bash-by-example/
# https://dev.to/awwsmm/101-bash-commands-and-tips-for-beginners-to-experts-30je
# https://www.computerhope.com/unix/ush.htm
# https://www.cyberciti.biz/faq/unix-howto-read-line-by-line-from-file/
# https://superuser.com/questions/408890/what-is-the-purpose-of-the-sh-command
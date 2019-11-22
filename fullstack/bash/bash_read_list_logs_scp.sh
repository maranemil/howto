#!/bin/bash
input="list.txt"
while IFS= read -r line
do
	#echo $line | sed -r 's/\.//' # add /g for recursive
	LINE=${line/./} # remove .
	echo $LINE
	scp user@server:~/path_backupfiles$LINE $(date +%s).log
	sleep 2
done < "$input"

# https://www.cyberciti.biz/faq/linux-unix-sleep-bash-scripting/
# http://tldp.org/LDP/Bash-Beginners-Guide/html/sect_09_05.html
# https://www.tldp.org/LDP/abs/html/loopcontrol.html
# http://matt.might.net/articles/bash-by-example/
# https://dev.to/awwsmm/101-bash-commands-and-tips-for-beginners-to-experts-30je
# https://www.computerhope.com/unix/ush.htm
# https://www.cyberciti.biz/faq/unix-howto-read-line-by-line-from-file/
# https://superuser.com/questions/408890/what-is-the-purpose-of-the-sh-command
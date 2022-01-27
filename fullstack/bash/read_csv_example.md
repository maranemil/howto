
## csv reader

```
#!/bin/bash
INPUT=batchclean.csv
OLDIFS=$IFS
IFS=,
[ ! -f $INPUT ] && { echo "$INPUT file not found"; exit 99; }
while read flname
do
	echo "Name : $flname"

	ls $flname | sed -e 's/^"//' -e 's/"$//'
	#rm $flname
	sleep 1
done < $INPUT
IFS=$OLDIFS

```

```
# https://www.cyberciti.biz/faq/unix-linux-bash-read-comma-separated-cvsfile/
# https://www.cyberciti.biz/faq/linux-unix-sleep-bash-scripting/
# https://www.cyberciti.biz/faq/howto-linux-unix-delete-remove-file/
```
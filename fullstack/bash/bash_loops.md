# bash loops

### remove
```
for f in file1 file2 file3
do
	rm "$f"
done
```

```
for VARIABLE in 1 2 3 4 5 .. N
do
	command1
	command2
	commandN
done
```

```
#!/bin/bash
for i in {1..5}
do
   echo "Welcome $i times"
done
```

### remove
```
for f in $(cat 1.txt) ; do
  rm "$f"
done
```

```
#!/bin/bash
# declare an array called array and define 3 vales
array=( one two three )
for i in "${array[@]}"
do
	echo $i
done
```

```
#!/bin/bash

# start with 1 and increment by 2 until you reach/pass 20
for i in $(seq 1 2 20)    
do
   echo "Welcome $i times"
done

# https://stackoverflow.com/questions/68104060/how-to-print-odd-numbers-in-bash
# start with 1 and increment by 3 until you reach/pass 20
for i in {1..20..3}    
do
    echo $i
done


```

```
#!/bin/bash
for (( c=1; c<=5; c++ ))
do
   echo "Welcome $c times"
done
```

---------------------------
```
#!/bin/bash

array=("first item" "second item" "third" "item")

echo "Number of items in original array: ${#array[*]}"
for ix in ${!array[*]}
do
    printf "   %s\n" "${array[$ix]}"
done
echo

arr=(${array[*]})
echo "After unquoted expansion: ${#arr[*]}"
for ix in ${!arr[*]}
do
    printf "   %s\n" "${arr[$ix]}"
done
echo

arr=("${array[*]}")
echo "After * quoted expansion: ${#arr[*]}"
for ix in ${!arr[*]}
do
    printf "   %s\n" "${arr[$ix]}"
done
echo

arr=("${array[@]}")
echo "After @ quoted expansion: ${#arr[*]}"
for ix in ${!arr[*]}
do
    printf "   %s\n" "${arr[$ix]}"
done
```

-----------------------------------
```
cat /tmp/list.txt | xargs mv -t /app/dest/
xargs mv -t /app/dest/ < /tmp/list.txt
sed 's/^ *//' < /tmp/list.txt | xargs -d '\n' mv -t /app/dest/
sed -i 12s/appSet/app-set/
while read file; do mv "$file" /app/dest/; done < list.txt
while IFS= read -r file; do mv "$file" /app/dest/; done < list.txt
for i in $(cat /tmp/list.txt); do mv "$i" /app/dest/; done
xargs -l -i < flist  mv -v {} /app/dst
xargs -I{} < flist  mv -v {} /app/dst
mv `cat /tmp/list.txt` /app/dest/
```

* https://www.cyberciti.biz/faq/bash-for-loop/
* https://www.cyberciti.biz/faq/bash-for-loop-array/
* https://www.cyberciti.biz/faq/bash-for-loop-array/
* http://www.linuxjournal.com/content/bash-arrays


```
#! /bin/bash
servers=( 192.xxx.xxx.2 192.xxx.xxx.3
          192.xxx.xxx.4 192.xxx.xxx.5
          192.xxx.xxx.6 192.xxx.xxx.7
)

for server in "${servers[@]}" ; do
    echo "$server"
done
```
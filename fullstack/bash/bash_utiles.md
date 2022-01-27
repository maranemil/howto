
### Shell check if folder exists 

```
if [ ! -d /directory/to/check ]; then
    mkdir -p /directory/toc/check
fi
```
Check for directory exists
```
if [ -d "$DIRPATH" ]; then
    # Add code logic here
fi
```
Check for directory does not exist
```
if [ ! -d "$DIRPATH" ]; then
    # Add code logic here
fi

if [[ -d "${DIRECTORY}" && ! -L "${DIRECTORY}" ]] ; then
    echo "It's a bona-fide directory"
fi
```



### create environment variables

https://scotch.io/tutorials/how-to-use-environment-variables

```
export DB_PASSWORD="abc"
echo $DB_PASSWORD
```


### BASH PERL VARS IN STRING

```
#!/bin/bash
cd "$(dirname "$0")"
echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~"

LOCKFILE=123456789

if [ ! -f /tmp/fl_$LOCKFILE.lock ]; then
        echo "Lock file created: /tmp/fl_$LOCKFILE.lock"
        touch /tmp/fl_$LOCKFILE.lock

        perl -le 'print "Process started!";'
        perl read.pl --config='cfg_'$LOCKFILE'_nfo.ini'

        echo "Lock file deleted: /tmp/fl_$LOCKFILE.lock"
        rm /tmp/fl_$LOCKFILE.lock
else
        echo "Cannot create Lock file for $LOCKFILE"
fi
```




* https://stackoverflow.com/questions/638975/how-do-i-tell-if-a-regular-file-does-not-exist-in-bash
* https://wiki.ubuntuusers.de/sleep/
* https://www.cyberciti.biz/faq/linux-unix-sleep-bash-scripting/
* http://tldp.org/HOWTO/Bash-Prog-Intro-HOWTO-5.html


```
#!/bin/bash

sleep 5
sleep 5s
sleep 2m
sleep 0.1h
sleep 2h &&
sleep 30m && killall vlc
sleep 5d

if [ ! -f /tmp/foo.txt ]; then
    echo "File not found!"
else
	echo "File found!"
fi
```

```
#!/bin/bash
FILE=$1

if [ ! -f "$FILE" ]
then
    echo "File $FILE does not exist"
fi


if [[ ! -f $FILE ]]; then
    if [[ -L $FILE ]]; then
        printf '%s is a broken symlink!\n' "$FILE"
    else
        printf '%s does not exist!\n' "$FILE"
    fi
fi
```

```
Bash File Testing

-b filename - Block special file
-c filename - Special character file
-d directoryname - Check for directory Existence
-e filename - Check for file existence, regardless of type (node, directory, socket, etc.)
-f filename - Check for regular file existence not a directory
-G filename - Check if file exists and is owned by effective group ID
-G filename set-group-id - True if file exists and is set-group-id
-k filename - Sticky bit
-L filename - Symbolic link
-O filename - True if file exists and is owned by the effective user id
-r filename - Check if file is a readable
-S filename - Check if file is socket
-s filename - Check if file is nonzero size
-u filename - Check if file set-user-id bit is set
-w filename - Check if file is writable
-x filename - Check if file is executable

-e: Returns true if file exists (regular file, directory, or symlink)
-f: Returns true if file exists and is a regular file
-d: Returns true if file exists and is a directory
-h: Returns true if file exists and is a symlink

-r: Returns true if file exists and is readable
-w: Returns true if file exists and is writable
-x: Returns true if file exists and is executable
-s: Returns true if file exists and has a size > 0
```



## bash read input yes no

```
https://stackoverflow.com/questions/226703/how-do-i-prompt-for-yes-no-cancel-input-in-a-linux-shell-script
https://www.computerhope.com/unix/bash/read.htm
https://www.shellhacks.com/yes-no-bash-script-prompt-confirmation/
https://tecadmin.net/bash-script-prompt-to-confirm-yes-no/
https://unix.stackexchange.com/questions/285362/how-to-execute-yes-no-operation-as-long-as-i-press-yes-in-bash
https://gist.github.com/davejamesmiller/1965569
https://danielgibbs.co.uk/2013/06/bash-yesno/
https://askubuntu.com/questions/338857/automatically-enter-input-in-command-line
```
```
while true; do
    read -p "Do you wish to install this program?" yn
    case $yn in
        [Yy]* ) make install; break;;
        [Nn]* ) exit;;
        * ) echo "Please answer yes or no.";;
    esac
done

echo "Do you wish to install this program?"
select yn in "Yes" "No"; do
    case $yn in
        Yes ) make install; break;;
        No ) exit;;
    esac
done

read -p "Are you sure? " -n 1 -r
echo    # (optional) move to a new line
if [[ ! $REPLY =~ ^[Yy]$ ]]
then
    exit 1
fi
```


```
http://tldp.org/LDP/Bash-Beginners-Guide/html/sect_08_02.html
https://unix.stackexchange.com/questions/152372/how-to-make-bash-script-ask-you-if-you-want-to-execute-the-next-segmentpart
https://unix.stackexchange.com/questions/232761/get-script-to-run-again-if-input-is-yes
https://askubuntu.com/questions/1038276/how-to-get-bash-file-to-echo-differently-based-on-user-input
https://tecadmin.net/prompt-user-input-in-linux-shell-script/
https://en.wikibooks.org/wiki/Bash_Shell_Scripting
https://itnext.io/bash-scripting-everything-you-need-to-know-about-bash-shell-programming-cd08595f2fba
https://stackoverflow.com/questions/2953646/how-can-i-declare-and-use-boolean-variables-in-a-shell-script
```

```
echo -n "Enter your name and press [ENTER]: "
read name
echo -n "Enter your gender and press [ENTER]: "
read -n 1 gender
echo
```

```
echo "Do you want to continue?(yes/no)"
read -s input
if [ "$input" == "yes" ]
then
echo "continue"
fi
```

```
#!/bin/bash
read -p "Enter Your Name: "  username
echo "Welcome $username!"

if [[ "$1" == --verbose ]] ; then
  verbose_mode=TRUE
  shift # remove the option from $@
else
  verbose_mode=FALSE
fi
```




###   How to Pass Arguments to a Bash Script

```
https://www.lifewire.com/pass-arguments-to-bash-script-2200571
http://linuxcommand.org/lc3_wss0120.php
http://mywiki.wooledge.org/BashFAQ/035#getopts
https://unix.stackexchange.com/questions/32290/pass-command-line-arguments-to-bash-script
https://www.poftut.com/how-to-pass-and-parse-linux-bash-script-arguments-and-parameters/
https://serverfault.com/questions/219306/control-a-bash-script-with-variables-from-an-external-file
https://www.tcl.tk/man/tcl8.5/tutorial/Tcl26.html
http://man7.org/linux/man-pages/man1/bash.1.html
https://www.computerhope.com/unix/bash/shift.htm
```

sh stats.sh songlist

```
#!/bin/bash
FILE1=$1
wc $FILE1

for FILE1 in "$@"
do
wc $FILE1
done
```


```
sh stats.sh songlist1 songlist2 songlist3
sh stats.sh 'songlist 1' 'songlist 2' 'songlist 3'
```

### Flags Method

makereport -u jsmith -p notebooks -d 10-20-2011 -f pdf

```
#!/bin/bash
while getopts u:d:p:f: option
do
case "${option}"
in
u) USER=${OPTARG};;
d) DATE=${OPTARG};;
p) PRODUCT=${OPTARG};;
f) FORMAT=${OPTARG};;
esac
done
```

```
myscript.sh 1 3
myscript.sh 10 "Hello Poftut"
```

```
#!/bin/bash
echo $1 $2

#!/bin/bash
salute=$1
name=$2
echo $salute $name
```

```
#!/bin/bash
for var in "$@"
do
  echo $var
done
```

```
#!/bin/bash
while getopts u:p: option
do
 case "${option}"
 in
 u) USER=${OPTARG};;
 p) PASSWORD=${OPTARG};;
 esac
done
echo "User:"$USER
echo "Password:"$PASSWORD
```

```
################################################
#
#   find exit in php extensions
#   exclude vendors
#   exclude index.php
#
################################################
```
```
RESULT=$(find . -type f  -name "*.php"  ! -iname "index.php" !  -name "vendors" -prune   -exec grep -Hn "exit[ ]*([ ]*)" {} \; | grep -v "/[ ]*exit" | grep -v "#[ ]*exit" | grep -v "//[ ]*exit" | tr -s '.' )
if [ "$RESULT" != "" ]; then
	echo "found exit"
	echo "  "${RESULT}
else
	echo "no exit found"
fi
```



```
################################################
# split list in lines
# https://stackoverflow.com/questions/918886/how-do-i-split-a-string-on-a-delimiter-in-bash
################################################
```
```
#!/usr/bin/env bash
IN="bla@some.com;john@home.com"
mails=$(echo $IN | tr ";" "\n")
for addr in $mails
do
    echo "> [$addr]"
done
```

```
################################################
find -wholename pattern
https://www.gnu.org/software/findutils/manual/html_node/find_html/Full-Name-Patterns.html
################################################
```

```
################################################
How to check the extension of a filename in a bash script?
https://stackoverflow.com/questions/407184/how-to-check-the-extension-of-a-filename-in-a-bash-script
################################################
```

```
if [ ${file: -4} == ".txt" ]
if [ "$file" == "*.txt" ]
if [[ $file == *.txt ]]
```

### read git diff and search for die() in php files


```
https://repl.it/languages/bash
https://www.tutorialspoint.com/execute_bash_online.php
```

```
GITDIFF=$(git diff develop..master --numstat | awk '{ print $3 }')
if [ "$GITDIFF" != "" ]; then
	#echo "  found git diff"
	#echo $GITDIFF
	FILES=$(echo $GITDIFF | tr ";" "\n")
	for FILE in $FILES
		do
    		if [ ${FILE: -4} == ".php" ]; then
				#RESULT=$(cat $FILE | grep -i "die()")
				RESULT=$(find $FILE -exec grep -Hn "die[ ]*([ ]*)" {} \; | grep -v "/[ ]*die" | grep -v "#[ ]*die" | grep -v "//[ ]*die")
				if [ "$RESULT" != "" ]; then
					echo "[$FILE]"
					echo "found EXIT";
				fi
			fi
	done
else
	echo "ok"
fi
```

### days date from to range bash shell

```
https://unix.stackexchange.com/questions/92880/how-to-print-dates-between-two-different-dates/92882
https://www.cyberciti.biz/faq/linux-unix-sleep-bash-scripting/
https://unix.stackexchange.com/questions/223543/get-the-date-of-last-months-last-day-in-a-shell-script
https://www.cyberciti.biz/faq/unix-linux-bash-script-check-if-variable-is-empty/
https://unix.stackexchange.com/questions/92880/how-to-print-dates-between-two-different-dates
https://www.cyberciti.biz/tips/linux-unix-get-yesterdays-tomorrows-date.html
https://unix.stackexchange.com/questions/445355/i-want-while-loop-for-date-2018-03-28-to-2018-04-02-in-unix
https://stackoverflow.com/questions/28226229/how-to-loop-through-dates-using-bash
https://unix.stackexchange.com/questions/84381/how-to-compare-two-dates-in-a-shell
https://stackoverflow.com/questions/23758160/how-can-i-get-first-day-and-last-day-of-previous-month-in-shell-script
http://tldp.org/LDP/abs/html/comparison-ops.html
http://tldp.org/HOWTO/Bash-Prog-Intro-HOWTO-11.html
https://linuxize.com/post/how-to-compare-strings-in-bash/
https://unix.stackexchange.com/questions/223543/get-the-date-of-last-months-last-day-in-a-shell-script

https://www.tutorialspoint.com/execute_bash_online.php
https://repl.it/
```

```
# v1
start=$(date --date='-1 month' +%Y-%m-01)
end=$(date -d "$(date +%Y-%m-01) -1 day" +%Y-%m-%d)
start=$(date -d "$(date +%Y-%m-01) -1 month" +%Y-%m-%d )
end=$(date -d"-1 day 1 $(date +%b)" +%F)
# or !=
while [[ $start < $end ]]; do
    printf "$start\n"; start=$(date -d "$start + 1 day" +"%Y-%m-%d")
    sleep 1
done
```

```
# v2
startdate='2019-12-01'
enddate='2019-12-31'
enddate=$( date -d "$enddate" +%Y%m%d )  # rewrite in YYYYMMDD format
i=0
while [ "$thedate" != "$enddate" ]; do
    thedate=$( date -d "$startdate + $i days" +%Y%m%d ) # get $i days forward
    printf 'The date is "%s"\n' "$thedate"
    i=$(( i + 1 ))
done
```

```
# v3
startdate='2019-12-01'
enddate='2019-12-31'
enddate=$( date -d "$enddate + 1 day" +%Y%m%d )   # rewrite in YYYYMMDD format and take last iteration into account
thedate=$( date -d "$startdate" +%Y%m%d )
while [ "$thedate" != "$enddate" ]; do
    printf 'The date is "%s"\n' "$thedate"
    thedate=$( date -d "$thedate + 1 days" +%Y%m%d ) # increment by one day
done
```

### check if env
```
https://unix.stackexchange.com/questions/190513/shell-scripting-proper-way-to-check-for-internet-connectivity
https://stackoverflow.com/questions/21097900/checking-if-pwd-contains-directory-name
https://stackoverflow.com/questions/19306771/how-can-i-get-the-current-users-username-in-bash/19306837#19306837
```

```
if [[ "$PWD" = */$(whoami)/* ]]
  then
    # do something
fi
```


```
#####################################################################
#
# 	run command stored in string inside bash script
#	https://stackoverflow.com/questions/2005192/how-to-execute-a-bash-command-stored-as-a-string-with-quotes-and-asterisk
#
#####################################################################
```
```
cmd='mysql AMORE -u root --password="password" -h localhost -e "select host from amoreconfig"'
$ eval $cmd

cmd="ls"
$cmd
```

```
#####################################################################
#
# 	Concat sring in bash script
#	https://linuxhint.com/string_concatenation_bash/
#
#####################################################################
```

```
#!/bin/bash
echo "Printing the list of foods"
#Initialize the variable before combine
foods=""
#for loop for reading the list
for value in 'Cake' 'ice-cream' 'Burger' 'Pizza'; do
#Combine the list values by using shorthand operator
foods+="$value "
done
#Print the combined values
echo "$foods"
```

```
https://stackoverflow.com/questions/3362920/get-just-the-filename-from-a-path-in-a-bash-script
https://stackoverflow.com/questions/965053/extract-filename-and-extension-in-bash?noredirect=1&lq=1
https://stackoverflow.com/questions/29761201/delete-everything-before-last-in-bash?noredirect=1&lq=1
https://stackoverflow.com/questions/59838/how-can-i-check-if-a-directory-exists-in-a-bash-shell-script?rq=1
https://stackoverflow.com/questions/59895/how-can-i-get-the-source-directory-of-a-bash-script-from-within-the-script-itsel?rq=1
https://stackoverflow.com/questions/592620/how-can-i-check-if-a-program-exists-from-a-bash-script?rq=1
https://stackoverflow.com/questions/918886/how-do-i-split-a-string-on-a-delimiter-in-bash?rq=1
https://stackoverflow.com/questions/965053/extract-filename-and-extension-in-bash?rq=1
https://stackoverflow.com/questions/1371261/get-current-directory-name-without-full-path-in-a-bash-script?rq=1
```

### getopts
```
https://www.ibm.com/docs/de/aix/7.2?topic=g-getopts-command
https://hope-this-helps.de/serendipity/archives/Bash-Parameter-sauber-an-Skript-uebergeben-509.html
https://forum.ubuntuusers.de/topic/sinn-von-getopts/
https://qastack.com.de/unix/75219/bash-getopts-short-options-only-all-require-values-own-validation
https://www.it-swarm.com.de/de/bash/bash-getops-lesen-von-optarg-fuer-optionale-flags/1040492806/
------------------------------------------------
```
```
#!/bin/bash

while getopts xyz:A: option
do
        case $option in
                x) echo "Option -x übergeben";;
                y) echo "Option -y übergeben";;
                z) echo "Option -z und Argument : ($OPTARG)";;
                A) echo "Option -A und Argument : ($OPTARG)";;
        esac
done
```
```
# definiere mögliche Parameter
# ------------------------------------------------

while getopts s:f:h opts; do
        case ${opts} in
                s) var1=${OPTARG} ;;
                f) var2=${OPTARG} ;;
                h) show_help ;;
        esac
done
```
------------------------------------------------
```
errs=0
declare -A option=(
    [MYSQL_HOST]="-h"
    [MYSQL_USER]="-u"
    [MYSQL_PASS]="-p"
    [BACKUP_DIR]="-d"
)
for var in "${!option[@]}"; do
    if [[ -z "${!var}" ]]; then
        echo "error: specify a value for $var with ${option[var]}"
        ((errs++))
    fi
done
((errs > 0)) && exit 1
```
------------------------------------------------
```
while getopts ":a:b:c:d:e:f:" opt; do
    case $opt in
        a) Apple="$OPTARG";;
        b) BANANA="$OPTARG";;
        c|d|e|f)
            if test "$OPTARG" = "$(eval echo '$'$((OPTIND - 1)))"; then
                OPTIND=$((OPTIND - 1))
            else
                 case $opt in
                     c) CHERRY="$OPTARG";;
                     d) DFRUIT="$OPTARG";;
                     ...
                esac
            fi ;;
        \?) ... ;;
        :)
             case "$OPTARG" in
                 c|d|e|f) ;; # Ignore missing arguments
                 *) echo "option requires an argument -- $OPTARG" >&2 ;;
            esac ;;
        esac
    done
```

### check for non-null/non-zero string variable

```
https://stackoverflow.com/questions/3601515/how-to-check-if-a-variable-is-set-in-bash/13864829#13864829
https://stackoverflow.com/questions/3601515/how-to-check-if-a-variable-is-set-in-bash/16753536
https://stackoverflow.com/questions/3601515/how-to-check-if-a-variable-is-set-in-bash/13864829
http://www.gnu.org/savannah-checkouts/gnu/bash/manual/bash.html#Shell-Parameter-Expansion
https://pubs.opengroup.org/onlinepubs/9699919799/utilities/V3_chap02.html#tag_18_06_02
https://www.gnu.org/software/bash/manual/html_node/Bash-Conditional-Expressions.html
https://www.gnu.org/software/bash/manual/html_node/Shell-Arithmetic.html
https://stackoverflow.com/revisions/16753536/1
```

```
if [ -n "$1" ]; then
  echo "You supplied the first parameter!"
else
  echo "First parameter not supplied."
fi

if [ -z "$1" ]; then
    echo "ok";
fi

if [ "$1" != "" ]; then
  echo \$1 is set
else
  echo \$1 is not set
fi

if [ $# -gt 0 ]; then
  echo \$1 is set
else
  echo \$1 is not set
fi

if test -n "${name-}"; then
  echo "name is set to $name"
else
  echo "name is not set or empty"
fi

if test ! -z "${var+}"; then
  echo "name is set to $name"
else
  echo "name is not set"
fi

#! /bin/bash -u

if [[ ! -v SOMEVAR ]]; then
    SOMEVAR='hello'
fi
echo $SOMEVAR
```
```
+-----------------------+-------------+---------+------------+
| Expression in script  | name='fish' | name='' | unset name |
+-----------------------+-------------+---------+------------+
| test "$name"          | TRUE        | f       | f          |
| test -n "$name"       | TRUE        | f       | f          |
| test ! -z "$name"     | TRUE        | f       | f          |
| test ! "${name-x}"    | f           | TRUE    | f          |
| test ! "${name+x}"    | f           | f       | TRUE       |
+-----------------------+-------------+---------+------------+

+----------------------+-------------+---------+------------+
| Expression in script | name='fish' | name='' | unset name |
+----------------------+-------------+---------+------------+
| test "${name+x}"     | TRUE        | TRUE    | f          |
| test "${name-x}"     | TRUE        | f       | TRUE       |
| test -z "$name"      | f           | TRUE    | TRUE       |
| test ! "$name"       | f           | TRUE    | TRUE       |
| test ! -n "$name"    | f           | TRUE    | TRUE       |
| test "$name" = ''    | f           | TRUE    | TRUE       |
+----------------------+-------------+---------+------------+
```

```
if [ ! -z "$1" ]; then
        echo '$1 is set'
fi
```

```
-a file
True if file exists.

-b file
True if file exists and is a block special file.

-c file
True if file exists and is a character special file.

-d file
True if file exists and is a directory.

-e file
True if file exists.

-f file
True if file exists and is a regular file.

-g file
True if file exists and its set-group-id bit is set.

-h file
True if file exists and is a symbolic link.

-k file
True if file exists and its "sticky" bit is set.

-p file
True if file exists and is a named pipe (FIFO).

-r file
True if file exists and is readable.

-s file
True if file exists and has a size greater than zero.

-t fd
True if file descriptor fd is open and refers to a terminal.

-u file
True if file exists and its set-user-id bit is set.

-w file
True if file exists and is writable.

-x file
True if file exists and is executable.

-G file
True if file exists and is owned by the effective group id.

-L file
True if file exists and is a symbolic link.

-N file
True if file exists and has been modified since it was last read.

-O file
True if file exists and is owned by the effective user id.

-S file
True if file exists and is a socket.

-v varname
True if the shell variable varname is set (has been assigned a value).

-z string
True if the length of string is zero.

-n string
string
True if the length of string is non-zero.
```

### create multiple folders

https://stackoverflow.com/questions/793858/how-to-mkdir-only-if-a-directory-does-not-already-exist


```
if [[ ! -e $dir ]]; then
    mkdir $dir
elif [[ ! -d $dir ]]; then
    echo "$dir already exists but is not a directory" 1>&2
fi
```
```
# create multiple folders
mkdir -p foo/bar/baz
mkdir -p foo bar baz

# check if exists
[ -d foo ] || mkdir foo
```


### ow to check if a variable is empty in a bash script?

https://www.digitalocean.com/community/questions/how-to-check-if-a-variable-is-empty-in-a-bash-script


```
#!/bin/bash

echo "Enter your name: "
read name

while [[ -z ${name} ]] ; do
    echo "Make sure to specify your name!"

    echo "Enter your name: "
    read name
done

echo "Hello ${name}"
```

### jq - parse error: Invalid numeric literal

```
parse error: Invalid numeric literal at line 1, column 7
parse error: Invalid numeric literal at line 2, column 0

https://github.com/stedolan/jq/issues/501
https://github.com/stedolan/jq/issues/1119
https://asciinema.org/a/Z4B06lh4Otdb6mBJmfg3hqraa
https://asciinema.org/
https://stackoverflow.com/questions/56136673/parse-error-invalid-numeric-literal-at-line-1-column-6
https://unix.stackexchange.com/questions/599900/curl-jq-get-value-from-field-name
```
```
jq --version

iconv -f UTF-16 -t ASCII config.json -o config.json
jq . config.json

echo "{'foo':'bar'}" | jq .foo

echo "{\"foo\":\"bar\"}" | jq .foo
echo '{"foo":"bar"}' | jq '.foo'
```
```
#!/bin/bash
for i in {1..15}
do
    newdate=`/bin/date -v +"$i"d +%Y%m%d`
    echo newdate=$newdate
    curl -k -s "https://api.earningscalendar.net/?date=$newdate" | jq type
done

curl -X POST \
    --header 'Content-Type:application/json' \
    --data "$json_document" 'https://myurl/resource' |
jq .id
```
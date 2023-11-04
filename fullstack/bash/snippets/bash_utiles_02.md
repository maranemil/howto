
#### use cd ... exit in case cd fails
```
https://unix.stackexchange.com/questions/511867/when-can-a-cd-command-fail-in-a-shell-script-and-what-can-i-do-to-remedy-it
https://github.com/koalaman/shellcheck/issues/592
https://stackoverflow.com/questions/47033419/display-error-and-exit-when-cd-exits-with-error
https://www.shellcheck.net/wiki/SC2164
https://linuxcommand.org/lc3_wss0140.php
https://rustrepo.com/repo/koalaman-shellcheck

#!/bin/sh
# with method
gofoo() {
  cd foo || return
}
gofoo

# short
cd "$foo" || { echo "Error xyz"; exit 1; }

# long ------------------
if ! cd "${dir}" ; then
    echo "Failed to enter folder ${dir}"
    echo "Aborting"
    exit 1
fi

# long ------------------
if [ ! -d "$WORK_DIR"/foo  ]
then
    cd "$WORK_DIR" || { echo "cd $WORK_DIR failed"; exit 127; }
    echo "Setting up foo ...please, wait!"
    git clone https://github.com/project/foo || { echo "git failed"; exit 127; }
    chmod 755 "$WORK_DIR"/foo || { echo "chmod foo failed"; exit 127; }
    cd "$WORK_DIR"/foo || { echo "cd failed"; exit 127; }
fi
```

---
### set -e, -u, -x, -o pipefail

```

https://explainshell.com/explain?cmd=set+-eux
https://unix.stackexchange.com/questions/480321/set-eux-instead-set-x-in-bash-profile-for-global-debugging
https://gist.github.com/mohanpedala/1e2ff5661761d3abd0385e8223e16425

-e  returns an exit status if run fails, shell exit
-u  write a message to standard error 
-x  write to standard error a trace
```


------------------------------------------------
```
permissions

https://stackoverflow.com/questions/28340263/how-to-make-a-file-executable-using-makefile
https://stackoverflow.com/questions/20508606/makefile-that-gives-permission-to-my-python-script
https://askubuntu.com/questions/229589/how-to-make-a-file-e-g-a-sh-script-executable-so-it-can-be-run-from-a-termi
https://github.com/imapsync/imapsync/blob/master/Makefile
https://www.gnu.org/software/automake/manual/automake.html
https://kb.iu.edu/d/abdb
https://www.grymoire.com/Unix/Permissions.html
https://www.baeldung.com/linux/chown-chmod-permissions

chmod +x filename.sh
./filename.sh

Makefile
all: myprogram
    chmod 755 myprogram
    
python myprogram.py $1 $2
python myprogram.py $@
```

------------------------------------------------
```
https://www.pascallandau.com/blog/structuring-the-docker-setup-for-php-projects/
https://github.com/docker-library/php/blob/master/docker-php-entrypoint
https://stackoverflow.com/questions/53298532/docker-entrypoints-override-involve-cmd-specification

docker build .docker -f .docker/nginx/Dockerfile

docker-php-entrypoint

#!/bin/sh
set -e
# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
    set -- php-fpm "$@"
fi
exec "$@"
```

```

##########################################################################
SC1061
##########################################################################

https://github.com/koalaman/shellcheck/wiki/SC1061

yes() {
  while echo "y"
  do
    true
  done
}
```



### date
```
#############################################################
bash date
#############################################################

https://learnubuntu.com/get-current-date-time/
https://www.howtogeek.com/410442/how-to-display-the-date-and-time-in-the-linux-terminal-and-use-it-in-bash-scripts/
https://www.howtogeek.com/google-messages-features-you-should-be-using/
https://askubuntu.com/questions/634173/how-to-get-date-and-time-using-command-line-interface
https://www.cyberciti.biz/faq/linux-display-date-and-time/

date +"%d-%m-%y"
date +"%d/%m/%y"
date +"%H:%M:%S"
date "+%r"
date +%c
date +%A%d%B
date +"Today is: %A %d %B"

%D: Prints the date in mm/dd/yy format.
%F: Prints the date in yyyy-mm-dd format.
%x: Prints the date in the format for your locale.
%H: Prints the hour 00, 01, 02...23.
%I: Prints the hour using the 12-hour clock, 00, 01, 02 ... 12, with a leading zero if required.

echo $(date --date='2 days ago')
echo $(date --date='25 Dec' +%j)
echo $(date -I -d "last month ")

timedatectl

#!/bin/bash
TODAY=$(date +"Today is %A, %d of %B")
TIMENOW=$(date +"The local time is %r")
TIME_UK=$(TZ=BST date +"The time in the UK is %r")
echo $TODAY
echo $TIMENOW
echo $TIME_UK

#!/bin/bash
# obtain the date and time
date_stamp=$(date +"%F-%H-%M-%S")
# make a directory with that name
mkdir "$date_stamp"
# copy the files from the current folder into it
cp *.txt "$date_stamp"
# all done, report back and exit
echo "Text files copied to directory: "$date_stamp


https://unix.stackexchange.com/questions/151547/linux-set-date-through-command-line
https://linux.die.net/man/1/date
https://unix.stackexchange.com/questions/120484/what-is-a-standard-command-for-printing-a-date-in-rfc-3339-format
https://datatracker.ietf.org/doc/html/rfc3339

date +"%s.%N" - 1699113226.695250031
date --rfc-3339=ns - 2023-11-04 16:54:02.069593873+01:00
date +"%s" 1699113266


```






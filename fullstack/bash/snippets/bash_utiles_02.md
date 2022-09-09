
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







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












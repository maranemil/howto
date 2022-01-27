
### bash if else

https://ryanstutorials.net/bash-scripting-tutorial/bash-if-statements.php

```
#!/bin/bash
# else example
if [ $# -eq 1 ]
	then
	nl $1
else
	nl /dev/stdin
fi
```


```
#!/bin/bash
# elif statements
if [ $1 -ge 18 ]
	then
		echo You may go to the party.
elif [ $2 == 'yes' ]
	then
		echo You may go to the party but be back before midnight.
else
	echo You may not go to the party.
fi
```



```
#!/bin/bash
# case example
case $1 in
	start)
		echo starting
	;;
	stop)
		echo stoping
	;;
	restart)
		echo restarting
	;;
	*)
		echo don\'t know
	;;
esac
```





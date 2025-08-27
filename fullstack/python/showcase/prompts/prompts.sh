

### open terminal and type :  sh prompts.sh

###

~~~bash
sqlite3 -header -csv prompts.db "select * from prompts;" > prompts_$(date +%s).csv
~~~

###

~~~bash
sqlite3 prompts.db .dump > prompts_$(date +%s).sql
~~~
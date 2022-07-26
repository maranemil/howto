###########################################################

Updating data in mysql db from bash script

###########################################################

https://stackoverflow.com/questions/28462376/updating-data-in-mysql-db-from-bash-script
https://www.shellhacks.com/mysql-run-query-bash-script-linux-command-line/
https://dev.mysql.com/doc/mysql-shell/8.0/en/mysql-shell-commands.html
https://www.tutorialspoint.com/mysql/mysql-update-query.htm
https://www.howtogeek.com/devops/check-a-value-in-a-mysql-database-from-a-linux-bash-script/


mysql -u USER -pPASSWORD -D DATABASE -e "SQL_QUERY"
mysql -u USER -pPASSWORD -h HOSTNAME -e "SQL_QUERY"
mysql -u root -pPassword -h hostname -D dbname -e 'query'

mysql -u USER -pPASSWORD <<EOF
SQL_QUERY 1
SQL_QUERY 2
SQL_QUERY N
EOF


#!/bin/bash
mysql -u username -puserpass dbname -e "UPDATE mytable SET mycolumn = 'myvalue' WHERE id='myid'";

#!/bin/bash
mysql -u username -puserpass -D dbname -e "UPDATE mytable SET mycolumn = 'myvalue' WHERE id='myid'";

#!/bin/bash
mysql -u root -ppassword DB_NAME <<EOF
SELECT * FROM CUSTOMERS WHERE NAME='YOURNAME';
SELECT * FROM ANOTHER_TABLE WHERE SOMETHING_ELSE;
... more queries
EOF

#!/bin/bash
mysql -u root -psecret <<MY_QUERY
USE mysql
SHOW tables
MY_QUERY

#!/bin/bash
field=$(mysql -u root -BNe 'USE test; SELECT label FROM test WHERE id=1')
if [ $field == 'TEST' ]; then
    //do stuff
fi

#!/bin/bash
if mysql -u root -e 'USE mydbname'; then
    //database exists, do stuff
fi

#!/bin/bash
if mysql -u root -e 'USE mydbname; SELECT * FROM tablename LIMIT 1'; then
   //database and table exist, do more stuff
fi


ERROR 1064 (42000) at line 52: Query needs escape

mysql -u USER -pPASSWORD <<EOF
UPDATE IGNORE \`call\` SET name='test' WHERE 1;
UPDATE IGNORE \`case\` SET name='test' WHERE 1;
EOF
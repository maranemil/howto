
######
#
### Executing SQL Statements from a Text File
######

~~~
https://dev.mysql.com/doc/refman/8.0/en/mysql-batch-commands.html
https://stackoverflow.com/questions/41070522/how-do-you-modify-a-multiline-statement-on-the-command-line-in-mysql
https://dev.mysql.com/doc/refman/8.0/en/mysql-commands.html
https://dev.mysql.com/doc/mysql-shell/8.0/en/mysql-shell-commands.html
https://www.shellhacks.com/mysql-run-query-bash-script-linux-command-line/

mysql db_name < text_file
mysql < text_file
mysql -u auser -p apassword the_database< sql.txt

MySQL has the \e command, which lets you edit the current command in your favorite editor. 
edit      (\e) Edit command with $EDITOR.
print     (\p) Print current command.

edit, \e

Edit the current input statement. mysql checks the values of the EDITOR and VISUAL environment variables to determine which editor to use. The default editor is vi if neither variable is set.

print, \p

Print the current input statement without executing it.
~~~

~~~
mysql> how
    -> tables\e
... in your favorite text editor, fix the query ...
    -> \p
--------------
show tables;

--------------

    -> ;
+---------------+
| Tables_in_foo |
+---------------+
| bar           |
+---------------+
mysql>
~~~
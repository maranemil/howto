
### create a new SQLite database file.
```bash
sqlite3 prompts.db
```

### create a sample table 
```sql
CREATE TABLE IF NOT EXISTS prompts (
            id INTEGER PRIMARY KEY,
            name TEXT,
            prompt VARCHAR(6000),
            type TEXT,
            score REAL,
            created_date datetime default current_timestamp
        )
```

### install kate
~~~
# sudo apt install kate konsole
~~~

### install env
~~~
sudo apt install python3-virtualenv
sudo apt-get install python3-tk

virtualenv --version
virtualenv venv --distribute
# virtualenv --python=/usr/bin/python3.7 venv
source venv/bin/activate

python3 --version
pip --version

python3 -m venv venv
~~~

### start php server
~~~
php -S localhost:8000
http://localhost:8000/prompts.php
~~~

### import dump 
~~~
sqlite3 prompts2.db
.mode insert prompts
sqlite> .out file.sql
SELECT NULL AS id,name,prompt,type,score,created_date from prompts;

cat file.sql | sqlite3 prompts.db
~~~
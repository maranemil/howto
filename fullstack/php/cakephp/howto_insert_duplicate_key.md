
### CakePHP 3.0: How to do an insert on duplicate key update?
```
/*
https://book.cakephp.org/2.0/en/models/associations-linking-models-together.html#hasone
https://api.cakephp.org/3.5/class-Cake.ORM.Behavior.CounterCacheBehavior.html
https://book.cakephp.org/2.0/en/core-utility-libraries/hash.html
https://book.cakephp.org/3.0/en/orm/saving-data.html
https://book.cakephp.org/2.0/en/core-utility-libraries/string.html
https://book.cakephp.org/3.0/en/orm/schema-system.html
https://book.cakephp.org/3.0/en/orm/validation.html
https://dev.mysql.com/doc/refman/5.5/en/insert-on-duplicate.html
https://book.cakephp.org/2.0/en/models/saving-your-data.html
https://book.cakephp.org/2.0/en/models/associations-linking-models-together.html#hasone
https://www.dreamincode.net/forums/topic/314299-cakephp-on-duplicate-key-update/
*/
```
### example 1
```
foreach ($articles AS $article) {
  $query = $this->Articles->query();
  $query
    ->insert($required_article_fields)
    ->values($article)
    ->epilog('ON DUPLICATE KEY UPDATE field=field+1')
    ->execute();
}
```
### example 2
```
$newUsers = [
    [
        'username' => 'Felicia',
        'age' => 27,
    ],
    [
        'username' => 'Timmy',
        'age' => 71,
    ],
];
$columns = array_keys($newUsers[0]);
$upsertQuery = $this->Users->query();
$upsertQuery->insert($columns);
// need to run clause('values') AFTER insert()
$upsertQuery->clause('values')->values($newUsers);
$upsertQuery->epilog('ON DUPLICATE KEY UPDATE `username`=VALUES(`username`), `age`=VALUES(`age`)')
                ->execute();

```
```
# mysql refman 5.5/en
# INSERT INTO t1 (a,b,c) VALUES (1,2,3),(4,5,6)  ON DUPLICATE KEY UPDATE c=VALUES(a)+VALUES(b);
# INSERT INTO t1 (a, b) SELECT c, d FROM t2  UNION SELECT e, f FROM t3 ON DUPLICATE KEY UPDATE b = b + c;
```
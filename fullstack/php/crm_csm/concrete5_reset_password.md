
### Reset your Concrete 5 Password via MySQL

```
UPDATE Users SET uPassword = md5('newpassword:PASSWORD_SALT') WHERE uName = 'admin';
UPDATE Users SET uPassword = md5('XXXX:YYYY') WHERE uEmail = 'ZZZZ';


define('PASSWORD_SALT', 'YOUR-PASSWORD-SALT');
UPDATE Users SET uPassword = md5('XXXX:YYYY') WHERE uName = 'ZZZZ';
UPDATE Users SET uPassword = md5('XXXX:YYYY') WHERE uEmail = 'ZZZZ';
```
-----------------------------

### The Shannon Code Method
```
$ui = UserInfo::getByID(USER_SUPER_ID);
$ui->changePassword('password');

https://www.squirrelhosting.co.uk/hosting-blog/hosting-blog-info.php?id=68
```
######
### UPDATE Users SET uPassword = md5('newpassword:PASSWORD_SALT') WHERE uName = 'admin';
#### http://concrete5tricks.com/blog/reset-admin-password-via-mysql/
######

```
Method 2: Manually modifying the password (5.6.2.1 and below)

Update. This will most likely only work on version below 5.6.2.1 and below. In version 5.6.3 the encryption was updated to use a more advanced encyption. If you are using 5.6.3 or over I would advise following method 3
When? Forgotten Password isn't functioning properly and version is below 5.6.3.

Open FTP and navigate to your site root. Open /config/site.php. Find the line that looks like ...
define('PASSWORD_SALT', 'gGSraUtFZ1mDtSirgKFmXKMu1gRWMARyUDSM4o8sBIlK9Djlb4kv2A5peUs1mPR6');

Copy down your password salt. In this situation, mine was gGSraUtFZ1mDtSirgKFmXKMu1gRWMARyUDSM4o8sBIlK9Djlb4kv2A5peUs1mPR6
Open http://www.adamek.biz/md5-generator.php and enter the password you want to reset to followed by a colon, followed by your password salt.

If i wanted to reset my password to "test", I would enter the following:
test:gGSraUtFZ1mDtSirgKFmXKMu1gRWMARyUDSM4o8sBIlK9Djlb4kv2A5peUs1mPR6

Remember that you need to replace it with your salt. After clicking "Calculate MD5", copy the text that appears in green.
Navigate to the Users table in the database, find the row of the User that you want to change the password for, modify the password column and enter your new md5 hash. Ensure theres no whitespace at the end.
```


#### https://www.concrete5.org/documentation/how-tos/developers/recovering-a-lost-password-without-forgotten-password/
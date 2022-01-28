
--------------------------------------------
### Add WordPress Admin User with phpMyAdmin
```

https://themeisle.com/blog/new-wordpress-admin-user/
https://wpengine.com/support/add-admin-user-phpmyadmin/
https://www.tipsandtricks-hq.com/create-a-wordpress-admin-user-for-a-wordpress-site-via-mysql-6649
https://www.wpbeginner.com/wp-tutorials/how-to-add-an-admin-user-to-the-wordpress-database-via-mysql/
https://www.md5online.org/md5-encrypt.html
https://wpshout.com/wp_schedule_event-examples/


wp_users table

user_login: Insert the username
user_pass: Add a MD5 password
user_email: Add the email address
user_registered: Select the date
user_status: Set this value to zero.


wp_usermeta table

user_id: Fill in the ID of the user you created in the previous step.
meta_key: Enter wp_capabilities
meta_value: Fill in the field with a:1:{s:13:"administrator";s:1:"1";}


user_id – Same ID from step 8
meta_key – wp_user_level
meta_value – 10


INSERT INTO `databasename`.`wp_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`)
VALUES ('4', 'demo', MD5('demo'), 'Your Name', 'test@yourdomain.com', 'http://www.test.com/', '2011-06-07 00:00:00', '', '0', 'Your Name');


INSERT INTO `databasename`.`wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`)
VALUES (NULL, '4', 'wp_capabilities', 'a:1:{s:13:"administrator";s:1:"1";}');


INSERT INTO `databasename`.`wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`)
VALUES (NULL, '4', 'wp_user_level', '10');


INSERT INTO `databasename`.`wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`)
VALUES (NULL, ‘your_user_id’, ‘wp_user_level’, ’10’);
```

```



https://www.smashingmagazine.com/2015/05/how-to-use-autoloading-and-a-plugin-container-in-wordpress-plugins/
https://wp-helpers.com/2021/03/30/create-a-simple-psr-4-compliant-autoloader-for-any-plugin/
https://code.tutsplus.com/tutorials/using-namespaces-and-autoloading-in-wordpress-plugins-4--cms-27342
```
-------------------------------------------------------
```
// include classes
spl_autoload_register('myplugin_autoloader');
function myplugin_autoloader($class_name)
{
    if (false !== strpos($class_name, 'mySync')) {
        $classes_dir = realpath(plugin_dir_path(__FILE__)) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;
        $allFiles = scandir($classes_dir);
        $classes_files = array_diff($allFiles, array('.', '..'));
        foreach ($classes_files as $class_file) {
            require_once $classes_dir . $class_file;
        }
    }
}
```
-------------------------------------------------------
```
https://www.php.net/manual/en/function.sprintf.php
https://www.php.net/manual/en/function.curl-getinfo.php

CURLINFO_HTTP_CODE 200="OK"
```
-------------------------------------------------------
```
Flushing cache from third-party applications

https://cachify.pluginkollektiv.org/documentation/#flushing-cache-from-third-party-applications
https://cachify.pluginkollektiv.org/documentation/#cachify_flush_cache
https://cachify.pluginkollektiv.org/documentation/#no-cache-expiration-option-while-using-hdd-cache
https://docs.wp-rocket.me/article/494-how-to-clear-cache-via-cron-job

if ( has_action('cachify_flush_cache') ) {
    do_action('cachify_flush_cache');
}


https://developer.wordpress.org/reference/functions/get_usermeta/
https://developer.wordpress.org/reference/functions/get_user_meta/

https://www.php.net/manual/en/function.rand.php
https://www.php.net/manual/en/function.random-int.php

```
-------------------------------------------------------
### How to Update WordPress Automatically Without Using FTP
```

https://stackoverflow.com/questions/18352682/correct-file-permissions-for-wordpress
https://stackoverflow.com/questions/640409/can-i-install-update-wordpress-plugins-without-providing-ftp-access
https://digwp.com/2010/11/ftp-in-wpconfig/
https://wp-entwickler.at/459/wenn-updaten-nicht-funktioniert-und-wordpress-ftp-verbindungsdaten-verlangt/


wp-config.php
define('FS_METHOD','direct');

sudo chown -R www-data:www-data wordpress/
sudo chown -R www-data:www-data  wp-content/
sudo chmod -R 777 wp-content/


sudo chown www-data:www-data  -R * # Let Apache be owner
sudo find . -type d -exec chmod 755 {} \;  # Change directory permissions rwxr-xr-x
sudo find . -type f -exec chmod 644 {} \;  # Change file permissions rw-r--r--
```

-------------------------------------------------------
### wordpress version docker
```
https://github.com/docker-library/wordpress/blob/master/versions.json
https://github.com/docker-library/wordpress/blob/master/latest/php7.4/apache/Dockerfile
https://raw.githubusercontent.com/docker-library/wordpress/master/latest/php8.0/fpm-alpine/Dockerfile


    "sha1": "3be7ed4dc6f46fe98271b974c88153640e95ad49",
    "upstream": "5.8.3",

```

-------------------------------------------------------
### docker compose examples
```
https://stackoverflow.com/questions/65812258/docker-composer-error-cannot-start-service-db-oci-runtime-create-failed-conta
https://forums.docker.com/t/cant-install-2nd-instance-of-wordpress-as-it-says-cannot-start-service-db-oci-runtime-create-failed-container-with-id/66034
https://forums.docker.com/t/dockerfile-cannot-start-service-and-2-same-service/98745
https://github.com/rwynn/monstache-showcase/issues/1

https://github.com/docker/compose/issues/4039


```

### docker db import
```
/docker-entrypoint-initdb.d
/docker-entrypoint-initdb.d/dump.sql
```













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


### ENV WORDPRESS_VERSION

```
ENV WORDPRESS_VERSION 6.0
ENV WORDPRESS_SHA1 7a5a6d0591771e730b05c49d0c3fc134624d0491

https://github.com/docker-library/wordpress/blob/master/versions.json
https://github.com/docker-library/wordpress/blob/master/latest/php7.4/fpm/Dockerfile
https://github.com/docker-library/wordpress
https://github.com/docker-library/wordpress/tree/master/latest/php7.4

https://github.com/TrafeX/docker-wordpress/blob/master/Dockerfile
https://github.com/etopian/alpine-php-wordpress
https://hub.docker.com/_/wordpress/
https://github.com/TrafeX/docker-wordpress
```


### update_usermeta

```
https://developer.wordpress.org/reference/functions/update_usermeta/
https://developer.wordpress.org/reference/functions/update_user_meta/
https://stackoverflow.com/questions/30610780/how-to-update-user-meta-for-multiple-meta-key-in-wordpress
https://wordpress.stackexchange.com/questions/206357/updating-user-meta
https://stackoverflow.com/questions/39873824/wordpress-which-is-fast-multiple-get-user-meta-or-custom-query-to-fetch-record
https://wordpress.stackexchange.com/questions/116703/cant-get-the-user-meta-correctly
```

### How to load a bootstrap modal just click on a wordpress plugin submenu?

```
https://www.sliderrevolution.com/resources/css-loaders/
https://developer.wordpress.org/resource/dashicons/#table-col-before
https://getbootstrap.com/docs/4.0/extend/icons/
https://icon-sets.iconify.design/dashicons/page-2.html
https://useiconic.com/open/
https://primer.style/octicons/
https://getbootstrap.com/docs/4.0/components/modal/
https://stackoverflow.com/questions/30313583/how-to-load-a-bootstrap-modal-just-click-on-a-wordpress-plugin-submenu
https://wordpress.stackexchange.com/questions/333704/jquery-modal-not-loading-video-on-popup-only-displaying-it-after-multiple-reope
```



### wordpress 6.0 docker
```
https://github.com/docker-library/wordpress
https://github.com/docker-library/wordpress
https://hub.docker.com/r/bitnami/wordpress/
https://hub.docker.com/_/wordpress
```
--------------------------------------------------------------------

### Correct file permissions for WordPress [closed]
```
https://stackoverflow.com/questions/18352682/correct-file-permissions-for-wordpress
https://www.malcare.com/blog/wordpress-file-permissions/
https://www.wpbeginner.com/beginners-guide/how-to-fix-file-and-folder-permissions-error-in-wordpress/
https://blogvault.net/wordpress-permissions/
https://secure.wphackedhelp.com/blog/wordpress-file-and-folder-permissions/
https://secure.wphackedhelp.com/blog/wordpress-file-and-folder-permissions/
https://wordpress.org/support/article/changing-file-permissions/#permission-scheme-for-wordpress
https://www.smashingmagazine.com/2014/05/proper-wordpress-filesystem-permissions-ownerships/
https://themeisle.com/blog/wordpress-file-permissions/
https://wordpress.org/support/article/changing-file-permissions/
https://www.malcare.com/blog/wordpress-file-permissions/

chown www-data:www-data  -R * # Let Apache be owner
find . -type d -exec chmod 755 {} \;  # Change directory permissions rwxr-xr-x
find . -type f -exec chmod 644 {} \;  # Change file permissions rw-r--r--

---

Equivalent to:
chmod -R ug+rw foldername

---

# Set all files and directories user and group to wp-user
chown wp-user:wp-user -R *

# Set uploads folder user and group to www-data
chown www-data:www-data -R wp-content/uploads/

# Set all directories permissions to 755
find . -type d -exec chmod 755 {} \;

# Set all files permissions to 644
find . -type f -exec chmod 644 {} \;

---

sudo find . -type f -exec chmod 664 {} +
sudo find . -type d -exec chmod 775 {} +
sudo chmod 660 wp-config.php
```


### Unable to create directory wp-content/uploads/

```

https://wp-me.com/fix-unable-to-create-directory-wp-content-uploads-is-its-parent-directory-writable-by-the-server/
https://stackoverflow.com/questions/30188630/unable-to-create-directory-in-wp-content-uploads-in-wordpress
https://www.tipsandtricks-hq.com/how-to-fix-the-unable-to-create-directory-error-in-wordpress-5264
https://askubuntu.com/questions/819579/unable-to-create-directory-wp-content-uploads-2016-09-is-its-parent-directory-w
https://www.digitalocean.com/community/tutorials/how-to-use-sftp-to-securely-transfer-files-with-a-remote-server


Settings > Media > wp-content/uploads

wp-config.php
 define( 'UPLOADS', 'wp-content/uploads' );
 
wp-config.php
require_once(ABSPATH . 'wp-settings.php');
```




### cURL error 6: Could not resolve host
```

https://bobcares.com/blog/wordpress-curl-error-6-could-not-resolve-host/
https://stackoverflow.com/questions/37667665/php-curl-installed-yet-composer-says-its-not
https://code.tutsplus.com/tutorials/how-to-use-curl-in-php--cms-36732
https://github.com/Homebrew/homebrew-core/issues/27938
https://github.com/Homebrew/homebrew-core/issues/27938

curl -V
php --ri curl
php -i | grep "SSL Version”
openssl version -a

# brew install curl --with-openssl
# brew install curl --with-openssl
# brew install php --with-homebrew-curl


vi /etc/resolv.conf

nameserver 8.8.8.8
nameserver 8.8.4.4

service apache2 restart

sudo apt-get install resolvconf

vi /etc/resolvconf/resolv.conf.d/base
nameserver 8.8.8.8
nameserver 8.8.4.4
```



### WordPress permissions
```

https://www.malcare.com/blog/wordpress-file-permissions/
https://stackoverflow.com/questions/18352682/correct-file-permissions-for-wordpress

Root directory (usually public_html): 755
wp-admin: 755
wp-includes: 755
wp-content: 755
wp-content/themes: 755
wp-content/plugins: 755
wp-content/uploads: 755
.htaccess: 644
index.php: 644
wp-config.php: 640

chown www-data:www-data  -R * # Let Apache be owner
find . -type d -exec chmod 755 {} \;  # Change directory permissions rwxr-xr-x
find . -type f -exec chmod 644 {} \;  # Change file permissions rw-r--r--
```

```

##########################################
WordPress repair
##########################################
https://redrice.biz/wordpress-reparieren/

https://ihre_webseite/wp-admin/maint/repair.php
define('WP_ALLOW_REPAIR', true);
```
```
#####################################################
Docker Official Image packaging for WordPress SHA
#####################################################

https://wordpress.org/download/releases/
https://github.com/docker-library/wordpress
https://github.com/docker-library/wordpress/blob/master/latest/php7.4/fpm-alpine/Dockerfile
https://docs.docker.com/samples/wordpress/
https://github.com/docker/awesome-compose/tree/master/wordpress-mysql
https://github.com/docker-library/wordpress
https://hub.docker.com/_/wordpress

ENV WORDPRESS_VERSION 6.1
ENV WORDPRESS_SHA1 d7ca8d05b33caf1ebf473387c8357f04a01cf0b5

define('WP_ALLOW_REPAIR', true);

/wp-admin/maint/repair.php?repair=1
/wp-admin/maint/repair.php?repair=2

define('FS_METHOD','direct');

sudo chmod -R 777 wordpress/
sudo chmod -R 777 wordpress/wp-content/
sudo chown -R www-data:www-data wordpress/
```



```
https://tkacz.pro/nginx-and-php-configure-php-ini-file/
https://www.php.net/manual/de/install.unix.nginx.php
https://www.trigital.de/php_upload_limit_nginx/
https://wiki.alpinelinux.org/wiki/Nginx_with_PHP
https://www.linode.com/docs/guides/serve-php-php-fpm-and-nginx/
```

```
systemctl status php7.0-fpm.service
systemctl restart php-fpm
systemctl restart httpd.service
systemctl restart php7.0-fpm
```

```
#----------------------------------------------
# Nginx_with_PHP
#----------------------------------------------
ini_set( 'memory_limit', '256M' );
ini_set('log_errors', 'On');
ini_set('error_reporting', 'E_ALL');
ini_set('display_errors', 'Off');
ini_set('expose_php', 'Off');
ini_set('cgi.fix_pathinfo', 1);
ini_set('error_log', '/home/user/error.log');
ini_set( 'zlib.output_compression', 'On' );
ini_set( 'zlib.output_compression_level', '3' );
```

```
#----------------------------------------------
# Apache2_with_PHP
#----------------------------------------------
set_time_limit(20); // or this way
proc_nice(19);

ini_set('memory_limit', '256M');
ini_set('html_errors', true);
ini_set('ignore_repeated_errors', true);
ini_set('ignore_repeated_source', true);
ini_set('error_reporting', true);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
ini_set('xdebug.default_enable', false);
ini_set('log_errors', true);

#ini_set('zlib.output_handler', true);
#ini_set('zlib.output_compression', 0);
#ini_set("zlib.output_compression_level",0);

#ini_set('output_handler', false);
#ini_set('output_buffering', true);
#ini_set('implicit_flush', true);
```

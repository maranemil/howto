#!/usr/bin/env php
<?php

#echo $1;

/*
1:  #!/usr/bin/php
2:  #!/usr/bin/env  php
3:  #!/usr/bin/php -n
4:  #!/usr/bin/php -ddisplay_errors=E_ALL
5:  #!/usr/bin/php -n -ddisplay_errors=E_ALL
*/

# php -r '$foo = 678; include("your_script.php");'
# php -r 'var_dump($argv);' -- -h

#!/bin/bash
#echo $1;

#!/bin/sh
#echo $1;

# http://php.net/manual/en/features.commandline.usage.php

ini_set('memory_limit', '2G');
proc_nice(19);
echo "Mem: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MiB \n";
echo "<br> \n";

ini_set('max_execution_time', 0);

ini_set('error_reporting', E_ERROR);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);

ini_set('html_errors', FALSE);
#ini_set('xdebug.default_enable', false);
ini_set('ignore_repeated_errors', true);
ini_set('ignore_repeated_source', true);

ini_set('mysql.cache_size', '4000'); // '2000'
ini_set('mysql.query_cache_size', '2000');
ini_set('mysql.query_cache_limit', '12000');

ini_set('mysql.query_cache_strip_comments', true);
ini_set('mysql.performance_schema', 'Off');
ini_set('mysql.innodb_stats_on_metadata', 'Off');
ini_set('mysqlnd.collect_statistics', 'Off');
ini_set('mysqlnd.collect_memory_statistics', 'Off');

ini_set('mysql.log_warnings', 0);
ini_set('mysql.slow_query_log', 0);
ini_set('mysql.long_query_time', 0);

echo "Done \n";

try {
    usleep(random_int(100000, 300000));
} catch (Exception $e) {
}


###################################################################
#
# PHP CLI Options
#
###################################################################

https://www.php.net/manual/de/features.commandline.usage.php
#!/usr/bin/php -n -ddisplay_errors=E_ALL

//-----------------------------
//  classic
//-----------------------------

#!/usr/bin/php

// var_dump($argv);


#1:  #!/usr/bin/php   							# standard way to start a script
#2:  #!/usr/bin/env  php							# uses "env" to find where PHP is installed
#3:  #!/usr/bin/php -n							# ignore the system's PHP.ini, and go with the defaults
#4:  #!/usr/bin/php -ddisplay_errors=E_ALL		# set exactly one configuration variable
#5:  #!/usr/bin/php -n -ddisplay_errors=E_ALL	# will not (as of 2013) work on Linux.

# declare(strict_types=1);

# ini_set('error_reporting', E_ERROR);
# ini_set('error_reporting', false);

ini_set('display_errors', false);
ini_set('display_startup_errors', false);

ini_set('memory_limit', '2500M'); // 2G
#proc_nice(19);

ini_set('html_errors', false);
ini_set('ignore_repeated_errors', true);
ini_set('ignore_repeated_source', true);


ini_set('zlib.output_handler', false);
ini_set('zlib.output_compression', 0);
ini_set("zlib.output_compression_level", 0);

ini_set('output_handler', false);
ini_set('output_buffering', false);
ini_set('implicit_flush', true);

ini_set('max_execution_time', 30);
ini_set('default_socket_timeout', 30);

#ini_set('mysql.connect_timeout', 30);
#ini_set('mysql.cache_size', 16000); // '2000'
#ini_set('mysql.cache_type', 0);
#ini_set('mysql.query_cache_strip_comments', true);

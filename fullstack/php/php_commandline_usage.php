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

usleep(rand(100000,300000));

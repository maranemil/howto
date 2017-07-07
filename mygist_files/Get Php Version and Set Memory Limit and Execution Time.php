<?php

/////////////////////////////////////////////////////
//
// Get Php Version and Set Memory Limit and Execution Time
//
/////////////////////////////////////////////////////

ini_set('max_execution_time', 300); 	//300 seconds = 5 minutes
ini_set('max_execution_time', 0); 	//0=NOLIMIT
set_time_limit(10); // or this way

ini_set('memory_limit', '256M');
ini_set('memory_limit', '3G'); // 3 Gigabytes

echo '<!-- ';
echo 'Die aktuelle PHP Version ist ' . phpversion();
echo ' -->';
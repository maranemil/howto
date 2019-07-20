<?php
/**
 * Created by PhpStorm.
 * User: lime
 * Date: 24.09.17
 * Time: 23:52
 */

echo "BATCH \n";
define('APP_DIR', 'app');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
define('WEBROOT_DIR', 'webroot');
define('WWW_ROOT', ROOT . DS . APP_DIR . DS . WEBROOT_DIR . DS);
/**
 * This only needs to be changed if the cake installed libs are located
 * outside of the distributed directory structure.
 */

if (!defined('CAKE_CORE_INCLUDE_PATH')) {
    //define ('CAKE_CORE_INCLUDE_PATH', FULL PATH TO DIRECTORY WHERE CAKE CORE IS INSTALLED DO NOT ADD A TRAILING DIRECTORY SEPARATOR';
    define('CAKE_CORE_INCLUDE_PATH', ROOT);
}
if (function_exists('ini_set')) {
    ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . CAKE_CORE_INCLUDE_PATH . PATH_SEPARATOR . ROOT . DS . APP_DIR . DS);
    define('APP_PATH', null);
    define('CORE_PATH', null);
} else {
    define('APP_PATH', ROOT . DS . APP_DIR . DS);
    define('CORE_PATH', CAKE_CORE_INCLUDE_PATH . DS);
}

require APP_PATH . 'config/database.php';

echo "CORE LOADED! \n";

$arrDB = (DATABASE_CONFIG::$default2); // add static public static $default2 = array() in app/config/database.php
$host = $arrDB['host'];
$username = $arrDB['login'];
$password = $arrDB['password'];
$db_name = $arrDB['database'];

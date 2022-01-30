<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 11.03.16
 * Time: 13:37
 */

##################################################
##
## PHP and SAP HANA
## // http://scn.sap.com/community/developer-center/hana/blog/2013/01/21/php-rocks-on-sap-hana-too
##
##################################################

$conn = odbc_connect("HANA_KT_SYS", "SYSTEM", "manager", SQL_CUR_USE_ODBC);
if (!($conn)) {
    echo "<p>Connection to DB via ODBC failed: ";
    echo odbc_errormsg($conn);
    echo "</p>\n";
} else {
    if (isset($_POST["CARRID"]) == false) {
        $sql = "SELECT CARRID, CARRNAME FROM SFLIGHT.SCARR WHERE MANDT = 300";
        $rs = odbc_exec($conn, $sql);
        while ($row = odbc_fetch_array($rs)) {
            $carrid = $row["CARRID"];
            $carrname = $row["CARRNAME"];
        }
    } else {
        $carrid_param = $_POST["CARRID"];
        $sql = "SELECT * FROM \"_SYS_BIC\".\"blag/AV_FLIGHTS\"  WHERE CARRID = '$carrid_param'";
        $rs = odbc_exec($conn, $sql);
        while ($row = odbc_fetch_array($rs)) {
            $mandt = $row["MANDT"];
            $carrid = $row["CARRID"];
        }
    }
}

############################################
##
## Basic connection to SAP HANA from PHP
## https://gist.github.com/vdespa/7786474
##
#############################################

/**
 * Basic connection to SAP HANA from PHP
 *
 * This is a sample connection to a SAP HANA system. It includes a proper error messaging so if the connection will fail
 * you should be able to get a proper error message.
 *
 * @license     The MIT License (MIT)
 * @author      Valentin Despa <info[at]vdespa[dot]de>
 * @version     1.0 / 04.12.2013
 */

/*
The MIT License (MIT)

Copyright (c) 2013 Valentin Despa

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
 */


/**
 * Prerequisites
 *
 * 1. ODBC extension needs to be enabled
 * 2. SAP HANA's HDBODBC driver needs to be installed on the host
 */

/**
 * 1. Enable the ODBC by changing the php.ini (enabling the odbc extensions)
 */

/*
In Windows (php.ini)
extension=php_pdo_odbc.dll
extension=php_odbc.dll

In Linux (php.ini)
extension=php_pdo_odbc.so
extension=php_odbc.so
*/

// Check if the ODBC extension is loaded
if (!extension_loaded('odbc')) {
    die('ODBC extension not enabled / loaded');
}

/**
 * 2. HANA ODBC Connection
 */

/*
 * You can download the SAP HANA Client, Developer edition from SAP
 * (which includes the needed driver http://scn.sap.com/docs/DOC-31722)
 *
 * HDBODBC32 -> 32 bit ODBC driver that comes with the SAP HANA Client.
 * HDBODBC -> 64 bit ODBC driver that comes with the SAP HANA Client.
 */
$driver = 'HDBODBC32';

// Host
// Note: I am hosting it on the Amazon AWS, so my host looks like this. Put whatever your system administrator gave you
$host = "ec2-XXX-XXX-XXX-XXX.compute-1.amazonaws.com:30015";

// Default name of your hana instance
$db_name = "HDB";

// Username
$username = 'YOURUSERNAME';

// Password
$password = "YOURPASSWORD";

// Try to connect
$conn = odbc_connect("Driver=$driver;ServerNode=$host;Database=$db_name;", $username, $password, SQL_CUR_USE_ODBC);

if (!$conn) {
    // Try to get a meaningful error if the connection fails
    echo "Connection failed.\n";
    echo "ODBC error code: " . odbc_error() . ". Message: " . odbc_errormsg();

    /*
     * Typical errors include
     *
     * Error code: S1000
     * General error;416 user is locked; try again later: lock time is 1440
     * Too many unsuccessful login attempts
     * Solution: wait and try again with other credentials
     *
     * Error code: 08S01
     * Communication link failure;-10709 Connection failed (RTE:[89006] Syste, SQL state 08S01 in SQLConnect
     * Solution: check your connection details, host, port.
     */
} else {
    // Do a basic select from DUMMY with is basically a synonym for SYS.DUMMY
    $sql = 'SELECT * FROM DUMMY';
    $result = odbc_exec($conn, $sql);
    if (!$result) {
        echo "Error while sending SQL statement to the database server.\n";
        echo "ODBC error code: " . odbc_error() . ". Message: " . odbc_errormsg();
    } else {
        while ($row = odbc_fetch_object($result)) {
            // Should output one row containing the string 'X'
            var_dump($row);
        }
    }
    odbc_close($conn);
}

/**
 * 3. More examples
 */

/**
 * 3.1. Calling a procedure, showing the result set
 *
 * (WIP)
 */
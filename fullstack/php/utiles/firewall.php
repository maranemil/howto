<?php /** @noinspection SpellCheckingInspection */
/** @noinspection DeprecatedIniOptionsInspection */
/************************************************************************/
/* PHP Firewall: Universal Firewall for WebSite                         */
/* ============================================                         */
/* Write by Cyril Levert                                                */
/* Copyright (c) 2009-2010                                              */
/* http://www.php-firewall.info                                         */
/* dev@php-maximus.org                                                  */
/* Others projects:                                                     */
/* CMS PHP Maximus ( with mysql database ) www.php-maximus.org          */
/* Blog PHP Minimus ( with mysqli database ) www.php-minimus.org        */
/* Mini CMS PHP Nanomus ( without database ) www.php-nanomus.org        */
/* Stop Spam Referer ( without database ) www.stop-spam-referer.info    */
/* Twitter clone ( PHP Kweeker CMS ) www.twitter.php-minimus.org        */
/* PHP Firewall ( without database ) www.php-firewall.info              */
/* Personnal blog www.cyril-levert.info                                 */
/* Release version 1.0.3                                                */
/* Release date : 12-04-2010                                            */
/*                                                                      */
/* This program is free software.                                       */
/************************************************************************/

// https://gist.github.com/jcherqui/65a85205bb401393bda9

/** IP Protected */
$IP_ALLOW = array('127.0.0.1');

/** configuration define */
const PHP_FIREWALL_ACTIVATION = true;
const PHP_FIREWALL_LANGUAGE = 'english';
const PHP_FIREWALL_ADMIN_MAIL = '';
const PHP_FIREWALL_PUSH_MAIL = false;
const PHP_FIREWALL_LOG_FILE = 'logs';
const PHP_FIREWALL_PROTECTION_UNSET_GLOBALS = true;
const PHP_FIREWALL_PROTECTION_RANGE_IP_DENY = true;
const PHP_FIREWALL_PROTECTION_RANGE_IP_SPAM = false;
const PHP_FIREWALL_PROTECTION_URL = true;
const PHP_FIREWALL_PROTECTION_REQUEST_SERVER = true;
const PHP_FIREWALL_PROTECTION_SANTY = true;
const PHP_FIREWALL_PROTECTION_BOTS = true;
const PHP_FIREWALL_PROTECTION_REQUEST_METHOD = true;
const PHP_FIREWALL_PROTECTION_DOS = true;
const PHP_FIREWALL_PROTECTION_UNION_SQL = true;
const PHP_FIREWALL_PROTECTION_CLICK_ATTACK = true;
const PHP_FIREWALL_PROTECTION_XSS_ATTACK = true;
const PHP_FIREWALL_PROTECTION_COOKIES = false;
const PHP_FIREWALL_PROTECTION_POST = false;
const PHP_FIREWALL_PROTECTION_GET = false;
const PHP_FIREWALL_PROTECTION_SERVER_OVH = true;
const PHP_FIREWALL_PROTECTION_SERVER_KIMSUFI = true;
const PHP_FIREWALL_PROTECTION_SERVER_DEDIBOX = true;
const PHP_FIREWALL_PROTECTION_SERVER_DIGICUBE = true;
const PHP_FIREWALL_PROTECTION_SERVER_OVH_BY_IP = true;
const PHP_FIREWALL_PROTECTION_SERVER_KIMSUFI_BY_IP = true;
const PHP_FIREWALL_PROTECTION_SERVER_DEDIBOX_BY_IP = true;
const PHP_FIREWALL_PROTECTION_SERVER_DIGICUBE_BY_IP = true;
/** end configuration */

/** IPS PROTECTED */
if ((count($IP_ALLOW) > 0) && in_array($_SERVER['REMOTE_ADDR'], $IP_ALLOW, true)) {
    return;
}
/** END IPS PROTECTED */


/** LANGUAGE */
if (PHP_FIREWALL_LANGUAGE === 'french') {
    define('_PHPF_PROTECTION_DEDIBOX', 'Protection contre les serveurs DEDIBOX active, cette IP range n\'est pas autorisée !');
    define('_PHPF_PROTECTION_DEDIBOX_IP', 'Protection contre les serveurs DEDIBOX active, cette IP range n\'est pas autorisée !');

    define('_PHPF_PROTECTION_DIGICUBE', 'Protection contre les serveurs DIGICUBE active, this IP range is not allowed !');
    define('_PHPF_PROTECTION_DIGICUBE_IP', 'Protection contre les serveurs DIGICUBE active, cette IP n\'est pas autorisée !');

    define('_PHPF_PROTECTION_KIMSUFI', 'Protection contre les serveurs KIMSUFI active, cette IP range n\'est pas autorisée !');
    define('_PHPF_PROTECTION_OVH', 'Protection contre les serveurs OVH active, cette IP range n\'est pas autorisée !');

    define('_PHPF_PROTECTION_BOTS', 'Attaque Bot détectée ! stop it ...');
    define('_PHPF_PROTECTION_CLICK', 'Click attaque détectée ! stop it .....');
    define('_PHPF_PROTECTION_DOS', 'Invalide user agent ! Stop it ...');
    define('_PHPF_PROTECTION_OTHER_SERVER', 'Poster depuis un autre serveur est interdit !');
    define('_PHPF_PROTECTION_REQUEST', 'Méthode de requête interdite ! Stop it ...');
    define('_PHPF_PROTECTION_SANTY', 'Attaque Santy detectée ! Stop it ...');
    define('_PHPF_PROTECTION_SPAM', 'Protection SPAM IPs active, cette IP range n\'est pas autorisée !');
    define('_PHPF_PROTECTION_SPAM_IP', 'Protection SPAM IPs active, cette IP range n\'est pas autorisée !');
    define('_PHPF_PROTECTION_UNION', 'Attaque Union détectée ! stop it ......');
    define('_PHPF_PROTECTION_URL', 'Protection url active, string non autorisée !');
    define('_PHPF_PROTECTION_XSS', 'Attaque XSS détectée ! stop it ...');
} else {
    define('_PHPF_PROTECTION_DEDIBOX', 'Protection DEDIBOX Server active, this IP range is not allowed !');
    define('_PHPF_PROTECTION_DEDIBOX_IP', 'Protection DEDIBOX Server active, this IP is not allowed !');

    define('_PHPF_PROTECTION_DIGICUBE', 'Protection DIGICUBE Server active, this IP range is not allowed !');
    define('_PHPF_PROTECTION_DIGICUBE_IP', 'Protection DIGICUBE Server active, this IP is not allowed !');

    define('_PHPF_PROTECTION_KIMSUFI', 'Protection KIMSUFI Server active, this IP range is not allowed !');
    define('_PHPF_PROTECTION_OVH', 'Protection OVH Server active, this IP range is not allowed !');

    define('_PHPF_PROTECTION_BOTS', 'Bot attack detected ! stop it ...');
    define('_PHPF_PROTECTION_CLICK', 'Click attack detected ! stop it .....');
    define('_PHPF_PROTECTION_DOS', 'Invalid user agent ! Stop it ...');
    define('_PHPF_PROTECTION_OTHER_SERVER', 'Posting from another server not allowed !');
    define('_PHPF_PROTECTION_REQUEST', 'Invalid request method check ! Stop it ...');
    define('_PHPF_PROTECTION_SANTY', 'Attack Santy detected ! Stop it ...');
    define('_PHPF_PROTECTION_SPAM', 'Protection SPAM IPs active, this IP range is not allowed !');
    define('_PHPF_PROTECTION_SPAM_IP', 'Protection died IPs active, this IP range is not allowed !');
    define('_PHPF_PROTECTION_UNION', 'Union attack detected ! stop it ......');
    define('_PHPF_PROTECTION_URL', 'Protection url active, string not allowed !');
    define('_PHPF_PROTECTION_XSS', 'XSS attack detected ! stop it ...');
}
/** END LANGUAGE*/


if (PHP_FIREWALL_ACTIVATION === true) {

    function PHP_FIREWALL_unset_globals()
    {
        # [EA] 'register_globals' was removed in PHP 5.4.0.
        if (ini_get('register_globals')) {
            $allow = array('_ENV' => 1, '_GET' => 1, '_POST' => 1, '_COOKIE' => 1, '_FILES' => 1, '_SERVER' => 1, '_REQUEST' => 1, 'GLOBALS' => 1);
            foreach ($GLOBALS as $key => $value) {
                if (!isset($allow[$key])) {
                    unset($GLOBALS[$key]);
                }
            }
        }
    }

    if (PHP_FIREWALL_PROTECTION_UNSET_GLOBALS === true) {
        PHP_FIREWALL_unset_globals();
    }

    /** fonctions de base */
    function PHP_FIREWALL_get_env($st_var): string
    {
        global $HTTP_SERVER_VARS;
        if (isset($_SERVER[$st_var])) {
            return strip_tags($_SERVER[$st_var]);
        } elseif (isset($_ENV[$st_var])) {
            return strip_tags($_ENV[$st_var]);
        } elseif (isset($HTTP_SERVER_VARS[$st_var])) {
            return strip_tags($HTTP_SERVER_VARS[$st_var]);
        } elseif (getenv($st_var)) {
            return strip_tags(getenv($st_var));
        } elseif (function_exists('apache_getenv') && apache_getenv($st_var, true)) {
            return strip_tags(apache_getenv($st_var, true));
        }
        return '';
    }

    function PHP_FIREWALL_get_referer(): string
    {
        if (PHP_FIREWALL_get_env('HTTP_REFERER')) {
            return PHP_FIREWALL_get_env('HTTP_REFERER');
        }
        return 'no referer';
    }

    function PHP_FIREWALL_get_ip(): string
    {
        if (PHP_FIREWALL_get_env('HTTP_X_FORWARDED_FOR')) {
            return PHP_FIREWALL_get_env('HTTP_X_FORWARDED_FOR');
        } elseif (PHP_FIREWALL_get_env('HTTP_CLIENT_IP')) {
            return PHP_FIREWALL_get_env('HTTP_CLIENT_IP');
        } else {
            return PHP_FIREWALL_get_env('REMOTE_ADDR');
        }
    }

    function PHP_FIREWALL_get_user_agent(): string
    {
        if (PHP_FIREWALL_get_env('HTTP_USER_AGENT')) {
            return PHP_FIREWALL_get_env('HTTP_USER_AGENT');
        }
        return 'none';
    }

    function PHP_FIREWALL_get_query_string()
    {
        if (PHP_FIREWALL_get_env('QUERY_STRING')) {
            return str_replace('%09', '%20', PHP_FIREWALL_get_env('QUERY_STRING'));
        }
        return '';
    }

    function PHP_FIREWALL_get_request_method(): string
    {
        if (PHP_FIREWALL_get_env('REQUEST_METHOD')) {
            return PHP_FIREWALL_get_env('REQUEST_METHOD');
        }
        return 'none';
    }

    function PHP_FIREWALL_gethostbyaddr()
    {
        if (PHP_FIREWALL_PROTECTION_SERVER_OVH === true || PHP_FIREWALL_PROTECTION_SERVER_KIMSUFI === true
            || PHP_FIREWALL_PROTECTION_SERVER_DEDIBOX === true
            || PHP_FIREWALL_PROTECTION_SERVER_DIGICUBE === true) {
            if (@ empty($_SESSION['PHP_FIREWALL_gethostbyaddr'])) {
                return $_SESSION['PHP_FIREWALL_gethostbyaddr'] = @gethostbyaddr(PHP_FIREWALL_get_ip());
            } else {
                return strip_tags($_SESSION['PHP_FIREWALL_gethostbyaddr']);
            }
        }
        return false;
    }

    /** bases define */
    define('PHP_FIREWALL_GET_QUERY_STRING', strtolower(PHP_FIREWALL_get_query_string()));
    define('PHP_FIREWALL_USER_AGENT', PHP_FIREWALL_get_user_agent());
    define('PHP_FIREWALL_GET_IP', PHP_FIREWALL_get_ip());
    define('PHP_FIREWALL_GET_HOST', PHP_FIREWALL_gethostbyaddr());
    define('PHP_FIREWALL_GET_REFERER', PHP_FIREWALL_get_referer());
    define('PHP_FIREWALL_GET_REQUEST_METHOD', PHP_FIREWALL_get_request_method());
    define('PHP_FIREWALL_REGEX_UNION', '#\w?\s?union\s\w*?\s?(select|all|distinct|insert|update|drop|delete)#is');
    function PHP_FIREWALL_push_email($subject, $msg)
    {
        $headers = "From: PHP Firewall: " . PHP_FIREWALL_ADMIN_MAIL . " <" . PHP_FIREWALL_ADMIN_MAIL . ">\r\n"
            . "Reply-To: " . PHP_FIREWALL_ADMIN_MAIL . "\r\n"
            . "Priority: urgent\r\n"
            . "Importance: High\r\n"
            . "Precedence: special-delivery\r\n"
            . "Organization: PHP Firewall\r\n"
            . "MIME-Version: 1.0\r\n"
            . "Content-Type: text/plain\r\n"
            . "Content-Transfer-Encoding: 8bit\r\n"
            . "X-Priority: 1\r\n"
            . "X-MSMail-Priority: High\r\n"
            . "X-Mailer: PHP/" . PHP_VERSION . "\r\n"
            . "X-PHPFirewall: 1.0 by PHPFirewall\r\n"
            . "Date:" . date("D, d M Y H:s:i") . " +0100\n";
        if (PHP_FIREWALL_ADMIN_MAIL !== '') {
            @mail(PHP_FIREWALL_ADMIN_MAIL, $subject, $msg, $headers);
        }
    }

    function PHP_FIREWALL_LOGS($type)
    {
        $f = fopen(__DIR__ . '/' . PHP_FIREWALL_LOG_FILE . '.txt', 'ab');
        $msg = date('j-m-Y H:i:s') . " | $type | IP: " . PHP_FIREWALL_GET_IP . " ] | DNS: " . gethostbyaddr(PHP_FIREWALL_GET_IP) . " | Agent: " . PHP_FIREWALL_USER_AGENT . " | URL: " . PHP_FIREWALL_REQUEST_URI . " | Referer: " . PHP_FIREWALL_GET_REFERER . "\n\n";
        fwrite($f, $msg);
        fclose($f);
        if (PHP_FIREWALL_PUSH_MAIL === true) {
            PHP_FIREWALL_push_email('Alert PHP Firewall ' . strip_tags($_SERVER['SERVER_NAME']), "PHP Firewall logs of " . strip_tags($_SERVER['SERVER_NAME']) . "\n" . str_replace('|', "\n", $msg));
        }
    }

    if ((PHP_FIREWALL_PROTECTION_SERVER_OVH === true) && stripos(PHP_FIREWALL_GET_HOST, 'ovh') !== false) {
        PHP_FIREWALL_LOGS('OVH Server list');
        die(_PHPF_PROTECTION_OVH);
    }

    if (PHP_FIREWALL_PROTECTION_SERVER_OVH_BY_IP === true) {
        $ip = explode('.', PHP_FIREWALL_GET_IP);
        if ($ip[0] . '.' . $ip[1] === '87.98'
            || $ip[0] . '.' . $ip[1] === '91.121'
            || $ip[0] . '.' . $ip[1] === '94.23'
            || $ip[0] . '.' . $ip[1] === '213.186'
            || $ip[0] . '.' . $ip[1] === '213.251') {
            PHP_FIREWALL_LOGS('OVH Server IP');
            die(_PHPF_PROTECTION_OVH);
        }
    }

    if ((PHP_FIREWALL_PROTECTION_SERVER_KIMSUFI === true) && stripos(PHP_FIREWALL_GET_HOST, 'kimsufi') !== false) {
        PHP_FIREWALL_LOGS('KIMSUFI Server list');
        die(_PHPF_PROTECTION_KIMSUFI);
    }

    if ((PHP_FIREWALL_PROTECTION_SERVER_DEDIBOX === true) && stripos(PHP_FIREWALL_GET_HOST, 'dedibox') !== false) {
        PHP_FIREWALL_LOGS('DEDIBOX Server list');
        die(_PHPF_PROTECTION_DEDIBOX);
    }

    if (PHP_FIREWALL_PROTECTION_SERVER_DEDIBOX_BY_IP === true) {
        $ip = explode('.', PHP_FIREWALL_GET_IP);
        if ($ip[0] . '.' . $ip[1] === '88.191') {
            PHP_FIREWALL_LOGS('DEDIBOX Server IP');
            die(_PHPF_PROTECTION_DEDIBOX_IP);
        }
    }

    if ((PHP_FIREWALL_PROTECTION_SERVER_DIGICUBE === true) && stripos(PHP_FIREWALL_GET_HOST, 'digicube') !== false) {
        PHP_FIREWALL_LOGS('DIGICUBE Server list');
        die(_PHPF_PROTECTION_DIGICUBE);
    }

    if (PHP_FIREWALL_PROTECTION_SERVER_DIGICUBE_BY_IP === true) {
        $ip = explode('.', PHP_FIREWALL_GET_IP);
        if ($ip[0] . '.' . $ip[1] === '95.130') {
            PHP_FIREWALL_LOGS('DIGICUBE Server IP');
            die(_PHPF_PROTECTION_DIGICUBE_IP);
        }
    }

    if (PHP_FIREWALL_PROTECTION_RANGE_IP_SPAM === true) {
        $ip_array = array('24', '186', '189', '190', '200', '201', '202', '209', '212', '213', '217', '222');
        $range_ip = explode('.', PHP_FIREWALL_GET_IP);
        if (in_array($range_ip[0], $ip_array, true)) {
            PHP_FIREWALL_LOGS('IPs Spam list');
            die(_PHPF_PROTECTION_SPAM);
        }
    }

    if (PHP_FIREWALL_PROTECTION_RANGE_IP_DENY === true) {
        $ip_array = array('0', '1', '2', '5', '10', '14', '23', '27', '31', '36', '37', '39', '42', '46', '49', '50', '100', '101', '102', '103', '104', '105', '106', '107', '114', '172', '176', '177', '179', '181', '185', '192', '223', '224');
        $range_ip = explode('.', PHP_FIREWALL_GET_IP);
        if (in_array($range_ip[0], $ip_array, true)) {
            PHP_FIREWALL_LOGS('IPs reserved list');
            die(_PHPF_PROTECTION_SPAM_IP);
        }
    }

    if (PHP_FIREWALL_PROTECTION_COOKIES === true) {
        $ct_rules = array('applet', 'base', 'bgsound', 'blink', 'embed', 'expression', 'frame', 'javascript', 'layer', 'link', 'meta', 'object', 'onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload', 'script', 'style', 'title', 'vbscript', 'xml');
        if (PHP_FIREWALL_PROTECTION_COOKIES === true) {
            foreach ($_COOKIE as $value) {
                $check = str_replace($ct_rules, '*', $value);
                if ($value !== $check) {
                    PHP_FIREWALL_LOGS('Cookie protect');
                    unset($value);
                }
            }
        }
        if (PHP_FIREWALL_PROTECTION_POST === true) {
            foreach ($_POST as $value) {
                $check = str_replace($ct_rules, '*', $value);
                if ($value != $check) {
                    PHP_FIREWALL_LOGS('POST protect');
                    unset($value);
                }
            }
        }
        if (PHP_FIREWALL_PROTECTION_GET === true) {
            foreach ($_GET as $value) {
                $check = str_replace($ct_rules, '*', $value);
                if ($value != $check) {
                    PHP_FIREWALL_LOGS('GET protect');
                    unset($value);
                }
            }
        }
    }

    /** protection de l'url */
    if (PHP_FIREWALL_PROTECTION_URL === true) {
        $ct_rules = array('absolute_path', 'ad_click', 'alert(', 'alert%20', ' and ', 'basepath', 'bash_history', '.bash_history', 'cgi-', 'chmod(', 'chmod%20', '%20chmod', 'chmod=', 'chown%20', 'chgrp%20', 'chown(', '/chown', 'chgrp(', 'chr(', 'chr=', 'chr%20', '%20chr', 'chunked', 'cookie=', 'cmd', 'cmd=', '%20cmd', 'cmd%20', '.conf', 'configdir', 'config.php', 'cp%20', '%20cp', 'cp(', 'diff%20', 'dat?', 'db_mysql.inc', 'document.location', 'document.cookie', 'drop%20', 'echr(', '%20echr', 'echr%20', 'echr=', '}else{', '.eml', 'esystem(', 'esystem%20', '.exe', 'exploit', 'file\://', 'fopen', 'fwrite', '~ftp', 'ftp:', 'ftp.exe', 'getenv', '%20getenv', 'getenv%20', 'getenv(', 'grep%20', '_global', 'global_', 'global[', 'http:', '_globals', 'globals_', 'globals[', 'grep(', 'g\+\+', 'halt%20', '.history', '?hl=', '.htpasswd', 'http_', 'http-equiv', 'http/1.', 'http_php', 'http_user_agent', 'http_host', '&icq', 'if{', 'if%20{', 'img src', 'img%20src', '.inc.php', '.inc', 'insert%20into', 'ISO-8859-1', 'ISO-', 'javascript\://', '.jsp', '.js', 'kill%20', 'kill(', 'killall', '%20like', 'like%20', 'locate%20', 'locate(', 'lsof%20', 'mdir%20', '%20mdir', 'mdir(', 'mcd%20', 'motd%20', 'mrd%20', 'rm%20', '%20mcd', '%20mrd', 'mcd(', 'mrd(', 'mcd=', 'mod_gzip_status', 'modules/', 'mrd=', 'mv%20', 'nc.exe', 'new_password', 'nigga(', '%20nigga', 'nigga%20', '~nobody', 'org.apache', '+outfile+', '%20outfile%20', '*/outfile/*', ' outfile ', 'outfile', 'password=', 'passwd%20', '%20passwd', 'passwd(', 'phpadmin', 'perl%20', '/perl', 'phpbb_root_path', '*/phpbb_root_path/*', 'p0hh', 'ping%20', '.pl', 'powerdown%20', 'rm(', '%20rm', 'rmdir%20', 'mv(', 'rmdir(', 'phpinfo()', '<?php', 'reboot%20', '/robot.txt', '~root', 'root_path', 'rush=', '%20and%20', '%20xorg%20', '%20rush', 'rush%20', 'secure_site, ok', 'select%20', 'select from', 'select%20from', '_server', 'server_', 'server[', 'server-info', 'server-status', 'servlet', 'sql=', '<script', '<script>', '</script', 'script>', '/script', 'switch{', 'switch%20{', '.system', 'system(', 'telnet%20', 'traceroute%20', '.txt', 'union%20', '%20union', 'union(', 'union=', 'vi(', 'vi%20', 'wget', 'wget%20', '%20wget', 'wget(', 'window.open', 'wwwacl', ' xor ', 'xp_enumdsn', 'xp_availablemedia', 'xp_filelist', 'xp_cmdshell', '$_request', '$_get', '$request', '$get', '&aim', '/etc/password', '/etc/shadow', '/etc/groups', '/etc/gshadow', '/bin/ps', 'uname\x20-a', '/usr/bin/id', '/bin/echo', '/bin/kill', '/bin/', '/chgrp', '/usr/bin', 'bin/python', 'bin/tclsh', 'bin/nasm', '/usr/x11r6/bin/xterm', '/bin/mail', '/etc/passwd', '/home/ftp', '/home/www', '/servlet/con', '?>', '.txt');
        $check = str_replace($ct_rules, '*', PHP_FIREWALL_GET_QUERY_STRING);
        if (PHP_FIREWALL_GET_QUERY_STRING != $check) {
            PHP_FIREWALL_LOGS('URL protect');
            die(_PHPF_PROTECTION_URL);
        }
    }

    /** Posting from other servers in not allowed */
    if ((PHP_FIREWALL_PROTECTION_REQUEST_SERVER === true) && PHP_FIREWALL_GET_REQUEST_METHOD === 'POST' && isset($_SERVER['HTTP_REFERER']) && !stripos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST'], 0)) {
        PHP_FIREWALL_LOGS('Posting another server');
        die(_PHPF_PROTECTION_OTHER_SERVER);
    }

    /** protection contre le vers santy */
    if (PHP_FIREWALL_PROTECTION_SANTY === true) {
        $ct_rules = array('rush', 'highlight=%', 'perl', 'chr(', 'pillar', 'visualcoder', 'sess_');
        $check = str_replace($ct_rules, '*', strtolower(PHP_FIREWALL_REQUEST_URI));
        if (strtolower(PHP_FIREWALL_REQUEST_URI) != $check) {
            PHP_FIREWALL_LOGS('Santy');
            die(_PHPF_PROTECTION_SANTY);
        }
    }

    /** protection bots */
    if (PHP_FIREWALL_PROTECTION_BOTS === true) {
        $ct_rules = array('@nonymouse', 'addresses.com', 'ideography.co.uk', 'adsarobot', 'ah-ha', 'aktuelles', 'alexibot', 'almaden', 'amzn_assoc', 'anarchie', 'art-online', 'aspseek', 'assort', 'asterias', 'attach', 'atomz', 'atspider', 'autoemailspider', 'backweb', 'backdoorbot', 'bandit', 'batchftp', 'bdfetch', 'big.brother', 'black.hole', 'blackwidow', 'blowfish', 'bmclient', 'boston project', 'botalot', 'bravobrian', 'buddy', 'bullseye', 'bumblebee ', 'builtbottough', 'bunnyslippers', 'capture', 'cegbfeieh', 'cherrypicker', 'cheesebot', 'chinaclaw', 'cicc', 'civa', 'clipping', 'collage', 'collector', 'copyrightcheck', 'cosmos', 'crescent', 'custo', 'cyberalert', 'deweb', 'diagem', 'digger', 'digimarc', 'diibot', 'directupdate', 'disco', 'dittospyder', 'download accelerator', 'download demon', 'download wonder', 'downloader', 'drip', 'dsurf', 'dts agent', 'dts.agent', 'easydl', 'ecatch', 'echo extense', 'efp@gmx.net', 'eirgrabber', 'elitesys', 'emailsiphon', 'emailwolf', 'envidiosos', 'erocrawler', 'esirover', 'express webpictures', 'extrac', 'eyenetie', 'fastlwspider', 'favorg', 'favorites sweeper', 'fezhead', 'filehound', 'filepack.superbr.org', 'flashget', 'flickbot', 'fluffy', 'frontpage', 'foobot', 'galaxyBot', 'generic', 'getbot ', 'getleft', 'getright', 'getsmart', 'geturl', 'getweb', 'gigabaz', 'girafabot', 'go-ahead-got-it', 'go!zilla', 'gornker', 'grabber', 'grabnet', 'grafula', 'green research', 'harvest', 'havindex', 'hhjhj@yahoo', 'hloader', 'hmview', 'homepagesearch', 'htmlparser', 'hulud', 'http agent', 'httpconnect', 'httpdown', 'http generic', 'httplib', 'httrack', 'humanlinks', 'ia_archiver', 'iaea', 'ibm_planetwide', 'image stripper', 'image sucker', 'imagefetch', 'incywincy', 'indy', 'infonavirobot', 'informant', 'interget', 'internet explore', 'infospiders', 'internet ninja', 'internetlinkagent', 'interneteseer.com', 'ipiumbot', 'iria', 'irvine', 'jbh', 'jeeves', 'jennybot', 'jetcar', 'joc web spider', 'jpeg hunt', 'justview', 'kapere', 'kdd explorer', 'kenjin.spider', 'keyword.density', 'kwebget', 'lachesis', 'larbin', 'laurion(dot)com', 'leechftp', 'lexibot', 'lftp', 'libweb', 'links aromatized', 'linkscan', 'link*sleuth', 'linkwalker', 'libwww', 'lightningdownload', 'likse', 'lwp', 'mac finder', 'mag-net', 'magnet', 'marcopolo', 'mass', 'mata.hari', 'mcspider', 'memoweb', 'microsoft url control', 'microsoft.url', 'midown', 'miixpc', 'minibot', 'mirror', 'missigua', 'mister.pix', 'mmmtocrawl', 'moget', 'mozilla/2', 'mozilla/3.mozilla/2.01', 'mozilla.*newt', 'multithreaddb', 'munky', 'msproxy', 'nationaldirectory', 'naverrobot', 'navroad', 'nearsite', 'netants', 'netcarta', 'netcraft', 'netfactual', 'netmechanic', 'netprospector', 'netresearchserver', 'netspider', 'net vampire', 'newt', 'netzip', 'nicerspro', 'npbot', 'octopus', 'offline.explorer', 'offline explorer', 'offline navigator', 'opaL', 'openfind', 'opentextsitecrawler', 'orangebot', 'packrat', 'papa foto', 'pagegrabber', 'pavuk', 'pbwf', 'pcbrowser', 'personapilot', 'pingalink', 'pockey', 'program shareware', 'propowerbot/2.14', 'prowebwalker', 'proxy', 'psbot', 'psurf', 'puf', 'pushsite', 'pump', 'qrva', 'quepasacreep', 'queryn.metasearch', 'realdownload', 'reaper', 'recorder', 'reget', 'replacer', 'repomonkey', 'rma', 'robozilla', 'rover', 'rpt-httpclient', 'rsync', 'rush=', 'searchexpress', 'searchhippo', 'searchterms.it', 'second street research', 'seeker', 'shai', 'sitecheck', 'sitemapper', 'sitesnagger', 'slysearch', 'smartdownload', 'snagger', 'spacebison', 'spankbot', 'spanner', 'spegla', 'spiderbot', 'spiderengine', 'sqworm', 'ssearcher100', 'star downloader', 'stripper', 'sucker', 'superbot', 'surfwalker', 'superhttp', 'surfbot', 'surveybot', 'suzuran', 'sweeper', 'szukacz/1.4', 'tarspider', 'takeout', 'teleport', 'telesoft', 'templeton', 'the.intraformant', 'thenomad', 'tighttwatbot', 'titan', 'tocrawl/urldispatcher', 'toolpak', 'traffixer', 'true_robot', 'turingos', 'turnitinbot', 'tv33_mercator', 'uiowacrawler', 'urldispatcherlll', 'url_spider_pro', 'urly.warning ', 'utilmind', 'vacuum', 'vagabondo', 'vayala', 'vci', 'visualcoders', 'visibilitygap', 'vobsub', 'voideye', 'vspider', 'w3mir', 'webauto', 'webbandit', 'web.by.mail', 'webcapture', 'webcatcher', 'webclipping', 'webcollage', 'webcopier', 'webcopy', 'webcraft@bea', 'web data extractor', 'webdav', 'webdevil', 'webdownloader', 'webdup', 'webenhancer', 'webfetch', 'webgo', 'webhook', 'web.image.collector', 'web image collector', 'webinator', 'webleacher', 'webmasters', 'webmasterworldforumbot', 'webminer', 'webmirror', 'webmole', 'webreaper', 'websauger', 'websaver', 'website.quester', 'website quester', 'websnake', 'websucker', 'web sucker', 'webster', 'webreaper', 'webstripper', 'webvac', 'webwalk', 'webweasel', 'webzip', 'wget', 'widow', 'wisebot', 'whizbang', 'whostalking', 'wonder', 'wumpus', 'wweb', 'www-collector-e', 'wwwoffle', 'wysigot', 'xaldon', 'xenu', 'xget', 'x-tractor', 'zeus');
        $check = str_replace($ct_rules, '*', strtolower(PHP_FIREWALL_USER_AGENT));
        if (strtolower(PHP_FIREWALL_USER_AGENT) != $check) {
            PHP_FIREWALL_LOGS('Bots attack');
            die(_PHPF_PROTECTION_BOTS);
        }
    }

    /** Invalid request method check */
    if ((PHP_FIREWALL_PROTECTION_REQUEST_METHOD === true) && strtolower(PHP_FIREWALL_GET_REQUEST_METHOD) !== 'get' && strtolower(PHP_FIREWALL_GET_REQUEST_METHOD) !== 'head'
        && strtolower(PHP_FIREWALL_GET_REQUEST_METHOD) !== 'post' && strtolower(PHP_FIREWALL_GET_REQUEST_METHOD) !== 'put') {
        PHP_FIREWALL_LOGS('Invalid request');
        die(_PHPF_PROTECTION_REQUEST);
    }

    /** protection dos attaque */
    if (PHP_FIREWALL_PROTECTION_DOS === true) {
        if (!defined('PHP_FIREWALL_USER_AGENT') || PHP_FIREWALL_USER_AGENT === '-') {
            PHP_FIREWALL_LOGS('Dos attack');
            die(_PHPF_PROTECTION_DOS);
        }
    }

    /** protection union sql attaque */
    if (PHP_FIREWALL_PROTECTION_UNION_SQL === true) {
        $stop = 0;
        $ct_rules = array('*/from/*', '*/insert/*', '+into+', '%20into%20', '*/into/*', ' into ', 'into', '*/limit/*', 'not123exists*', '*/radminsuper/*', '*/select/*', '+select+', '%20select%20', ' select ', '+union+', '%20union%20', '*/union/*', ' union ', '*/update/*', '*/where/*');
        $check = str_replace($ct_rules, '*', PHP_FIREWALL_GET_QUERY_STRING);
        if (PHP_FIREWALL_GET_QUERY_STRING !== $check) {
            $stop++;
        }
        if (preg_match(PHP_FIREWALL_REGEX_UNION, PHP_FIREWALL_GET_QUERY_STRING)) {
            $stop++;
        }
        if (preg_match('/([OdWo5NIbpuU4V2iJT0n]{5}) /', rawurldecode(PHP_FIREWALL_GET_QUERY_STRING))) {
            $stop++;
        }
        if (strpos(rawurldecode(PHP_FIREWALL_GET_QUERY_STRING), '*') !== false) {
            $stop++;
        }
        if (!empty($stop)) {
            PHP_FIREWALL_LOGS('Union attack');
            die(_PHPF_PROTECTION_UNION);
        }
    }

    /** protection click attack */
    if (PHP_FIREWALL_PROTECTION_CLICK_ATTACK === true) {
        $ct_rules = array('/*', 'c2nyaxb0', '/*');
        if (PHP_FIREWALL_GET_QUERY_STRING !== str_replace($ct_rules, '*', PHP_FIREWALL_GET_QUERY_STRING)) {
            PHP_FIREWALL_LOGS('Click attack');
            die(_PHPF_PROTECTION_CLICK);
        }
    }

    /** protection XSS attack */
    if (PHP_FIREWALL_PROTECTION_XSS_ATTACK === true) {
        $ct_rules = array('http\:\/\/', 'https\:\/\/', 'cmd=', '&cmd', 'exec', 'concat', './', '../', 'http:', 'h%20ttp:', 'ht%20tp:', 'htt%20p:', 'http%20:', 'https:', 'h%20ttps:', 'ht%20tps:', 'htt%20ps:', 'http%20s:', 'https%20:', 'ftp:', 'f%20tp:', 'ft%20p:', 'ftp%20:', 'ftps:', 'f%20tps:', 'ft%20ps:', 'ftp%20s:', 'ftps%20:', '.php?url=');
        $check = str_replace($ct_rules, '*', PHP_FIREWALL_GET_QUERY_STRING);
        if (PHP_FIREWALL_GET_QUERY_STRING !== $check) {
            PHP_FIREWALL_LOGS('XSS attack');
            die(_PHPF_PROTECTION_XSS);
        }
    }

}
<?php
/**
* Created by PhpStorm.
* User: emil
* Date: 20.05.15
* Time: 15:31
*/


// http://www.weblicating.com/c5/site-php/

# Set advanced permissions on
define('PERMISSIONS_MODEL', 'advanced');

# Use APC Caching (you need APC installed)
define('CACHE_LIBRARY', 'apc');

# Disable Zend Cache Cleaning (may improve performance)
define('CACHE_FRONTEND_OPTIONS',
serialize(array('automatic_cleaning_factor' => 0)));

# Set time to 24 hour format
define('DATE_FORM_HELPER_FORMAT_HOUR', '24');

# Date Formatting
define('DATE_APP_GENERIC_MDYT_FULL', 'F d, Y \a\t g:i A');
define('DATE_APP_GENERIC_MDYT', 'n/j/Y \a\t g:i A');
define('DATE_APP_GENERIC_MDY', 'n/j/Y');
define('DATE_APP_GENERIC_MDY_FULL', 'F d, Y');

#Change minimum user name length from default value 3
define('USER_USERNAME_MINIMUM', 3);

#Change maximum username length from default value 64
define('USER_USERNAME_MAXIMUM', 64);

#Change minimum password length from default value 3
define('USER_PASSWORD_MINIMUM', 5);

#Change maximum password length from default value 64
define('USER_PASSWORD_MAXIMUM', 64);

#Change session time from default of 2 hours
define('SESSION_MAX_LIFETIME', 7200); // 2 hours

#Set registration email notification address
define('EMAIL_ADDRESS_REGISTER_NOTIFICATION', 'example@domain.com');

#Set registration email notification from address
define('EMAIL_ADDRESS_REGISTER_NOTIFICATION_FROM', 'example@domain.com');

#######################################
###### White Label Configuration
#######################################

#Disable concrete5 marketplace integration.
define('ENABLE_MARKETPLACE_SUPPORT', false);

#Disable help searches in the intelligent search.
define('ENABLE_INTELLIGENT_SEARCH_HELP', false);

#Disable marketplace add-ons appear in intelligent
#search results.
define('ENABLE_INTELLIGENT_SEARCH_MARKETPLACE', false);

#Disable newsflow
define('ENABLE_NEWSFLOW_OVERLAY', false);

#Path to the logo image. This can also be a full URL.
#This file should be 49x49 pixels.
define('WHITE_LABEL_LOGO_SRC', 'PATH TO FILE');

#Alt text for the logo
define('WHITE_LABEL_APP_NAME', 'TEXT');

#Disable Layouts.
define('ENABLE_AREA_LAYOUTS', false);

#Disable Custom Design for blocks or areas.
define('ENABLE_CUSTOM_DESIGN', false);

# Dsable Newsflow connect to concrete5.org to retrieve latest updates.
define('ENABLE_APP_NEWS', false);

# Set to a valid image (either local or a remote URL), or none.
define('WHITE_LABEL_DASHBOARD_BACKGROUND_SRC', 'none');

# Web address for today's Image
define('WHITE_LABEL_DASHBOARD_BACKGROUND_FEED', false);

####################################
## https://github.com/jordanlev/concrete5-cli/blob/master/append_to_config_site_php.txt
####################################

define('URL_REWRITING_ALL', true);
define('PAGE_TITLE_FORMAT', '%2$s :: %1$s'); // "%1$s" is site name, "%2$s" is page title
define('STATISTICS_TRACK_PAGE_VIEWS', false);

define('ENABLE_MARKETPLACE_SUPPORT', false);
define('ENABLE_INTELLIGENT_SEARCH_HELP', false);
define('ENABLE_NEWSFLOW_OVERLAY', false);
define('ENABLE_APP_NEWS', false);
define('WHITE_LABEL_DASHBOARD_BACKGROUND_SRC', 'none');
define('DASHBOARD_BACKGROUND_INFO', false);

define('WHITE_LABEL_LOGO_SRC', substr($_SERVER['SCRIPT_NAME'], 0, stripos($_SERVER['SCRIPT_NAME'], 'index.php')) . 'images/toolbar-logo.png'); //49px x 49px

define('APP_TIMEZONE', 'America/Chicago');
define('SESSION', 'CONCRETE5');
define('SESSION_MAX_LIFETIME', 7200); // browser session (seconds of inactivity before user is logged out, or 0 for never)

define('EMAIL_DEFAULT_FROM_ADDRESS', 'example@example.com');
define('EMAIL_DEFAULT_FROM_NAME', 'John Smith');
define('EMAIL_ADDRESS_REGISTER_NOTIFICATION', 'example1@example.com, example2@example.com');
define('EMAIL_ADDRESS_REGISTER_NOTIFICATION_FROM', EMAIL_DEFAULT_FROM_ADDRESS);
define('FORM_BLOCK_SENDER_EMAIL', EMAIL_DEFAULT_FROM_ADDRESS);

define('PERMISSIONS_MODEL', 'advanced');
define('ENABLE_AREA_LAYOUTS', false);
define('ENABLE_CUSTOM_DESIGN', false);

#VERSION-SPECIFIC SETTINGS...
 define('ENABLE_APPLICATION_EVENTS', true); //required in 5.5.1+ when using a config/site_events.php file (despite what the documentation says!)
define('CACHE_FRONTEND_OPTIONS', serialize(array('automatic_cleaning_factor' => 0)));

define('ENABLE_NEWSFLOW_OVERLAY', false);
define('ENABLE_APP_NEWS', false);

###############################################
// http://c5hub.com/resources/white-label-your-concrete5-installation/
###############################################

## Whitelabeling
define('ENABLE_NEWSFLOW_OVERLAY', FALSE);
define('ENABLE_MARKETPLACE_SUPPORT', FALSE);
define('ENABLE_INTELLIGENT_SEARCH_HELP', FALSE);
define('ENABLE_INTELLIGENT_SEARCH_MARKETPLACE', FALSE);
define('ENABLE_APP_NEWS', FALSE);
define('WHITE_LABEL_LOGO_SRC', 'path to logo file')
define('WHITE_LABEL_APP_NAME', 'My Application');
define('WHITE_LABEL_DASHBOARD_BACKGROUND_SRC','path to background image');


define('PERMISSIONS_MODEL', 'advanced');
define('ENABLE_NEWSFLOW_OVERLAY', false);
define('ENABLE_APP_NEWS', false);
define('WHITE_LABEL_DASHBOARD_BACKGROUND_FEED', false);

#####################################################
// http://redconservatory.com/blog/concrete-5-setup-a-checklist/
#####################################################

//enable or disable the news overlay that pops up when you first log in
define('ENABLE_NEWSFLOW_OVERLAY', true);
//the format to use for the title of the page. This example would be: Page Title :: Site Name
define('PAGE_TITLE_FORMAT', '%2$s :: %1$s');
//JPEG compression on thumbnails - default is 80
define('AL_THUMBNAIL_JPEG_COMPRESSION', 90);
//The following three settings are used to set the default from address and from display name to use in emails
define('EMAIL_DEFAULT_FROM_ADDRESS', 'noreply@website.com');
define('EMAIL_DEFAULT_FROM_NAME', 'MyWebsite.com');
define('FORM_BLOCK_SENDER_EMAIL', EMAIL_DEFAULT_FROM_ADDRESS);

/* SERVER SPECIFIC VARS
----------------------------------------------------*/
/*** LOCAL ***/
if (strpos($_SERVER['SERVER_NAME'], 'localhost') !== false) {
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'root');
/*** STAGE ***/
} else if (strpos($_SERVER['SERVER_NAME'], '.myagency.com') !== false) {
    define('DB_USERNAME', 'concrete5tricks');
    define('DB_PASSWORD', 'alsonotourrealpassword');
/*** PRODUCTION ***/
} else {
    define('DB_USERNAME', 'concrete5tricks');
    define('DB_PASSWORD', 'thisisnotourrealpasswordsmileyface');
}

/* SERVER INDEPENDENT VARS
----------------------------------------------------*/
define('DB_SERVER', 'localhost');
define('DB_DATABASE', 'concrete5tricks');
define('PASSWORD_SALT', 'OAj8Cg617yiK2utYKHOtoIhiemu9WL7nBTk9m78sLx7x38D1nqpQhyXrjUehello');

###################################
## http://concrete5tricks.com/blog/dev-stage-prod-same-config
###################################

define('BASE_URL', 'http://www.mysite.com');
define('DIR_REL', '');
define('REDIRECT_TO_BASE_URL', false);
define('BASE_URL', 'http://localhost');
define('BASE_URL', 'http://concrete5.dev');
define('DIR_REL', '/concrete5_v2'); to define('DIR_REL', '');

####################################

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'abcdefghijklmnop');
define('DB_PASSWORD', '12345678901234');
define('DB_DATABASE', a1b2c3d4e5f6);
define('PASSWORD_SALT', 'aabbccddeeffgghhiijjkkllmmoopp');
define('PERMISSIONS_MODEL', 'advanced');
define('USER_PASSWORD_MINIMUM', 8);
define('WHITE_LABEL_LOGO_SRC', '/files/bw/logo_menu.png');
define('WHITE_LABEL_DASHBOARD_BACKGROUND_SRC', '/files/bw/dash_bg.jpg');
define('WHITE_LABEL_APP_NAME', 'bwWebAdmin');
define('ENABLE_INTELLIGENT_SEARCH_HELP', false);
define('ENABLE_NEWSFLOW_OVERLAY', false);
define('ENABLE_APP_NEWS', false);
define('ENABLE_CUSTOM_DESIGN', false);
define('PAGE_TITLE_FORMAT', '%1$s - %2$s');
define('BASE_URL', 'http://www.example.com');
define('URL_REWRITING_ALL', true);
define('EMAIL_DEFAULT_FROM_NAME', 'EXAMPLE.COM');
define('EMAIL_DEFAULT_FROM_ADDRESS', 'website@example.com');
define('FORM_BLOCK_SENDER_EMAIL', 'website@example.com');
define('EMAIL_ADDRESS_REGISTER_NOTIFICATION_FROM', 'website@example.com');

if ( extension_loaded('apc') && ini_get('apc.enabled') == "1"){ define('CACHE_LIBRARY', 'apc'); }

################################################
############# wiki cheatsheet ##################
################################################
/*
http://de.wikibooks.org/wiki/Concrete5:_Entwicklung_mit_Concrete5:_Concrete's_Anwendungsablauf
http://de.wikibooks.org/wiki/Concrete5:_Entwicklung_mit_Concrete5:_Concrete's_Anwendungsablauf
http://www.brettworks.net/kb/concrete5-cheat-sheet/
https://mikeyhogarth.wordpress.com/2013/03/16/concrete5-custom-theme-cheat-sheet/
http://www.mesuva.com.au/blog/concrete5/concrete5-cheat-sheet/
http://www.webli.us/cheatsheet/doku.php

http://andrewembler.com/posts/creating-a-simple-concrete5-wrapper-custom-block-template/
http://www.concrete5tutorials.com/block-tutorials/concrete5-facebook-comments-block-tutorial/
http://www.concrete5tutorials.com/block-tutorials/interfacing-with-the-database/
http://codingexplained.com/coding/php/concrete5/creating-a-block-in-concrete5
*/
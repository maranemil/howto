```
http://scripthere.com/how-to-setup-cron-job-in-wordpress-without-plugin/
https://blazzdev.com/scheduled-tasks-cron-wordpress-plugin-boilerplate/
https://codeopolis.com/posts/creating-a-basic-wordpress-cron-job-in-3-steps/
https://developer.wordpress.org/cli/commands/cron/event/run/
https://developer.wordpress.org/plugins/cron/scheduling-wp-cron-events/
https://developer.wordpress.org/plugins/cron/understanding-wp-cron-scheduling/
https://developer.wordpress.org/reference/functions/wp_schedule_event/
https://developer.wordpress.org/reference/functions/wp_schedule_single_event/
https://isabelcastillo.com/run-a-wp_schedule_event-recurrence-every-3-minutes
https://kinsta.com/knowledgebase/disable-wp-cron/
https://make.wordpress.org/cli/handbook/guides/installing/
https://pretagteam.com/question/wordpress-cronjob-every-3-minutes
https://pretagteam.com/question/wordpress-wpcron-not-working-and-not-giving-error-in-log
https://spinupwp.com/doc/understanding-wp-cron/
https://stackoverflow.com/questions/39442982/wordpress-cronjob-every-3-minutes/39482569
https://stackoverflow.com/questions/67491876/wordpress-cron-job-custom-hook-not-working
https://themeisle.com/blog/disable-wp-cron/
https://wetopi.com/how-to-run-a-cron-job-with-wordpress/
https://wordpress.org/support/topic/wp-cron-is-not-running-my-function/
https://wordpress.stackexchange.com/questions/13660/create-cron-job-without-a-plugin
https://wordpress.stackexchange.com/questions/208135/how-to-run-a-function-every-5-minutes
https://wordpress.stackexchange.com/questions/49927/add-action-to-wp-cron
https://wpguru.co.uk/2014/01/how-to-create-a-cron-job-in-wordpress-teach-your-plugin-to-do-something-automatically/
https://wpshout.com/wp_schedule_event-examples/
https://www.cloudways.com/blog/wordpress-cron-job/
https://www.jnorton.co.uk/wordpress-tutorial-cron-jobs-scheduled-tasks
https://www.liquidweb.com/kb/install-wp-cli/
https://www.paidmembershipspro.com/troubleshooting-issues-with-wp-cron-and-other-scheduled-services/
https://www.php.net/manual/en/function.file-put-contents.php
https://www.siteground.com/tutorials/wordpress/real-cron-job/
https://www.webtimiser.de/custom-functions-dein-wp-plugin-snippets/
```
--------------------------------------------------------------------------------------

```
https://wordpress.stackexchange.com/questions/199725/triggering-cron-by-calling-wp-cron-php-on-the-command-line-rather-than-with-wget/332594
https://apple.stackexchange.com/questions/121817/how-to-fix-curl-60-ssl-certificate-invalid-certificate-chain-when-using-sudo


# don't verify ssl
curl -k --url http://example.com/wp-cron.php > /dev/null 2>&1
curl --insecure --url http://example.com/wp-cron.php --verbose


# wp-config.php
define('DISABLE_WP_CRON', true);

wp cron event run --due-now > /dev/null 2>&1
```


```
https://developer.wordpress.org/reference/functions/get_user_by/
https://developer.wordpress.org/reference/functions/remove_role/
https://developer.wordpress.org/reference/functions/wp_roles/
https://developer.wordpress.org/reference/classes/wp_user/remove_role/
https://developer.wordpress.org/reference/classes/wp_user/
```

--------------------------------------------------------------------------------------
```
wget -q -O - https://yoursite.com/wp-cron.php?doing_wp_cron >/dev/null 2>&1


@define('FORCE_SSL_ADMIN', false);

define('ALTERNATE_WP_CRON', true);
ALTERNATE_WP_CRON defined in wp-config.php
?doing_wp_cron

ALTERNATE_WP_CRON from TRUE to FALSE
Or add define('DISABLE_CRON', true);

set DISABLE_WP_CRON to true in wp-config.php as:
define( 'DISABLE_WP_CRON', true );



/** Disable virtual cron */
define('DISABLE_WP_CRON', true);
define('DISABLE_WP_CRON', true);
define(‘DISABLE_WP_CRON’, ‘true’);

wp cron event run --due-now >/dev/null 2>&1

wget -q -O - https://domain.com/wp-cron.php?doing_wp_cron >/dev/null 2>&1
php -q wp-cron.php


curl -vs -o -S https://mysite.com/wp-cron.php?doing_wp_cron > /home/site/logs/cron.log 2>&1


# Run all cron events due right now
wp cron event run --due-now
wp --info

#wp: command not found

curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
php wp-cli.phar --info


chmod +x wp-cli.phar
sudo mv wp-cli.phar /usr/local/bin/wp
wp --info


curl -vs -o -S https://mysite.com/wp-cron.php?setcronjob
```

---------------------------------------------------------------------------------
```

function isa_add_cron_recurrence_interval( $schedules ) {

    $schedules['every_three_minutes'] = array(
            'interval'  => 180,
            'display'   => __( 'Every 3 Minutes', 'textdomain' )
    );

    return $schedules;
}
add_filter( 'cron_schedules', 'isa_add_cron_recurrence_interval' );
```
---------------------------------------------------------------------------------
```

Plugin


// Security reasons...
if( !function_exists( 'add_action' ) ){
    die('...');
}

// The activation hook
function isa_activation(){
    if( !wp_next_scheduled( 'isa_add_every_three_minutes_event' ) ){
        wp_schedule_event( time(), 'every_three_minutes', 'isa_add_every_three_minutes_event' );
    }
}

register_activation_hook(   __FILE__, 'isa_activation' );

// The deactivation hook
function isa_deactivation(){
    if( wp_next_scheduled( 'isa_add_every_three_minutes_event' ) ){
        wp_clear_scheduled_hook( 'isa_add_every_three_minutes_event' );
    }
}

register_deactivation_hook( __FILE__, 'isa_deactivation' );


// The schedule filter hook
function isa_add_every_three_minutes( $schedules ) {
    $schedules['every_three_minutes'] = array(
            'interval'  => 180,
            'display'   => __( 'Every 3 Minutes', 'textdomain' )
    );
    return $schedules;
}

add_filter( 'cron_schedules', 'isa_add_every_three_minutes' );


// The WP Cron event callback function
function isa_every_three_minutes_event_func() {
    // do something
}

add_action( 'isa_add_every_three_minutes_event', 'isa_every_three_minutes_event_func' );

```
---------------------------------------------------------------------------------
```

function my_cron_schedules($schedules){
    if(!isset($schedules["5min"])){
        $schedules["5min"] = array(
            'interval' => 5*60,
            'display' => __('Once every 5 minutes'));
    }
    if(!isset($schedules["30min"])){
        $schedules["30min"] = array(
            'interval' => 30*60,
            'display' => __('Once every 30 minutes'));
    }
    return $schedules;
}
add_filter('cron_schedules','my_cron_schedules');
wp_schedule_event(time(), '5min', 'my_schedule_hook', $args);
$args = array(false);
function schedule_my_cron(){
    wp_schedule_event(time(), '5min', 'my_schedule_hook', $args);
}
if(!wp_next_scheduled('my_schedule_hook',$args)){
    add_action('init', 'schedule_my_cron');
}
```
---------------------------------------------------------------------------------
```
function run_every_five_minutes() {
    // Could probably do with some logic here to stop it running if just after running.
    // codes go here
}

if ( ! get_transient( 'every_5_minutes' ) ) {
    set_transient( 'every_5_minutes', true, 5 * MINUTE_IN_SECONDS );
    run_every_five_minutes();

    // It's better use a hook to call a function in the plugin/theme
    //add_action( 'init', 'run_every_five_minutes' );
}
```
---------------------------------------------------------------------------------
```
// Add a new interval of 180 seconds
// See http://codex.wordpress.org/Plugin_API/Filter_Reference/cron_schedules
add_filter( 'cron_schedules', 'isa_add_every_three_minutes' );
function isa_add_every_three_minutes( $schedules ) {
    $schedules['every_three_minutes'] = array(
            'interval'  => 180,
            'display'   => __( 'Every 3 Minutes', 'textdomain' )
    );
    return $schedules;
}

// Schedule an action if it's not already scheduled
if ( ! wp_next_scheduled( 'isa_add_every_three_minutes' ) ) {
    wp_schedule_event( time(), 'every_three_minutes', 'isa_add_every_three_minutes' );
}

// Hook into that action that'll fire every three minutes
add_action( 'isa_add_every_three_minutes', 'every_three_minutes_event_func' );
function every_three_minutes_event_func() {
    // do something
}
```
---------------------------------------------------------------------------------
```
Scheduled Event

// create a scheduled event (if it does not exist already)
function cronstarter_activation() {
	if( !wp_next_scheduled( 'mycronjob' ) ) {
	   wp_schedule_event( time(), 'daily', 'mycronjob' );
	}
}
// and make sure it's called whenever WordPress loads
add_action('wp', 'cronstarter_activation');


// unschedule event upon plugin deactivation
function cronstarter_deactivate() {
	// find out when the last event was scheduled
	$timestamp = wp_next_scheduled ('mycronjob');
	// unschedule previous event if any
	wp_unschedule_event ($timestamp, 'mycronjob');
}
register_deactivation_hook (__FILE__, 'cronstarter_deactivate');


// here's the function we'd like to call with our cron job
function my_repeat_function() {

	// do here what needs to be done automatically as per your schedule

}

// hook that function onto our scheduled event:
add_action ('mycronjob', 'my_repeat_function');
```

```
Custom Intervals

// add custom interval
function cron_add_minute( $schedules ) {
	// Adds once every minute to the existing schedules.
    $schedules['everyminute'] = array(
	    'interval' => 60,
	    'display' => __( 'Once Every Minute' )
    );
    return $schedules;
}
add_filter( 'cron_schedules', 'cron_add_minute' );

// create a scheduled event (if it does not exist already)
function cronstarter_activation() {
	if( !wp_next_scheduled( 'mycronjob' ) ) {
	   wp_schedule_event( time(), 'everyminute', 'mycronjob' );
	}
}
// and make sure it's called whenever WordPress loads
add_action('wp', 'cronstarter_activation');
```
---------------------------------------------------------------------------------
```
add_action( 'my_hookname', 'my_function' );
function my_function() {
	wp_mail( 'hello@example.com', 'WP Crontrol', 'WP Crontrol rocks!' );
}
```
---------------------------------------------------------------------------------
```
https://www.codegrepper.com/code-examples/php/frameworks/laravel/cron+job+in+wordpress+without+plugin


register_activation_hook(__FILE__, 'my_activation');

function my_activation() {
if (! wp_next_scheduled ( 'my_hourly_event' )) {
wp_schedule_event(time(), 'hourly', 'my_hourly_event');
}
}

add_action('my_hourly_event', 'do_this_hourly');

function do_this_hourly() {
// do something every hour
}
```

---------------------------------------------------------------------------------
```
https://newbedev.com/php-cron-job-in-wordpress-without-plugin-code-example

register_activation_hook(__FILE__, 'my_activation');

function my_activation() {
    if (! wp_next_scheduled ( 'my_hourly_event' )) {
    wp_schedule_event(time(), 'hourly', 'my_hourly_event');
    }
}

add_action('my_hourly_event', 'do_this_hourly');

function do_this_hourly() {
    // do something every hour
}

```
---------------------------------------------------------------------------------
```
add_action( 'init', function () {
	if ( ! wp_next_scheduled( 'do_single_action' ) ) {
		wp_schedule_single_event( time(), 'do_single_action' );
	}

	add_action( 'do_single_action', 'do_this_once' );

	function do_this_once() {
		error_log( 'DO THIS ONCE' );
	}
} );
```

---------------------------------------------------------------------------------
```
functions.php:


add_action( 'init', function () {
	if ( ! has_action( 'import_scheduled_job' ) ) {
		add_action( 'import_scheduled_job', 'Products\do_import', 10, 2 );
	}
} );


namespace Products;

class Product_Importer {

  // Other functions, including one which calls create_async_job
  // when the user starts an import

  private function create_async_job( $file ) {
    if ( ! wp_next_scheduled( 'import_scheduled_job' ) ) {
      wp_schedule_single_event(
        time(),
        'import_scheduled_job',
        array(
          'file' => $file,
          'attachment_id' => $this->id
	)
      );
    }
  }

  public static function import( $file, $attachment_id ) {
    // ...
  }
}

function do_import( $file, $attachment_id ) {
	Product_Importer::import( $file, $attachment_id );
}
```


---------------------------------------------------------------------------------
```
https://stackoverflow.com/questions/67491876/wordpress-cron-job-custom-hook-not-working


function schedule_my_cron(){
    wp_schedule_event(time(), 'hourly', 'my_hourly_event', array(), true);
}

if(!wp_next_scheduled('my_hourly_event',$args)){
    add_action('init', 'schedule_my_cron');
}

add_action('my_hourly_event', 'do_this_hourly', 10); // Works with action being 'wp_loaded'

function do_this_hourly() {
    error_log("test"); // Not working.
    $log = __DIR__ . '/error_log.txt';
    file_put_contents($log, "Response: \n", FILE_APPEND); // Works with making action 'wp_loaded'
}
```
---------------------------------------------------------------------------------
```
https://pretagteam.com/question/wordpress-cron-wpschedulesingleevent-action-not-always-working


register_activation_hook(__FILE__, 'my_activation');
add_action('my_hourly_event', 'do_this_hourly');

function my_activation() {
   wp_schedule_event(time(), 'hourly', 'my_hourly_event');
}

function do_this_hourly() {
   // do something every hour
}

register_deactivation_hook(__FILE__, 'my_deactivation');

function my_deactivation() {
   wp_clear_scheduled_hook('my_hourly_event');
}
```
---------------------------------------------------------------------------------
```
https://www.cloudways.com/blog/wordpress-cron-job/

add_action( 'cloudways_new_cron', 'cw_function' );
function cw_function() {
wp_mail( 'farhan.ayub@cloudways.com', 'Cloudways Cron', 'Cloudways - a Managed Cloud Hosting!' );
}
```
---------------------------------------------------------------------------------
```
https://pressable.com/knowledgebase/how-to-manage-cron-jobs-at-pressable/#steps-to-create-a-new-cron-job-in-wordpress

functions.php

add_action( ‘wp_test_email’,  'email_cron_function' );
function email_cron_function() {
    // This is the task that the cron job will perform when triggered
    wp_mail( 'youremail@example.com', 'Automatic email', Scheduled email from cron');
}
```


---------------------------------------------------------------------------------
```
https://wordpress.stackexchange.com/questions/29697/wp-cron-wont-trigger-my-action

add_action('update_properties_daily', array(&$this, 'do_updates'));

if(!wp_next_scheduled('update_properties_daily') )
{
   wp_schedule_event( time(), 'daily', 'update_properties_daily');
}
```
---------------------------------------------------------------------------------
```

function my_activation() {
    if ( !wp_next_scheduled( 'my_hourly_event' ) ) {
        wp_schedule_event( time(), 'hourly', 'my_hourly_event');
    }
}
function do_this_hourly() {
    // do something every hour
        $log = __DIR__ . '/error_log.txt';
   file_put_contents($log, "Response: \n", FILE_APPEND);
}
add_action('my_hourly_event', 'do_this_hourly');
add_action('init', 'my_activation');
```















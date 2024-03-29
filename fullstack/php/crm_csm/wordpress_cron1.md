

--------------------------------------------
### wordpress-cron
--------------------------------------------
```
http://hookr.io/functions/wp_next_scheduled/
https://docs.classicpress.net/reference/functions/wp_next_scheduled/
https://developer.wordpress.org/reference/functions/wp_next_scheduled/
https://hotexamples.com/examples/-/-/wp_next_scheduled/php-wp_next_scheduled-function-examples.html
https://wordpress.stackexchange.com/questions/323608/wp-get-schedule-and-wp-next-scheduled-dont-find-my-scheduled-wp-cron-job
https://docs.w3cub.com/wordpress/functions/wp_next_scheduled
https://stackoverflow.com/questions/42127262/is-checking-for-wp-next-scheduled-necessary-before-calling-wp-schedule-event
https://www.wpbeginner.com/plugins/how-to-view-and-control-wordpress-cron-jobs/
https://wordpress.stackexchange.com/questions/98032/is-there-a-quick-way-to-view-the-wp-cron-schedule
https://developer.wordpress.org/plugins/cron/simple-testing/
https://kinsta.com/knowledgebase/wordpress-cron-job/
https://developer.wordpress.org/plugins/cron/understanding-wp-cron-scheduling/
https://kinsta.com/knowledgebase/wordpress-cron-job/
```


```
if ( !function_exists( 'wp_next_scheduled' ) ) {
    require_once ABSPATH . WPINC . '/cron.php';
}

// Action hook to execute when event is run.
$hook = '';

// Optional. Arguments to pass to the hook's callback function.
$args = array();

// NOTICE! Understand what this does before running.
$result = wp_next_scheduled($hook, $args);
```
...
```
$args = array( false );
if ( ! wp_next_scheduled( 'myevent', $args ) ) {
    wp_schedule_event( time(), 'daily', 'myevent', $args );
}
```
...
```
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
...
```
add_action( 'wpb_custom_cron', 'wpb_custom_cron_func' );

function wpb_custom_cron_func() {
  wp_mail( 'you@example.com', 'Automatic email', 'Automatic scheduled email from WordPress to test cron');
}
```
---------------------------------------------------------------------------------
```
SELECT *
FROM `wp_options`
WHERE `option_name` LIKE '%cron%'

$cron_jobs = get_option( 'cron' );
var_dump($cron_jobs);

echo '<pre>';
print_r( _get_cron_array() );
echo '</pre>';

wp cron event list

function bl_print_tasks() {
    echo '<pre>'; print_r( _get_cron_array() ); echo '</pre>';
}
bl_print_tasks();
```
---------------------------------------------------------------------------------
```
https://wordpress.org/plugins/wp-cron-status-checker/
https://wordpress.org/plugins/wp-crontrol/

add_filter( 'cron_schedules', 'example_add_cron_interval' );

function example_add_cron_interval( $schedules ) {
 $schedules['five_seconds'] = array(
 'interval' => 5,
 'display' => esc_html__( 'Every Five Seconds' ),
 );

return $schedules;
 }
```
---------------------------------------------------------------------------------
```

define('DISABLE_WP_CRON', 'true');
```

---------------------------------------------------------------------------------
```
https://developer.wordpress.org/reference/functions/wp_schedule_event/
https://developer.wordpress.org/reference/functions/wp_next_scheduled/
https://developer.wordpress.org/reference/functions/wp_clear_scheduled_hook/
https://developer.wordpress.org/reference/functions/wp_unschedule_hook/
https://developer.wordpress.org/plugins/cron/scheduling-wp-cron-events/


https://developer.wordpress.org/reference/functions/wp_safe_redirect/
https://developer.wordpress.org/reference/functions/wp_redirect/
https://developer.wordpress.org/reference/functions/is_plugin_active/

#get_header();
#ob_clean();
#ob_start();
#flush();

get_bloginfo('url')
self::get_current_url()

public static function get_current_url() {
	return ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}
```


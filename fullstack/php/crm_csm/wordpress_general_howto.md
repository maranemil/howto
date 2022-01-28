
######
###   API Development Examples
######

```
curl --user 'docker:lGUIh1' http://172.20.0.2/wp-json/
curl --user 'docker:lGUIh1' http://172.20.0.2/wp-json/wp/v2/plugins | jq .
curl -X GET http://172.20.0.2/wp-json/wp/v2/users | jq .
curl -X GET http://172.20.0.2/wp-json/wp/v2/users/me   | jq .
curl -X GET --user 'docker:lGUIh1' http://172.20.0.2/wp-json/wp/v2/users/me | jq .
curl -X GET http://172.20.0.2/wp-json/wp/v2/users/?username=wordpress | jq .


curl -X GET http://172.20.0.2/wp-json/wp/v2/posts
curl -X GET http://172.20.0.2/wp-json/wp/v2/posts/?per_page=1
curl -X GET http://172.20.0.2/wp-json/wp/v2/users/1


add post > POST http://yoursite.com/wp-json/wp/v2/posts/
edit > PUT http://yoursite.com/wp-json/wp/v2/posts/567
delete > DELETE http://yoursite.com/wp-json/wp/v2/posts/567?force=true

https://usersinsights.com/wordpress-user-meta-query/
https://wordpress.stackexchange.com/questions/220307/user-appears-twice-in-a-wp-user-query
https://code.tutsplus.com/articles/using-wordpress-for-web-application-development-wp_user_query--wp-35015
https://developer.wordpress.org/reference/files/wp-includes/user.php/
https://developer.wordpress.org/reference/functions/get_users/
https://developer.wordpress.org/rest-api/reference/users/
https://developer.wordpress.org/reference/classes/wp_user_query/
https://developer.wordpress.org/rest-api/using-the-rest-api/authentication/
https://torquemag.io/2015/08/working-with-users-via-the-wordpress-rest-api/

plugins
https://developer.wordpress.org/plugins/plugin-basics/best-practices/########
https://developer.wordpress.org/plugins/intro/
https://wordpress.stackexchange.com/questions/48329/how-to-structure-a-plugin
https://medium.com/@gpp/wordpress-plugin-development-basics-ff144cc847ce
https://www.codeable.io/blog/wordpress-plugin-development/
https://www.codetab.org/tutorial/wordpress-plugin-development/plugin-structure/
https://webdesign.tutsplus.com/tutorials/create-a-custom-wordpress-plugin-from-scratch--net-2668
https://wplift.com/how-to-create-a-wordpress-plugin
https://wpshout.com/wordpress-plugin-development-tutorial/
https://unmatchedstyle.com/news/how-to-build-a-wordpress-plugin.php
https://code.tutsplus.com/articles/create-wordpress-plugins-with-oop-techniques--net-20153
https://www.dinkuminteractive.com/writing-your-first-plugin-for-wordpress-a-primer/
https://www.sitepoint.com/wordpress-easy-administration-plugin-1/
https://www.icecubedigital.com/blog/wordpress-plugin-development-step-by-step-guide/
https://www.codeable.io/blog/wordpress-plugin-development/#
https://wpbuffs.com/wordpress-plugin-development/
https://www.wpexplorer.com/writing-simple-wordpress-plugin/
https://crunchify.com/how-to-create-first-wordpress-plugin-step-by-step-guided-tour-with-sample-code/
https://wpengine.com/resources/best-tools-wordpress-plugin-development/
https://www.webfx.com/blog/web-design/wordpress-plugin-development-tips/
https://www.icecubedigital.com/blog/wordpress-plugin-development-step-by-step-guide/
https://pippinsplugins.com/structuring-your-first-wordpress-plugin/

https://wpbuffs.com/wordpress-plugin-development/
https://www.youtube.com/watch?v=GNaJygOfgnk
https://www.youtube.com/watch?v=hbJiwm5YL5Q
https://www.youtube.com/watch?v=NdDRNiIfYDw
https://knowthecode.io/labs/lets-build-wordpress-starter-plugin/episode-2
https://www.wpexplorer.com/writing-simple-wordpress-plugin/

https://wordpress.stackexchange.com/questions/374695/cant-use-wp-json-wp-v2-plugins-api-endpoint-even-as-administrator
https://developer.wordpress.org/rest-api/reference/users/
https://developer.wordpress.org/rest-api/
https://github.com/WP-API/Basic-Auth/blob/master/basic-auth.php
https://kinsta.com/blog/wordpress-rest-api/
https://developer.wordpress.org/rest-api/using-the-rest-api/authentication/
https://www.dreamhost.com/wordpress/tutorial-wp-rest-api/
```

######
###   Plugin Development Examples
######
```
https://knowthecode.io/labs/lets-build-wordpress-starter-plugin/episode-2
https://knowthecode.io/labs/lets-build-wordpress-starter-plugin/episode-3
https://knowthecode.io/labs/lets-build-wordpress-starter-plugin/episode-4
https://knowthecode.io/labs/lets-build-wordpress-starter-plugin/episode-5
https://knowthecode.io/labs/lets-build-wordpress-starter-plugin/episode-6
https://knowthecode.io/labs/lets-build-wordpress-starter-plugin/episode-7
https://knowthecode.io/labs/lets-build-wordpress-starter-plugin/episode-8

https://developer.wordpress.org/plugins/plugin-basics/header-requirements/
https://developer.wordpress.org/plugins/plugin-basics/uninstall-methods/
https://developer.wordpress.org/plugins/plugin-basics/activation-deactivation-hooks/
https://developer.wordpress.org/plugins/plugin-basics/best-practices/
https://codex.wordpress.org/Plugin_API/Hooks
https://codex.wordpress.org/Plugin_API/Action_Reference
https://codex.wordpress.org/WP_DEBUG

----------------------------------------
# debug
----------------------------------------
@ini_set('display_errors', true);
@ini_set('error_log', ABSPATH.'/wp-content/debug.log');
define('FS_METHOD', 'direct');
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

/** Enable WP_DEBUG mode */
define( 'WP_DEBUG', true );

if ( WP_DEBUG ) {
    @error_reporting( E_ALL );
    @ini_set( 'log_errors', true );
    @ini_set( 'log_errors_max_len', '0' );

    define( 'WP_DEBUG_LOG', true );
    define( 'WP_DEBUG_DISPLAY', false );
    @ini_set( 'display_errors', 0 );
    define( 'CONCATENATE_SCRIPTS', false );
    define( 'SAVEQUERIES', true );
    define( 'SCRIPT_DEBUG', false );
}

https://www.webfx.com/blog/web-design/wordpress-plugin-development-tips/
https://crunchify.com/how-to-create-first-wordpress-plugin-step-by-step-guided-tour-with-sample-code/
https://www.sitepoint.com/wordpress-easy-administration-plugin-1/
https://www.dinkuminteractive.com/writing-your-first-plugin-for-wordpress-a-primer/
```
------------------------------------------------------------
### header plugin examples
------------------------------------------------------------
```
https://codex.wordpress.org/File_Header
https://codex.wordpress.org/Custom_Headers
https://www.wpexplorer.com/writing-simple-wordpress-plugin/


/**
 * Plugin Name
 *
 * @package     PluginPackage
 * @author      Your Name
 * @copyright   2019 Your Name or Company Name
 * @license     GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name: Plugin Name
 * Plugin URI:  https://example.com/plugin-name
 * Description: Description of the plugin.
 * Version:     1.0.0
 * Author:      Your Name
 * Author URI:  https://example.com
 * Text Domain: plugin-slug
 * License:     GPL v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

/*
Plugin Name: Health Check
Plugin URI: https://wordpress.org/plugins/health-check/
Description: Checks the health of your WordPress install
Version: 0.1.0
Author: The Health Check Team
Author URI: http://health-check-team.example.com
Text Domain: health-check
Domain Path: /languages
*/


/*
Plugin Name: Name of your plugin
Plugin URI:  http://link to your plugin homepage
Description: Describe what your plugin is all about in a few short sentences
Version:     1.0
Author:      Your name (Yay! Here comes fame... )
Author URI:  http://link to your website
License:     GPL2 etc
License URI: http://link to your plugin license
*/

/**
* Plugin Name: Your Plugin Name
* Plugin URI: http://yourdomain.com
* Description: Insert a brief description of what your plugin does here.
* Version: 1.0.0
* Author: Your Name
* Author URI: http://yourdomain.com
* License: GPL2
*/
```


------------------------------------------------------------
### plugins structure examples
------------------------------------------------------------
```
wp-content/
	plugins/
		first-plugin/
			assets/
				vendor/
					composer/
			config/
			src/
				support/exceptions.php *
				sandbox.php
			index.php - empty
			plugin.php - namespace myplugin
			composer.json
wp-content/
	plugins/
		somewheres-plugin/
			somewheres-plugin.php
			admin/
				css/
				images/
				js/
			includes/
				class.php
			public/
				css/
				images/
				js/

wp-content/
	plugins/
		plumage/
			plumage.php
			uninstall.php
			languages/
			includes/
			admin/
				js/
				css/
				images/
			public/
				js/
				css/
				images/

```
------------------------------------------------------------
### wp plugin composer.json - will be installed in assets vendors
------------------------------------------------------------
```
https://knowthecode.io/labs/lets-build-wordpress-starter-plugin/episode-5

{
    "name" 			: "",
    "description" 	: "",
    "type"          : "project",
    "keywords" 		: ["wordpress", "wp", "plugin"],
    "homepage" 		: "https://knowthecode.io",
    "license" 		: "GPL-2.0+",
    "authors": [
        {
            "name" 	: "hellofromTonya",
            "email" : "hellofromtonya@knowthecode.io"
        }
    ],
    "require": {
        "php" : ">=5.4.0"
    },
    "require-dev": {
        "mockery/mockery" : "~4.9",
        "raveren/kint" : "~1.0",
        "flip/whoops" : "~2.0"
    },
    "autoload" : {
    	"classmap": [],
    	"files": [
    		"src/path-to-file/file.php"
    	]
    },
    "extra": {
        "branch-alias": {
            "dev-master": "1.0-dev"
        }
    },
    "config": {
        "vendor-dir": "assets/vendor"
    },
    "minimum-stability": "dev"
}

composer dumpautoload


flip.whoops
raveren.kint - "kint-php/kint"


[kint]
namespace Pluginname;
required_once(__DIR__.'/assets/vendor/autoload.php');
ddd('in here'); = vardump() + die()
d('') = vardump()


[whoops]
https://github.com/filp/whoops
https://github.com/filp/whoops/blob/master/docs/API%20Documentation.md


use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

required_once(__DIR__.'/assets/vendor/autoload.php');

$whoops = new Run();
$error_page = new PrettyPageHandler();
$error_page->setEditor('sublime');
$whoops->pushHandler($error_page);
$whoops->register();


add_action('init', __NAMESPACE__.'\launch');
function launch(){}

add_action('loop_start', __NAMESPACE__.'\demo');
function demo(){ var_dump(gett_the_ID())}
```

------------------------------------------------------------
### functions
------------------------------------------------------------
```
# Add function
function rename_wordpress_typo_fix( $text ) {
	return str_replace( 'wordpress', 'WordPress', $text );
}
add_filter( 'the_content', 'rename_wordpress_typo_fix' );


# Add submenu section
function crunchy_add_menu() {
	add_submenu_page("options-general.php", "Crunchy Plugin", "Crunchy Plugin", "manage_options", "crunchy-hello-world", "crunchy_hello_world_page");
}
add_action("admin_menu", "crunchy_add_menu");

# add something in db
function custom_function( $post_id ) {
    //do something
}
add_action( 'save_post','custom_function' );

# add filter
function modify_value( $filter ) {
    //change $filter and return new value
}
add_filter( 'original_filter','modify_value' );

# sanitize and escape data
echo esc_html( $my_custom_variable )


#add translate
# https://codex.wordpress.org/I18n_for_WordPress_Developers
<button id=”exampleButton”><?php _e( ‘Save’, ‘text_domain’ ); ?></button>

# chef if function exists
if ( ! function_exists(“hello_world_get_data”) ) {
  function hello_world_get_data() {
   // do something...
  }
}
```




### - wp plugin header in

```
package - plugins or namespace
namespace - Some/custom/Folder -> wp-content/plugins/some/src/custom/folder/file.php
------------------------------------------------------------
```

```
https://www.codeable.io/blog/wordpress-plugin-development/#
------------------------------------------------------------
hello world plugin
------------------------------------------------------------
/wp-content/plugins/my-plugin/my-plugin.php


function print_hello_world_title()  {
  echo "<h1>Hello World</h1>";
}
function hello_world_admin_menu()  {
  add_menu_page(
    'Hello World',// page title
    'Hello World Menu Title,// menu title
    'manage_options',// capability
    'hello-world',// menu slug
    'print_hello_world_title'  // callback function
  );
}
add_action( 'admin_menu', 'hello_world_admin_menu' );
```


------------------------------------------------------------
### Setting up the Plugin Class
#### https://code.tutsplus.com/articles/create-wordpress-plugins-with-oop-techniques--net-20153
```
# 1. Standard usage
add_shortcode('shortcode_name', 'shortcode_func');

function shortcode_func()
{
 // Contents of this function will execute when the blogger
// uses the [shortcode_name] shortcode.
}

# 2. With PHP 5.3, we can pass an anonymous function.
add_shortcode('shortcode_name', function() {
   // Contents of this function will execute when the blogger
  // uses the [shortcode_name] shortcode.
});

#3. Within a class
class WPDribble {
	public function __construct()
	{
		add_shortcode('Dribble', array($this, 'shortcode'));
	}

	public function shortcode()
	{
           // Contents of this function will execute when the blogger
          // uses the [shortcode_name] shortcode.
	}
}
```



------------------------------------------------------------
### My First Plugin
```
https://unmatchedstyle.com/news/how-to-build-a-wordpress-plugin.php
https://unmatchedstyle.com/wp-content/uploads/2009/03/myplugin.phps

<?
/*
Plugin Name: My First Plugin
Plugin URI: http://www.jasonjohnson.org/
Description: My first plugin.
Author: Jason Johnson
Version: 1.0
Author URI: http://www.jasonjohnson.org/
*/

$plugins = array();
$active = array();

function active_plugins() {
	global $plugins, $active;

	$plugins = get_plugins();

	foreach($plugins as $file => $data) {
		if(is_plugin_active($file)) {
			$active[$file] = get_plugin_data(WP_PLUGIN_DIR."/$file");
		}
	}

	wp_add_dashboard_widget('active_plugins', 'Active Plugins', 'active_plugins_dashboard_widget');
}

function active_plugins_dashboard_widget() {
	global $plugins, $active;

	print("<ul>");

	foreach($active as $plugin) {
		print("<li>{$plugin['Title']} by {$plugin['Author']}</li>");
	}

	print("</ul>");
}

add_action('wp_dashboard_setup', 'active_plugins');
?>
```
```
------------------------------------------------------------
https://wpshout.com/wordpress-plugin-development-tutorial/
https://wplift.com/how-to-create-a-wordpress-plugin
------------------------------------------------------------
```

### Just Do Something
```
add_action( 'init', 'washout_do_thing' );
function washout_do_thing() {}
```


### Query Recent Posts of All Post Types
```
add_action( 'init', 'washout_do_thing' );
function washout_do_thing() {
		if( ! isset( $_GET['west'] ) ) :
			return;
		endif;

		$args = array(
			'posts_per_page' => 5,
			'post_type' => 'any',
			'post_status' => 'publish',
			'orderby' => 'date',
			'order' => 'DESC',
		);

		$query = new WP_Query( $args );
		var_dump( $query );
		die;
}
```
------------------------------------------------------------
### Add Functions
```
https://webdesign.tutsplus.com/tutorials/create-a-custom-wordpress-plugin-from-scratch--net-2668

function tuples_register_post_type() {
    // movies
    $labels = array(
        'name' => __( 'Movies' , 'tuples' ),
        'singular_name' => __( 'Movie' , 'tuples' )
        ...
        );

        $args = array(
        'labels' => $labels,
        'has_archive' => true
        ...
         'rewrite'   => array( 'slug' => 'movies' ),
        'show_in_rest' => true
        );
}
add_action( 'init', 'tuples_register_post_type' );

# Stylesheets and Scripts
function tuples_movie_styles() {
    wp_enqueue_style( 'movies',  plugin_dir_url( __FILE__ ) . ‘/css/movies.css’ );
}
add_action( 'wp_enqueue_scripts', ‘tuples_movie_styles' );

include( plugin_dir_path( __FILE__ ) . ‘includes/movie-content.php' );
```
```
------------------------------------------------------------
Enable WP_DEBUG wp-config.php
https://www.codetab.org/tutorial/wordpress-plugin-development/plugin-structure/
------------------------------------------------------------
https://wordpress.stackexchange.com/questions/48329/how-to-structure-a-plugin


SG optimizer
Classic Editor
```


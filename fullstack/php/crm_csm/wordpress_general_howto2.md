
#############################################################
### WordPress  codex
#############################################################
```
http://hookr.io/4.1.1/hooks/#index=a
http://hookr.io/4.1.1/classes/#index=a
http://hookr.io/4.1.1/functions/#index=a
http://hookr.io/plugins/#index=a
https://adambrown.info/p/wp_hooks
https://adambrown.info/p/wp_hooks/hook
https://codex.wordpress.org/Plugin_API/Action_Reference
https://developer.wordpress.org/reference/hooks/
https://developer.wordpress.org/reference/functions/add_action/
https://developer.wordpress.org/reference/functions/hello_dolly_get_lyric/


https://gist.github.com/mikeschinkel/523831
https://wordpress.org/plugins/query-monitor/

https://wpmudev.com/blog/adding-admin-notices/
https://medium.com/the-metric/modern-wordpress-development-you-should-throw-an-exception-when-you-encounter-a-wp-error-81fb82275cbd
https://developer.wordpress.org/reference/functions/is_admin/
https://www.cssigniter.com/add-a-site-wide-dismissible-notice-bar-to-your-wordpress-website/
https://www.thecreativedev.com/how-to-create-shortcode-for-bootstrap-alert-box-in-wordpress/
https://digwp.com/2016/05/wordpress-admin-notices/
https://developer.wordpress.org/reference/hooks/admin_notices/


https://developer.wordpress.org/reference/functions/is_wp_error/
https://stackoverflow.com/questions/25275042/wp-wp-update-useruserdata-error
https://developer.wordpress.org/reference/functions/get_user_by/
https://developer.wordpress.org/reference/classes/wp_user/get_data_by/
https://developer.wordpress.org/reference/functions/wp_insert_user/
https://developer.wordpress.org/reference/functions/wp_delete_user/
https://developer.wordpress.org/reference/functions/add_role/
https://wordpress.stackexchange.com/questions/4725/how-to-change-a-users-role/4727
https://usersinsights.com/wordpress-custom-role/
https://managewp.com/blog/create-custom-user-roles-wordpress
https://developer.wordpress.org/reference/functions/add_role/

# id required for update
$userdata = array(
    'ID' => $current_user->ID,
    'user_email' => $em
);

# add roles
$u = new WP_User( 3 );
// Remove role
$u->remove_role( 'subscriber' );
// Add role
$u->add_role( 'editor' );

// Fetch the WP_User object of our user.
$u = new WP_User( 3 );
// Replace the current role with 'editor' role
$u->set_role( 'editor' );


$user = new WP_User(123); //123 is the user ID
$user->roles; // ["subscriber"]
$user->add_role('power_member');
$user->roles; // ["subscriber", "power_member"]
$user->set_role('editor');
$user->roles; // ["editor"]

```
```
https://languagetool.org/

https://packagist.org/packages/datatables/datatables
https://editor.datatables.net/manual/php/installing
https://editor.datatables.net/manual/php/installing#Composer
```
```
[openid]
https://quarkus.io/guides/security-openid-connect-client
https://openid.net/specs/openid-connect-basic-1_0.html

https://developer.okta.com/docs/reference/api/oidc/#endpoints
https://developers.google.com/identity/protocols/oauth2/openid-connect
https://developers.onelogin.com/openid-connect/api/client-credentials-grant
https://connect2id.com/learn/openid-connect
https://blog.softwaremill.com/who-am-i-keycloak-impersonation-api-bfe7acaf051a
https://datatracker.ietf.org/doc/html/draft-ietf-oauth-token-exchange-19
https://mrparkers.github.io/terraform-provider-keycloak/resources/keycloak_openid_client/

https://www.keycloak.org/docs/latest/server_admin/
https://www.keycloak.org/docs/11.0/server_admin/
https://www.keycloak.org/docs/latest/securing_apps/index.html#direct-naked-impersonation
https://wjw465150.gitbooks.io/keycloak-documentation/content/server_admin/topics/clients/oidc/confidential.html
https://www.keycloak.org/docs/latest/server_admin/index.html#_service_accounts
```
```
/.well-known/openid-configuration	Return OpenID Connect metadata related to the specified authorization server.


https://developers.redhat.com/blog/2020/11/24/authentication-and-authorization-using-the-keycloak-rest-api#keycloak_connection_using_a_java_application
https://developers.redhat.com/blog/2020/01/29/api-login-and-jwt-token-generation-using-keycloak#set_up_a_client
```

```
POST /auth/realms/demo/protocol/openid-connect/token
Authorization: Basic cHJvZHVjdC1zYS1jbGllbnQ6cGFzc3dvcmQ=
Content-Type: application/x-www-form-urlencoded
grant_type=client_credentials


curl -XPOST "http://localhost:8080/auth/realms/whatever-realm/protocol/openid-connect/token" \
-H "Authorization: Basic <base64 encoded client_id:client_secret>" \
-H "Content-Type: application/x-www-form-urlencoded" \
-d "grant_type=client_credentials"

curl -X POST \
    -d "client_id=starting-client" \
    -d "client_secret=the client secret" \
    --data-urlencode "grant_type=urn:ietf:params:oauth:grant-type:token-exchange" \
    -d "requested_subject=wburke" \
    http://localhost:8080/auth/realms/myrealm/protocol/openid-connect/token

curl -L -X POST 'http://localhost:8080/auth/realms/whatever-realm/protocol/openid-connect/token' \
-H 'Content-Type: application/x-www-form-urlencoded' \
--data-urlencode 'client_id=clientid-03' \
--data-urlencode 'grant_type=password' \
--data-urlencode 'client_secret=ec78c6bb-8339-4bed-9b1b-e973d27107dc' \
--data-urlencode 'scope=openid' \
--data-urlencode 'username=emuhamma' \
--data-urlencode 'password=1'

https://manual.phpdoc.org/HTMLSmartyConverter/HandS/phpDocumentor/tutorial_tags.since.pkg.html
```
```
#register_activation_hook(__FILE__, array('WP_Plugname', 'plugin_activation'));
#register_deactivation_hook(__FILE__, array('WP_Plugname', 'plugin_deactivation'));

#add_action('init', array('WP_Plugname','init'));
#add_action('init', array('WP_Plugname','init')); // init for class

https://stackoverflow.com/questions/27222755/purely-custom-html-form-popup-in-wordpress-site
https://www.w3schools.com/howto/howto_css_modals.asp
https://getbootstrap.com/docs/4.0/components/modal/
```

-----------------------------------------------------
### jquery WordPress
```
https://digwp.com/2011/09/using-instead-of-jquery-in-wordpress/
https://stackoverflow.com/questions/11159860/how-do-i-add-a-simple-jquery-script-to-wordpress
https://de.wordpress.org/support/topic/jquery-aktivieren-auf-wordpress-seiten/

wp_enqueue_script("jquery");

add_action( 'wp_enqueue_scripts', 'add_my_script' );
function add_my_script() {
    wp_enqueue_script(
        'your-script', // name your script so that you can attach other scripts and de-register, etc.
        get_template_directory_uri() . '/js/your-script.js', // this is the location of your script file
        array('jquery') // this array lists the scripts upon which your script depends
    );
}
```


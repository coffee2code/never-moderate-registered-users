=== Never Moderate Registered Users ===
Contributors: coffee2code
Donate link: http://coffee2code.com/donate
Tags: comment, moderation, subscribers, spam, registered, users, coffee2code
Requires at least: 2.8
Tested up to: 3.2
Stable tag: 2.0.2
Version: 2.0.2

Never moderate or mark as spam comments made by registered users, regardless of the apparent spamminess of the comment.


== Description ==

Never moderate or mark as spam comments made by registered users, regardless of the apparent spamminess of the comment.

To be recognized as a registered user, the user must be logged into your blog at the time they post their comment.

This plugin assumes that you trust your registered users.  It will automatically approve any comment made by registered users, even if the comment stinks of spam.  Therefore, it is recommended that you do not allow users to register themselves (uncheck the setting "Anyone can register" in the WordPress admin under Settings -> General).

For those wanting to allow people to register themselves, and still have those people (called "subscribers" by WordPress) to be moderated as necessary, but allow for users with other roles or capabilities from being moderated, you can still do so.  The plugin provides a filter, 'c2c_never_moderate_registered_users_caps', which allows you to specify the roles and capabilities that can bypass moderation.  See the FAQ for an example.

This plugin is a partial successor to my now-defunct Never Moderate Admins or Post Author plugin.  In addition to preventing admins and the post's author from being moderated, that plugin also allowed you to prevent registered users from being moderated.  WordPress has long since integrated that functionality, so the main thrust of that plugin became moot.  However, the ability to never moderate registered users is still a valid need that requires this plugin.

Links: [Plugin Homepage](http://coffee2code.com/wp-plugins/never-moderate-registered-users/) | [Author Homepage](http://coffee2code.com)


== Installation ==

1. Unzip `never-moderate-registered-users.zip` inside the `/wp-content/plugins/` directory (or install via the built-in WordPress plugin installer)
1. Activate the plugin through the 'Plugins' admin menu in WordPress


== Frequently Asked Questions ==

= Hey, why did I get some obvious spam from a registered user? =

This plugin assumes that any comment made by a registered user (or a user of the minimum defined user_level) is not spam, regardless of the spamminess of their comment.  If you don't trust your registered users you probably shouldn't have this plugin activated.  Or at least follow the directions above to increase the minimum threshold for trusted users.

= I don't trust registered users who are just "subscribers", but I trust "contributors"; can this plugin moderate accordingly? =

Yes.  You can specify the capabilities and roles that can bypass moderation.  Here's an example that can be placed in your active theme's functions.php file:

`add_filter( 'c2c_never_moderate_registered_users_caps', 'dont_moderate_contributors' );
function dont_moderate_contributors( $caps ) {
	$caps[] = 'contributor';
	return $caps;
}`


== Filters ==

The plugin is further customizable via one filter. Typically, these customizations would be put into your active theme's functions.php file, or used by another plugin.

= c2c_never_moderate_registered_users_caps (filter) =

The 'c2c_never_moderate_registered_users_caps' filter allows you to define the capabilities, any one of which a user must have in order to never get moderated.

Arguments:

* $caps (array): Array of capabilities, one of which a user must have in order to bypass moderation checks. Default is an empty array (meaning any registered user bypasses moderation checks.)

Example:

`add_filter( 'c2c_never_moderate_registered_users_caps', 'dont_moderate_contributors' );
function dont_moderate_contributors( $caps ) {
	$caps[] = 'contributor';
	return $caps;
}`


== Changelog ==

= 2.0.2 =
* Note compatibility through WP 3.2+
* Minor code formatting changes (spacing)
* Fix plugin homepage and author links in description in readme.txt

= 2.0.1 =
* Note compatibility with WP 3.1+
* Update copyright date (2011)
* Move code comments

= 2.0 =
* Add filter 'c2c_never_moderate_registered_users_caps' to allow specifying capabilities a user must have in order to bypass moderation. If none are specified, then the user just has to be registered.
* Remove $min_user_level argument and support
* Wrap function in if(!function_exists()) check
* Remove docs from top of plugin file (all that and more are in readme.txt)
* Minor code improvements and reformatting (spacing)
* Add PHPDoc
* Note compatibility with WP 3.0+
* Drop compatibility with versions of WP older than 2.8
* Update copyright date
* Add package info to top of plugin file
* Add Changelog, Filters, and Upgrade Notice sections to readme.txt
* Add to plugin repository

= 1.0 =
* Initial release


== Upgrade Notice ==

= 2.0.2 =
Trivial update: noted compatibility through WP 3.2+ and minor code formatting changes (spacing)

= 2.0.1 =
Trivial update: noted compatibility with WP 3.1+ and updated copyright date.

= 2.0 =
Recommended major update! Highlights: removed user_level permission support but added filter for capabilities/roles permission; verified WP 3.0 compatibility.
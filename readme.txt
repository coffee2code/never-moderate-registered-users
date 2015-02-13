=== Never Moderate Registered Users ===
Contributors: coffee2code
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6ARCFJ9TX3522
Tags: comment, moderation, subscribers, spam, registered, users, coffee2code
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Requires at least: 3.1
Tested up to: 4.1
Stable tag: 2.1.2

Never moderate or mark as spam comments made by registered users, regardless of the apparent spamminess of the comment.


== Description ==

This plugin prevents comments from registered users from ever going into the moderation queue or getting automatically marked as spam, regardless of the apparent spamminess of the comment.

To be recognized as a registered user, the user must be logged into your site at the time they post their comment.

This plugin assumes that you trust your registered users. It will automatically approve any comment made by registered users, even if the comment stinks of spam. Therefore, it is recommended that you do not allow users to register themselves (uncheck the setting "Anyone can register" in the WordPress admin under Settings -> General).

You can still allow open registration, whereby these "subscribers" are moderated as usual, while other more privileged users do not get moderated. The plugin provides a filter, 'c2c_never_moderate_registered_users_caps', which allows you to specify the roles and capabilities that can bypass moderation. See the FAQ for an example.

This plugin is a partial successor to my now-defunct Never Moderate Admins or Post Author plugin. In addition to preventing admins and the post's author from being moderated, that plugin also allowed you to prevent registered users from being moderated. WordPress has long since integrated that functionality, so the main thrust of that plugin became moot. However, the ability to never moderate registered users is still a valid need that requires this plugin.

Links: [Plugin Homepage](http://coffee2code.com/wp-plugins/never-moderate-registered-users/) | [Plugin Directory Page](https://wordpress.org/plugins/never-moderate-registered-users/) | [Author Homepage](http://coffee2code.com)


== Installation ==

1. Unzip `never-moderate-registered-users.zip` inside the `/wp-content/plugins/` directory (or install via the built-in WordPress plugin installer)
1. Activate the plugin through the 'Plugins' admin menu in WordPress


== Frequently Asked Questions ==

= Hey, why did I get some obvious spam from a registered user? =

This plugin assumes that any comment made by a registered user (or a user of the minimum defined user_level) is not spam, regardless of the spamminess of their comment. If you don't trust your registered users you probably shouldn't have this plugin activated. Or at least follow the directions above to increase the minimum threshold for trusted users.

= I don't trust registered users who are just "subscribers", but I trust "contributors"; can this plugin moderate accordingly? =

Yes. You can specify the capabilities and roles that can bypass moderation. Here's an example that can be placed in your active theme's functions.php file:

`add_filter( 'c2c_never_moderate_registered_users_caps', 'dont_moderate_contributors' );
function dont_moderate_contributors( $caps ) {
	$caps[] = 'contributor';
	return $caps;
}`

= Does this plugin include unit tests? =

Yes.


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

= 2.1.2 (2015-02-13) =
* Note compatibility through WP 4.1+
* Update copyright date (2015)

= 2.1.1 (2014-08-30) =
* Minor plugin header reformatting
* Minor code reformatting (bracing, spacing)
* Minor documentation reformatting (spacing, typo)
* Change documentation links to wp.org to be https
* Note compatibility through WP 4.0+
* Add plugin icon

= 2.1 (2013-01-05) =
* Fix so spam comments from registered users get approved
* Accept $commentdata arg from 'pre_comment_approved' filter instead of using global
* Check for use of both user_ID or user_id in commentdata array
* Add unit tests
* Note compatibility through WP 3.8+
* Drop compatibility with versions of WP older than 3.1
* Update copyright date (2014)
* Minor code and documentation reformatting (spacing, bracing)
* Change donate link
* Add banner image

= 2.0.5 =
* Add check to prevent execution of code if file is directly accessed
* Note compatibility through WP 3.5+
* Update copyright date (2013)

= 2.0.4 =
* Re-license as GPLv2 or later (from X11)
* Add 'License' and 'License URI' header tags to readme.txt and plugin file
* Remove ending PHP close tag
* Note compatibility through WP 3.4+

= 2.0.3 =
* Note compatibility through WP 3.3+
* Tweak extended description
* Add link to plugin directory page to readme.txt
* Update copyright date (2012)

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

= 2.1.2 =
Trivial update: noted compatibility through WP 4.1+ and updated copyright date (2015)

= 2.1.1 =
Trivial update: noted compatibility through WP 4.0+; added plugin icon.

= 2.1 =
Recommended update: bug fixes; minor code tweaks; added unit tests; noted compatibility through WP 3.8+; dropped compatibility with versions of WP older than 3.1

= 2.0.5 =
Trivial update: noted compatibility through WP 3.5+

= 2.0.4 =
Trivial update: noted compatibility through WP 3.4+; explicitly stated license

= 2.0.3 =
Trivial update: noted compatibility through WP 3.3+

= 2.0.2 =
Trivial update: noted compatibility through WP 3.2+ and minor code formatting changes (spacing)

= 2.0.1 =
Trivial update: noted compatibility with WP 3.1+ and updated copyright date.

= 2.0 =
Recommended major update! Highlights: removed user_level permission support but added filter for capabilities/roles permission; verified WP 3.0 compatibility.

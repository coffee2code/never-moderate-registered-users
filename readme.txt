=== Never Moderate Registered Users ===
Contributors: coffee2code
Donate link: http://coffee2code.com
Tags: comment, moderation, subscribers, spam
Requires at least: 2.3
Tested up to: 2.5
Stable tag: trunk
Version: 1.0

Never moderate or mark as spam comments made by registered users, regardless of the apparent spamminess of the comment.

== Description ==

Never moderate or mark as spam comments made by registered users, regardless of the apparent spamminess of the comment.

To be recognized as a registered user, the user must be logged into your blog at the time they post their comment.

This plugin assumes that you trust your registered users.  It will automatically approve any comment made by registered users, even if the comment stinks of spam.  Therefore, it is recommended that you do not allow users to register themselves (uncheck the setting "Anyone can register" in the WordPress admin under Options -> General, or in WP 2.5: Settings -> General).

For those wanting to allow people to register themselves, and still have those people (called "subscribers" by WordPress) to be moderated as necessary, but allow for other higher-level trusted users from being moderated,  you can still do so.  Edit the plugin source file and change the <code>$min_user_level</code> argument of <code>function c2c_never_moderate_registered_users( $approved, $min_user_level='0' )</code> to a higher value than "0".  "1" corresponds to a "contributor". See http://codex.wordpress.org/Roles_and_Capabilities#level_10 for more info on user levels and roles.

This plugin is a partial successor to my now-defunct Never Moderate Admins or Post Author.  In addition to preventing admins and the post's author from being moderated, that plugin also allowed you to prevent registered users from being moderated.  WordPress has since integrated that functionality, so the main thrust of that plugin became moot.  However, the ability to never moderate registered users is still a valid need that requires this new plugin.

== Installation ==

1. Unzip `never-moderate-registered-users.zip` inside the `/wp-content/plugins/` directory, or copy `never-moderate-registered-users.php` into `/wp-content/plugins/`
1. Activate the plugin through the 'Plugins' admin menu in WordPress

== Frequently Asked Questions ==


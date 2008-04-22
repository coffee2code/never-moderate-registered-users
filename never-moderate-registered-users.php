<?php
/*
Plugin Name: Never Moderate Registered Users
Version: 1.0
Plugin URI: http://coffee2code.com/wp-plugins/never-moderate-registered-users
Author: Scott Reilly
Author URI: http://coffee2code.com
Description: Never moderate or mark as spam comments made by registered users, regardless of the apparent spamminess of the comment.

To be recognized as a registered user, the user must be logged into your blog at the time they post their comment.

This plugin assumes that you trust your registered users.  It will automatically approve any comment made by
registered users, even if the comment stinks of spam.  Therefore, it is recommended that you do not allow users
to register themselves (uncheck the setting "Anyone can register" in the WordPress admin under Options -> General,
or in WP 2.5: Settings -> General).

For those wanting to allow people to register themselves, and still have those people (called "subscribers" by
WordPress) to be moderated as necessary, but allow for other higher-level trusted users from being moderated, you
can still do so.  Edit the plugin source file and change the $min_user_level argument of 
	function c2c_never_moderate_registered_users( $approved, $min_user_level='0' )
to a higher value than "0".  "1" corresponds to a "contributor".
See http://codex.wordpress.org/Roles_and_Capabilities#level_10 for more info on user levels and roles.

This plugin is a partial successor to my now-defunct Never Moderate Admins or Post Author.  In addition to
preventing admins and the post's author from being moderated, that plugin also allowed you to prevent registered 
users from being moderated.  WordPress has since integrated that functionality, so the main thrust of that plugin
became moot.  However, the ability to never moderate registered users is still a valid need that requires this new
plugin.

Compatible with WordPress 2.3+, and 2.5+.

=>> Read the accompanying readme.txt file for more information.  Also, visit the plugin's homepage
=>> for more information and the latest updates

Installation:

1. Download the file http://coffee2code.com/wp-plugins/never-moderate-registered-users.zip and unzip it into your 
/wp-content/plugins/ directory.
2. Activate the plugin through the 'Plugins' admin menu in WordPress

*/

/*
Copyright (c) 2008 by Scott Reilly (aka coffee2code)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation 
files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, 
modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the 
Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR
IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

*/

// All users with a user level greater than or equal to $min_user_level will NEVER be moderated
function c2c_never_moderate_registered_users( $approved, $min_user_level='0' ) {
	global $wpdb, $commentdata;
	$user_id = $commentdata['user_ID'];
	// If the comment isn't from a registered user, don't change approval status
	if ( !$user_id )
		return $approved;

 	$user = new WP_User($user_id);
	if ( $user && (1 !== $approved) && $user->has_cap('level_' . $min_user_level) )
		$approved = 1;

	return $approved;
}

add_filter('pre_comment_approved', 'c2c_never_moderate_registered_users', 15);

?>
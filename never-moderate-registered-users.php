<?php
/**
 * @package Never_Moderate_Registered_Users
 * @author Scott Reilly
 * @version 2.0.1
 */
/*
Plugin Name: Never Moderate Registered Users
Version: 2.0.1
Plugin URI: http://coffee2code.com/wp-plugins/never-moderate-registered-users/
Author: Scott Reilly
Author URI: http://coffee2code.com
Description: Never moderate or mark as spam comments made by registered users, regardless of the apparent spamminess of the comment.

Compatible with WordPress 2.5+, 2.6+, 2.7+, 2.8+, 2.9+, 3.0+, 3.1+.

=>> Read the accompanying readme.txt file for instructions and documentation.
=>> Also, visit the plugin's homepage for additional information and updates.
=>> Or visit: http://wordpress.org/extend/plugins/never-moderate-registered-users/

*/

/*
Copyright (c) 2008-2011 by Scott Reilly (aka coffee2code)

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

if ( !function_exists( 'c2c_never_moderate_registered_users' ) ) :
/**
 * Never moderate comments by registered users.
 *
 * @since 1.0
 *
 * @param int $approved Current approval status for comment
 * @return int If the comment is approved
 */
function c2c_never_moderate_registered_users( $approved ) {
	global $wpdb, $commentdata;
	$user_id = isset( $commentdata['user_ID'] ) ? $commentdata['user_ID'] : false;

	// If the comment isn't from a registered user, or is already approved, don't change approval status
	if ( !$user_id || $approved )
		return $approved;

	$user = new WP_User( $user_id );
	if ( $user ) {
		$trusted_caps = (array) apply_filters( 'c2c_never_moderate_registered_users_caps', array() );
		if ( empty( $trusted_caps ) ) {
			$has_cap = true;
		} else {
			$has_cap = false;
			foreach ( $trusted_caps as $cap ) {
				if ( $user->has_cap( $cap ) ) {
					$has_cap = true;
					break;
				}
			}
		}
		if ( $has_cap )
			$approved = 1;
	}

	return $approved;
}
endif;

add_filter( 'pre_comment_approved', 'c2c_never_moderate_registered_users', 15 );

?>
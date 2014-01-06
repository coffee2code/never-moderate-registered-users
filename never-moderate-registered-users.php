<?php
/**
 * @package Never_Moderate_Registered_Users
 * @author Scott Reilly
 * @version 2.1
 */
/*
Plugin Name: Never Moderate Registered Users
Version: 2.1
Plugin URI: http://coffee2code.com/wp-plugins/never-moderate-registered-users/
Author: Scott Reilly
Author URI: http://coffee2code.com/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Description: Never moderate or mark as spam comments made by registered users, regardless of the apparent spamminess of the comment.

Compatible with WordPress 3.1 through 3.8+.

=>> Read the accompanying readme.txt file for instructions and documentation.
=>> Also, visit the plugin's homepage for additional information and updates.
=>> Or visit: http://wordpress.org/plugins/never-moderate-registered-users/
*/

/*
	Copyright (c) 2008-2014 by Scott Reilly (aka coffee2code)

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

defined( 'ABSPATH' ) or die();

if ( ! function_exists( 'c2c_never_moderate_registered_users' ) ) :
/**
 * Never moderate comments by registered users.
 *
 * @since 1.0
 *
 * @param int|string $approved    Current approval status for comment: 0, 1, spam
 * @param array      $commentdata The comment data
 * @return int|string             New approval status for comment, either same as incoming or 1
 */
function c2c_never_moderate_registered_users( $approved, $commentdata ) {
	global $wpdb;

	if ( isset( $commentdata['user_ID'] ) ) {
		$user_id = $commentdata['user_ID'];
	} elseif ( isset( $commentdata['user_id'] ) ) {
		$user_id = $commentdata['user_id'];
	} else {
		$user_id = false;
	}

	// If the comment isn't from a registered user, or is already approved, don't change approval status
	if ( ! $user_id || 1 == $approved ) {
		return $approved;
	}

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

		if ( $has_cap ) {
			$approved = 1;
		}
	}

	return $approved;
}
endif;

add_filter( 'pre_comment_approved', 'c2c_never_moderate_registered_users', 15, 2 );

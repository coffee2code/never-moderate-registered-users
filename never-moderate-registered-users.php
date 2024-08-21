<?php
/**
 * Plugin Name: Never Moderate Registered Users
 * Version:     2.3.5
 * Plugin URI:  https://coffee2code.com/wp-plugins/never-moderate-registered-users/
 * Author:      Scott Reilly
 * Author URI:  https://coffee2code.com/
 * Text Domain: never-moderate-registered-users
 * License:     GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Description: Never moderate or mark as spam comments made by registered users, regardless of the apparent spamminess of the comment.
 *
 * Compatible with WordPress 3.1 through 6.6+.
 *
 * =>> Read the accompanying readme.txt file for instructions and documentation.
 * =>> Also, visit the plugin's homepage for additional information and updates.
 * =>> Or visit: https://wordpress.org/plugins/never-moderate-registered-users/
 *
 * @package Never_Moderate_Registered_Users
 * @author  Scott Reilly
 * @version 2.3.5
 */

/*
	Copyright (c) 2008-2024 by Scott Reilly (aka coffee2code)

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
 * @param int|string|WP_Error $approved    The approval status. Accepts 1, 0,
 *                                         'spam', 'trash', or WP_Error.
 * @param array               $commentdata Comment data
 *
 * @return int|string|WP_Error New approval status for comment, either same as incoming or 1
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

	// If the comment status is a WP_Error, isn't from a registered user, or
	// is already approved, then don't change approval status
	if ( is_wp_error( $approved ) || ! $user_id || 1 == $approved ) {
		return $approved;
	}

	$user = new WP_User( $user_id );

	if ( $user ) {
		/**
		 * Filters the user capabilities that are trusted enough to warrant never
		 * being moderated.
		 *
		 * If not capabilities are explicitly provided, then any registered user
		 * does not get moderated.
		 *
		 * @since 2.0.0
		 *
		 * @param array $user_caps The user caps. Empty array implies any registered
		 *                         user. Default empty array.
		 */
		$trusted_caps = (array) apply_filters( 'c2c_never_moderate_registered_users_caps', array() );

		if ( ! $trusted_caps ) {
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
			/**
			 * Filters the approval when the plugin switches a comment from being
			 * unapproved to being approved.
			 *
			 * Returning a WP_Error value from the filter will shortcircuit
			 * comment insertion and allow skipping further processing.
			 *
			 * @since 2.2
			 *
			 * @param int|string|WP_Error $approved Approval status. Accepts
			 *                                      1, 0, 'spam', 'trash', or
			 *                                      WP_Error. Default 1.
			 * @param array      $commentdata       Comment data.
			 * @param WP_User    $user              The commenting user.
			 */
			$approved = apply_filters( 'c2c_never_moderate_registered_users_approved', 1, $commentdata, $user );
		}
	}

	return $approved;
}
endif;

add_filter( 'pre_comment_approved', 'c2c_never_moderate_registered_users', 15, 2 );

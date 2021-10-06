=== Never Moderate Registered Users ===
Contributors: coffee2code
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6ARCFJ9TX3522
Tags: comment, moderation, subscribers, spam, registered, users, coffee2code
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Requires at least: 3.1
Tested up to: 5.8
Stable tag: 2.3.2

Never moderate or mark as spam comments made by registered users (or, alternatively, those with specified capabilities), regardless of the apparent spamminess of the comment.


== Description ==

This plugin prevents comments from registered users from ever going into the moderation queue or getting automatically marked as spam, regardless of the apparent spamminess of the comment.

To be recognized as a registered user, the user must be logged into your site at the time they post their comment.

This plugin assumes that you trust your registered users. It will automatically approve any comment made by registered users, even if the comment stinks of spam. Therefore, it is recommended that you do not allow users to register themselves (uncheck the setting "Anyone can register" in the WordPress admin under Settings -> General).

You can still allow open registration, whereby these "subscribers" are moderated as usual, while other more privileged users do not get moderated. The plugin provides a filter, 'c2c_never_moderate_registered_users_caps', which allows you to specify the roles and capabilities that can bypass moderation. See the FAQ for an example.

This plugin is a partial successor to my now-defunct Never Moderate Admins or Post Author plugin. In addition to preventing admins and the post's author from being moderated, that plugin also allowed you to prevent registered users from being moderated. WordPress has long since integrated that functionality, so the main thrust of that plugin became moot. However, the ability to never moderate registered users is still a valid need that requires this plugin.

Links: [Plugin Homepage](https://coffee2code.com/wp-plugins/never-moderate-registered-users/) | [Plugin Directory Page](https://wordpress.org/plugins/never-moderate-registered-users/) | [GitHub](https://github.com/coffee2code/never-moderate-registered-users/) | [Author Homepage](https://coffee2code.com)


== Installation ==

1. Install via the built-in WordPress plugin installer. Or download and unzip `never-moderate-registered-users.zip` inside the plugins directory for your site (typically `wp-content/plugins/`)
1. Activate the plugin through the 'Plugins' admin menu in WordPress
1. Optional: Use one or more of the provided hooks in custom code to control specific capabilities that should be exempted from moderation and spam or to control the feature on a comment-by-comment basis.


== Frequently Asked Questions ==

= Hey, why did I get some obvious spam from a registered user? =

This plugin assumes that any comment made by a registered user (or a user with a specified capabilities) is not spam, regardless of the spamminess of their comment. If you don't trust your registered users you probably shouldn't have this plugin activated. Or at least follow the directions above to increase the minimum threshold for trusted users.

= I don't trust registered users who are just "subscribers", but I trust "contributors"; can this plugin moderate accordingly? =

Yes. You can specify the capabilities and roles that can bypass moderation. See the example provided for the 'c2c_never_moderate_registered_users_caps' filter.

= Does this plugin include unit tests? =

Yes.


== Hooks ==

The plugin is further customizable via two filters. Typically, code making use of filters should ideally be put into a mu-plugin or site-specific plugin (which is beyond the scope of this readme to explain).

**c2c_never_moderate_registered_users_caps (filter)**

The 'c2c_never_moderate_registered_users_caps' filter allows you to define the capabilities that are automatically trusted, any one of which a user must have in order to never get moderated.

Arguments:

* $caps (array): Array of capabilities, one of which a user must have in order to bypass moderation checks. Default is an empty array (meaning any registered user bypasses moderation checks.)

Example:

`
/**
 * Require that a user have at least 'contributor' capabilities in order to be
 * trusted enough not to be moderated.
 *
 * @param array $caps Array of trusted capabilities. If blank, then any user registered on the site is trusted.
 * @return array
 */
function dont_moderate_contributors( $caps ) {
	$caps[] = 'contributor';
	return $caps;
}
add_filter( 'c2c_never_moderate_registered_users_caps', 'dont_moderate_contributors' );
`

**c2c_never_moderate_registered_users_approved (filter)**

The 'c2c_never_moderate_registered_users_approved' filter allows for granular control for whether a comment by a registered user that would otherwise be moderated or marked as spam should automatically be approved. Note: this filter only runs when a comment is from a registered user *and* is flagged for moderation or spam.

Arguments:

* $approved    (int|string) The approval status. Will be 1 unless changed by another plugin using this hook. May be passed 1, 0, or 'spam'. Hooking function can return any of those in addition to 'trash' or WP_Error.
* $commentdata (array)      Comment data.
* $user        (WP_User)    The commenting user.

Example:

`
/**
 * Always moderate comments by registered users if they mention "Google".
 *
 * @param int|string $approved  Approval status. Will be one of 1, 0, or 'spam'.
 * @param array      $commentdata        Comment data.
 * @param WP_User    $user               The commenting user.
 * @return int|string|WP_Error Can a registered user's comment bypass moderation? Either 1, 0, 'spam', 'trash', or WP_Error.
 */
function c2c_even_registered_users_cannot_say_google( $approved, $commentdata, $user ) {
	if ( $approved && false !== stripos( $commentdata['comment_content'], 'google' ) ) {
		$approved = 0;
	}
	return $approved;
}
add_filter( 'c2c_never_moderate_registered_users_approved', 'c2c_even_registered_users_cannot_say_google', 10, 3 );
`


== Changelog ==

= 2.3.2 (2021-04-09) =
* Change: Note compatibility through WP 5.7+
* Change: Update copyright date (2021)

= 2.3.1 (2020-08-27) =
* Change: Restructure unit test file structure
    * New: Create new subdirectory `phpunit/` to house all files related to unit testing
    * Change: Move `bin/` to `phpunit/bin/`
    * Change: Move `tests/bootstrap.php` to `phpunit/`
    * Change: Move `tests/` to `phpunit/tests/`
    * Change: Rename `phpunit.xml` to `phpunit.xml.dist` per best practices
* Change: Note compatibility through WP 5.5+
* Change: Tweak some documentation in readme.txt
* Unit tests: Check if WP is 5.5+ to use renamed option names

= 2.3 (2020-05-10) =
* Change: Disallow handling comments flagged with `WP_Error`
* Change: Update inline docs for `c2c_never_moderate_registered_users()` and filter `c2c_never_moderate_registered_users_approved` to reflect that a `WP_Error` and 'trash' are also valid potential values
* Change: Use HTTPS for link to WP SVN repository in bin script for configuring unit tests
* Change: Note compatibility through WP 5.4+
* Change: Update links to coffee2code.com to be HTTPS
* Change: Unit tests: Remove unnecessary unregistering of hooks

_Full changelog is available in [CHANGELOG.md](https://github.com/coffee2code/never-moderate-registered-users/blob/master/CHANGELOG.md)._


== Upgrade Notice ==

= 2.3.2 =
Trivial update: noted compatibility through WP 5.7+ and updated copyright date (2021)

= 2.3.1 =
Trivial update: Restructured unit test file structure and noted compatibility through WP 5.5+.

= 2.3 =
Minor update: Skipped handling of comments flagged as being an error, updated a few URLs to be HTTPS, updated some inline docs, and noted compatibility through WP 5.4+.

= 2.2.2 =
Trivial update: modernized unit tests, created CHANGELOG.md to store historical changelog outside of readme.txt, noted compatibility through WP 5.3+, and updated copyright date (2020)

= 2.2.1 =
Trivial update: noted compatibility through WP 5.1+ and updated copyright date (2019)

= 2.2 =
Minor feature update: added 'c2c_never_moderate_registered_users_approved' filter, added README.md, noted compatibility through WP 4.9+, and updated copyright date (2018)

= 2.1.4 =
Trivial update: updated unit test bootstrap file, noted compatibility through WP 4.7+, and updated copyright date (2017)

= 2.1.3 =
Trivial update: minor unit test tweaks; verified compatibility through WP 4.4+; and updated copyright date (2016)

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

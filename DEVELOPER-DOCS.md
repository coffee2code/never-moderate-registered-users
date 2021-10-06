# Developer Documentation

## Hooks

The plugin exposes a number of filters for hooking. Code using these filters should ideally be put into a mu-plugin or site-specific plugin (which is beyond the scope of this readme to explain).

### `c2c_never_moderate_registered_users_caps` _(filter)_

The `c2c_never_moderate_registered_users_caps` filter allows you to define the capabilities that are automatically trusted, any one of which a user must have in order to never get moderated.

#### Arguments:

* **$caps** _(array)_: Array of capabilities, one of which a user must have in order to bypass moderation checks. Default is an empty array (meaning any registered user bypasses moderation checks.)

#### Example:

```php
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
```

### `c2c_never_moderate_registered_users_approved` _(filter)_

The `c2c_never_moderate_registered_users_approved` filter allows for granular control for whether a comment by a registered user that would otherwise be moderated or marked as spam should automatically be approved. Note: this filter only runs when a comment is from a registered user *and* is flagged for moderation or spam.

#### Arguments:

* **$approved**    _(int|string)_ The approval status. Will be 1 unless changed by another plugin using this hook. May be passed 1, 0, or 'spam'. Hooking function can return any of those in addition to 'trash' or WP_Error.
* **$commentdata** _(array)_      Comment data.
* **$user**        _(WP_User)_    The commenting user.

#### Example:

```php
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
```

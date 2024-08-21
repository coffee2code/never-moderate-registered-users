=== Never Moderate Registered Users ===
Contributors: coffee2code
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6ARCFJ9TX3522
Tags: comment, moderation, subscribers, spam, users
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Requires at least: 3.1
Tested up to: 6.6
Stable tag: 2.3.5

Never moderate or mark as spam comments made by registered users, regardless of the apparent spamminess of the comment.


== Description ==

This plugin prevents comments from registered users (or, alternatively, those with specified capabilities) from ever going into the moderation queue or getting automatically marked as spam, regardless of the apparent spamminess of the comment.

To be recognized as a registered user, the user must be logged into your site at the time they post their comment.

This plugin assumes that you trust your registered users. It will automatically approve any comment made by registered users, even if the comment stinks of spam. Therefore, it is recommended that you do not allow users to register themselves (uncheck the setting "Anyone can register" in the WordPress admin under Settings -> General).

You can still allow open registration, whereby these "subscribers" are moderated as usual, while other more privileged users do not get moderated. The plugin provides a filter, 'c2c_never_moderate_registered_users_caps', which allows you to specify the roles and capabilities that can bypass moderation. See the FAQ for an example.

This plugin is a partial successor to my now-defunct Never Moderate Admins or Post Author plugin. In addition to preventing admins and the post's author from being moderated, that plugin also allowed you to prevent registered users from being moderated. WordPress has long since integrated that functionality, so the main thrust of that plugin became moot. However, the ability to never moderate registered users is still a valid need that requires this plugin.

Links: [Plugin Homepage](https://coffee2code.com/wp-plugins/never-moderate-registered-users/) | [Plugin Directory Page](https://wordpress.org/plugins/never-moderate-registered-users/) | [GitHub](https://github.com/coffee2code/never-moderate-registered-users/) | [Author Homepage](https://coffee2code.com)


== Installation ==

1. Install via the built-in WordPress plugin installer. Or install the plugin code inside the plugins directory for your site (typically `/wp-content/plugins/`).
1. Activate the plugin through the 'Plugins' admin menu in WordPress
1. Optional: Use one or more of the provided hooks in custom code to control specific capabilities that should be exempted from moderation and spam or to control the feature on a comment-by-comment basis.


== Frequently Asked Questions ==

= Hey, why did I get some obvious spam from a registered user? =

This plugin assumes that any comment made by a registered user (or a user with a specified capabilities) is not spam, regardless of the spamminess of their comment. If you don't trust your registered users you probably shouldn't have this plugin activated. Or at least follow the directions above to increase the minimum threshold for trusted users.

= I don't trust registered users who are just "subscribers", but I trust "contributors"; can this plugin moderate accordingly? =

Yes. You can specify the capabilities and roles that can bypass moderation. See the example provided for the 'c2c_never_moderate_registered_users_caps' filter.

= Does this plugin include unit tests? =

Yes. The tests are not packaged in the release .zip file or included in plugins.svn.wordpress.org, but can be found in the [plugin's GitHub repository](https://github.com/coffee2code/never-moderate-registered-users/).


== Developer Documentation ==

Developer documentation can be found in [DEVELOPER-DOCS.md](https://github.com/coffee2code/never-moderate-registered-users/blob/master/DEVELOPER-DOCS.md). That documentation covers the numerous hooks provided by the plugin. Those hooks are listed below to provide an overview of what's available.

* `c2c_never_moderate_registered_users_caps`     : Customize the capabilities that are automatically trusted, any one of which a user must have in order to never get moderated.
* `c2c_never_moderate_registered_users_approved` : Customize granular control for whether a comment by a registered user that would otherwise be moderated or marked as spam should automatically be approved.


== Changelog ==

= 2.3.5 (2024-08-21) =
* Change: Shorten plugin description
* Change: Note compatibility through WP 6.6+
* Change: Update copyright date (2024)
* Change: Reduce number of 'Tags' from `readme.txt`
* Change: Remove development and testing-related files from release packaging
* Unit tests:
    * Hardening: Prevent direct web access to `bootstrap.php`
    * Change: In bootstrap, store path to plugin directory in a constant

= 2.3.4 (2023-06-06) =
* Change: Note compatibility through WP 6.3+
* Change: Update copyright date (2023)
* New: Add `.gitignore` file
* Unit tests:
    * Fix: Allow tests to run against current versions of WordPress
    * New: Add `composer.json` for PHPUnit Polyfill dependency
    * Change: Prevent PHP warnings due to missing core-related generated files

= 2.3.3 (2021-10-05) =
* New: Add DEVELOPER-DOCS.md and move hooks documentation into it
* Change: Note compatibility through WP 5.8+
* Change: Tweak installation instruction
* Unit tests:
    * Change: Restructure unit test directories
        * Change: Move `phpunit/` into `tests/`
        * Change: Move `phpunit/bin` into `tests/`
    * Change: Remove 'test-' prefix from unit test file
    * Change: In bootstrap, store path to plugin file constant
    * Change: In bootstrap, add backcompat for PHPUnit pre-v6.0

_Full changelog is available in [CHANGELOG.md](https://github.com/coffee2code/never-moderate-registered-users/blob/master/CHANGELOG.md)._


== Upgrade Notice ==

= 2.3.5 =
Trivial update: noted compatibility through WP 6.6+, removed unit tests from release packaging, and updated copyright date (2024)

= 2.3.4 =
Trivial update: noted compatibility through WP 6.3+, updated unit tests to run against latest WordPress, and updated copyright date (2023)

= 2.3.3 =
Trivial update: added DEVELOPER-DOCS.md, noted compatibility through WP 5.8+, and minor reorganization and tweaks to unit tests

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

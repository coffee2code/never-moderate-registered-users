# Changelog

## 2.3.5 _(2024-08-21)_
* Change: Shorten plugin description
* Change: Note compatibility through WP 6.6+
* Change: Update copyright date (2024)
* Change: Reduce number of 'Tags' from `readme.txt`
* Change: Remove development and testing-related files from release packaging
* Unit tests:
    * Hardening: Prevent direct web access to `bootstrap.php`
    * Change: In bootstrap, store path to plugin directory in a constant

## 2.3.4 _(2023-06-06)_
* Change: Note compatibility through WP 6.3+
* Change: Update copyright date (2023)
* New: Add `.gitignore` file
* Unit tests:
    * Fix: Allow tests to run against current versions of WordPress
    * New: Add `composer.json` for PHPUnit Polyfill dependency
    * Change: Prevent PHP warnings due to missing core-related generated files

## 2.3.3 _(2021-10-05)_
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

## 2.3.2 _(2021-04-09)_
* Change: Note compatibility through WP 5.7+
* Change: Update copyright date (2021)

## 2.3.1 _(2020-08-27)_
* Change: Restructure unit test file structure
    * New: Create new subdirectory `phpunit/` to house all files related to unit testing
    * Change: Move `bin/` to `phpunit/bin/`
    * Change: Move `tests/bootstrap.php` to `phpunit/`
    * Change: Move `tests/` to `phpunit/tests/`
    * Change: Rename `phpunit.xml` to `phpunit.xml.dist` per best practices
* Change: Note compatibility through WP 5.5+
* Change: Tweak some documentation in readme.txt
* Unit tests: Check if WP is 5.5+ to use renamed option names

## 2.3 _(2020-05-10)_
* Change: Disallow handling comments flagged with `WP_Error`
* Change: Update inline docs for `c2c_never_moderate_registered_users()` and filter `c2c_never_moderate_registered_users_approved` to reflect that a `WP_Error` and 'trash' are also valid potential values
* Change: Use HTTPS for link to WP SVN repository in bin script for configuring unit tests
* Change: Note compatibility through WP 5.4+
* Change: Update links to coffee2code.com to be HTTPS
* Change: Unit tests: Remove unnecessary unregistering of hooks

## 2.2.2 _(2019-11-25)_
* New: Add CHANGELOG.md and move all but most recent changelog entries into it
* Change: Update unit test install script and bootstrap to use latest WP unit test repo
* Change: Note compatibility through WP 5.3+
* Change: Update copyright date (2020)
* Change: Split paragraph in README.md's "Support" section into two

## 2.2.1 _(2019-03-07)_
* New: Add inline documentation for undocumented hook
* Fix: Correct code example error in readme
* Change: Rename readme.txt section from 'Filters' to 'Hooks'
* Change: Tweak third installation instruction
* Change: Note compatibility through WP 5.1+
* Change: Update copyright date (2019)
* Change: Update License URI to be HTTPS

## 2.2 _(2018-04-28)_
* New: Add filter `c2c_never_moderate_registered_users_approved` for ultimately overriding if an otherwise moderated or spam comment by a registered user should be approved
* New: Add README.md
* Change: Add GitHub link to readme
* Change: Unit tests: Minor whitespace tweaks to bootstrap
* Change: Update installation instruction to prefer built-in installer over .zip file
* Change: Note compatibility through WP 4.9+
* Change: Update copyright date (2018)

## 2.1.4 _(2017-01-03)_
* Fix: Prevent PHP unit test errors by defaulting expected commentdata array elements.
* New: Add LICENSE file.
* Change: Enable more error ourput for unit tests.
* Change: Default `WP_TESTS_DIR` to `/tmp/wordpress-tests-lib` rather than erroring out if not defined via environment variable.
* Change: Minor tweaks to code documentation.
* Change: Note compatibility through WP 4.7+.
* Change: Update copyright date (2017).

## 2.1.3 _(2016-01-28)_
* New: Create empty index.php to prevent files from being listed if web server has enabled directory listings.
* New: Add 'Text Domain' header attribute.
* Change: Update unit tests to account for `wp_allow_comment()` returning 'trash' for spam comments when trash is enabled.
* Change: Explicitly declare methods in unit tests as public.
* Change: Add docblock to code example in readme.txt.
* Change: Note compatibility through WP 4.4+.
* Change: Update copyright date (2016).

## 2.1.2 _(2015-02-13)_
* Note compatibility through WP 4.1+
* Update copyright date (2015)

## 2.1.1 _(2014-08-30)_
* Minor plugin header reformatting
* Minor code reformatting (bracing, spacing)
* Minor documentation reformatting (spacing, typo)
* Change documentation links to wp.org to be https
* Note compatibility through WP 4.0+
* Add plugin icon

## 2.1 _(2013-01-05)_
* Fix so spam comments from registered users get approved
* Accept $commentdata arg from `pre_comment_approved` filter instead of using global
* Check for use of both `user_ID` or `user_id` in commentdata array
* Add unit tests
* Note compatibility through WP 3.8+
* Drop compatibility with versions of WP older than 3.1
* Update copyright date (2014)
* Minor code and documentation reformatting (spacing, bracing)
* Change donate link
* Add banner image

## 2.0.5
* Add check to prevent execution of code if file is directly accessed
* Note compatibility through WP 3.5+
* Update copyright date (2013)

## 2.0.4
* Re-license as GPLv2 or later (from X11)
* Add 'License' and 'License URI' header tags to readme.txt and plugin file
* Remove ending PHP close tag
* Note compatibility through WP 3.4+

## 2.0.3
* Note compatibility through WP 3.3+
* Tweak extended description
* Add link to plugin directory page to readme.txt
* Update copyright date (2012)

## 2.0.2
* Note compatibility through WP 3.2+
* Minor code formatting changes (spacing)
* Fix plugin homepage and author links in description in readme.txt

## 2.0.1
* Note compatibility with WP 3.1+
* Update copyright date (2011)
* Move code comments

## 2.0
* Add filter `c2c_never_moderate_registered_users_caps` to allow specifying capabilities a user must have in order to bypass moderation. If none are specified, then the user just has to be registered.
* Remove `$min_user_level` argument and support
* Wrap function in `if(!function_exists())` check
* Remove docs from top of plugin file (all that and more are in readme.txt)
* Minor code improvements and reformatting (spacing)
* Add PHPDoc
* Note compatibility with WP 3.0+
* Drop compatibility with versions of WP older than 2.8
* Update copyright date
* Add package info to top of plugin file
* Add Changelog, Filters, and Upgrade Notice sections to readme.txt
* Add to plugin repository

## 1.0
* Initial release

<?php

class Never_Moderate_Registered_Users_Test extends WP_UnitTestCase {

	function setUp() {
		parent::setUp();

		update_option( 'blacklist_keys', "blackjack\npoker\nthisisspam\nviagra" );
		update_option( 'comment_moderation', '0' );
		update_option( 'comment_whitelist', '0' );
		update_option( 'comment_max_links', 1 );
	}

	function tearDown() {
		parent::tearDown();
		$this->unset_current_user();

		remove_filter( 'c2c_never_moderate_registered_users_caps', array( $this, 'c2c_never_moderate_registered_users_caps' ) );
		remove_filter( 'comment_max_links_url', array( $this, 'comment_max_links_url' ) );
	}


	/**
	 *
	 * HELPER FUNCTIONS
	 *
	 */


	private function create_user( $role, $set_as_current = true ) {
		$user_id = $this->factory->user->create( array( 'role' => $role ) );
		if ( $set_as_current ) {
			wp_set_current_user( $user_id );
		}
		return $user_id;
	}

	// helper function, unsets current user globally. Taken from post.php test.
	private function unset_current_user() {
		global $current_user, $user_ID;

		$current_user = $user_ID = null;
    }

	private function get_commentdata( $settings ) {
		$user_id = $this->create_user( 'author', false );
		$post_id = $this->factory->post->create( array( 'post_author' => $user_id ) );

		$defaults = array(
			'comment_post_ID' => $post_id,
			'comment_author' => 'some visitor',
			'comment_author_url' => 'http://example.com',
			'comment_content' => $text,
		);
		return wp_parse_args( $settings, $defaults );
	}

	function c2c_never_moderate_registered_users_caps( $caps ) {
		$caps[] = 'manage_options';
		return $caps;
	}

	function comment_max_links_url( $max ) {
		return 1;
	}


	/**
	 *
	 * TESTS
	 *
	 */


	function test_registered_user_spammy_comment_not_treated_as_spam() {
		$user_id     = $this->create_user( 'subscriber' );
		$commentdata = $this->get_commentdata( array( 'comment_content' => 'blackjack', 'user_id' => $user_id ) );

		$this->assertEquals( '1', wp_allow_comment( $commentdata ) );

		$comment_id = wp_new_comment( $commentdata );
		$comment = get_comment( $comment_id );

		$this->assertEquals( '1', $comment->comment_approved );
	}

	function test_registered_user_good_comment_is_approved() {
		$user_id     = $this->create_user( 'subscriber' );
		$commentdata = $this->get_commentdata( array( 'comment_content' => 'good', 'user_id' => $user_id ) );

		$this->assertEquals( '1', wp_allow_comment( $commentdata ) );

		$comment_id = wp_new_comment( $commentdata );
		$comment = get_comment( $comment_id );

		$this->assertEquals( '1', $comment->comment_approved );
	}

	function test_registered_user_moderation_worth_comment_is_approved() {
		add_filter( 'comment_max_links_url', array( $this, 'comment_max_links_url' ) );

		$user_id     = $this->create_user( 'subscriber' );
		$commentdata = $this->get_commentdata( array( 'comment_content' => 'http://example.org/link1 http://example.org/link2', 'user_id' => $user_id ) );

		$this->assertEquals( '1', wp_allow_comment( $commentdata ) );

		$comment_id = wp_new_comment( $commentdata );
		$comment = get_comment( $comment_id );

		$this->assertEquals( '1', $comment->comment_approved );
	}

	function test_unregistered_user_good_comment_not_affected() {
		$commentdata = $this->get_commentdata( array( 'comment_content' => 'comment' ) );

		$this->assertEquals( '1', wp_allow_comment( $commentdata ) );

		$comment_id = wp_new_comment( $commentdata );
		$comment = get_comment( $comment_id );

		$this->assertEquals( '1', $comment->comment_approved );
	}

	function test_unregistered_user_spam_comment_not_affected() {
		$commentdata = $this->get_commentdata( array( 'comment_content' => 'blackjack' ) );

		$this->assertEquals( 'spam', wp_allow_comment( $commentdata ) );

		$comment_id = wp_new_comment( $commentdata );
		$comment = get_comment( $comment_id );

		$this->assertEquals( 'spam', $comment->comment_approved );
	}

	function test_unregistered_user_moderation_worthy_comment_not_affected() {
		add_filter( 'comment_max_links_url', array( $this, 'comment_max_links_url' ) );

		$commentdata = $this->get_commentdata( array( 'comment_content' => 'http://example.org/link1 http://example.org/link2' ) );

		$this->assertEquals( '0', wp_allow_comment( $commentdata ) );

		$comment_id = wp_new_comment( $commentdata );
		$comment = get_comment( $comment_id );

		$this->assertEquals( '0', $comment->comment_approved );
	}

	function test_registered_user_spammy_comment_is_treated_as_spam_when_caps_not_high_enough() {
		add_filter( 'c2c_never_moderate_registered_users_caps', array( $this, 'c2c_never_moderate_registered_users_caps' ) );

		$user_id     = $this->create_user( 'subscriber' );
		$commentdata = $this->get_commentdata( array( 'comment_content' => 'blackjack', 'user_id' => $user_id ) );

		$this->assertEquals( 'spam', wp_allow_comment( $commentdata ) );

		$comment_id = wp_new_comment( $commentdata );
		$comment = get_comment( $comment_id );

		$this->assertEquals( 'spam', $comment->comment_approved );
	}

	function test_registered_user_moderation_worth_comment_is_moderated_when_caps_not_high_enough() {
		add_filter( 'c2c_never_moderate_registered_users_caps', array( $this, 'c2c_never_moderate_registered_users_caps' ) );
		add_filter( 'comment_max_links_url', array( $this, 'comment_max_links_url' ) );

		$user_id     = $this->create_user( 'subscriber' );
		$commentdata = $this->get_commentdata( array( 'comment_content' => 'http://example.org/link1 http://example.org/link2' ) );

		$this->assertEquals( '0', wp_allow_comment( $commentdata ) );

		$comment_id = wp_new_comment( $commentdata );
		$comment = get_comment( $comment_id );

		$this->assertEquals( '0', $comment->comment_approved );

	}
}

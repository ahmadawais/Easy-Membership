<?php
/**
 * Membership Initializer.
 *
 * Responsible for membership related stuff.
 * 		1. Registration.
 * 		2. Login.
 * 		3. Forgot your password.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Composer Autoload.
 *
 * @since 1.0.0
 */
if ( file_exists( EM_DIR . '/vendor/autoload.php' ) ) {
    require_once( EM_DIR . '/vendor/autoload.php' );
}

/**
 * Enqueue Scripts & Styles.
 *
 * @since 1.0.0
 */
if ( file_exists( EM_DIR . '/lib/class-em-enqueue.php' ) ) {
    require_once( EM_DIR . '/lib/class-em-enqueue.php' );
}

/**
 * Class: EM_Member.
 *
 * @since 1.0.0
 */
if ( file_exists( EM_DIR . '/lib/class-member.php' ) ) {
    require_once( EM_DIR . '/lib/class-member.php' );
}

/**
 * Class: EM_Login.
 *
 * @since 1.0.0
 */
if ( file_exists( EM_DIR . '/lib/class-login.php' ) ) {
    require_once( EM_DIR . '/lib/class-login.php' );
}

/**
 * Class: EM_Register.
 *
 * @since 1.0.0
 */
if ( file_exists( EM_DIR . '/lib/class-register.php' ) ) {
    require_once( EM_DIR . '/lib/class-register.php' );
}

/**
 * Class: EM_Reset.
 *
 * @since 1.0.0
 */
if ( file_exists( EM_DIR . '/lib/class-reset.php' ) ) {
    require_once( EM_DIR . '/lib/class-reset.php' );
}

/**
 * Class: EM_Edit_Profile.
 *
 * @since 1.0.0
 */
if ( file_exists( EM_DIR . '/lib/class-edit-profile.php' ) ) {
    require_once( EM_DIR . '/lib/class-edit-profile.php' );
}

/**
 * Class: EM_Profile_Fields.
 *
 * @since 1.0.0
 */
if ( file_exists( EM_DIR . '/lib/class-profile-fields.php' ) ) {
    require_once( EM_DIR . '/lib/class-profile-fields.php' );
}

/**
 * Class: EM_Submit_Post.
 *
 * @since 1.0.0
 */
if ( file_exists( EM_DIR . '/lib/class-submit-post.php' ) ) {
    require_once( EM_DIR . '/lib/class-submit-post.php' );
}


/**
 * Paddle Init.
 *
 * @since 1.0.0
 */
if ( file_exists( EM_DIR . '/paddle/paddle-init.php' ) ) {
    require_once( EM_DIR . '/paddle/paddle-init.php' );
}
/**
 * Actions/Filters for membership.
 *
 * Classes:
 * 			1. EM_Member
 */
if ( class_exists( 'EM_Member' ) ) {
	// Object: EM_Member class.
	$em_Member_init = new EM_Member();

	// Register the shortcode [em_login]
	add_action( 'init', array( $em_Member_init, 'login' ) );

	// Enable the user with no privileges to request ajax login
	add_action( 'wp_ajax_nopriv_em_ajax_login', array( $em_Member_init, 'ajax_login' ) );

	// Register the shortcode [em_register]
	add_action( 'init', array( $em_Member_init, 'register' ) );

	// Enable the user with no privileges to request ajax register
	add_action( 'wp_ajax_nopriv_em_ajax_register', array( $em_Member_init, 'ajax_register' ) );

	// Register the shortcode [em_reset]
	add_action( 'init', array( $em_Member_init, 'reset' ) );

	// Enable the user with no privileges to request ajax password reset
	add_action( 'wp_ajax_nopriv_em_ajax_reset', array( $em_Member_init, 'ajax_reset' ) );

	// Register the shortcode [em_edit_profile]
	add_action( 'init', array( $em_Member_init, 'edit_profile' ) );

	if ( class_exists( 'EM_Profile_Fields') ) {
		// Extra User Profile Fields.
	    add_filter( 'user_contactmethods', array( 'EM_Profile_Fields', 'extra_fields' ) );
	}
	// Edit Profile only for logged in user.
	add_action( 'wp_ajax_em_update_profile_action', array( $em_Member_init, 'update' ) );

	// Upload profile image.
	// Action: `em_profile_image_upload` line#65 `edit-profile.js`.
    add_action( 'wp_ajax_em_profile_image_upload', array( $em_Member_init, 'upload_profile_image' ) );

	// Register the shortcode [em_submit_post]
	add_action( 'init', array( $em_Member_init, 'submit_post' ) );

	// Submit a post for logged in user.
	add_action( 'wp_ajax_EM_Submit_Post_action', array( $em_Member_init, 'submit' ) );
}

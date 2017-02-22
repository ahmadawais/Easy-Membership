<?php
/**
 * Class: EM_Enquque.
 *
 * All the enqueued scripts & Styles.
 *
 * @since 	1.0.0
 * @package EM
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if class doesn't exist before.
if ( ! class_exists( 'EM_Enquque' ) ) {
	/**
	 * EM_Enquque.
	 *
	 * VR Scripts Class.
	 *
	 * @since 1.0.0
	 */
	class EM_Enquque {
		/**
		 * Scripts.
		 *
		 * Static public function. Object has no access to it
		 * and a call from an object can lead to a Fatal error
		 * in $this context.
		 *
		 * TODO: has_shortcode() check or page checks.
		 *
		 * @since 1.0.0
		 */
		public static function scripts() {
			if ( ! is_admin() ) {
				// Enqueue jQuery.
				wp_enqueue_script('jquery');

				// jQuery Form Plugin.
				// Usage: member
				wp_enqueue_script(
					'em_form',
					EM_URL . '/js/vendor/jquery.form.js',
					array( 'jquery' ),
					'3.51.0',
					true
				);

				// Bootstrap: `modal.js`.
				// Usage: member
				wp_enqueue_script(
					'em_modal',
					EM_URL . '/js/vendor/modal.js',
					array( 'jquery' ),
					'3.3.4',
					true
				);

				// jQuery Validation Plugin.
				// Usage: member
				wp_enqueue_script(
					'em_validate',
					EM_URL . '/js/vendor/jquery.validate.min.js',
					array( 'jquery' ),
					'1.13.1',
					true
				);

				// login-register-reset.js.
				// Usage: member
				wp_enqueue_script(
					'em_member_customJS',
					EM_URL . '/js/custom/login-register-reset.js',
					array( 'jquery', 'em_form', 'em_modal', 'em_validate' ),
					EM_VERSION,
					true
				);

				// login-register-reset.js.
				// Usage: member
				wp_enqueue_script(
					'em_member_customJS',
					EM_URL . '/js/custom/login-register-reset.js',
					array( 'jquery', 'em_form', 'em_modal', 'em_validate' ),
					EM_VERSION,
					true
				);

				// Paddle.js Setup.
				wp_enqueue_script(
				    'em_paddleJS',
				    'https://cdn.paddle.com/paddle/paddle.js',
				    array( 'jquery' ),
				    EM_VERSION,
				    true
				);

				// Paddle-button.js.
				wp_enqueue_script(
					'em_paddle_buttonJS',
					EM_URL . '/js/custom/paddle-button.js',
					array( 'jquery', 'em_form', 'em_modal', 'em_validate', 'em_member_customJS', 'em_paddleJS' ),
					EM_VERSION,
					true
				);

				// Needed for Profile Image.
				// Usage: member
				// wp_enqueue_script( 'plupload' );

				// Edit Profile JS.
				// Usage: member
				// wp_enqueue_script(
				//     'em_edit_profileJS',
				//     EM_URL . '/js/custom/edit-profile.js',
				//     array( 'jquery', 'plupload' ),
				//     EM_VERSION,
				//     true
				// );

				// $edit_profile_data = array(
				// 	'ajaxURL'       => admin_url( 'admin-ajax.php' ),
				// 	'uploadNonce'   => wp_create_nonce ( 'em_allow_upload_profile_image' ),
				// 	'fileTypeTitle' => __( 'Valid file formats.', 'EM' ),
				// );

				// wp_localize_script( 'em_edit_profileJS', 'editProfile', $edit_profile_data );

				// // Submit Post JS.
				// // Usage: member
				// wp_enqueue_script(
				//     'em_submit_postJS',
				//     EM_URL . '/js/custom/submit-post.js',
				//     array( 'jquery', 'plupload' ),
				//     EM_VERSION,
				//     true
				// );

				// $submit_post_data = array(
				// 	'ajaxURL'       => admin_url( 'admin-ajax.php' ),
				// 	'uploadNonce'   => wp_create_nonce ( 'em_allow_submit_post_image' ),
				// 	'fileTypeTitle' => __( 'Valid file formats.', 'EM' ),
				// );

				// wp_localize_script( 'em_submit_postJS', 'submitPost', $submit_post_data );

				// // CSS.
				// wp_enqueue_style(
				// 	'em_css',
				// 	EM_URL . '/css/style.css',
				// 	array(),
				// 	EM_VERSION,
				// 	'all'
				// );
			} // End if().
		} // Function ended.
	} // Class ended.
} // End class_exits().

/**
 * Actions/Filters related to EM_Enquque class.
 *
 * @since 1.0.0
 */
if ( class_exists( 'EM_Enquque' ) ) {
	/**
	 * Enqueue scripts.
	 *
	 * Static function `scripts`, Object has no access to it,
	 * a call from an object can lead to a Fatal error in $this
	 * context So, calling it via the classname.
	 *
	 * @since 1.0.0
	 */
	add_action( 'wp_enqueue_scripts', array( 'EM_Enquque' , 'scripts' ) );
}

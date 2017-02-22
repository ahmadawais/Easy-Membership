<?php
/**
 * CLASS: EM_PADDLE
 *
 * Paddle Payment gateway.
 *
 * @since 	1.0.0
 * @package EM
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Class should NOT exist before this.
if ( ! class_exists( 'EM_PADDLE' ) ) {
	/**
	 * EM_PADDLE.
	 *
	 * Paddle Payment handling class.
	 *
	 * @since 1.0.0
	 */
	class EM_PADDLE {
		// $vendor_id = 16413;
		// $vendor_auth_code = b5ffd62fed60f246fc64eb9a12726a4492542171362f4bc596;
		// $product_id = 511115;

		/**
		 * Button Shortcode.
		 *
		 * The [em_paddle_button]
		 *
		 * @since 1.0.0
		 */
		public function shortcode() {

			// Shortcode: `[em_paddle_button]`.
			add_shortcode( 'em_paddle_button', function () {
				/**
				 * VIEW: paddle-button.
				 *
				 * @since 1.0.0
				 */
				if ( file_exists( EM_DIR . '/paddle/view-paddle-button.php' ) ) {
				    require_once( EM_DIR . '/paddle/view-paddle-button.php' );
				}

			} );// annonymous function and action ended.

		} // Function ended.



	} // End class.
} // End if().

/**
 * Actions/Filters related to EM_PADDLE class.
 *
 * @since 1.0.0
 */
if ( class_exists( 'EM_PADDLE' ) ) {
  // Register the shortcode [em_paddle_button].
  add_action( 'init', array( 'EM_PADDLE', 'shortcode' ) );
}


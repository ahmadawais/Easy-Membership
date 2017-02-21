<?php
/**
 * Class: EM_Reset
 *
 * Reset class.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * EM_Reset.
 *
 * VR Membership reset pass class.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'em_reset' ) ) :

class EM_Reset {

	/**
	 * Reset Short.
	 *
	 * @since 1.0.0
	 */
	public function reset() {

		/**
		 * Shortcode: `[em_reset]`.
		 *
		 * @since 1.0.0
		 */
		add_shortcode( 'em_reset', function () {

			/**
			 * VIEW: reset.
			 *
			 * @since 1.0.0
			 */
			if ( file_exists( EM_DIR . '/lib/view-reset.php' ) ) {
			    require_once( EM_DIR . '/lib/view-reset.php' );
			}

		} );// annonymous function and action ended.

	} // Function ended.

	/**
	 * AJAX Reset.
	 *
	 * @since 1.0.0
	 */
	public function ajax_reset() {

		// First check the nonce, if it fails the function will break
        check_ajax_referer( 'vr-ajax-forgot-nonce', 'vr-secure-reset' );

        $account = $_POST['reset_username_or_email'];
        $error = "";
        $get_by = "";

        if( empty( $account ) ) {
            $error = __( 'Provide a valid username or email address!', 'EM' );
        } else {
            if( is_email( $account ) ) {
                if( email_exists( $account ) ) {
                    $get_by = 'email';
                } else {
                    $error = __( 'No user found for given email!', 'EM' );
                }
            } elseif( validate_username( $account ) ) {
                if( username_exists( $account ) ) {
                    $get_by = 'login';
                } else {
                    $error = __( 'No user found for given username!', 'EM' );
                }
            } else {
                $error = __( 'Invalid username or email!', 'EM' );
            }
        }

        if( empty( $error ) ) {

            // Generate new random password
            $random_password = wp_generate_password();

            // Get user data by field( fields are id, slug, email or login )
            $target_user = get_user_by( $get_by, $account );

            $update_user = wp_update_user( array(
                'ID' => $target_user->ID,
                'user_pass' => $random_password
            ) );

            // if  update_user return true then send user an email containing the new password
            if( $update_user ) {

                $from = get_option( 'admin_email' ); // Set whatever you want like mail@yourdomain.com

                if( !isset( $from ) || !is_email( $from ) ) {
                    $site_name = strtolower( $_SERVER['SERVER_NAME'] );
                    if( substr( $site_name, 0, 4 ) == 'www.' ) {
                        $site_name = substr( $site_name, 4 );
                    }
                    $from = 'admin@' . $site_name;
                }

                $to = $target_user->user_email;
                $website_name = get_bloginfo( 'name' );
                $subject = sprintf( __('Your New Password For %s', 'EM'), $website_name );
                $sender = sprintf( __( 'From: %s <%s>', 'EM' ), $website_name , $from ) . "\r\n";
                $message = sprintf( __( 'Your new password is: %s', 'EM' ), $random_password );

                // email header
                $header = 'Content-type: text/html; charset=utf-8' . "\r\n";
                $header = apply_filters( "inspiry_password_reset_header", $header );
                $header .= $sender;

                $mail = wp_mail( $to, $subject, $message, $header );

                if( $mail ) {
                    $success = __( 'Check your email for new password', 'EM' );
                } else {
                    $error = __( 'Failed to send you new password email!', 'EM' );
                }

            } else {
                $error = __( 'Oops! Something went wrong while resetting your password!', 'EM' );
            }
        }

        if( ! empty( $error ) ){
            echo json_encode(
                array(
                    'success' => false,
                    'message' => $error
                )
            );
        } elseif( ! empty( $success ) ) {
            echo json_encode(
                array(
                    'success' => true,
                    'message' => $success
                )
            );
        }

        die();

	}

} // Class ended.

endif;

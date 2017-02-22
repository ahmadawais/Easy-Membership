<?php
/**
 * Paddle Init
 *
 * Handles Paddle Payments.
 *
 * @since 	1.0.0
 * @package EM
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * CLASS: EM_PADDLE.
 *
 * @since 1.0.0
 */
if ( file_exists( EM_DIR . '/paddle/class-em-paddle.php' ) ) {
    require_once( EM_DIR . '/paddle/class-em-paddle.php' );
}

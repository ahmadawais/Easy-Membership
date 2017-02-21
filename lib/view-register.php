<?php
/**
 * View: Registration
 *
 * VR membership registration view.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Array of pages.
 *
 * Array for multiple similar settings and controls.
 *
 * @since  1.0.0
 */
$em_pages_array = array(
    'login',
    'register',
    'reset'
);

// Save page links here.
$em_page_links = array();

// Looping through.
foreach ( $em_pages_array as $page ) {
    $em_page = get_option( 'em_page_' . $page );
    $em_page_links[ $page ] = isset( $em_page ) && '' != $em_page && false != $em_page
                                ? get_permalink( $em_page ) : '/';
}

/**
 * Display a message if user is already logged in.
 */
if ( is_user_logged_in() ) {

    $current_user = wp_get_current_user();
    $first_name   = esc_html( $current_user->user_firstname );
    $user_login   = esc_html( $current_user->user_login );
    $name = ( empty( $first_name ) ) ? $user_login : $first_name;
    ?>

    <div>

        <h3><?php _e( 'Hey, ' . $name . '!', 'EM' ); ?></h3>

        <p class="message">
            <?php
                _e( 'You are already logged in. ', 'EM' );
                _e( 'Go to the <a href="/">Homepage!</a> or <a href="' . wp_logout_url( home_url() ) . '">Logout!</a>', 'EM' );
            ?>
        </p>
        <!-- /.message -->

    </div>

    <?php

} else {

?>

<div class="form-wrapper">

    <form id="register-form" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" enctype="multipart/form-data">

        <div class="em_form__element">
            <label class="login-form-label" for="register_username"><?php _e( 'Username', 'EM' ); ?><span>*</span></label>
            <input id="register_username" name="register_username" type="text" class="login-form-input login-form-input-common"
                   title="<?php _e( '* Please enter a valid username.', 'EM' ); ?>"
                   placeholder="<?php _e( 'Username', 'EM' ); ?>" />
        </div>

        <div class="em_form__element">
            <label class="login-form-label" for="register_email"><?php _e( 'Email', 'EM' ); ?><span>*</span></label>
            <input id="register_email" name="register_email" type="text" class="login-form-input login-form-input-common"
                   title="<?php _e( '* Please provide valid email address!', 'EM' ); ?>"
                   placeholder="<?php _e( 'Email', 'EM' ); ?>" />
        </div>

        <div class="em_form__element">
            <label class="login-form-label" for="register_pwd"><?php _e( 'Password', 'EM' ); ?></label>
            <input id="register_pwd" name="register_pwd" type="password" class="login-form-input login-form-input-common"
                   title="<?php _e( '* Provide your password', 'EM' ); ?>"
                   placeholder="<?php _e( 'Password', 'EM' ); ?>" />
        </div>

        <div class="em_form__element">
            <label class="login-form-label" for="register_pwd2"><?php _e( 'Confirm Password', 'EM' ); ?></label>
            <input id="register_pwd2" name="register_pwd2" type="password" class="login-form-input login-form-input-common"
                   title="<?php _e( '* Password should be same as above', 'EM' ); ?>"
                   placeholder="<?php _e( 'Confirm Password', 'EM' ); ?>" />
        </div>

        <div class="em_form__element  em_btn em_btn--block">
            <input type="submit" id="register-button" name="user-submit" class="em_btn--primary em_btn--homePad" value="<?php _e( 'Register', 'EM' ); ?>" />
            <input type="hidden" name="action" value="em_ajax_register" />
            <?php  // nonce for security
            wp_nonce_field( 'vr-ajax-register-nonce', 'vr-secure-register' );

            if ( is_page() || is_single() ) {
                ?><input type="hidden" name="redirect_to" value="<?php wp_reset_postdata(); global $post; the_permalink( $post->ID ); ?>" /><?php
            } else {
                ?><input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url( '/' ) ); ?>" /><?php
            }

            ?>
            <div class="text-center">
                <div id="register-message" class="modal-message em_notice em_notice--success em_dn"></div>
                <div id="register-error" class="modal-error em_notice em_notice--error em_dn"></div>
                <img id="register-loader" class="modal-loader" src="<?php echo EM_URL; ?>/img/ajax-loader.gif" alt="Working...">
            </div>
        </div>

    </form>

    <div class="em_form__element">
        <span class="em_btn">
            <a
                href="<?php echo $em_page_links['login']; ?>"
                class="em_btn--secondary em_btn--homePad em_open_login_form"
            >
                <?php _e( 'Login', 'EM' ); ?>
            </a>
        </span>
        <span class="em_btn">
            <a
                href="<?php echo $em_page_links['reset']; ?>"
                class="em_btn--secondary em_btn--homePad em_open_reset_form"
            >
                <?php _e( 'Forgot Password?', 'EM' ); ?>
            </a>
        </span>

    </div>

</div>

<?php } // if/else ended. ?>

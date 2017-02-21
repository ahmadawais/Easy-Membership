<?php
/**
 * View: Login File
 *
 * VR membership login view.
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
    'reset',
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
        <h3><?php _e( 'Edit Your Profile!', 'EM' ); ?></h3>
        <?php do_shortcode( '[em_edit_profile]' ); ?>

    </div>

    <?php

} else {

?>

<div class="form-wrapper">

    <form id="login-form" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" enctype="multipart/form-data">

        <div class="em_form__element">
            <label class="login-form-label" for="login-username"><?php _e( 'Username', 'EM' ); ?></label>
            <input id="login-username" name="log" type="text" class="login-form-input login-form-input-common required"
                   title="<?php _e( '* Provide your username', 'EM' ); ?>"
                   placeholder="<?php _e( 'Username', 'EM' ); ?>" />
        </div>

        <div class="em_form__element">
            <label class="login-form-label" for="password"><?php _e( 'Password', 'EM' ); ?></label>
            <input id="password" name="pwd" type="password" class="login-form-input login-form-input-common required"
                   title="<?php _e( '* Provide your password', 'EM' ); ?>"
                   placeholder="<?php _e( 'Password', 'EM' ); ?>" />
        </div>

        <div class="em_form__element em_btn em_btn--block">
            <input type="submit" id="login-button" class="em_btn--primary em_btn--homePad" value="<?php _e( 'Login', 'EM' ); ?>" />
            <input type="hidden" name="action" value="em_ajax_login" />
            <input type="hidden" name="user-cookie" value="1" />
            <?php
            // nonce for security
            wp_nonce_field( 'vr-ajax-login-nonce', 'vr-secure-login' );

            if ( is_page() || is_single() ) {
                ?>
                <input type="hidden" name="redirect_to" value="<?php wp_reset_postdata(); global $post; the_permalink( $post->ID ); ?>" />
                <?php
            } else {
                ?>
                <input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url( '/' ) ); ?>" />
                <?php
            }

            ?>
            <div class="text-center">
                <div id="login-message" class="modal-message em_notice em_notice--success em_dn"></div>
                <div id="login-error" class="modal-error em_notice em_notice--error em_dn"></div>
                <img id="login-loader" class="modal-loader em_dn" src="<?php echo VRC_URL; ?>/assets/img/ajax-loader.gif" alt="Working...">
            </div>
        </div>

    </form>

    <div class="em_form__element EM_Login_seconday_buttons">

            <span class="em_btn">
                <a
                    href="<?php echo $em_page_links['register']; ?>"
                    class="em_btn--secondary em_btn--homePad em_open_register_form"
                >
                    <?php _e( 'Register Now', 'EM' ); ?>
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

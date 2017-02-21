<?php
/**
 * View: Forget File
 *
 * VR membership forget view.
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
    $name         = ( empty( $first_name ) ) ? $user_login : $first_name;
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

    <form id="forgot-form" class="em_forgot_form" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" enctype="multipart/form-data">

        <div class="em_form__element">
            <label class="login-form-label" for="reset_username_or_email"><?php _e( 'Username or Email', 'EM' ); ?><span>*</span></label>
            <input id="reset_username_or_email" name="reset_username_or_email" type="text" class="login-form-input login-form-input-common required"
                   title="<?php _e( '* Provide a valid username or email!', 'EM' ); ?>"
                   placeholder="<?php _e( 'Username or Email', 'EM' ); ?>" />
        </div>

        <div class="em_form__element  em_btn em_btn--block ">
            <input type="submit" id="forgot-button" name="user-submit" class="em_btn--primary em_btn--homePad" value="<?php _e( 'Reset Password', 'EM' ); ?>">
            <input type="hidden" name="action" value="em_ajax_reset" />
            <input type="hidden" name="user-cookie" value="1" />
            <?php wp_nonce_field( 'vr-ajax-forgot-nonce', 'vr-secure-reset' ); ?>
            <div class="text-center">
                <div id="forgot-message" class="modal-message em_notice em_notice--success em_dn"></div>
                <div id="forgot-error" class="modal-error em_notice em_notice--error em_dn"></div>
                <img id="forgot-loader" class="modal-loader em_dn" src="<?php echo VRC_URL; ?>/assets/img/ajax-loader.gif" alt="Working...">
            </div>
        </div>

    </form>

    <div class="clearfix clear">

        <?php if( get_option( 'users_can_register' ) ) : ?>

            <div class="em_form__element">
                <span class="em_btn ">
                    <a
                        href="<?php echo $em_page_links['login']; ?>"
                        class="em_btn--secondary em_btn--homePad em_open_login_form"
                    >
                        <?php _e( 'Login', 'EM' ); ?>
                    </a>
                </span>

                <span class="em_btn">
                    <a
                        href="<?php echo $em_page_links['register']; ?>"
                        class="em_btn--secondary em_btn--homePad em_open_register_form"
                    >
                        <?php _e( 'Register', 'EM' ); ?>
                    </a>
                </span>

            </div>
        <?php endif; ?>

    </div>

</div>

<?php } // if/else ended. ?>

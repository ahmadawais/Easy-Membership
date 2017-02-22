/**
 * Padde Button
 *
 * Paddle Button with Paddle.js.
 *
 * @since 	1.0.0
 * @package EM
 */

jQuery( function( $ ) {
	$( document ).ready(function() {
		// Log.
		console.log( "DOM Ready!" );

		// Setup is needed.
		Paddle.Setup({
			vendor: 16413,
			debug: true,
		});

		// On click of button.
		$( '.em_paddle_button' ).on( 'click', function() {
			// Closed without buying.
			function checkoutClosed(data) {
				console.log(data);
				alert('Your purchase has been cancelled, we hope to see you again soon!');
			}

			// Bought.
			function checkoutComplete(data) {
				console.log(data);
				alert('Thanks for your purchase.');
			}

			// Start Checkout.
			Paddle.Checkout.open({
				product: 511115,
				email: "test@sale.com",
				successCallback: "checkoutComplete",
				closeCallback: "checkoutClosed"
			}); // End checkout.
		}); // End on click.
	}); // End DOM Ready.
} ); // EOF.

<?php
/**
 * inquiry-form.php — Traitement serveur du formulaire de demande.
 *
 * Remplace le mailto du site statique par un vrai envoi d'email (wp_mail).
 * Si tu préfères Contact Form 7 / WPForms, tu peux ignorer ce fichier et
 * coller le shortcode du plugin dans la page « Inquiry » à la place.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'admin_post_nopriv_chi_inquiry', 'chi_handle_inquiry' );
add_action( 'admin_post_chi_inquiry', 'chi_handle_inquiry' );

function chi_handle_inquiry() {
	$redirect = wp_get_referer() ? wp_get_referer() : home_url( '/' );

	if ( ! isset( $_POST['chi_inquiry_nonce'] ) || ! wp_verify_nonce( wp_unslash( $_POST['chi_inquiry_nonce'] ), 'chi_inquiry' ) ) {
		wp_safe_redirect( add_query_arg( 'sent', 'error', $redirect ) );
		exit;
	}

	$name     = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
	$email    = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
	$company  = sanitize_text_field( wp_unslash( $_POST['company'] ?? '' ) );
	$product  = sanitize_text_field( wp_unslash( $_POST['product'] ?? '' ) );
	$quantity = sanitize_text_field( wp_unslash( $_POST['quantity'] ?? '' ) );
	$message  = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );

	if ( empty( $name ) || ! is_email( $email ) ) {
		wp_safe_redirect( add_query_arg( 'sent', 'error', $redirect ) );
		exit;
	}

	$contact = chi_contact();
	$to      = $contact['email'];
	$subject = sprintf( '[%s] Inquiry: %s', get_bloginfo( 'name' ), $name ? $name : $email );

	$body  = $message . "\n\n-----\n";
	$body .= "Name: {$name}\n";
	$body .= "Email: {$email}\n";
	$body .= "Company: {$company}\n";
	if ( $product ) {
		$body .= "Product: {$product}\n";
	}
	if ( $quantity ) {
		$body .= "Quantity: {$quantity}\n";
	}

	$headers = array(
		'Reply-To: ' . $name . ' <' . $email . '>',
	);

	$ok = wp_mail( $to, $subject, $body, $headers );

	wp_safe_redirect( add_query_arg( 'sent', $ok ? 'ok' : 'error', $redirect ) );
	exit;
}

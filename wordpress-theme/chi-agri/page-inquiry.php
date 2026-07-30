<?php
/**
 * Template Name: Inquiry
 * page-inquiry.php — Page « Demande » : coordonnées + formulaire réel.
 * S'applique automatiquement à une Page de slug « inquiry », ou via le
 * gabarit « Inquiry ».
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();

$chi_contact  = chi_contact();
$chi_products = chi_get_products();
$sent         = isset( $_GET['sent'] ) ? sanitize_key( wp_unslash( $_GET['sent'] ) ) : '';
?>
<section id="inquiry" class="mesh subpage-section">
	<div class="container">
		<div class="section-head reveal">
			<span class="kicker"><?php echo esc_html( chi_txt( 'inquiry_kicker' ) ); ?></span>
			<h2><?php echo esc_html( chi_txt( 'inquiry_title' ) ); ?></h2>
			<p><?php echo esc_html( chi_txt( 'inquiry_intro' ) ); ?></p>
		</div>

		<?php if ( 'ok' === $sent ) : ?>
			<p class="form-notice form-notice--ok"><?php echo esc_html( chi_txt( 'notice_ok' ) ); ?></p>
		<?php elseif ( 'error' === $sent ) : ?>
			<p class="form-notice form-notice--error"><?php echo esc_html( chi_txt( 'notice_error' ) ); ?></p>
		<?php endif; ?>

		<div class="inquiry-grid reveal">
			<form class="contact-form" id="contactForm" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" novalidate>
				<input type="hidden" name="action" value="chi_inquiry" />
				<?php wp_nonce_field( 'chi_inquiry', 'chi_inquiry_nonce' ); ?>

				<div class="field">
					<label for="cf-name"><?php echo esc_html( chi_txt( 'form_name' ) ); ?></label>
					<input type="text" id="cf-name" name="name" placeholder="<?php echo esc_attr( chi_txt( 'form_name_ph' ) ); ?>" required />
				</div>
				<div class="field">
					<label for="cf-email"><?php echo esc_html( chi_txt( 'form_email' ) ); ?></label>
					<input type="email" id="cf-email" name="email" placeholder="you@company.com" required />
				</div>
				<div class="field">
					<label for="cf-company"><?php echo esc_html( chi_txt( 'form_company' ) ); ?></label>
					<input type="text" id="cf-company" name="company" placeholder="<?php echo esc_attr( chi_txt( 'form_company_ph' ) ); ?>" />
				</div>
				<div class="field-row">
					<div class="field">
						<label for="cf-product"><?php echo esc_html( chi_txt( 'form_product' ) ); ?></label>
						<select id="cf-product" name="product">
							<?php foreach ( $chi_products as $p ) : ?>
								<option value="<?php echo esc_attr( $p['name'] ); ?>"><?php echo esc_html( $p['name'] ); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="field">
						<label for="cf-quantity"><?php echo esc_html( chi_txt( 'form_quantity' ) ); ?></label>
						<input type="text" id="cf-quantity" name="quantity" placeholder="<?php echo esc_attr( chi_txt( 'form_quantity_ph' ) ); ?>" />
					</div>
				</div>
				<div class="field">
					<label for="cf-message"><?php echo esc_html( chi_txt( 'form_message' ) ); ?></label>
					<textarea id="cf-message" name="message" placeholder="<?php echo esc_attr( chi_txt( 'form_message_ph' ) ); ?>"></textarea>
				</div>
				<button type="submit" class="btn btn-primary"><?php echo esc_html( chi_txt( 'form_submit' ) ); ?></button>
			</form>

			<aside class="contact-info">
				<h3><?php echo esc_html( chi_txt( 'info_title' ) ); ?></h3>
				<div class="info-item">
					<div class="info-label"><?php echo esc_html( chi_txt( 'info_contact' ) ); ?></div>
					<span><?php echo esc_html( trim( $chi_contact['person'] . ( $chi_contact['role'] ? ' (' . $chi_contact['role'] . ')' : '' ) ) ); ?></span>
				</div>
				<div class="info-item">
					<div class="info-label"><?php echo esc_html( chi_txt( 'info_email' ) ); ?></div>
					<a href="mailto:<?php echo esc_attr( $chi_contact['email'] ); ?>"><?php echo esc_html( $chi_contact['email'] ); ?></a>
				</div>
				<div class="info-item">
					<div class="info-label"><?php echo esc_html( chi_txt( 'info_phone' ) ); ?></div>
					<a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $chi_contact['phone'] ) ); ?>"><?php echo esc_html( $chi_contact['phone'] ); ?></a>
				</div>
				<div class="info-item">
					<div class="info-label"><?php echo esc_html( chi_txt( 'info_address' ) ); ?></div>
					<span><?php echo esc_html( $chi_contact['address'] ); ?></span>
				</div>
			</aside>
		</div>
	</div>
</section>

<?php
get_footer();

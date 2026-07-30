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
			<span class="kicker"><?php echo esc_html( chi_t( 'Inquiry' ) ); ?></span>
			<h2><?php echo esc_html( chi_t( 'Send us an inquiry' ) ); ?></h2>
			<p><?php echo esc_html( chi_t( "Tell us which fruit and quantity you're interested in." ) ); ?></p>
		</div>

		<?php if ( 'ok' === $sent ) : ?>
			<p class="form-notice form-notice--ok"><?php echo esc_html( chi_t( 'Thanks! Your inquiry has been sent.' ) ); ?></p>
		<?php elseif ( 'error' === $sent ) : ?>
			<p class="form-notice form-notice--error"><?php echo esc_html( chi_t( 'Sorry, something went wrong. Please try again or email us directly.' ) ); ?></p>
		<?php endif; ?>

		<div class="inquiry-grid reveal">
			<form class="contact-form" id="contactForm" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" novalidate>
				<input type="hidden" name="action" value="chi_inquiry" />
				<?php wp_nonce_field( 'chi_inquiry', 'chi_inquiry_nonce' ); ?>

				<div class="field">
					<label for="cf-name"><?php echo esc_html( chi_t( 'Your name' ) ); ?></label>
					<input type="text" id="cf-name" name="name" placeholder="<?php echo esc_attr( chi_t( 'Full name' ) ); ?>" required />
				</div>
				<div class="field">
					<label for="cf-email"><?php echo esc_html( chi_t( 'Your email' ) ); ?></label>
					<input type="email" id="cf-email" name="email" placeholder="you@company.com" required />
				</div>
				<div class="field">
					<label for="cf-company"><?php echo esc_html( chi_t( 'Company' ) ); ?></label>
					<input type="text" id="cf-company" name="company" placeholder="<?php echo esc_attr( chi_t( 'Company name' ) ); ?>" />
				</div>
				<div class="field-row">
					<div class="field">
						<label for="cf-product"><?php echo esc_html( chi_t( 'Product of interest' ) ); ?></label>
						<select id="cf-product" name="product">
							<?php foreach ( $chi_products as $p ) : ?>
								<option value="<?php echo esc_attr( $p['name'] ); ?>"><?php echo esc_html( $p['name'] ); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="field">
						<label for="cf-quantity"><?php echo esc_html( chi_t( 'Quantity' ) ); ?></label>
						<input type="text" id="cf-quantity" name="quantity" placeholder="<?php echo esc_attr( chi_t( 'e.g. pallets / tonnes' ) ); ?>" />
					</div>
				</div>
				<div class="field">
					<label for="cf-message"><?php echo esc_html( chi_t( 'Message' ) ); ?></label>
					<textarea id="cf-message" name="message" placeholder="<?php echo esc_attr( chi_t( 'Your message' ) ); ?>"></textarea>
				</div>
				<button type="submit" class="btn btn-primary"><?php echo esc_html( chi_t( 'Send inquiry' ) ); ?></button>
			</form>

			<aside class="contact-info">
				<h3><?php echo esc_html( chi_t( 'Our contact details' ) ); ?></h3>
				<div class="info-item">
					<div class="info-label"><?php echo esc_html( chi_t( 'Contact' ) ); ?></div>
					<span><?php echo esc_html( trim( $chi_contact['person'] . ( $chi_contact['role'] ? ' (' . $chi_contact['role'] . ')' : '' ) ) ); ?></span>
				</div>
				<div class="info-item">
					<div class="info-label"><?php echo esc_html( chi_t( 'Email' ) ); ?></div>
					<a href="mailto:<?php echo esc_attr( $chi_contact['email'] ); ?>"><?php echo esc_html( $chi_contact['email'] ); ?></a>
				</div>
				<div class="info-item">
					<div class="info-label"><?php echo esc_html( chi_t( 'Phone' ) ); ?></div>
					<a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $chi_contact['phone'] ) ); ?>"><?php echo esc_html( $chi_contact['phone'] ); ?></a>
				</div>
				<div class="info-item">
					<div class="info-label"><?php echo esc_html( chi_t( 'Address' ) ); ?></div>
					<span><?php echo esc_html( $chi_contact['address'] ); ?></span>
				</div>
			</aside>
		</div>
	</div>
</section>

<?php
get_footer();

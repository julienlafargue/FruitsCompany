<?php
/**
 * template-parts/contact.php — Section contact de l'accueil (coordonnées).
 * Le formulaire complet est sur la page « Inquiry ».
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$chi_contact = chi_contact();
$inquiry     = get_page_by_path( 'inquiry' );
$inquiry_url = $inquiry ? get_permalink( $inquiry ) : home_url( '/inquiry/' );
?>
<section id="contact" class="mesh">
	<div class="container">
		<div class="section-head reveal">
			<span class="kicker"><?php echo esc_html( chi_t( 'Contact' ) ); ?></span>
			<h2><?php echo esc_html( chi_t( 'Get in touch' ) ); ?></h2>
			<p><?php echo esc_html( chi_t( 'Importer, wholesaler or distributor? Send us an inquiry.' ) ); ?></p>
		</div>

		<div class="contact-single reveal">
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
				<a href="<?php echo esc_url( $inquiry_url ); ?>" class="btn btn-accent"><?php echo esc_html( chi_t( 'Send an inquiry' ) ); ?></a>
			</aside>
		</div>
	</div>
</section>

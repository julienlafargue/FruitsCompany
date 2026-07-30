<?php
/**
 * footer.php — Pied de page (logo à texte blanc, navigation, coordonnées).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$chi_contact = chi_contact();
$inquiry     = get_page_by_path( 'inquiry' );
$inquiry_url = $inquiry ? get_permalink( $inquiry ) : home_url( '/inquiry/' );
?>
</main>

<footer class="site-footer">
	<div class="container">
		<div class="footer-grid">
			<div class="footer-brand">
				<span class="logo" id="footerLogo">
					<img class="logo-img" src="<?php echo esc_url( get_theme_file_uri( 'assets/img/logo-footer.png' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
				</span>
				<p><?php echo esc_html( chi_t( 'Exporter of fresh exotic fruits' ) ); ?></p>
			</div>
			<div>
				<h4><?php echo esc_html( chi_t( 'Navigation' ) ); ?></h4>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/#about' ) ); ?>"><?php echo esc_html( chi_t( 'About us' ) ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/#products' ) ); ?>"><?php echo esc_html( chi_t( 'Our products' ) ); ?></a></li>
					<li><a href="<?php echo esc_url( $inquiry_url ); ?>"><?php echo esc_html( chi_t( 'Contact us' ) ); ?></a></li>
				</ul>
			</div>
			<div>
				<h4><?php echo esc_html( chi_t( 'Contact' ) ); ?></h4>
				<ul>
					<li><a href="mailto:<?php echo esc_attr( $chi_contact['email'] ); ?>"><?php echo esc_html( $chi_contact['email'] ); ?></a></li>
					<li><a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $chi_contact['phone'] ) ); ?>"><?php echo esc_html( $chi_contact['phone'] ); ?></a></li>
				</ul>
			</div>
		</div>
		<div class="footer-bottom">
			<span>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>. <?php echo esc_html( chi_t( 'All rights reserved.' ) ); ?></span>
			<span><?php echo esc_html( chi_t( 'Grown and exported with care from Mauritius' ) ); ?></span>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

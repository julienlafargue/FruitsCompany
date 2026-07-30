<?php
/**
 * front-page.php — Page d'accueil (one-page) : hero + about + produits + contact.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();

get_template_part( 'template-parts/hero' );
get_template_part( 'template-parts/about' );
get_template_part( 'template-parts/products' );
get_template_part( 'template-parts/contact' );

get_footer();

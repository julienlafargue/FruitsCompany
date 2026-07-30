<?php
/**
 * template-parts/hero.php — Section hero (image plein écran + titre + CTA).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$chi_hero_url = chi_image_url( chi_hero_image(), 1900, 1200 );
$inquiry      = get_page_by_path( 'inquiry' );
$inquiry_url  = $inquiry ? get_permalink( $inquiry ) : home_url( '/inquiry/' );

// Titre avec le mot « Fruits » surligné (dégradé animé). Le motif est
// traduisible via Polylang (l'ordre des mots change en FR).
$chi_grad  = '<span class="grad">' . esc_html( chi_t( 'Fruits' ) ) . '</span>';
$chi_title = sprintf( chi_t( 'Fresh %s from the heart of the Indian Ocean' ), $chi_grad );
?>
<section class="hero" id="hero">
	<div class="hero-bg" style="--hero-img:url('<?php echo esc_url( $chi_hero_url ); ?>'); background-image:url('<?php echo esc_url( $chi_hero_url ); ?>');"></div>
	<div class="hero-overlay"></div>
	<svg class="hero-leaf leaf-1" viewBox="0 0 100 100" aria-hidden="true"><path fill="currentColor" d="M96 4C40 9 9 40 4 96c0 0 28-4 49-25S96 30 96 4z"/><path stroke="rgba(255,255,255,.35)" stroke-width="2" fill="none" d="M18 82C40 60 62 38 88 14"/></svg>
	<svg class="hero-leaf leaf-2" viewBox="0 0 100 100" aria-hidden="true"><path fill="currentColor" d="M96 4C40 9 9 40 4 96c0 0 28-4 49-25S96 30 96 4z"/><path stroke="rgba(255,255,255,.35)" stroke-width="2" fill="none" d="M18 82C40 60 62 38 88 14"/></svg>

	<div class="container">
		<h1><?php echo wp_kses_post( $chi_title ); ?></h1>
		<p class="hero-tagline"><?php echo esc_html( chi_t( 'Exporter of fresh exotic fruits' ) ); ?></p>
		<div class="hero-actions">
			<a href="<?php echo esc_url( home_url( '/#products' ) ); ?>" class="btn btn-accent"><?php echo esc_html( chi_t( 'Discover our products' ) ); ?></a>
			<a href="<?php echo esc_url( $inquiry_url ); ?>" class="btn btn-ghost"><?php echo esc_html( chi_t( 'Contact us' ) ); ?></a>
		</div>
	</div>
	<a href="#about" class="hero-scroll" aria-hidden="true">&#9662;</a>
</section>

<?php
/**
 * template-parts/products.php — Section « Nos fruits » (cartes produit).
 * Les produits viennent du CPT chi_product (ou d'un contenu par défaut).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$chi_products = chi_get_products();
?>
<section id="products" class="mesh">
	<div class="container">
		<div class="section-head reveal">
			<span class="kicker"><?php echo esc_html( chi_txt( 'products_kicker' ) ); ?></span>
			<h2><?php echo esc_html( chi_txt( 'products_title' ) ); ?></h2>
		</div>
		<div class="products-grid stagger" id="productsGrid">
			<?php foreach ( $chi_products as $p ) : ?>
				<article class="product-card">
					<div class="product-media">
						<div class="pm-img" style="background-image:url('<?php echo esc_url( chi_image_url( $p['img'], 500, 360 ) ); ?>')"></div>
						<?php if ( ! empty( $p['emoji'] ) ) : ?>
							<div class="pm-emoji" aria-hidden="true"><?php echo esc_html( $p['emoji'] ); ?></div>
						<?php endif; ?>
					</div>
					<div class="product-body">
						<h3><?php echo esc_html( $p['name'] ); ?></h3>
						<div class="product-specs">
							<?php if ( ! empty( $p['season'] ) ) : ?>
								<span class="product-meta"><span class="pm-label"><?php echo esc_html( chi_txt( 'label_season' ) ); ?></span> <?php echo esc_html( $p['season'] ); ?></span>
							<?php endif; ?>
							<?php if ( ! empty( $p['weight'] ) ) : ?>
								<span class="product-meta"><span class="pm-label"><?php echo esc_html( chi_txt( 'label_weight' ) ); ?></span> <?php echo esc_html( $p['weight'] ); ?></span>
							<?php endif; ?>
						</div>
						<?php if ( ! empty( $p['desc'] ) ) : ?>
							<p class="product-desc"><?php echo esc_html( $p['desc'] ); ?></p>
						<?php endif; ?>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

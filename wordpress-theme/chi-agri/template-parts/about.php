<?php
/**
 * template-parts/about.php — Section « À propos » + carrousel + chiffres clés.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$chi_slides = chi_about_slides();
$chi_stats  = chi_stats();
?>
<section id="about" class="mesh">
	<div class="container about-grid">
		<div class="about-text reveal">
			<span class="kicker"><?php echo esc_html( chi_t( 'About us' ) ); ?></span>
			<h2><?php echo esc_html( chi_t( 'Grown and exported with care' ) ); ?></h2>
			<p><?php echo esc_html( chi_t( 'At Chi-Agri, we specialise in exporting premium exotic fruits from Mauritius. From the field to the crate, we manage every step of the process to ensure our fruit arrives fresh and of the highest quality.' ) ); ?></p>
			<p><?php echo esc_html( chi_t( 'We focus exclusively on Victoria pineapples and Passion fruit, sourced directly from Mauritius and delivered to Rungis Market in France.' ) ); ?></p>
		</div>
		<div class="about-visual reveal">
			<div class="carousel" id="aboutCarousel" aria-label="Photos">
				<?php foreach ( $chi_slides as $i => $slide ) : ?>
					<div class="carousel-slide<?php echo 0 === $i ? ' active' : ''; ?>" style="background-image:url('<?php echo esc_url( chi_image_url( $slide, 900, 900 ) ); ?>')"></div>
				<?php endforeach; ?>
			</div>
			<div class="carousel-dots" id="aboutDots">
				<?php foreach ( $chi_slides as $i => $slide ) : ?>
					<button type="button" class="<?php echo 0 === $i ? 'active' : ''; ?>" data-index="<?php echo esc_attr( $i ); ?>" aria-label="Slide <?php echo esc_attr( $i + 1 ); ?>"></button>
				<?php endforeach; ?>
			</div>
		</div>
	</div>

	<div class="container about-stats stagger" id="statsGrid">
		<?php foreach ( $chi_stats as $s ) : ?>
			<div class="about-stat">
				<?php if ( ! empty( $s['icon'] ) ) : ?>
					<div class="stat-icon" aria-hidden="true"><?php echo esc_html( $s['icon'] ); ?></div>
				<?php endif; ?>
				<div class="stat-value" data-target="<?php echo esc_attr( $s['value'] ); ?>" data-suffix="<?php echo esc_attr( $s['suffix'] ); ?>">0<?php echo esc_html( $s['suffix'] ); ?></div>
				<div class="stat-label"><?php echo esc_html( $s['label'] ); ?></div>
			</div>
		<?php endforeach; ?>
	</div>
</section>

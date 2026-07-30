<?php
/**
 * index.php — Gabarit de repli générique (pages, articles, archives).
 * L'accueil utilise front-page.php et la demande page-inquiry.php.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>
<section class="mesh subpage-section">
	<div class="container">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class(); ?>>
					<div class="section-head reveal">
						<h2><?php the_title(); ?></h2>
					</div>
					<div class="entry-content"><?php the_content(); ?></div>
				</article>
				<?php
			endwhile;
		else :
			?>
			<div class="section-head reveal"><h2><?php esc_html_e( 'Nothing here', 'chi-agri' ); ?></h2></div>
			<?php
		endif;
		?>
	</div>
</section>
<?php
get_footer();

<?php
/**
 * header.php — En-tête du site (logo, navigation, sélecteur de langue).
 * Reprend la structure et les classes du site statique.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$chi_is_front = is_front_page();
$chi_lang     = function_exists( 'chi_language_switch' ) ? chi_language_switch() : null;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="icon" type="image/svg+xml" href="<?php echo esc_url( get_theme_file_uri( 'assets/img/favicon.svg' ) ); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header<?php echo $chi_is_front ? '' : ' scrolled'; ?>">
	<div class="container">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" id="headerLogo" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			<?php
			if ( has_custom_logo() ) {
				the_custom_logo();
			} else {
				printf(
					'<img class="logo-img" src="%s" alt="%s" />',
					esc_url( get_theme_file_uri( 'assets/img/logo.png' ) ),
					esc_attr( get_bloginfo( 'name' ) )
				);
			}
			?>
		</a>

		<nav class="main-nav" id="mainNav" aria-label="<?php esc_attr_e( 'Main navigation', 'chi-agri' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'items_wrap'     => '%3$s',
						'depth'          => 1,
					)
				);
			} else {
				// Repli : liens identiques au site statique (one-page + inquiry).
				$inquiry = get_page_by_path( 'inquiry' );
				$inquiry_url = $inquiry ? get_permalink( $inquiry ) : home_url( '/inquiry/' );
				?>
				<a href="<?php echo esc_url( home_url( '/#about' ) ); ?>" data-section="about">
					<span class="nav-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20C4 12 9 5 20 4c0 11-7 16-16 16z"/><path d="M4 20c3-6 7-9 11-11"/></svg></span>
					<span><?php echo esc_html( chi_txt( 'nav_about' ) ); ?></span>
				</a>
				<a href="<?php echo esc_url( home_url( '/#products' ) ); ?>" data-section="products">
					<span class="nav-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 8h14l-1.2 10.2a2 2 0 0 1-2 1.8H8.2a2 2 0 0 1-2-1.8L5 8z"/><path d="M9 8l1.5-4"/><path d="M15 8l-1.5-4"/></svg></span>
					<span><?php echo esc_html( chi_txt( 'nav_products' ) ); ?></span>
				</a>
				<a href="<?php echo esc_url( $inquiry_url ); ?>" data-section="contact">
					<span class="nav-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg></span>
					<span><?php echo esc_html( chi_txt( 'nav_contact' ) ); ?></span>
				</a>
				<?php
			}
			?>
		</nav>

		<div class="header-actions">
			<?php if ( $chi_lang ) : ?>
				<a class="lang-toggle" href="<?php echo esc_url( $chi_lang['url'] ); ?>" aria-label="<?php esc_attr_e( 'Switch language', 'chi-agri' ); ?>"><?php echo esc_html( $chi_lang['label'] ); ?></a>
			<?php endif; ?>
			<button class="nav-toggle" id="navToggle" aria-label="<?php esc_attr_e( 'Menu', 'chi-agri' ); ?>" aria-expanded="false">
				<span></span><span></span><span></span>
			</button>
		</div>
	</div>
</header>

<main id="top">

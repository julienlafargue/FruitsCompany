<?php
/**
 * functions.php — Réglages du thème Chi-Agri.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CHI_AGRI_VERSION', '1.0.0' );

require_once get_theme_file_path( 'inc/helpers.php' );
require_once get_theme_file_path( 'inc/cpt-products.php' );
require_once get_theme_file_path( 'inc/acf-fields.php' );
require_once get_theme_file_path( 'inc/inquiry-form.php' );

/* --- Supports du thème ----------------------------------------------------- */
add_action( 'after_setup_theme', 'chi_setup' );

function chi_setup() {
	load_theme_textdomain( 'chi-agri', get_theme_file_path( 'languages' ) );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 96,
			'width'       => 260,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Menu principal', 'chi-agri' ),
			'footer'  => __( 'Menu footer', 'chi-agri' ),
		)
	);
}

/* --- Assets (CSS/JS + polices) --------------------------------------------- */
add_action( 'wp_enqueue_scripts', 'chi_enqueue_assets' );

function chi_enqueue_assets() {
	// Polices (mêmes que le site statique).
	wp_enqueue_style(
		'chi-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Oswald:wght@300;400&family=Poppins:wght@600;700;800&display=swap',
		array(),
		null
	);

	// Feuille principale (reprise à l'identique du site statique).
	wp_enqueue_style(
		'chi-main',
		get_theme_file_uri( 'assets/css/style.css' ),
		array( 'chi-fonts' ),
		CHI_AGRI_VERSION
	);

	// En-tête de thème (obligatoire pour WordPress).
	wp_enqueue_style( 'chi-style', get_stylesheet_uri(), array( 'chi-main' ), CHI_AGRI_VERSION );

	// JS allégé (carrousel, menu mobile, reveal, header scrolled).
	wp_enqueue_script(
		'chi-site',
		get_theme_file_uri( 'assets/js/site.js' ),
		array(),
		CHI_AGRI_VERSION,
		true
	);
}

/* --- Polylang : enregistrement des chaînes d'interface --------------------- */
add_action( 'init', 'chi_register_strings' );

function chi_register_strings() {
	if ( ! function_exists( 'pll_register_string' ) ) {
		return;
	}
	$strings = array(
		'Fresh %s from the heart of the Indian Ocean',
		'Fruits',
		'Discover our products',
		'Contact us',
		'Exporter of fresh exotic fruits',
		'Grown and exported with care',
		"At Chi-Agri, we specialise in exporting premium exotic fruits from Mauritius. From the field to the crate, we manage every step of the process to ensure our fruit arrives fresh and of the highest quality.",
		'We focus exclusively on Victoria pineapples and Passion fruit, sourced directly from Mauritius and delivered to Rungis Market in France.',
		'About us',
		'Our products',
		'Our fruit',
		'Season',
		'Weight',
		'Year-round',
		'Contact',
		'Get in touch',
		'Importer, wholesaler or distributor? Send us an inquiry.',
		'Send an inquiry',
		'Our contact details',
		'Email',
		'Phone',
		'Address',
		'Inquiry',
		'Send us an inquiry',
		"Tell us which fruit and quantity you're interested in.",
		'Navigation',
		'All rights reserved.',
		'Grown and exported with care from Mauritius',
		'Exotic fruits',
		'Harvest to dispatch',
		'Grown in Mauritius',
		'Traceable to the plot',
		'Victoria Pineapple',
		'Passion Fruit',
		'Your name',
		'Full name',
		'Your email',
		'Company',
		'Company name',
		'Product of interest',
		'Quantity',
		'e.g. pallets / tonnes',
		'Message',
		'Your message',
		'Send inquiry',
		'Thanks! Your inquiry has been sent.',
		'Sorry, something went wrong. Please try again or email us directly.',
		'Grown on selected partner farms in Mauritius. Small, golden and very sweet, with a soft core and low acidity.',
		'Deep purple skin and bright, aromatic pulp. Grown in Mauritius and hand-picked when fully ripe.',
	);
	foreach ( $strings as $s ) {
		pll_register_string( 'chi-agri', $s, 'Chi-Agri', strlen( $s ) > 60 );
	}
}

/**
 * Sélecteur de langue (EN/FR) rendu dans le header, si Polylang est actif.
 * Renvoie l'URL vers l'autre langue et son libellé (drapeau).
 *
 * @return array|null { url, label }
 */
function chi_language_switch() {
	if ( ! function_exists( 'pll_the_languages' ) || ! function_exists( 'pll_current_language' ) ) {
		return null;
	}
	$langs = pll_the_languages( array( 'raw' => 1, 'hide_current' => 1 ) );
	if ( empty( $langs ) ) {
		return null;
	}
	$other = reset( $langs );
	$flags = array( 'en' => '🇬🇧 EN', 'fr' => '🇫🇷 FR' );
	$slug  = isset( $other['slug'] ) ? $other['slug'] : '';
	return array(
		'url'   => isset( $other['url'] ) ? $other['url'] : '#',
		'label' => isset( $flags[ $slug ] ) ? $flags[ $slug ] : strtoupper( $slug ),
	);
}

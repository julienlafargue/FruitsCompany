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

/* --- Provisionnement à l'activation du thème ------------------------------- */
add_action( 'after_switch_theme', 'chi_provision_pages' );

/**
 * Crée la page « Inquiry » (slug = inquiry → utilise page-inquiry.php) si elle
 * n'existe pas encore, afin que le formulaire fonctionne dès l'activation du
 * thème, sans dépendre de l'outil de dev mu-plugins/chi-seed.php.
 */
function chi_provision_pages() {
	if ( get_page_by_path( 'inquiry' ) ) {
		return;
	}
	wp_insert_post(
		array(
			'post_title'   => 'Inquiry',
			'post_name'    => 'inquiry',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		)
	);
}

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

/*
 * NB : la gestion bilingue (EN/FR) est autonome — voir inc/helpers.php
 * (chi_lang, chi_txt, chi_language_switch). Polylang n'est plus requis.
 */

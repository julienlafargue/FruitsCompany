<?php
/**
 * helpers.php — Fonctions utilitaires du thème Chi-Agri.
 *
 * Objectif : rendre le contenu éditable via ACF/Polylang tout en gardant des
 * valeurs par défaut identiques au site statique. Ainsi, le thème affiche le
 * site complet même sur une installation vierge (sans ACF configuré).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Lit un champ ACF avec repli sur une valeur par défaut.
 *
 * @param string $name    Nom du champ ACF.
 * @param mixed  $default Valeur par défaut (contenu actuel du site).
 * @param mixed  $post_id ID de post ou 'option' (page d'options ACF).
 * @return mixed
 */
function chi_field( $name, $default = '', $post_id = false ) {
	if ( function_exists( 'get_field' ) ) {
		$value = $post_id ? get_field( $name, $post_id ) : get_field( $name );
		if ( null !== $value && '' !== $value && array() !== $value ) {
			return $value;
		}
	}
	return $default;
}

/**
 * Traduit une chaîne d'interface via Polylang si présent, sinon renvoie la
 * chaîne telle quelle. Enregistrée côté admin via pll_register_string().
 *
 * @param string $text Texte source (langue par défaut).
 * @return string
 */
function chi_t( $text ) {
	if ( function_exists( 'pll__' ) ) {
		return pll__( $text );
	}
	return $text;
}

/**
 * Résout une valeur d'image en URL utilisable — équivalent du resolveImage()
 * du site statique.
 *  - Identifiant Unsplash "photo-xxxx"  → URL Unsplash redimensionnée
 *  - ID de pièce jointe WordPress (int) → URL de la taille demandée
 *  - Chemin "assets/..." ou URL absolue → renvoyé tel quel (préfixé du thème
 *    si chemin relatif d'assets)
 *
 * @param mixed $src Valeur d'image.
 * @param int   $w   Largeur souhaitée.
 * @param int   $h   Hauteur souhaitée (0 = auto).
 * @return string
 */
function chi_image_url( $src, $w = 1200, $h = 0 ) {
	if ( empty( $src ) ) {
		return '';
	}

	// Pièce jointe WordPress (ID numérique ou tableau ACF image).
	if ( is_array( $src ) && isset( $src['url'] ) ) {
		return $src['url'];
	}
	if ( is_numeric( $src ) ) {
		$url = wp_get_attachment_image_url( (int) $src, 'full' );
		return $url ? $url : '';
	}

	// Identifiant Unsplash.
	if ( 0 === strpos( $src, 'photo-' ) ) {
		$size = 'auto=format&fit=crop&q=75&w=' . intval( $w ) . ( $h ? '&h=' . intval( $h ) : '' );
		return 'https://images.unsplash.com/' . $src . '?' . $size;
	}

	// Chemin d'assets du thème.
	if ( 0 === strpos( $src, 'assets/' ) ) {
		return get_theme_file_uri( $src );
	}

	// URL absolue ou autre chemin : renvoyé tel quel.
	return $src;
}

/**
 * Coordonnées de contact (page d'options ACF), avec valeurs par défaut.
 *
 * @return array
 */
function chi_contact() {
	return array(
		'person'  => chi_field( 'contact_person', 'Jaysen Chinapyel', 'option' ),
		'role'    => chi_field( 'contact_role', 'Director', 'option' ),
		'email'   => chi_field( 'contact_email', 'chiagri_Mauritius@gmail.com', 'option' ),
		'phone'   => chi_field( 'contact_phone', '+230 57803810', 'option' ),
		'address' => chi_field( 'contact_address', 'Sanashee Towers, Reserve Street, Port Louis, Mauritius', 'option' ),
	);
}

/**
 * Chiffres clés (repeater ACF), avec valeurs par défaut = contenu actuel.
 *
 * @return array[] { value, suffix, icon, label }
 */
function chi_stats() {
	$default = array(
		array(
			'value'  => 2,
			'suffix' => '+',
			'icon'   => '🍍',
			'label'  => chi_t( 'Exotic fruits' ),
		),
		array(
			'value'  => 48,
			'suffix' => 'h',
			'icon'   => '⏱️',
			'label'  => chi_t( 'Harvest to dispatch' ),
		),
		array(
			'value'  => 100,
			'suffix' => '%',
			'icon'   => '🇲🇺',
			'label'  => chi_t( 'Grown in Mauritius' ),
		),
		array(
			'value'  => 100,
			'suffix' => '%',
			'icon'   => '📍',
			'label'  => chi_t( 'Traceable to the plot' ),
		),
	);

	$rows = chi_field( 'stats', array(), 'option' );
	if ( empty( $rows ) || ! is_array( $rows ) ) {
		return $default;
	}

	$out = array();
	foreach ( $rows as $r ) {
		$out[] = array(
			'value'  => isset( $r['value'] ) ? $r['value'] : 0,
			'suffix' => isset( $r['suffix'] ) ? $r['suffix'] : '',
			'icon'   => isset( $r['icon'] ) ? $r['icon'] : '',
			'label'  => isset( $r['label'] ) ? $r['label'] : '',
		);
	}
	return $out;
}

/**
 * Slides du carrousel « À propos ». Champ ACF (galerie ou repeater d'images)
 * avec repli sur les identifiants Unsplash actuels.
 *
 * @return array Liste de valeurs d'image (ID pièce jointe, "photo-…", URL).
 */
function chi_about_slides() {
	$default = array(
		'photo-1694592014176-0ef0c28274f2',
		'photo-1576380021180-4b60fb58e7ea',
		'photo-1502009285422-74e42ac2fd68',
		'photo-1562157244-acec728ea5b2',
	);
	$slides = chi_field( 'about_slides', array(), 'option' );
	if ( empty( $slides ) || ! is_array( $slides ) ) {
		return $default;
	}
	// Normalise (galerie ACF = tableaux d'images, ou IDs).
	return array_map(
		function ( $s ) {
			if ( is_array( $s ) && isset( $s['ID'] ) ) {
				return (int) $s['ID'];
			}
			if ( is_array( $s ) && isset( $s['image'] ) ) {
				return $s['image'];
			}
			return $s;
		},
		$slides
	);
}

/**
 * Image de fond du hero, avec repli.
 *
 * @return string valeur d'image (ID, "photo-…" ou URL).
 */
function chi_hero_image() {
	return chi_field( 'hero_image', 'photo-1513415277900-a62401e19be4', 'option' );
}

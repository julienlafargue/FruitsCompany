<?php
/**
 * settings.php — Page de réglages du thème SANS ACF PRO.
 *
 * Les « Options Pages » d'ACF étant réservées à ACF PRO, on stocke les réglages
 * globaux (textes, coordonnées, images, chiffres) dans une fiche unique d'un
 * type de contenu privé « chi_settings ». Les champs ACF (gratuits) s'affichent
 * sur l'écran d'édition de cette fiche, accessible via le menu « Chi-Agri ».
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* --- Type de contenu privé pour les réglages ------------------------------- */
add_action( 'init', 'chi_register_settings_cpt' );

function chi_register_settings_cpt() {
	register_post_type(
		'chi_settings',
		array(
			'labels'          => array(
				'name'          => __( 'Chi-Agri', 'chi-agri' ),
				'singular_name' => __( 'Réglages', 'chi-agri' ),
			),
			'public'          => false,
			'show_ui'         => true,
			'show_in_menu'    => false, // menu ajouté manuellement (lien direct).
			'supports'        => array( 'title' ),
			'capability_type' => 'post',
			'map_meta_cap'    => true,
		)
	);
}

/**
 * Renvoie l'ID de la fiche de réglages (la crée si nécessaire, en admin).
 *
 * @param bool|null $create Forcer/empêcher la création. Par défaut : uniquement
 *                          en admin (jamais sur une requête front).
 * @return int 0 si absente et non créée.
 */
function chi_settings_id( $create = null ) {
	$id = (int) get_option( 'chi_settings_id' );
	if ( $id && get_post_status( $id ) ) {
		return $id;
	}

	$existing = get_posts(
		array(
			'post_type'   => 'chi_settings',
			'numberposts' => 1,
			'fields'      => 'ids',
			'post_status' => 'any',
		)
	);
	if ( ! empty( $existing ) ) {
		update_option( 'chi_settings_id', (int) $existing[0] );
		return (int) $existing[0];
	}

	$create = is_null( $create ) ? is_admin() : $create;
	if ( ! $create ) {
		return 0;
	}

	$new = wp_insert_post(
		array(
			'post_type'   => 'chi_settings',
			'post_title'  => __( 'Réglages du site', 'chi-agri' ),
			'post_status' => 'publish',
		)
	);
	if ( $new && ! is_wp_error( $new ) ) {
		update_option( 'chi_settings_id', (int) $new );
		return (int) $new;
	}
	return 0;
}

/**
 * Lit un réglage global (fiche chi_settings) avec repli sur un défaut.
 *
 * @param string $name    Nom du champ.
 * @param mixed  $default Valeur par défaut.
 * @return mixed
 */
function chi_opt( $name, $default = '' ) {
	$id = chi_settings_id();
	if ( ! $id ) {
		return $default;
	}
	return chi_field( $name, $default, $id );
}

/* --- Menu « Chi-Agri » : lien direct vers l'édition de la fiche ------------- */
add_action( 'admin_menu', 'chi_settings_menu' );

function chi_settings_menu() {
	$id   = chi_settings_id();
	$slug = $id ? 'post.php?post=' . $id . '&action=edit' : 'edit.php?post_type=chi_settings';
	add_menu_page(
		__( 'Chi-Agri', 'chi-agri' ),
		__( 'Chi-Agri', 'chi-agri' ),
		'edit_theme_options',
		$slug,
		'',
		'dashicons-palmtree',
		3
	);
}

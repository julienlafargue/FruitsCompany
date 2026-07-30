<?php
/**
 * acf-fields.php — Définition des champs éditables (ACF, en PHP).
 *
 * Nécessite le plugin « Advanced Custom Fields » (gratuit). Sans lui, le thème
 * fonctionne quand même : les helpers (chi_field) retombent sur les valeurs par
 * défaut. Avec ACF, l'utilisateur édite tout depuis l'admin.
 *
 * - Page d'options « Chi-Agri » : coordonnées, image hero, carrousel, chiffres.
 * - Champs du produit (CPT chi_product) : saison, poids, emoji, description.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* --- Page d'options ACF ---------------------------------------------------- */
add_action( 'acf/init', 'chi_register_options_page' );

function chi_register_options_page() {
	if ( ! function_exists( 'acf_add_options_page' ) ) {
		return;
	}
	acf_add_options_page(
		array(
			'page_title' => __( 'Réglages Chi-Agri', 'chi-agri' ),
			'menu_title' => __( 'Chi-Agri', 'chi-agri' ),
			'menu_slug'  => 'chi-agri-settings',
			'capability' => 'edit_theme_options',
			'icon_url'   => 'dashicons-palmtree',
			'position'   => 3,
			'redirect'   => false,
		)
	);
}

/* --- Champs ---------------------------------------------------------------- */
add_action( 'acf/init', 'chi_register_fields' );

function chi_register_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	// Coordonnées + images du site (page d'options).
	acf_add_local_field_group(
		array(
			'key'      => 'group_chi_options',
			'title'    => __( 'Contenu du site', 'chi-agri' ),
			'fields'   => array(
				array( 'key' => 'field_chi_contact_person', 'label' => 'Contact — nom', 'name' => 'contact_person', 'type' => 'text' ),
				array( 'key' => 'field_chi_contact_role', 'label' => 'Contact — fonction', 'name' => 'contact_role', 'type' => 'text' ),
				array( 'key' => 'field_chi_contact_email', 'label' => 'Email', 'name' => 'contact_email', 'type' => 'email' ),
				array( 'key' => 'field_chi_contact_phone', 'label' => 'Téléphone', 'name' => 'contact_phone', 'type' => 'text' ),
				array( 'key' => 'field_chi_contact_address', 'label' => 'Adresse', 'name' => 'contact_address', 'type' => 'textarea', 'rows' => 2 ),
				array( 'key' => 'field_chi_hero_image', 'label' => 'Image du hero (fond)', 'name' => 'hero_image', 'type' => 'image', 'return_format' => 'id' ),
				array(
					'key'          => 'field_chi_about_slides',
					'label'        => 'Carrousel « À propos »',
					'name'         => 'about_slides',
					'type'         => 'gallery',
					'return_format'=> 'id',
					'insert'       => 'append',
				),
				array(
					'key'        => 'field_chi_stats',
					'label'      => 'Chiffres clés',
					'name'       => 'stats',
					'type'       => 'repeater',
					'layout'     => 'table',
					'button_label' => 'Ajouter un chiffre',
					'sub_fields' => array(
						array( 'key' => 'field_chi_stat_value', 'label' => 'Valeur', 'name' => 'value', 'type' => 'number' ),
						array( 'key' => 'field_chi_stat_suffix', 'label' => 'Suffixe', 'name' => 'suffix', 'type' => 'text' ),
						array( 'key' => 'field_chi_stat_icon', 'label' => 'Emoji', 'name' => 'icon', 'type' => 'text' ),
						array( 'key' => 'field_chi_stat_label', 'label' => 'Libellé', 'name' => 'label', 'type' => 'text' ),
					),
				),
			),
			'location' => array(
				array(
					array( 'param' => 'options_page', 'operator' => '==', 'value' => 'chi-agri-settings' ),
				),
			),
		)
	);

	// Champs du produit.
	acf_add_local_field_group(
		array(
			'key'      => 'group_chi_product',
			'title'    => __( 'Détails du produit', 'chi-agri' ),
			'fields'   => array(
				array(
					'key'          => 'field_chi_product_img_src',
					'label'        => 'Photo de secours (si pas d\'image à la une)',
					'name'         => 'product_img_src',
					'type'         => 'text',
					'instructions' => 'Optionnel. Identifiant Unsplash « photo-… » ou URL. Utilisé seulement si aucune image à la une n\'est définie.',
				),
				array( 'key' => 'field_chi_product_season', 'label' => 'Saison', 'name' => 'product_season', 'type' => 'text' ),
				array( 'key' => 'field_chi_product_weight', 'label' => 'Poids', 'name' => 'product_weight', 'type' => 'text' ),
				array( 'key' => 'field_chi_product_emoji', 'label' => 'Emoji', 'name' => 'product_emoji', 'type' => 'text' ),
				array( 'key' => 'field_chi_product_desc', 'label' => 'Description', 'name' => 'product_desc', 'type' => 'textarea', 'rows' => 3 ),
			),
			'location' => array(
				array(
					array( 'param' => 'post_type', 'operator' => '==', 'value' => 'chi_product' ),
				),
			),
		)
	);
}

<?php
/**
 * acf-fields.php — Champs éditables (ACF, en PHP).
 *
 * Nécessite le plugin « Advanced Custom Fields » (gratuit). Sans lui, le thème
 * fonctionne quand même (repli sur les valeurs par défaut). Avec ACF, tout est
 * éditable depuis le menu « Chi-Agri », y compris les textes EN et FR.
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

	/* ---- Groupe options : Général / Images / Chiffres / Textes ---- */
	$fields = array();

	// Onglet « Général ».
	$fields[] = array( 'key' => 'field_chi_tab_general', 'label' => 'Général', 'type' => 'tab' );
	$fields[] = array(
		'key'     => 'field_chi_default_lang',
		'label'   => 'Langue par défaut',
		'name'    => 'default_lang',
		'type'    => 'select',
		'choices' => array( 'en' => 'English', 'fr' => 'Français' ),
		'default_value' => 'en',
	);
	$fields[] = array( 'key' => 'field_chi_contact_person', 'label' => 'Contact — nom', 'name' => 'contact_person', 'type' => 'text', 'default_value' => 'Jaysen Chinapyel' );
	$fields[] = array( 'key' => 'field_chi_contact_role', 'label' => 'Contact — fonction', 'name' => 'contact_role', 'type' => 'text', 'default_value' => 'Director' );
	$fields[] = array( 'key' => 'field_chi_contact_email', 'label' => 'Email', 'name' => 'contact_email', 'type' => 'email', 'default_value' => 'chiagri_Mauritius@gmail.com' );
	$fields[] = array( 'key' => 'field_chi_contact_phone', 'label' => 'Téléphone', 'name' => 'contact_phone', 'type' => 'text', 'default_value' => '+230 57803810' );
	$fields[] = array( 'key' => 'field_chi_contact_address', 'label' => 'Adresse', 'name' => 'contact_address', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Sanashee Towers, Reserve Street, Port Louis, Mauritius' );

	// Onglet « Images ».
	$fields[] = array( 'key' => 'field_chi_tab_images', 'label' => 'Images', 'type' => 'tab' );
	$fields[] = array( 'key' => 'field_chi_hero_image', 'label' => 'Image du hero (fond)', 'name' => 'hero_image', 'type' => 'image', 'return_format' => 'id' );
	$fields[] = array( 'key' => 'field_chi_about_slides', 'label' => 'Carrousel « À propos »', 'name' => 'about_slides', 'type' => 'gallery', 'return_format' => 'id', 'insert' => 'append' );

	// Onglet « Chiffres clés ».
	$fields[] = array( 'key' => 'field_chi_tab_stats', 'label' => 'Chiffres clés', 'type' => 'tab' );
	$fields[] = array(
		'key'          => 'field_chi_stats',
		'label'        => 'Chiffres clés',
		'name'         => 'stats',
		'type'         => 'repeater',
		'layout'       => 'table',
		'button_label' => 'Ajouter un chiffre',
		'sub_fields'   => array(
			array( 'key' => 'field_chi_stat_value', 'label' => 'Valeur', 'name' => 'value', 'type' => 'number' ),
			array( 'key' => 'field_chi_stat_suffix', 'label' => 'Suffixe', 'name' => 'suffix', 'type' => 'text' ),
			array( 'key' => 'field_chi_stat_icon', 'label' => 'Emoji', 'name' => 'icon', 'type' => 'text' ),
			array( 'key' => 'field_chi_stat_label_en', 'label' => 'Libellé (EN)', 'name' => 'label_en', 'type' => 'text' ),
			array( 'key' => 'field_chi_stat_label_fr', 'label' => 'Libellé (FR)', 'name' => 'label_fr', 'type' => 'text' ),
		),
	);

	// Onglet « Textes » : paires EN/FR générées depuis le dictionnaire.
	$fields[] = array( 'key' => 'field_chi_tab_texts', 'label' => 'Textes', 'type' => 'tab' );
	foreach ( chi_text_defaults() as $key => $data ) {
		$is_long = strlen( $data['en'] ) > 90;
		$type    = $is_long ? 'textarea' : 'text';
		$fields[] = array(
			'key'           => 'field_txt_' . $key . '_en',
			'label'         => $data['label'] . ' — EN',
			'name'          => 'txt_' . $key . '_en',
			'type'          => $type,
			'rows'          => 3,
			'default_value' => $data['en'],
			'wrapper'       => array( 'width' => '50' ),
		);
		$fields[] = array(
			'key'           => 'field_txt_' . $key . '_fr',
			'label'         => $data['label'] . ' — FR',
			'name'          => 'txt_' . $key . '_fr',
			'type'          => $type,
			'rows'          => 3,
			'default_value' => $data['fr'],
			'wrapper'       => array( 'width' => '50' ),
		);
	}

	acf_add_local_field_group(
		array(
			'key'      => 'group_chi_options',
			'title'    => __( 'Contenu du site', 'chi-agri' ),
			'fields'   => $fields,
			'location' => array(
				array(
					array( 'param' => 'options_page', 'operator' => '==', 'value' => 'chi-agri-settings' ),
				),
			),
		)
	);

	/* ---- Champs du produit (bilingues) ---- */
	acf_add_local_field_group(
		array(
			'key'      => 'group_chi_product',
			'title'    => __( 'Détails du produit', 'chi-agri' ),
			'fields'   => array(
				array( 'key' => 'field_chi_product_name_en', 'label' => 'Nom (EN)', 'name' => 'product_name_en', 'type' => 'text', 'instructions' => 'Laisser vide pour reprendre le titre du produit.' ),
				array( 'key' => 'field_chi_product_name_fr', 'label' => 'Nom (FR)', 'name' => 'product_name_fr', 'type' => 'text' ),
				array( 'key' => 'field_chi_product_img_src', 'label' => "Photo de secours (si pas d'image à la une)", 'name' => 'product_img_src', 'type' => 'text', 'instructions' => 'Optionnel. Identifiant Unsplash « photo-… » ou URL.' ),
				array( 'key' => 'field_chi_product_emoji', 'label' => 'Emoji', 'name' => 'product_emoji', 'type' => 'text' ),
				array( 'key' => 'field_chi_product_weight', 'label' => 'Poids', 'name' => 'product_weight', 'type' => 'text' ),
				array( 'key' => 'field_chi_product_season_en', 'label' => 'Saison (EN)', 'name' => 'product_season_en', 'type' => 'text' ),
				array( 'key' => 'field_chi_product_season_fr', 'label' => 'Saison (FR)', 'name' => 'product_season_fr', 'type' => 'text' ),
				array( 'key' => 'field_chi_product_desc_en', 'label' => 'Description (EN)', 'name' => 'product_desc_en', 'type' => 'textarea', 'rows' => 3 ),
				array( 'key' => 'field_chi_product_desc_fr', 'label' => 'Description (FR)', 'name' => 'product_desc_fr', 'type' => 'textarea', 'rows' => 3 ),
			),
			'location' => array(
				array(
					array( 'param' => 'post_type', 'operator' => '==', 'value' => 'chi_product' ),
				),
			),
		)
	);
}

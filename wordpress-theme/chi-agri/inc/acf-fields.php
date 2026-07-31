<?php
/**
 * acf-fields.php — Champs éditables (ACF **gratuit**, en PHP).
 *
 * N'utilise QUE des types de champs gratuits (text, textarea, select, image) —
 * pas de Répéteur / Galerie / Options Page (réservés à ACF PRO). Les réglages
 * globaux s'affichent sur la fiche « chi_settings » (menu « Chi-Agri »).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'acf/init', 'chi_register_fields' );

function chi_register_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$fields = array();

	/* ---- Onglet « Général » ---- */
	$fields[] = array( 'key' => 'field_chi_tab_general', 'label' => 'Général', 'type' => 'tab' );
	$fields[] = array( 'key' => 'field_chi_default_lang', 'label' => 'Langue par défaut', 'name' => 'default_lang', 'type' => 'select', 'choices' => array( 'en' => 'English', 'fr' => 'Français' ), 'default_value' => 'en' );
	$fields[] = array( 'key' => 'field_chi_contact_person', 'label' => 'Contact — nom', 'name' => 'contact_person', 'type' => 'text', 'default_value' => 'Jaysen Chinapyel' );
	$fields[] = array( 'key' => 'field_chi_contact_role', 'label' => 'Contact — fonction', 'name' => 'contact_role', 'type' => 'text', 'default_value' => 'Director' );
	$fields[] = array( 'key' => 'field_chi_contact_email', 'label' => 'Email', 'name' => 'contact_email', 'type' => 'email', 'default_value' => 'chiagri_Mauritius@gmail.com' );
	$fields[] = array( 'key' => 'field_chi_contact_phone', 'label' => 'Téléphone', 'name' => 'contact_phone', 'type' => 'text', 'default_value' => '+230 57803810' );
	$fields[] = array( 'key' => 'field_chi_contact_address', 'label' => 'Adresse', 'name' => 'contact_address', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Sanashee Towers, Reserve Street, Port Louis, Mauritius' );

	/* ---- Onglet « Images » (champs image simples) ---- */
	$fields[] = array( 'key' => 'field_chi_tab_images', 'label' => 'Images', 'type' => 'tab' );
	$fields[] = array( 'key' => 'field_chi_hero_image', 'label' => 'Image du hero (fond)', 'name' => 'hero_image', 'type' => 'image', 'return_format' => 'id' );
	$fields[] = array( 'key' => 'field_chi_slides_msg', 'label' => 'Carrousel « À propos »', 'type' => 'message', 'message' => 'Jusqu\'à 5 photos (les vides sont ignorées).' );
	for ( $i = 1; $i <= 5; $i++ ) {
		$fields[] = array( 'key' => 'field_chi_slide_' . $i, 'label' => 'Carrousel — photo ' . $i, 'name' => 'slide_' . $i, 'type' => 'image', 'return_format' => 'id', 'wrapper' => array( 'width' => '20' ) );
	}

	/* ---- Onglet « Chiffres clés » (4 blocs fixes) ---- */
	$fields[] = array( 'key' => 'field_chi_tab_stats', 'label' => 'Chiffres clés', 'type' => 'tab' );
	$stat_defaults = array(
		1 => array( 2, '+', '🍍', 'Exotic fruits', 'Fruits exotiques' ),
		2 => array( 48, 'h', '⏱️', 'Harvest to dispatch', "De la récolte à l'expédition" ),
		3 => array( 100, '%', '🇲🇺', 'Grown in Mauritius', "Cultivé à l'île Maurice" ),
		4 => array( 100, '%', '📍', 'Traceable to the plot', "Traçable jusqu'à la parcelle" ),
	);
	foreach ( $stat_defaults as $i => $d ) {
		$fields[] = array( 'key' => 'field_chi_stat_' . $i . '_msg', 'label' => 'Chiffre ' . $i, 'type' => 'message', 'message' => '' );
		$fields[] = array( 'key' => 'field_chi_stat_' . $i . '_value', 'label' => 'Valeur', 'name' => 'stat_' . $i . '_value', 'type' => 'number', 'default_value' => $d[0], 'wrapper' => array( 'width' => '20' ) );
		$fields[] = array( 'key' => 'field_chi_stat_' . $i . '_suffix', 'label' => 'Suffixe', 'name' => 'stat_' . $i . '_suffix', 'type' => 'text', 'default_value' => $d[1], 'wrapper' => array( 'width' => '15' ) );
		$fields[] = array( 'key' => 'field_chi_stat_' . $i . '_icon', 'label' => 'Emoji', 'name' => 'stat_' . $i . '_icon', 'type' => 'text', 'default_value' => $d[2], 'wrapper' => array( 'width' => '15' ) );
		$fields[] = array( 'key' => 'field_chi_stat_' . $i . '_label_en', 'label' => 'Libellé EN', 'name' => 'stat_' . $i . '_label_en', 'type' => 'text', 'default_value' => $d[3], 'wrapper' => array( 'width' => '25' ) );
		$fields[] = array( 'key' => 'field_chi_stat_' . $i . '_label_fr', 'label' => 'Libellé FR', 'name' => 'stat_' . $i . '_label_fr', 'type' => 'text', 'default_value' => $d[4], 'wrapper' => array( 'width' => '25' ) );
	}

	/* ---- Onglet « Textes » : paires EN/FR ---- */
	$fields[] = array( 'key' => 'field_chi_tab_texts', 'label' => 'Textes', 'type' => 'tab' );
	foreach ( chi_text_defaults() as $key => $data ) {
		$type = strlen( $data['en'] ) > 90 ? 'textarea' : 'text';
		$fields[] = array( 'key' => 'field_txt_' . $key . '_en', 'label' => $data['label'] . ' — EN', 'name' => 'txt_' . $key . '_en', 'type' => $type, 'rows' => 3, 'default_value' => $data['en'], 'wrapper' => array( 'width' => '50' ) );
		$fields[] = array( 'key' => 'field_txt_' . $key . '_fr', 'label' => $data['label'] . ' — FR', 'name' => 'txt_' . $key . '_fr', 'type' => $type, 'rows' => 3, 'default_value' => $data['fr'], 'wrapper' => array( 'width' => '50' ) );
	}

	acf_add_local_field_group(
		array(
			'key'      => 'group_chi_settings',
			'title'    => __( 'Contenu du site', 'chi-agri' ),
			'fields'   => $fields,
			'location' => array(
				array(
					array( 'param' => 'post_type', 'operator' => '==', 'value' => 'chi_settings' ),
				),
			),
			'menu_order'            => 0,
			'hide_on_screen'        => array( 'permalink', 'the_content', 'excerpt', 'discussion', 'comments', 'slug', 'author' ),
		)
	);

	/* ---- Champs du produit (types gratuits) ---- */
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

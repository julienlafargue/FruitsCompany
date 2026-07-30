<?php
/**
 * Plugin Name: Chi-Agri Seed (dev)
 * Description: Crée la page « Inquiry » et quelques produits de démonstration
 *              au premier chargement, pour tester le thème localement. À ne pas
 *              déployer en production (dossier mu-plugins de dev uniquement).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'chi_seed_content', 99 );

function chi_seed_content() {
	if ( get_option( 'chi_seed_done' ) ) {
		return;
	}
	// Attendre que le CPT soit enregistré.
	if ( ! post_type_exists( 'chi_product' ) ) {
		return;
	}

	// Page « Inquiry » (slug = inquiry → utilise page-inquiry.php).
	if ( ! get_page_by_path( 'inquiry' ) ) {
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

	// Produits de démonstration (repli identique au site statique).
	$products = array(
		array(
			'title'     => 'Victoria Pineapple',
			'name_fr'   => 'Ananas Victoria',
			'season_en' => 'Year-round',
			'season_fr' => "Toute l'année",
			'weight'    => '550-800 g',
			'emoji'     => '🍍',
			'img'       => 'photo-1490885578174-acda8905c2c6',
			'desc_en'   => 'Grown on selected partner farms in Mauritius. Small, golden and very sweet, with a soft core and low acidity.',
			'desc_fr'   => "Cultivé dans des fermes partenaires sélectionnées à l'île Maurice. Petit, doré et très sucré, à cœur tendre et peu acide.",
		),
		array(
			'title'     => 'Passion Fruit',
			'name_fr'   => 'Fruit de la Passion',
			'season_en' => 'Year-round',
			'season_fr' => "Toute l'année",
			'weight'    => '550-800 g',
			'emoji'     => '🟣',
			'img'       => 'photo-1502009285422-74e42ac2fd68',
			'desc_en'   => 'Deep purple skin and bright, aromatic pulp. Grown in Mauritius and hand-picked when fully ripe.',
			'desc_fr'   => "Peau pourpre et pulpe parfumée. Cultivé à l'île Maurice et cueilli à la main à pleine maturité.",
		),
	);

	// Meta → clé de champ ACF (pour que get_field reconnaisse les valeurs).
	$refs = array(
		'product_name_fr'   => 'field_chi_product_name_fr',
		'product_img_src'   => 'field_chi_product_img_src',
		'product_emoji'     => 'field_chi_product_emoji',
		'product_weight'    => 'field_chi_product_weight',
		'product_season_en' => 'field_chi_product_season_en',
		'product_season_fr' => 'field_chi_product_season_fr',
		'product_desc_en'   => 'field_chi_product_desc_en',
		'product_desc_fr'   => 'field_chi_product_desc_fr',
	);

	$existing = get_posts( array( 'post_type' => 'chi_product', 'numberposts' => 1, 'fields' => 'ids' ) );
	if ( empty( $existing ) ) {
		foreach ( $products as $order => $p ) {
			$id = wp_insert_post(
				array(
					'post_title'  => $p['title'],
					'post_status' => 'publish',
					'post_type'   => 'chi_product',
					'menu_order'  => $order,
				)
			);
			if ( $id && ! is_wp_error( $id ) ) {
				$meta = array(
					'product_name_fr'   => $p['name_fr'],
					'product_img_src'   => $p['img'],
					'product_emoji'     => $p['emoji'],
					'product_weight'    => $p['weight'],
					'product_season_en' => $p['season_en'],
					'product_season_fr' => $p['season_fr'],
					'product_desc_en'   => $p['desc_en'],
					'product_desc_fr'   => $p['desc_fr'],
				);
				foreach ( $meta as $k => $v ) {
					update_post_meta( $id, $k, $v );
					update_post_meta( $id, '_' . $k, $refs[ $k ] );
				}
			}
		}
	}

	update_option( 'chi_seed_done', 1 );
}

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
			'title'  => 'Victoria Pineapple',
			'season' => 'Year-round',
			'weight' => '550-800 g',
			'emoji'  => '🍍',
			'img'    => 'photo-1490885578174-acda8905c2c6',
			'desc'   => 'Grown on selected partner farms in Mauritius. Small, golden and very sweet, with a soft core and low acidity.',
		),
		array(
			'title'  => 'Passion Fruit',
			'season' => 'Year-round',
			'weight' => '550-800 g',
			'emoji'  => '🟣',
			'img'    => 'photo-1502009285422-74e42ac2fd68',
			'desc'   => 'Deep purple skin and bright, aromatic pulp. Grown in Mauritius and hand-picked when fully ripe.',
		),
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
				// Champs (ACF si présent, sinon meta simple lue par chi_field fallback).
				update_post_meta( $id, 'product_season', $p['season'] );
				update_post_meta( $id, 'product_weight', $p['weight'] );
				update_post_meta( $id, 'product_emoji', $p['emoji'] );
				update_post_meta( $id, 'product_img_src', $p['img'] );
				update_post_meta( $id, 'product_desc', $p['desc'] );
			}
		}
	}

	update_option( 'chi_seed_done', 1 );
}

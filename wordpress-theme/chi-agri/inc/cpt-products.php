<?php
/**
 * cpt-products.php — Custom Post Type « Produits ».
 *
 * Remplace le tableau PRODUCTS de js/content.js. Chaque produit devient un
 * post éditable (titre, image à la une, + champs ACF saison/poids/emoji/desc),
 * traduisible via Polylang.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'chi_register_products_cpt' );

function chi_register_products_cpt() {
	$labels = array(
		'name'               => __( 'Produits', 'chi-agri' ),
		'singular_name'      => __( 'Produit', 'chi-agri' ),
		'add_new'            => __( 'Ajouter un produit', 'chi-agri' ),
		'add_new_item'       => __( 'Ajouter un produit', 'chi-agri' ),
		'edit_item'          => __( 'Modifier le produit', 'chi-agri' ),
		'new_item'           => __( 'Nouveau produit', 'chi-agri' ),
		'view_item'          => __( 'Voir le produit', 'chi-agri' ),
		'search_items'       => __( 'Rechercher un produit', 'chi-agri' ),
		'not_found'          => __( 'Aucun produit', 'chi-agri' ),
		'menu_name'          => __( 'Produits', 'chi-agri' ),
	);

	register_post_type(
		'chi_product',
		array(
			'labels'       => $labels,
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => true,
			'show_in_rest' => true, // éditeur de blocs + API.
			'menu_icon'    => 'dashicons-carrot',
			'menu_position'=> 22,
			'supports'     => array( 'title', 'thumbnail', 'page-attributes' ),
			'has_archive'  => false,
			'rewrite'      => false,
		)
	);
}

/**
 * Retourne les produits à afficher (CPT), avec repli sur le contenu par défaut
 * (identique au site statique) si aucun produit n'a encore été créé.
 *
 * @return array[] { name, img, season, weight, emoji, desc }
 */
function chi_get_products() {
	$query = new WP_Query(
		array(
			'post_type'      => 'chi_product',
			'posts_per_page' => -1,
			'orderby'        => 'menu_order title',
			'order'          => 'ASC',
			'no_found_rows'  => true,
		)
	);

	if ( $query->have_posts() ) {
		$out = array();
		foreach ( $query->posts as $post ) {
			$thumb = get_post_thumbnail_id( $post->ID );
			$out[] = array(
				'name'   => get_the_title( $post ),
				'img'    => $thumb ? (int) $thumb : chi_field( 'product_img_src', '', $post->ID ),
				'season' => chi_field( 'product_season', '', $post->ID ),
				'weight' => chi_field( 'product_weight', '', $post->ID ),
				'emoji'  => chi_field( 'product_emoji', '', $post->ID ),
				'desc'   => chi_field( 'product_desc', '', $post->ID ),
			);
		}
		wp_reset_postdata();
		return $out;
	}

	// Repli : contenu par défaut = js/content.js actuel.
	return array(
		array(
			'name'   => chi_t( 'Victoria Pineapple' ),
			'img'    => 'photo-1490885578174-acda8905c2c6',
			'season' => chi_t( 'Year-round' ),
			'weight' => '550-800 g',
			'emoji'  => '🍍',
			'desc'   => chi_t( 'Grown on selected partner farms in Mauritius. Small, golden and very sweet, with a soft core and low acidity.' ),
		),
		array(
			'name'   => chi_t( 'Passion Fruit' ),
			'img'    => 'photo-1502009285422-74e42ac2fd68',
			'season' => chi_t( 'Year-round' ),
			'weight' => '550-800 g',
			'emoji'  => '🟣',
			'desc'   => chi_t( 'Deep purple skin and bright, aromatic pulp. Grown in Mauritius and hand-picked when fully ripe.' ),
		),
	);
}

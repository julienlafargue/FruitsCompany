<?php
/**
 * helpers.php — Fonctions utilitaires du thème Chi-Agri.
 *
 * Système bilingue AUTONOME (sans dépendre de Polylang) :
 *  - la langue courante vient d'un cookie (basculé par ?lang=fr / ?lang=en) ;
 *  - chaque texte a une version EN et une version FR, éditables dans l'admin
 *    (menu « Chi-Agri »), avec repli sur le contenu actuel du site.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ==========================================================================
   LANGUE
   ========================================================================== */

/**
 * Bascule la langue si ?lang=xx est présent (pose un cookie) — appelé sur init.
 */
function chi_maybe_set_lang() {
	if ( isset( $_GET['lang'] ) ) {
		$lang = 'fr' === $_GET['lang'] ? 'fr' : 'en';
		setcookie( 'chi_lang', $lang, time() + YEAR_IN_SECONDS, COOKIEPATH ? COOKIEPATH : '/' );
		$_COOKIE['chi_lang'] = $lang;
	}
}
add_action( 'init', 'chi_maybe_set_lang' );

/**
 * Langue courante : 'en' ou 'fr'.
 *
 * @return string
 */
function chi_lang() {
	if ( isset( $_COOKIE['chi_lang'] ) && in_array( $_COOKIE['chi_lang'], array( 'en', 'fr' ), true ) ) {
		return $_COOKIE['chi_lang'];
	}
	$def = chi_opt( 'default_lang', 'en' );
	return 'fr' === $def ? 'fr' : 'en';
}

/**
 * Lien de bascule de langue (vers l'AUTRE langue) + libellé (drapeau).
 *
 * @return array { url, label }
 */
function chi_language_switch() {
	$other = 'fr' === chi_lang() ? 'en' : 'fr';
	$flags = array( 'en' => '🇬🇧 EN', 'fr' => '🇫🇷 FR' );
	return array(
		'url'   => esc_url_raw( add_query_arg( 'lang', $other ) ),
		'label' => $flags[ $other ],
	);
}

/* ==========================================================================
   CHAMPS ACF (avec repli sur valeurs par défaut)
   ========================================================================== */

/**
 * Lit un champ ACF avec repli sur une valeur par défaut.
 *
 * @param string $name    Nom du champ ACF.
 * @param mixed  $default Valeur par défaut.
 * @param mixed  $post_id ID de post ou 'option'.
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

/* ==========================================================================
   TEXTES BILINGUES
   ========================================================================== */

/**
 * Dictionnaire des textes éditables : clé => { label, en, fr }.
 * Les valeurs EN/FR servent de défaut (= contenu actuel du site) ET de
 * valeur pré-remplie dans l'admin. Le titre du hero met le mot surligné
 * entre accolades { } (dégradé animé).
 *
 * @return array
 */
function chi_text_defaults() {
	return array(
		// Hero
		'hero_title'    => array( 'label' => 'Hero — titre (mot surligné entre { })', 'en' => 'Fresh {Fruits} from the heart of the Indian Ocean', 'fr' => "{Fruits} frais venu du cœur de l'océan Indien" ),
		'hero_tagline'  => array( 'label' => 'Hero — accroche', 'en' => 'Exporter of fresh exotic fruits', 'fr' => 'Exportateur de fruits exotiques frais' ),
		'btn_discover'  => array( 'label' => 'Bouton — découvrir', 'en' => 'Discover our products', 'fr' => 'Découvrir nos produits' ),
		'btn_contact'   => array( 'label' => 'Bouton — contact', 'en' => 'Contact us', 'fr' => 'Nous contacter' ),
		// Navigation
		'nav_about'     => array( 'label' => 'Menu — à propos', 'en' => 'About', 'fr' => 'À propos' ),
		'nav_products'  => array( 'label' => 'Menu — produits', 'en' => 'Products', 'fr' => 'Produits' ),
		'nav_contact'   => array( 'label' => 'Menu — contact', 'en' => 'Contact us', 'fr' => 'Nous contacter' ),
		// À propos
		'about_kicker'  => array( 'label' => 'À propos — étiquette', 'en' => 'About us', 'fr' => 'À propos' ),
		'about_title'   => array( 'label' => 'À propos — titre', 'en' => 'Grown and exported with care', 'fr' => 'Cultivé et exporté avec soin' ),
		'about_p1'      => array( 'label' => 'À propos — paragraphe 1', 'en' => 'At Chi-Agri, we specialise in exporting premium exotic fruits from Mauritius. From the field to the crate, we manage every step of the process to ensure our fruit arrives fresh and of the highest quality.', 'fr' => "Chez Chi-Agri, nous sommes spécialisés dans l'export de fruits exotiques premium de l'île Maurice. Du champ à la caisse, nous gérons chaque étape pour garantir un fruit frais et de la plus haute qualité." ),
		'about_p2'      => array( 'label' => 'À propos — paragraphe 2', 'en' => 'We focus exclusively on Victoria pineapples and Passion fruit, sourced directly from Mauritius and delivered to Rungis Market in France.', 'fr' => "Nous nous concentrons exclusivement sur l'ananas Victoria et le fruit de la passion, sourcés directement à Maurice et livrés au marché de Rungis en France." ),
		// Produits
		'products_kicker' => array( 'label' => 'Produits — étiquette', 'en' => 'Our products', 'fr' => 'Nos produits' ),
		'products_title'  => array( 'label' => 'Produits — titre', 'en' => 'Our fruit', 'fr' => 'Nos fruits' ),
		'label_season'    => array( 'label' => 'Libellé — saison', 'en' => 'Season', 'fr' => 'Saison' ),
		'label_weight'    => array( 'label' => 'Libellé — poids', 'en' => 'Weight', 'fr' => 'Poids' ),
		// Contact (accueil)
		'contact_kicker'  => array( 'label' => 'Contact — étiquette', 'en' => 'Contact', 'fr' => 'Contact' ),
		'contact_title'   => array( 'label' => 'Contact — titre', 'en' => 'Get in touch', 'fr' => 'Contactez-nous' ),
		'contact_intro'   => array( 'label' => 'Contact — intro', 'en' => 'Importer, wholesaler or distributor? Send us an inquiry.', 'fr' => 'Importateur, grossiste ou distributeur ? Envoyez-nous une demande.' ),
		'contact_send'    => array( 'label' => 'Contact — bouton demande', 'en' => 'Send an inquiry', 'fr' => 'Envoyer une demande' ),
		'info_title'      => array( 'label' => 'Coordonnées — titre', 'en' => 'Our contact details', 'fr' => 'Nos coordonnées' ),
		'info_contact'    => array( 'label' => 'Coordonnées — contact', 'en' => 'Contact', 'fr' => 'Contact' ),
		'info_email'      => array( 'label' => 'Coordonnées — email', 'en' => 'Email', 'fr' => 'Email' ),
		'info_phone'      => array( 'label' => 'Coordonnées — téléphone', 'en' => 'Phone', 'fr' => 'Téléphone' ),
		'info_address'    => array( 'label' => 'Coordonnées — adresse', 'en' => 'Address', 'fr' => 'Adresse' ),
		// Page demande + formulaire
		'inquiry_kicker'  => array( 'label' => 'Demande — étiquette', 'en' => 'Inquiry', 'fr' => 'Demande' ),
		'inquiry_title'   => array( 'label' => 'Demande — titre', 'en' => 'Send us an inquiry', 'fr' => 'Envoyez-nous une demande' ),
		'inquiry_intro'   => array( 'label' => 'Demande — intro', 'en' => "Tell us which fruit and quantity you're interested in.", 'fr' => 'Indiquez-nous le fruit et la quantité qui vous intéressent.' ),
		'form_name'       => array( 'label' => 'Formulaire — nom', 'en' => 'Your name', 'fr' => 'Votre nom' ),
		'form_name_ph'    => array( 'label' => 'Formulaire — nom (indice)', 'en' => 'Full name', 'fr' => 'Nom complet' ),
		'form_email'      => array( 'label' => 'Formulaire — email', 'en' => 'Your email', 'fr' => 'Votre email' ),
		'form_company'    => array( 'label' => 'Formulaire — société', 'en' => 'Company', 'fr' => 'Société' ),
		'form_company_ph' => array( 'label' => 'Formulaire — société (indice)', 'en' => 'Company name', 'fr' => 'Nom de la société' ),
		'form_product'    => array( 'label' => 'Formulaire — produit', 'en' => 'Product of interest', 'fr' => 'Produit concerné' ),
		'form_quantity'   => array( 'label' => 'Formulaire — quantité', 'en' => 'Quantity', 'fr' => 'Quantité' ),
		'form_quantity_ph'=> array( 'label' => 'Formulaire — quantité (indice)', 'en' => 'e.g. pallets / tonnes', 'fr' => 'ex. palettes / tonnes' ),
		'form_message'    => array( 'label' => 'Formulaire — message', 'en' => 'Message', 'fr' => 'Message' ),
		'form_message_ph' => array( 'label' => 'Formulaire — message (indice)', 'en' => 'Your message', 'fr' => 'Votre message' ),
		'form_submit'     => array( 'label' => 'Formulaire — bouton', 'en' => 'Send inquiry', 'fr' => 'Envoyer la demande' ),
		'notice_ok'       => array( 'label' => 'Formulaire — message succès', 'en' => 'Thanks! Your inquiry has been sent.', 'fr' => 'Merci ! Votre demande a bien été envoyée.' ),
		'notice_error'    => array( 'label' => 'Formulaire — message erreur', 'en' => 'Sorry, something went wrong. Please try again or email us directly.', 'fr' => "Désolé, une erreur est survenue. Réessayez ou écrivez-nous directement." ),
		// Footer
		'footer_tagline'  => array( 'label' => 'Footer — accroche', 'en' => 'Exporter of fresh exotic fruits', 'fr' => 'Exportateur de fruits exotiques frais' ),
		'footer_nav'      => array( 'label' => 'Footer — titre navigation', 'en' => 'Navigation', 'fr' => 'Navigation' ),
		'footer_contact'  => array( 'label' => 'Footer — titre contact', 'en' => 'Contact', 'fr' => 'Contact' ),
		'footer_rights'   => array( 'label' => 'Footer — droits', 'en' => 'All rights reserved.', 'fr' => 'Tous droits réservés.' ),
		'footer_made'     => array( 'label' => 'Footer — signature', 'en' => 'Grown and exported with care from Mauritius', 'fr' => "Cultivé et exporté avec soin depuis l'île Maurice" ),
	);
}

/**
 * Renvoie un texte dans la langue courante : valeur éditée (ACF) sinon défaut.
 *
 * @param string $key Clé du dictionnaire.
 * @return string
 */
function chi_txt( $key ) {
	$lang = chi_lang();
	$val  = chi_opt( 'txt_' . $key . '_' . $lang, '' );
	if ( '' !== $val ) {
		return $val;
	}
	$defaults = chi_text_defaults();
	if ( isset( $defaults[ $key ] ) ) {
		return isset( $defaults[ $key ][ $lang ] ) ? $defaults[ $key ][ $lang ] : $defaults[ $key ]['en'];
	}
	return '';
}

/* ==========================================================================
   IMAGES / DONNÉES
   ========================================================================== */

/**
 * Résout une valeur d'image en URL (ID pièce jointe, "photo-…" Unsplash, URL).
 */
function chi_image_url( $src, $w = 1200, $h = 0 ) {
	if ( empty( $src ) ) {
		return '';
	}
	if ( is_array( $src ) && isset( $src['url'] ) ) {
		return $src['url'];
	}
	if ( is_numeric( $src ) ) {
		$url = wp_get_attachment_image_url( (int) $src, 'full' );
		return $url ? $url : '';
	}
	if ( 0 === strpos( $src, 'photo-' ) ) {
		$size = 'auto=format&fit=crop&q=75&w=' . intval( $w ) . ( $h ? '&h=' . intval( $h ) : '' );
		return 'https://images.unsplash.com/' . $src . '?' . $size;
	}
	if ( 0 === strpos( $src, 'assets/' ) ) {
		return get_theme_file_uri( $src );
	}
	return $src;
}

/**
 * Coordonnées de contact (identiques dans les deux langues).
 *
 * @return array
 */
function chi_contact() {
	return array(
		'person'  => chi_opt( 'contact_person', 'Jaysen Chinapyel' ),
		'role'    => chi_opt( 'contact_role', 'Director' ),
		'email'   => chi_opt( 'contact_email', 'chiagri_Mauritius@gmail.com' ),
		'phone'   => chi_opt( 'contact_phone', '+230 57803810' ),
		'address' => chi_opt( 'contact_address', 'Sanashee Towers, Reserve Street, Port Louis, Mauritius' ),
	);
}

/**
 * Chiffres clés (repeater ACF, libellé bilingue), défaut = contenu actuel.
 *
 * @return array[] { value, suffix, icon, label }
 */
function chi_stats() {
	$lang = chi_lang();

	$default = array(
		array( 'value' => 2, 'suffix' => '+', 'icon' => '🍍', 'label' => 'en' === $lang ? 'Exotic fruits' : 'Fruits exotiques' ),
		array( 'value' => 48, 'suffix' => 'h', 'icon' => '⏱️', 'label' => 'en' === $lang ? 'Harvest to dispatch' : "De la récolte à l'expédition" ),
		array( 'value' => 100, 'suffix' => '%', 'icon' => '🇲🇺', 'label' => 'en' === $lang ? 'Grown in Mauritius' : "Cultivé à l'île Maurice" ),
		array( 'value' => 100, 'suffix' => '%', 'icon' => '📍', 'label' => 'en' === $lang ? 'Traceable to the plot' : "Traçable jusqu'à la parcelle" ),
	);

	// 4 blocs fixes (champs gratuits : le Répéteur est réservé à ACF PRO).
	$out = array();
	for ( $i = 1; $i <= 4; $i++ ) {
		$value = chi_opt( 'stat_' . $i . '_value', '' );
		$label = chi_opt( 'stat_' . $i . '_label_' . $lang, '' );
		if ( '' === $value && '' === $label ) {
			continue; // bloc vide → ignoré.
		}
		$out[] = array(
			'value'  => '' === $value ? 0 : $value,
			'suffix' => chi_opt( 'stat_' . $i . '_suffix', '' ),
			'icon'   => chi_opt( 'stat_' . $i . '_icon', '' ),
			'label'  => $label,
		);
	}
	return empty( $out ) ? $default : $out;
}

/**
 * Slides du carrousel « À propos ».
 *
 * @return array
 */
function chi_about_slides() {
	$default = array(
		'photo-1694592014176-0ef0c28274f2',
		'photo-1576380021180-4b60fb58e7ea',
		'photo-1502009285422-74e42ac2fd68',
		'photo-1562157244-acec728ea5b2',
	);
	// 5 champs image (la Galerie est réservée à ACF PRO).
	$slides = array();
	for ( $i = 1; $i <= 5; $i++ ) {
		$img = chi_opt( 'slide_' . $i, '' );
		if ( ! empty( $img ) ) {
			$slides[] = $img;
		}
	}
	return empty( $slides ) ? $default : $slides;
}

/**
 * Image de fond du hero.
 *
 * @return string
 */
function chi_hero_image() {
	return chi_opt( 'hero_image', 'photo-1513415277900-a62401e19be4' );
}

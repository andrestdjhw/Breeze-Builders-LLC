<?php
/**
 * Breeze Builders — theme functions
 *
 * @package Breeze
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'BREEZE_VER', '0.1.0' );
define( 'BREEZE_DIR', get_template_directory() );
define( 'BREEZE_URI', get_template_directory_uri() );

/**
 * Theme setup.
 */
function breeze_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'breeze' ),
		'footer'  => __( 'Footer Menu', 'breeze' ),
	) );
}
add_action( 'after_setup_theme', 'breeze_setup' );

/**
 * Enqueue styles & scripts with filemtime() cache-busting (828 convention).
 */
function breeze_assets() {
	// Fonts — Fraunces (display serif) + Inter (body).
	wp_enqueue_style(
		'breeze-fonts',
		'https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	$tokens = BREEZE_DIR . '/assets/css/tokens.css';
	$main   = BREEZE_DIR . '/assets/css/main.css';
	$js     = BREEZE_DIR . '/assets/js/main.js';

	wp_enqueue_style( 'breeze-tokens', BREEZE_URI . '/assets/css/tokens.css', array(), file_exists( $tokens ) ? filemtime( $tokens ) : BREEZE_VER );
	wp_enqueue_style( 'breeze-main', BREEZE_URI . '/assets/css/main.css', array( 'breeze-tokens' ), file_exists( $main ) ? filemtime( $main ) : BREEZE_VER );
	wp_enqueue_script( 'breeze-main', BREEZE_URI . '/assets/js/main.js', array(), file_exists( $js ) ? filemtime( $js ) : BREEZE_VER, true );
}
add_action( 'wp_enqueue_scripts', 'breeze_assets' );

/**
 * NAP / brand config — single source of truth for phone, email, service area.
 * TODO(#2,#8,#9): replace placeholders with confirmed client data.
 */
function breeze_config( $key = null ) {
	$config = array(
		'brand'         => 'Breeze Builders',           // legal: Breeze Builders LLC; DBA "Breeze Builders GC" — confirm lockup (open item #6)
		'phone_display' => '(702) 491-4767',            // confirm as primary NAP line (#2)
		'phone_href'    => '+17024914767',
		'email'         => 'info@breezebuildersgc.com', // owner/business email pending (open item #1)
		'license'       => 'NV License B + C-2',         // exact numbers pending (#8)
		'insured'       => 'GL · WC · Umbrella',
		'since'         => '2021',
		'team'          => '14',
		'address'       => '871 Coronado Center Drive, Suite 200, Henderson, NV 89052',
		'cities'        => array( 'Henderson', 'Las Vegas', 'North Las Vegas', 'Summerlin', 'Green Valley', 'Anthem', 'Seven Hills', 'Southern Highlands' ),
		'extended'      => 'California · Arizona (by project)', // confirm CSLB/ROC + cities before publishing (#3/#10)
		'domain'        => 'breezebuildersgc.com',
		// Hero background video — path relative to /wp-content/ (works on local + production).
		'hero_video'    => '/uploads/2026/07/blured-handyman-give-you-screwdriver-in-blue-studi-2025-12-17-05-38-55-utc.mp4',
		'hero_poster'   => '', // optional: first-frame image for faster paint / reduced-motion fallback
		// Service page hero backgrounds — paths relative to /wp-content/.
		'hero_images'   => array(
			'remodeling'         => '/uploads/2026/07/Remodeling-scaled.jpg',
			'hvac'               => '/uploads/2026/07/HVAC-scaled.jpg',
			'electrical'         => '/uploads/2026/07/Electrical-scaled.jpg',
			'general-contractor' => '/uploads/2026/07/GeneralContracting-scaled.jpg',
		),
		// Front-page "Serving the valley" section background.
		'serving_bg'    => '/uploads/2026/07/ServingAreasBreeze-scaled.webp',
		'social'        => array(   // URLs pendientes (Daniel las pasa); '#' deja los links presentes pero inertes
			'facebook'  => '#',
			'tiktok'    => '#',
			'instagram' => '#',
		),
	);
	if ( $key ) {
		return isset( $config[ $key ] ) ? $config[ $key ] : '';
	}
	return $config;
}

/**
 * Render a template part with args. Thin wrapper for readability.
 *
 * @param string $slug File in /template-parts (without extension).
 * @param array  $args Passed to the part as $args.
 */
function breeze_part( $slug, $args = array() ) {
	get_template_part( 'template-parts/' . $slug, null, $args );
}

/**
 * Get a service hero background image path by key (remodeling, hvac, electrical, general-contractor).
 *
 * @param string $key Service key as defined in breeze_config('hero_images').
 * @return string Path relative to /wp-content/, or '' if not set.
 */
function breeze_hero_image( $key ) {
	$images = breeze_config( 'hero_images' );
	return isset( $images[ $key ] ) ? $images[ $key ] : '';
}

/**
 * Render the social icon links (Facebook, TikTok, Instagram).
 * URLs come from breeze_config('social'); a '#' value renders the icon but stays inert.
 * Used by both the header utility bar and the footer.
 *
 * @param string $classname Wrapper class (e.g. 'utility-bar__social' or 'footer-social').
 */
function breeze_social_links( $classname = 'social-links' ) {
	$social = breeze_config( 'social' );
	$icons  = array(
		'facebook'  => '<path d="M22 12a10 10 0 10-11.56 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.78l-.44 2.89h-2.34v6.99A10 10 0 0022 12z"/>',
		'tiktok'    => '<path d="M16.5 3c.3 2 1.62 3.57 3.5 3.86v2.64c-1.3.08-2.55-.35-3.66-1.05v5.92c0 3.02-2.2 5.63-5.28 5.63-3 0-5.18-2.48-5.18-5.4 0-3.13 2.53-5.42 5.6-5.1v2.72c-.32-.1-.66-.16-1-.16-1.4 0-2.5 1.16-2.5 2.6 0 1.48 1.1 2.6 2.5 2.6 1.48 0 2.6-1.2 2.6-2.72V3h3.42z"/>',
		'instagram' => '<rect x="3.2" y="3.2" width="17.6" height="17.6" rx="5" fill="none" stroke="currentColor" stroke-width="1.8"/><circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="1.8"/><circle cx="17.2" cy="6.8" r="1.2"/>',
	);
	$labels = array( 'facebook' => 'Facebook', 'tiktok' => 'TikTok', 'instagram' => 'Instagram' );

	echo '<div class="' . esc_attr( $classname ) . '">';
	foreach ( $icons as $key => $svg ) {
		$url = isset( $social[ $key ] ) ? $social[ $key ] : '#';
		echo '<a href="' . esc_url( $url ) . '" target="_blank" rel="noopener noreferrer" aria-label="' . esc_attr( $labels[ $key ] ) . '">';
		echo '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false">' . $svg . '</svg>'; // phpcs:ignore -- static inline icon markup
		echo '</a>';
	}
	echo '</div>';
}

/**
 * Body classes for page-type styling hooks.
 */
function breeze_body_classes( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'is-home';
	}
	if ( is_page_template( array( 'template-remodeling.php', 'template-hvac.php', 'template-electrical.php', 'template-general-contractor.php' ) ) ) {
		$classes[] = 'is-service';
	}
	return $classes;
}
add_filter( 'body_class', 'breeze_body_classes' );

/**
 * LocalBusiness JSON-LD for local SEO (brief §12: LocalBusiness + service-area schema).
 * areaServed anchors NV; CA/AZ intentionally omitted until CSLB/ROC confirmed (#10).
 */
function breeze_schema() {
	$schema = array(
		'@context'      => 'https://schema.org',
		'@type'         => 'GeneralContractor',
		'name'          => breeze_config( 'brand' ),
		'legalName'     => 'Breeze Builders LLC',
		'telephone'     => breeze_config( 'phone_href' ),
		'email'         => breeze_config( 'email' ),
		'url'           => home_url( '/' ),
		'foundingDate'  => breeze_config( 'since' ),
		'address'       => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => '871 Coronado Center Drive, Suite 200',
			'addressLocality' => 'Henderson',
			'addressRegion'   => 'NV',
			'postalCode'      => '89052',
			'addressCountry'  => 'US',
		),
		'areaServed'    => array_map( function ( $c ) {
			return array( '@type' => 'City', 'name' => $c );
		}, breeze_config( 'cities' ) ),
		'makesOffer'    => array( 'Remodeling', 'HVAC', 'Electrical', 'General Contracting' ),
	);
	echo "\n" . '<script type="application/ld+json">' . wp_json_encode( $schema ) . '</script>' . "\n";
}
add_action( 'wp_head', 'breeze_schema' );
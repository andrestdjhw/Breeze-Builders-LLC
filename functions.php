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

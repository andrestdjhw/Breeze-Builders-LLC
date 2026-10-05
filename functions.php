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

require_once BREEZE_DIR . '/inc/services.php';
require_once BREEZE_DIR . '/inc/faqs.php';
require_once BREEZE_DIR . '/inc/locations.php';

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
	// Fonts — Tomorrow (display/headings). Body uses Arial (system font, no load needed).
	wp_enqueue_style(
		'breeze-fonts',
		'https://fonts.googleapis.com/css2?family=Tomorrow:wght@500;600;700&display=swap',
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
		// Palette "El Plano Maestro" (confirmed): MIDNIGHT #0C3A59 · EMBER #D84545 · SAND #DDD0C0 · SLATE #575859 · BREEZE #D3E3F0 · UMBER #3D0606
		'phone_display' => '(702) 491-4767',            // confirm as primary NAP line (#2)
		'phone_href'    => '+17024914767',
		'email'         => 'info@breezebuildersgc.com', // owner/business email pending (open item #1)
		'email_topbar'  => 'info@breezebuilders.com',   // shown in the top bar per client; differs from 'email' (…gc.com) — confirm which is correct
		'license'       => 'NV License B + C-2',         // exact numbers pending (#8)
		'insured'       => 'GL · WC · Umbrella',
		'since'         => '2021',
		'team'          => '14',
		'address'       => '871 Coronado Center Drive, Suite 200, Henderson, NV 89052',
		'cities'        => array( 'Henderson', 'Las Vegas', 'North Las Vegas', 'Summerlin', 'Green Valley', 'Anthem', 'Seven Hills', 'Southern Highlands' ),
		'extended'      => 'California · Arizona (by project)', // confirm CSLB/ROC + cities before publishing (#3/#10)
		'domain'        => 'breezebuildersgc.com',
		'logo'          => '/uploads/2026/10/BB_isologo-scaled.png', // brand isologo (relative to /wp-content/)
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
 * Responsive src/srcset for an uploads path (relative to /wp-content/), so small slots
 * (e.g. carousel cards) don't download and decode the full 2560px "-scaled" original.
 *
 * @param string $path Upload path relative to /wp-content/.
 * @param string $size Registered image size used for src.
 * @return array{src:string,srcset:string} srcset is '' if the file isn't a known attachment.
 */
function breeze_image_set( $path, $size = 'medium_large' ) {
	$url = content_url( $path );
	$id  = attachment_url_to_postid( $url );
	if ( ! $id ) {
		return array( 'src' => $url, 'srcset' => '' );
	}
	$src = wp_get_attachment_image_url( $id, $size );
	return array(
		'src'    => $src ? $src : $url,
		'srcset' => (string) wp_get_attachment_image_srcset( $id, $size ),
	);
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
/**
 * Leads — every estimate request is stored as a private "Lead" in wp-admin
 * (so nothing is lost if email delivery fails) and emailed to breeze_config('email').
 */
function breeze_register_leads() {
	register_post_type( 'breeze_lead', array(
		'labels'          => array( 'name' => 'Leads', 'singular_name' => 'Lead' ),
		'public'          => false,
		'show_ui'         => true,
		'menu_icon'       => 'dashicons-email-alt',
		'supports'        => array( 'title', 'editor' ),
		'capability_type' => 'post',
		'capabilities'    => array( 'create_posts' => 'do_not_allow' ), // leads only come from the form
		'map_meta_cap'    => true,
	) );
}
add_action( 'init', 'breeze_register_leads' );

/**
 * Handle the estimate form (admin-post.php?action=breeze_lead), then redirect back
 * to the page with ?lead=sent|invalid|error so the form can show a notice.
 */
function breeze_handle_lead() {
	$back = isset( $_POST['redirect'] ) ? esc_url_raw( wp_unslash( $_POST['redirect'] ) ) : home_url( '/' );
	$back = wp_validate_redirect( $back, home_url( '/' ) );
	$hash = isset( $_POST['anchor'] ) ? '#' . sanitize_html_class( wp_unslash( $_POST['anchor'] ) ) : '';
	$go   = function ( $status ) use ( $back, $hash ) {
		wp_safe_redirect( add_query_arg( 'lead', $status, $back ) . $hash );
		exit;
	};

	if ( ! isset( $_POST['breeze_lead_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['breeze_lead_nonce'] ) ), 'breeze_lead' ) ) {
		$go( 'error' );
	}
	// Honeypot filled → a bot. Pretend it worked.
	if ( ! empty( $_POST['company'] ) ) {
		$go( 'sent' );
	}

	$fields = array(
		'name'    => isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '',
		'phone'   => isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '',
		'email'   => isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '',
		'city'    => isset( $_POST['city'] ) ? sanitize_text_field( wp_unslash( $_POST['city'] ) ) : '',
		'service' => isset( $_POST['service'] ) ? sanitize_text_field( wp_unslash( $_POST['service'] ) ) : '',
		'details' => isset( $_POST['details'] ) ? sanitize_textarea_field( wp_unslash( $_POST['details'] ) ) : '',
	);
	if ( '' === $fields['name'] || '' === $fields['phone'] ) {
		$go( 'invalid' );
	}

	$body = sprintf(
		"Name: %s\nPhone: %s\nEmail: %s\nCity / ZIP: %s\nService: %s\n\nProject details:\n%s\n\nSent from: %s",
		$fields['name'], $fields['phone'], $fields['email'] ? $fields['email'] : '-', $fields['city'] ? $fields['city'] : '-',
		$fields['service'], $fields['details'] ? $fields['details'] : '-', $back
	);
	$title = sprintf( '%s — %s (%s)', $fields['name'], $fields['service'], $fields['phone'] );

	$saved = wp_insert_post( array(
		'post_type'    => 'breeze_lead',
		'post_status'  => 'private',
		'post_title'   => $title,
		'post_content' => $body,
	) );

	$headers = $fields['email'] ? array( 'Reply-To: ' . $fields['name'] . ' <' . $fields['email'] . '>' ) : array();
	$mailed  = wp_mail( breeze_config( 'email' ), 'New estimate request: ' . $title, $body, $headers );

	$go( ( $saved && ! is_wp_error( $saved ) ) || $mailed ? 'sent' : 'error' );
}
add_action( 'admin_post_nopriv_breeze_lead', 'breeze_handle_lead' );
add_action( 'admin_post_breeze_lead', 'breeze_handle_lead' );

/**
 * Legal pages — slug => [title, page template]. Linked from the footer.
 */
function breeze_legal_pages() {
	return array(
		'privacy-policy'       => array( 'Privacy Policy', 'template-privacy-policy.php' ),
		'terms-and-conditions' => array( 'Terms & Conditions', 'template-terms-conditions.php' ),
	);
}

/**
 * Every page the theme provisions itself: legal pages + FAQs + Locations (nav).
 */
function breeze_auto_pages() {
	return breeze_legal_pages() + array(
		'faqs'      => array( 'FAQs', 'faqs-template.php' ),
		'locations' => array( 'Locations', 'locations-template.php' ),
	);
}

/**
 * Create (or adopt, e.g. WordPress's default draft "Privacy Policy") the theme's pages
 * once, publish them with their template, and register the privacy page with core.
 * Bump the option key when adding pages so existing installs pick them up.
 */
function breeze_ensure_pages() {
	if ( get_option( 'breeze_auto_pages_v2' ) ) {
		return;
	}
	foreach ( breeze_auto_pages() as $slug => $page ) {
		$existing = get_page_by_path( $slug );
		$id       = $existing ? $existing->ID : wp_insert_post( array(
			'post_type'   => 'page',
			'post_title'  => $page[0],
			'post_name'   => $slug,
			'post_status' => 'publish',
		) );
		if ( ! $id || is_wp_error( $id ) ) {
			return; // try again on the next request
		}
		if ( $existing && 'publish' !== $existing->post_status ) {
			wp_update_post( array( 'ID' => $id, 'post_status' => 'publish' ) );
		}
		update_post_meta( $id, '_wp_page_template', $page[1] );
		if ( 'privacy-policy' === $slug ) {
			update_option( 'wp_page_for_privacy_policy', $id );
		}
	}
	update_option( 'breeze_auto_pages_v2', 1 );
}
add_action( 'init', 'breeze_ensure_pages', 20 );

/**
 * URL of a theme page by slug (falls back to the pretty path if the page is missing).
 */
function breeze_page_url( $slug ) {
	$page = get_page_by_path( $slug );
	return $page ? get_permalink( $page ) : home_url( '/' . $slug . '/' );
}

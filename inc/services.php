<?php
/**
 * Services — single source for the home carousel and the "Services" mega menu.
 * @package Breeze
 */

/**
 * Inline SVG path markup for a service icon key (home, wind, bolt, grid).
 *
 * @param string $key Icon key.
 * @return string
 */
function breeze_service_icon( $key ) {
	$icons = array(
		'home'  => '<path d="M3 11l9-8 9 8"/><path d="M5 10v10h14V10"/>',
		'wind'  => '<path d="M4 8h12a3 3 0 100-6"/><path d="M2 12h18a3 3 0 110 6"/><path d="M4 16h9a2 2 0 110 4"/>',
		'bolt'  => '<path d="M13 2L4 14h7l-1 8 9-12h-7z"/>',
		'grid'  => '<rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>',
	);
	return isset( $icons[ $key ] ) ? $icons[ $key ] : '';
}

/**
 * The four services: icon, key (hero image), title, short (mega menu), alt, text, url, cta.
 *
 * @return array
 */
function breeze_services() {
	return array(
		array(
			'icon'  => 'home',
			'key'   => 'remodeling',
			'short' => 'Kitchens, baths, additions & whole-home renovations.',
			'title' => 'Remodeling',
			'alt'   => 'Kitchen and bathroom remodeling in the Las Vegas valley',
			'text'  => 'Kitchens, baths, additions, and whole-home renovations that protect and raise your property\'s value. We handle design, structure, systems, and finish under one roof, so your remodel never stalls waiting on an outside trade.',
			'url'   => '/remodeling/',
			'cta'   => 'Explore remodeling',
		),
		array(
			'icon'  => 'wind',
			'key'   => 'hvac',
			'short' => 'Repair, replacement & high-efficiency upgrades.',
			'title' => 'HVAC',
			'alt'   => 'HVAC repair and AC replacement for Las Vegas homes',
			'text'  => 'Repair, replacement, and high-efficiency upgrades built for Las Vegas heat. You get honest repair-vs-replace guidance backed by real numbers: comfort and efficiency, never a scare tactic.',
			'url'   => '/hvac/',
			'cta'   => 'See HVAC',
		),
		array(
			'icon'  => 'bolt',
			'key'   => 'electrical',
			'short' => 'Panels, wiring, EV chargers & lighting, C-2 licensed.',
			'title' => 'Electrical',
			'alt'   => 'Licensed electrical panel and wiring work in Henderson, NV',
			'text'  => 'Panel upgrades, wiring, EV chargers, lighting, and safety work, done to code by a C-2 licensed team. Because we self-perform electrical, your critical systems never get handed to an unknown subcontractor.',
			'url'   => '/electrical/',
			'cta'   => 'See electrical',
		),
		array(
			'icon'  => 'grid',
			'key'   => 'general-contractor',
			'short' => 'Permits, trades & timeline under one accountable team.',
			'title' => 'General Contracting',
			'alt'   => 'General contractor managing a multi-trade project in Las Vegas',
			'text'  => 'One company coordinating the permits, the trades, and the timeline: the single point of accountability that keeps a multi-trade project on schedule and on budget.',
			'url'   => '/general-contractor/',
			'cta'   => 'See general contracting',
		),
	);
}

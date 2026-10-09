<?php
/**
 * Project photos — the client's real job photos (uploads/2026/10/1–16.webp).
 * Used by the projects gallery (template-parts/projects.php) and the before/after slider.
 * Each item: file (relative to /wp-content/), title (also the alt text), cat (see breeze_project_cats()).
 * @package Breeze
 */

/**
 * Gallery categories, in filter order.
 *
 * @return array slug => label
 */
function breeze_project_cats() {
	return array(
		'kitchens'  => 'Kitchens',
		'bathrooms' => 'Bathrooms',
		'interiors' => 'Interiors',
		'exteriors' => 'Exteriors',
		'progress'  => 'In progress',
	);
}

/**
 * @param array $cats  Only these category slugs (empty = all).
 * @param int   $limit Max items (0 = no limit).
 * @return array
 */
function breeze_projects( $cats = array(), $limit = 0 ) {
	$dir   = '/uploads/2026/10/';
	$items = array(
		// Finished work first: it leads the "All" view and the home gallery.
		array( '12', 'Kitchen remodel with a stone waterfall island and pendant lighting', 'kitchens' ),
		array( '9', 'Primary bath with marble tub surround, glass shower, and chandelier', 'bathrooms' ),
		array( '13', 'Living room feature wall with stone, wood slats, and a built-in fireplace', 'interiors' ),
		array( '2', 'Spa-style bathroom with freestanding tub and curbless walk-in shower', 'bathrooms' ),
		array( '14', 'Rebuilt exterior stairway at a multi-family property', 'exteriors' ),
		array( '15', 'Double vanity with backlit mirrors and under-cabinet lighting', 'bathrooms' ),
		array( '4', 'Kitchen refresh with white shaker cabinets', 'kitchens' ),
		array( '10', 'Primary suite with marble floors and a walk-in closet', 'bathrooms' ),
		// Work in progress: shows the process (and the self-performed trades) behind the finish.
		array( '11', 'Kitchen cabinets set and ready for countertops', 'progress' ),
		array( '6', 'Interior framing for a whole-home reconfiguration', 'progress' ),
		array( '5', 'Crew re-stuccoing an exterior stairway', 'progress' ),
		array( '16', 'New exterior stair framing at a multi-family property', 'progress' ),
		array( '8', 'Walls opened up during a layout change', 'progress' ),
		array( '7', 'Whole-home interior demolition', 'progress' ),
		array( '3', 'Kitchen demolition before new cabinets', 'progress' ),
		array( '1', 'Original bathroom ahead of a remodel', 'progress' ),
	);
	$out = array();
	foreach ( $items as $item ) {
		if ( $cats && ! in_array( $item[2], $cats, true ) ) {
			continue;
		}
		$out[] = array( 'file' => $dir . $item[0] . '.webp', 'title' => $item[1], 'cat' => $item[2] );
		if ( $limit && count( $out ) >= $limit ) {
			break;
		}
	}
	return $out;
}

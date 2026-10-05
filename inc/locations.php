<?php
/**
 * Locations — counties we serve and the communities inside each, for the Locations page.
 * Each county: name, state, map (Google Maps query), blurb, areas ([ name, map query, note ]).
 * To add a county (e.g. CA/AZ once licensing is confirmed, open items #3/#10), append an entry.
 * @package Breeze
 */

/**
 * @return array
 */
function breeze_locations() {
	return array(
		array(
			'name'  => 'Clark County',
			'state' => 'Nevada',
			'badge' => 'Home base',
			'map'   => 'Clark County, NV',
			'blurb' => 'Our crews are based in Henderson and work across the entire Las Vegas valley: remodeling, HVAC, electrical, and general contracting under one licensed, insured team.',
			'areas' => array(
				array( 'Henderson', 'Henderson, NV', 'Our home office, plus Green Valley, Anthem, and Seven Hills.' ),
				array( 'Las Vegas', 'Las Vegas, NV', 'From established central neighborhoods to the newest builds.' ),
				array( 'North Las Vegas', 'North Las Vegas, NV', 'Growing communities with newer homes and big systems.' ),
				array( 'Summerlin', 'Summerlin, Las Vegas, NV', 'Master-planned homes ready for upgrades and remodels.' ),
				array( 'Green Valley', 'Green Valley, Henderson, NV', '1990s and 2000s homes with aging HVAC and panels.' ),
				array( 'Anthem', 'Anthem, Henderson, NV', 'Hillside homes where heat load and efficiency matter.' ),
				array( 'Seven Hills', 'Seven Hills, Henderson, NV', 'High-equity homes protected with careful, coordinated work.' ),
				array( 'Southern Highlands', 'Southern Highlands, NV', 'Larger homes with multi-trade remodel projects.' ),
			),
		),
	);
}

/**
 * Google Maps embed URL for a free-text place query (no API key needed).
 *
 * @param string $query Place query.
 * @param int    $zoom  Optional zoom level (0 lets Google choose).
 * @return string
 */
function breeze_map_embed( $query, $zoom = 0 ) {
	$url = 'https://www.google.com/maps?q=' . rawurlencode( $query ) . '&output=embed';
	return $zoom ? $url . '&z=' . (int) $zoom : $url;
}

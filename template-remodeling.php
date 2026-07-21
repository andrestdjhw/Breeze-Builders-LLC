<?php
/**
 * Template Name: Service — Remodeling
 * @package Breeze
 */
get_header();
breeze_part( 'service-page', array(
	'eyebrow' => 'Remodeling',
	'image'   => breeze_hero_image( 'remodeling' ),
	'title'   => 'Remodeling that protects the value you\'ve built.',
	'lead'    => 'Kitchens, bathrooms, additions, and whole-home renovations, designed and built by a licensed team that handles the structure, the systems, and the finish.',
	'intro_head' => 'Why remodel with Breeze',
	'intro_body' => 'Your home is likely your largest asset. A remodel should make it work better and be worth more, not become a months-long ordeal with a contractor who vanishes. Because we self-perform electrical and HVAC too, your remodel doesn\'t stall waiting on outside trades.',
	'list_head' => 'What we build',
	'list' => array( 'Kitchen remodels & reconfigurations', 'Bathroom remodels', 'Room additions & interior alterations', 'Whole-home & multi-system renovations', 'Aging-in-place upgrades (accessibility, comfort, safety)' ),
	'expect_head' => 'What you can expect',
	'expect' => array( 'A clear scope and a clear price before we start', 'One project manager, one point of contact', 'Permits, code, and inspections handled', 'A clean site and a predictable timeline' ),
	'prices' => array( array( 'Bathroom remodel', '$15K–$40K' ), array( 'Kitchen w/ reconfiguration', '$63K–$126K+' ), array( 'Whole-home / multi-system', '$50K–$150K+' ) ),
	'prices_note' => 'Every property is different. Your estimate is built to your project, not a template. (Confirm ranges before publishing, TODO #5.)',
) );
get_footer();
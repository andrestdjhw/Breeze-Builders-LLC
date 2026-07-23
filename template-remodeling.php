<?php
/**
 * Template Name: Service — Remodeling
 * @package Breeze
 */
get_header();
breeze_part( 'service-page', array(
	'eyebrow' => 'Remodeling',
	'image'   => breeze_hero_image( 'remodeling' ),
	'faqs' => array(
		array(
			'q' => 'How long does a kitchen or bathroom remodel take?',
			'a' => 'It depends on scope. A bathroom typically runs a few weeks, and a full kitchen with reconfiguration takes longer. Before we start you get a clear timeline, one project manager, and updates as the work moves.',
		),
		array(
			'q' => 'Do I need permits for my remodel?',
			'a' => 'Most remodels that touch structure, plumbing, electrical, or mechanical systems do. As a licensed general contractor we pull the permits, build to code, and handle the inspections for you.',
		),
		array(
			'q' => 'Can you handle the electrical and HVAC parts of my remodel?',
			'a' => 'Yes, and that is the point of hiring Breeze. We self-perform the electrical and HVAC work your remodel needs, so the project never stalls waiting on an outside trade.',
		),
		array(
			'q' => 'How much does a remodel cost in the Las Vegas valley?',
			'a' => 'Typical ranges: bathroom remodels from about $15K to $40K, kitchens with reconfiguration from $63K to $126K and up, and whole-home projects from $50K to $150K and up. Your estimate is built to your actual scope, with a clear price before we start.',
		),
		array(
			'q' => 'Will my home be livable during the remodel?',
			'a' => 'In most cases, yes. We plan the phases with you, protect the areas we are not working in, and keep a clean site, so daily life can go on around the project.',
		),
	),
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
<?php
/**
 * Template Name: Service — HVAC
 * @package Breeze
 */
get_header();
breeze_part( 'service-page', array(
	'eyebrow' => 'HVAC',
	'title'   => 'When your AC quits in July, you need answers — not a sales pitch.',
	'lead'    => 'Fast, honest HVAC repair, replacement, and high-efficiency upgrades for Las Vegas homes. We tell you the truth about repair vs. replace, and we back it with numbers.',
	'primary' => array( 'label' => 'AC Down? Call Now', 'url' => 'tel:' . breeze_config( 'phone_href' ) ),
	'secondary' => array( 'label' => 'Get a Free Estimate', 'url' => home_url( '/contact/' ) ),
	'intro_head' => 'The honest approach',
	'intro_body' => 'The HVAC industry has trained homeowners to expect fear: replace everything, today, or else. We do it differently. We diagnose the real problem, show you the cost curve on repair vs. replacement, and let you decide with the facts.',
	'closing_head' => 'Built for Las Vegas heat',
	'closing_body' => 'Here, an AC failure isn\'t a discomfort — it\'s an emergency. Our extreme heat wears systems out faster than the national average. We help you understand where your system is in its life, and what the new efficiency standards and the R-410A phase-out mean for your home and your bill.',
	'list_head' => 'HVAC services',
	'list' => array( 'AC repair & emergency service', 'System replacement & new installation', 'High-efficiency & heat-pump upgrades', 'Maintenance & tune-ups', 'Refrigerant service' ),
	'expect_head' => 'Rebates & financing',
	'expect' => array( 'We help you capture available NV Energy rebates', 'Monthly payment options so replacement doesn\'t hit all at once', 'A straight repair-vs-replace recommendation, in writing' ),
) );
get_footer();

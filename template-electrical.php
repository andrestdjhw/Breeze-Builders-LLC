<?php
/**
 * Template Name: Service — Electrical
 * @package Breeze
 */
get_header();
breeze_part( 'service-page', array(
	'eyebrow' => 'Electrical',
	'image'   => breeze_hero_image( 'electrical' ),
	'title'   => 'Electrical work done safe, to code, and by a licensed team.',
	'lead'    => 'Panel upgrades, wiring, EV chargers, lighting, and safety work from a C-2 licensed electrical contractor you can trust inside your home.',
	'intro_head' => 'Why it matters',
	'intro_body' => 'Electrical isn\'t the place to gamble on the cheapest bid or an unlicensed handyman. It touches the safety of your home and the value of your property. Breeze holds a C-2 electrical license and does the work to code, with permits and inspections handled.',
	'closing_head' => 'Part of the bigger picture',
	'closing_body' => 'Because we also handle remodeling and HVAC, your electrical work connects seamlessly to the rest of your project, with no finger-pointing between trades.',
	'list_head' => 'Electrical services',
	'list' => array( 'Electrical panel upgrades', 'Whole-home & remodel wiring', 'EV charger installation', 'Lighting upgrades', 'Safety inspections & code compliance', 'Capacity upgrades for new systems' ),
) );
get_footer();
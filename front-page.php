<?php
/**
 * Front page (Home).
 * @package Breeze
 */
get_header();

breeze_part( 'hero', array(
	'eyebrow'   => 'Remodeling · HVAC · Electrical · General Contracting',
	'title'     => 'One team. Every trade. Your whole property handled right.',
	'lead'      => 'Breeze Builders is a licensed, insured contractor serving Las Vegas, Henderson, and North Las Vegas — remodeling, HVAC, and electrical under one roof, one crew, and one company that owns the outcome.',
	'primary'   => array( 'label' => 'Get a Free Estimate', 'url' => home_url( '/contact/' ) ),
	'secondary' => array( 'label' => 'AC out? Call now', 'url' => 'tel:' . breeze_config( 'phone_href' ) ),
) );

breeze_part( 'services-grid' );
breeze_part( 'fear-answer' );
breeze_part( 'proof' );
breeze_part( 'financing' );
breeze_part( 'service-area' );
breeze_part( 'cta-band' );

get_footer();

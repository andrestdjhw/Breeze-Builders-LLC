<?php
/**
 * Template Name: Service — General Contractor
 * @package Breeze
 */
get_header();
breeze_part( 'service-page', array(
	'eyebrow' => 'General Contracting',
	'image'   => breeze_hero_image( 'general-contractor' ),
	'title'   => 'One company. One contract. Every trade under control.',
	'lead'    => 'Most projects need more than one trade. Breeze Builders is the general contractor that self-performs remodeling, HVAC, and electrical, so you get one team, one responsibility, and one clean result.',
	'intro_head' => 'The multi-trade advantage',
	'intro_body' => 'When you hire separate specialists, you become the project manager: chasing schedules, settling disputes, and hoping the electrician and the remodeler talk to each other. As your general contractor, we own the whole thing: permits, trades, timeline, and outcome. One company means fewer subs, fewer points of failure, and less risk on you. You carry the project, not the risk.',
	'list_head' => 'What a GC relationship gives you',
	'list' => array( 'A single point of accountability', 'Coordinated trades that actually show up on time', 'Permits, code, and inspections managed for you', 'Fewer surprises, cleaner execution' ),
) );
get_footer();
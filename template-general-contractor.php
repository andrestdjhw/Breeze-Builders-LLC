<?php
/**
 * Template Name: Service — General Contractor
 * @package Breeze
 */
get_header();
breeze_part( 'service-page', array(
	'eyebrow' => 'General Contracting',
	'image'   => breeze_hero_image( 'general-contractor' ),
	'faqs' => array(
		array(
			'q' => 'What does a general contractor actually do?',
			'a' => 'A general contractor owns the whole project: scope, permits, scheduling, coordinating the trades, inspections, and the finished result. You deal with one company instead of managing several.',
		),
		array(
			'q' => 'Why hire a GC instead of separate contractors?',
			'a' => 'With separate specialists, you become the project manager, chasing schedules and settling disputes. With Breeze as your GC there is one estimate, one timeline, and one company accountable for the outcome.',
		),
		array(
			'q' => 'Do you use subcontractors?',
			'a' => 'We self-perform the core trades: remodeling, HVAC, and electrical. When a project needs a specialty outside those, we manage that trade directly, so you still have a single point of accountability.',
		),
		array(
			'q' => 'How do estimates and contracts work?',
			'a' => 'You get a clear scope and an organized estimate before any work starts, and what we quote is what you pay. Changes are discussed and approved with you first, in writing.',
		),
		array(
			'q' => 'Can you take over a project another contractor left unfinished?',
			'a' => 'We can evaluate it. We document the current state, tell you honestly what it will take to finish it right, and if we take it on, we manage it to completion under one responsibility.',
		),
	),
	'title'   => 'One company. One contract. Every trade under control.',
	'lead'    => 'Most projects need more than one trade. Breeze Builders is the general contractor that self-performs remodeling, HVAC, and electrical, so you get one team, one responsibility, and one clean result.',
	'intro_head' => 'The multi-trade advantage',
	'intro_body' => 'When you hire separate specialists, you become the project manager: chasing schedules, settling disputes, and hoping the electrician and the remodeler talk to each other. As your general contractor, we own the whole thing: permits, trades, timeline, and outcome. One company means fewer subs, fewer points of failure, and less risk on you. You carry the project, not the risk.',
	'list_head' => 'What a GC relationship gives you',
	'list' => array( 'A single point of accountability', 'Coordinated trades that actually show up on time', 'Permits, code, and inspections managed for you', 'Fewer surprises, cleaner execution' ),
) );
get_footer();
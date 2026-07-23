<?php
/**
 * Template Name: Service — Electrical
 * @package Breeze
 */
get_header();
breeze_part( 'service-page', array(
	'eyebrow' => 'Electrical',
	'image'   => breeze_hero_image( 'electrical' ),
	'faqs' => array(
		array(
			'q' => 'Do I need an electrical panel upgrade?',
			'a' => 'Common signs are breakers that trip often, an older panel, or new demands like an EV charger, a new AC system, or a remodel. We evaluate your panel and your plans, and tell you honestly whether an upgrade is needed.',
		),
		array(
			'q' => 'Can you install an EV charger at my home?',
			'a' => 'Yes. We check your panel capacity first, handle the permit, and install the charger to code, so it charges safely at full speed.',
		),
		array(
			'q' => 'Is the wiring in my older home safe?',
			'a' => 'Many valley homes from the 1990s and 2000s are due for a checkup. We inspect the panel, the wiring, and the connections, and give you a clear, prioritized picture of what is fine and what needs attention.',
		),
		array(
			'q' => 'Do you pull permits for electrical work?',
			'a' => 'Yes. Breeze holds a C-2 electrical license, and permitted, inspected work is how we protect both your safety and your property value.',
		),
		array(
			'q' => 'Why hire a licensed electrician instead of a handyman?',
			'a' => 'Electrical work touches the safety of your home. A licensed, insured contractor does it to code, with permits and inspections, and carries the responsibility if anything goes wrong. With an unlicensed handyman, that risk becomes yours.',
		),
	),
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
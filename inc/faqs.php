<?php
/**
 * FAQ content — single source for the home FAQ, each service page, and the FAQs page.
 * Each group: label + items ([ q, a ]). Edit questions here only.
 * @package Breeze
 */

/**
 * @param string|null $group Group key (general, remodeling, hvac, electrical, general-contractor),
 *                          or null for all groups as key => [ label, items ].
 * @return array
 */
function breeze_faqs( $group = null ) {
	$groups = array(
		'general' => array(
			'label' => 'General',
			'items' => array(
				array(
					'q' => 'Are you licensed and insured?',
					'a' => 'Yes. Breeze Builders holds a Nevada B (General Contractor) and C-2 (Electrical) license and carries General Liability, Workers\' Comp, and Umbrella coverage. The risk of the project stays with us, not you.',
				),
				array(
					'q' => 'Do you really do remodeling, HVAC, and electrical in-house?',
					'a' => 'We self-perform all three and coordinate them as your general contractor. That means one estimate, one schedule, and one company accountable for the whole job instead of four subcontractors you have to manage.',
				),
				array(
					'q' => 'What areas do you serve?',
					'a' => 'We serve the entire Las Vegas valley, including Henderson, Las Vegas, North Las Vegas, Summerlin, Green Valley, Anthem, Seven Hills, and Southern Highlands. Extended coverage in California and Arizona is available on a per-project basis.',
				),
				array(
					'q' => 'How fast can you respond, especially for a broken AC?',
					'a' => 'HVAC failures in Las Vegas heat are emergencies, so we prioritize them. Call us and we\'ll get you a clear answer fast, and if a repair makes more sense than a full replacement, we\'ll tell you that honestly.',
				),
				array(
					'q' => 'Do you handle permits and inspections?',
					'a' => 'Yes. As a licensed general contractor we pull the permits, build to code, and manage the inspections for you, so your project is documented and done right.',
				),
				array(
					'q' => 'What will my project cost?',
					'a' => 'Every property is different, so we build your estimate around your actual scope, with a clear price and financing options up front, and no surprises between the estimate and the invoice.',
				),
				array(
					'q' => 'How do I get an estimate?',
					'a' => 'Call us or send the short form on our contact page. Estimates are free, clear, and pressure-free. We look at your project, explain your options, and give you a straight answer.',
				),
			),
		),
		'remodeling' => array(
			'label' => 'Remodeling',
			'items' => array(
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
		),
		'hvac' => array(
			'label' => 'HVAC',
			'items' => array(
				array(
					'q' => 'Should I repair or replace my AC?',
					'a' => 'It comes down to the age of the system, the cost of the repair, and how it is trending. We diagnose the real problem, show you the numbers on both paths, and let you decide. If a repair makes more sense, that is what we recommend.',
				),
				array(
					'q' => 'How long does an AC replacement take?',
					'a' => 'A standard residential replacement is usually completed in about a day. If ductwork or electrical capacity needs updating, we tell you up front and schedule it as one coordinated job.',
				),
				array(
					'q' => 'What size AC system does my home need?',
					'a' => 'Bigger is not automatically better. We size systems with a proper load calculation based on your home, not guesswork, so you get even comfort and reasonable energy bills.',
				),
				array(
					'q' => 'Do you offer emergency AC service?',
					'a' => 'Yes. In Las Vegas heat an AC failure is an emergency, so we prioritize those calls. Phone us and we will get you a clear answer fast.',
				),
				array(
					'q' => 'What is the R-410A phase-out and does it affect me?',
					'a' => 'The industry is transitioning away from R-410A refrigerant, which makes older systems more expensive to maintain over time. We explain what it means for your specific system with numbers, not pressure, so you can plan the right move.',
				),
			),
		),
		'electrical' => array(
			'label' => 'Electrical',
			'items' => array(
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
		),
		'general-contractor' => array(
			'label' => 'General Contracting',
			'items' => array(
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
		),
	);
	if ( null === $group ) {
		return $groups;
	}
	return isset( $groups[ $group ] ) ? $groups[ $group ]['items'] : array();
}

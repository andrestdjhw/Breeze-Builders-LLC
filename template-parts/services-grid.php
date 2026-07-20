<?php
/** Home services — 4 cards (extended copy for SEO depth). @package Breeze */
$icons = array(
	'home'  => '<path d="M3 11l9-8 9 8"/><path d="M5 10v10h14V10"/>',
	'wind'  => '<path d="M4 8h12a3 3 0 100-6"/><path d="M2 12h18a3 3 0 110 6"/><path d="M4 16h9a2 2 0 110 4"/>',
	'bolt'  => '<path d="M13 2L4 14h7l-1 8 9-12h-7z"/>',
	'grid'  => '<rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>',
);
$services = array(
	array( 'home', 'Remodeling', 'Kitchens, baths, additions, and whole-home renovations that protect and raise your property\'s value. We handle design, structure, systems, and finish under one roof, so your remodel never stalls waiting on an outside trade.', '/remodeling/', 'Explore remodeling' ),
	array( 'wind', 'HVAC', 'Repair, replacement, and high-efficiency upgrades built for Las Vegas heat. You get honest repair-vs-replace guidance backed by real numbers — comfort and efficiency, never a scare tactic.', '/hvac/', 'See HVAC' ),
	array( 'bolt', 'Electrical', 'Panel upgrades, wiring, EV chargers, lighting, and safety work, done to code by a C-2 licensed team. Because we self-perform electrical, your critical systems never get handed to an unknown subcontractor.', '/electrical/', 'See electrical' ),
	array( 'grid', 'General Contracting', 'One company coordinating the permits, the trades, and the timeline — the single point of accountability that keeps a multi-trade project on schedule and on budget.', '/general-contractor/', 'See general contracting' ),
);
?>
<section class="section section--mist">
	<div class="wrap">
		<span class="eyebrow">What we do</span>
		<h2>Four connected services most valley contractors can only subcontract.</h2>
		<p class="lead" style="max-width:64ch;margin-bottom:2.5rem;">We self-perform remodeling, HVAC, and electrical, and coordinate every trade as your general contractor — so one team is accountable from the first walkthrough to the final inspection.</p>
		<div class="cards">
			<?php foreach ( $services as $s ) : ?>
				<div class="card">
					<div class="card__icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><?php echo $s[0] ? preg_replace('/[\r\n]/','',$icons[ $s[0] ]) : ''; // phpcs:ignore ?></svg></div>
					<h3><?php echo esc_html( $s[1] ); ?></h3>
					<p><?php echo esc_html( $s[2] ); ?></p>
					<a class="card__link" href="<?php echo esc_url( home_url( $s[3] ) ); ?>"><?php echo esc_html( $s[4] ); ?> &rarr;</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
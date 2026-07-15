<?php
/** Home services — 4 cards. @package Breeze */
$icons = array(
	'home'  => '<path d="M3 11l9-8 9 8"/><path d="M5 10v10h14V10"/>',
	'wind'  => '<path d="M4 8h12a3 3 0 100-6"/><path d="M2 12h18a3 3 0 110 6"/><path d="M4 16h9a2 2 0 110 4"/>',
	'bolt'  => '<path d="M13 2L4 14h7l-1 8 9-12h-7z"/>',
	'grid'  => '<rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>',
);
$services = array(
	array( 'home', 'Remodeling', 'Kitchens, baths, additions, and whole-home projects that protect and raise your property\'s value.', '/remodeling/', 'Explore remodeling' ),
	array( 'wind', 'HVAC', 'Repair, replacement, and high-efficiency upgrades built for Las Vegas heat. Honest advice, never a scare tactic.', '/hvac/', 'See HVAC' ),
	array( 'bolt', 'Electrical', 'Panel upgrades, wiring, EV chargers, and safety work — done to code by a licensed team.', '/electrical/', 'See electrical' ),
	array( 'grid', 'General Contracting', 'One company managing the permits, the trades, and the timeline.', '/general-contractor/', 'See general contracting' ),
);
?>
<section class="section">
	<div class="wrap">
		<span class="eyebrow">What we do</span>
		<h2>Most contractors do one thing. Your home needs more than one.</h2>
		<p class="lead" style="max-width:60ch;margin-bottom:2.5rem;">We self-perform remodeling, HVAC, and electrical — so one team is accountable from the first walkthrough to the final inspection.</p>
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

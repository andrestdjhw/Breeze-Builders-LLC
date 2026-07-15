<?php
/** Signature device: the stories in the buyer's head → how Breeze rewrites them. @package Breeze */
$rows = array(
	array( 'They\'ll scare me into a $15,000 sale.', 'Honest, educational advice with good / better / premium options — never a scare tactic.' ),
	array( 'In summer, they charge whatever they want.', 'Transparent, no-pressure pricing — the same fair quote in July as in January.' ),
	array( 'They\'ll take a deposit and disappear.', 'Licensed, insured, and here since 2021 — a real 14-person team, not a one-off.' ),
	array( 'The estimate says one thing; the invoice says another.', 'Clear scope and an organized estimate — what we quote is what you pay.' ),
	array( 'They\'ll leave my house a mess.', 'A clean-execution promise, backed by before/after proof.' ),
	array( 'No license or insurance means the problem becomes mine.', 'Licensed B + C-2 and fully insured, shown up front. The risk stays with us.' ),
	array( 'Moving is too expensive — I\'d rather invest in this house.', 'We protect and increase your property\'s value, so the investment pays off.' ),
	array( 'Lots of reviews and they answer fast — they must be safe.', 'Real Google reviews and fast response, right beside every way to reach us.' ),
);
$check = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M20 6L9 17l-5-5"/></svg>';
?>
<section class="section section--mist">
	<div class="wrap">
		<span class="eyebrow">Why homeowners choose Breeze</span>
		<h2 style="max-width:20ch;">You've already heard the horror stories. Here's how we're different.</h2>
		<div class="fear-list" style="margin-top:2rem;">
			<?php foreach ( $rows as $r ) : ?>
				<div class="fear-row">
					<div class="fear-row__q"><span><?php echo esc_html( $r[0] ); ?></span></div>
					<div class="fear-row__a"><span class="check"><?php echo $check; // phpcs:ignore ?></span><span><?php echo esc_html( $r[1] ); ?></span></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

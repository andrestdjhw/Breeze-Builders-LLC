<?php
/**
 * Template Name: Contact / Get Estimate
 * @package Breeze
 * The form (template-parts/estimate-form.php) stores each request as a Lead in
 * wp-admin and emails breeze_config('email') — confirm that address before launch (#9).
 */
get_header();
?>
<section class="hero hero--pattern" style="padding-block:var(--sp-6);">
	<div class="wrap wrap--sm" style="text-align:center;">
		<span class="eyebrow" style="justify-content:center;">Get a free estimate</span>
		<h1 style="color:#fff;">Tell us what your property needs.</h1>
		<p class="lead">Get a clear, honest estimate from a licensed, insured team. No pressure, no scare tactics. Just a straight answer.</p>
	</div>
</section>
<?php breeze_part( 'trust-strip' ); ?>

<section class="section">
	<div class="wrap">
		<div class="form-grid">
			<div class="form-card" id="estimate" data-tilt>
				<?php breeze_part( 'estimate-form', array( 'prefix' => 'contact', 'anchor' => 'estimate' ) ); ?>
			</div>
			<aside>
				<h3>Why homeowners call us</h3>
				<ul class="ticks">
					<li>Licensed B + C-2 &middot; fully insured</li>
					<li>We answer fast: the sooner we talk, the sooner it's handled</li>
					<li>Financing available: pre-qualify without affecting your credit</li>
				</ul>
				<div class="section--navy" style="border-radius:var(--radius-lg);padding:1.5rem;margin-top:1.5rem;">
					<h3 style="color:#fff;">AC emergency?</h3>
					<p>Don't wait on a form.</p>
					<a class="btn btn--gold" href="tel:<?php echo esc_attr( breeze_config( 'phone_href' ) ); ?>">Call <?php echo esc_html( breeze_config( 'phone_display' ) ); ?></a>
				</div>

				<div class="map-embed" style="margin-top:1.5rem;">
					<iframe
						src="https://www.google.com/maps?q=<?php echo esc_attr( rawurlencode( breeze_config( 'address' ) ) ); ?>&amp;output=embed"
						title="Breeze Builders &mdash; <?php echo esc_attr( breeze_config( 'address' ) ); ?>"
						loading="lazy"
						referrerpolicy="no-referrer-when-downgrade"
						allowfullscreen
					></iframe>
				</div>
			</aside>
		</div>
	</div>
</section>
<?php
breeze_part( 'service-area' );
get_footer();
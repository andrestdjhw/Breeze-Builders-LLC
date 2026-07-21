<?php
/**
 * Template Name: Contact / Get Estimate
 * @package Breeze
 * NOTE: form markup is scaffold only. Wire to Gravity Forms / WPForms / HubSpot
 * before launch (TODO #9). Do not collect leads on the placeholder action.
 */
get_header();
?>
<section class="hero" style="padding-block:var(--sp-6);">
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
			<div>
				<!-- TODO #9: replace with Gravity Forms / HubSpot embed. -->
				<form class="estimate-form" method="post" action="#" novalidate>
					<div class="field"><label for="name">Name</label><input id="name" name="name" type="text" required></div>
					<div class="field"><label for="phone">Phone</label><input id="phone" name="phone" type="tel" required></div>
					<div class="field"><label for="email">Email</label><input id="email" name="email" type="email"></div>
					<div class="field"><label for="service">Service needed</label>
						<select id="service" name="service">
							<option>Remodeling</option><option>HVAC</option><option>Electrical</option>
							<option>General Contracting</option><option>Commercial</option><option>Not sure yet</option>
						</select>
					</div>
					<div class="field"><label for="city">City or ZIP</label><input id="city" name="city" type="text"></div>
					<div class="field"><label for="details">Project details</label><textarea id="details" name="details"></textarea></div>
					<button class="btn btn--gold btn--lg" type="submit">Request My Estimate</button>
				</form>
			</div>
			<aside>
				<h3>Why homeowners call us</h3>
				<ul class="ticks">
					<li>Licensed B + C-2 · fully insured</li>
					<li>We answer fast: the sooner we talk, the sooner it's handled</li>
					<li>Financing available: pre-qualify without affecting your credit</li>
				</ul>
				<div class="section--navy" style="border-radius:var(--radius-lg);padding:1.5rem;margin-top:1.5rem;">
					<h3 style="color:#fff;">AC emergency?</h3>
					<p>Don't wait on a form.</p>
					<a class="btn btn--gold" href="tel:<?php echo esc_attr( breeze_config( 'phone_href' ) ); ?>">Call <?php echo esc_html( breeze_config( 'phone_display' ) ); ?></a>
				</div>
			</aside>
		</div>
	</div>
</section>
<?php
breeze_part( 'service-area' );
get_footer();
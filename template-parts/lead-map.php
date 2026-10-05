<?php
/**
 * Lead + location — estimate form beside a Google map of the office address.
 * Sits right before the CTA band on the home page.
 * @package Breeze
 */
$address = breeze_config( 'address' );
?>
<section class="section" id="estimate">
	<div class="wrap">
		<div class="lead-map">
			<div class="lead-map__form">
				<span class="eyebrow">Free estimate</span>
				<h2>Tell us about your project.</h2>
				<p class="lead-map__intro">Send the short form and we'll call you back with a clear, honest answer. No pressure, no scare tactics.</p>
				<div class="form-card">
					<?php breeze_part( 'estimate-form', array( 'prefix' => 'home-lead', 'anchor' => 'estimate', 'submit' => 'Get My Free Estimate' ) ); ?>
				</div>
			</div>
			<div class="lead-map__place">
				<div class="map-embed lead-map__map">
					<iframe
						src="https://www.google.com/maps?q=<?php echo esc_attr( rawurlencode( $address ) ); ?>&amp;output=embed"
						title="Breeze Builders &mdash; <?php echo esc_attr( $address ); ?>"
						loading="lazy"
						referrerpolicy="no-referrer-when-downgrade"
						allowfullscreen
					></iframe>
				</div>
				<ul class="lead-map__nap">
					<li>
						<strong>Visit us</strong>
						<a href="https://www.google.com/maps/search/?api=1&amp;query=<?php echo esc_attr( rawurlencode( $address ) ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $address ); ?></a>
					</li>
					<li>
						<strong>Call us</strong>
						<a href="tel:<?php echo esc_attr( breeze_config( 'phone_href' ) ); ?>"><?php echo esc_html( breeze_config( 'phone_display' ) ); ?></a>
					</li>
					<li>
						<strong>Email</strong>
						<a href="mailto:<?php echo esc_attr( breeze_config( 'email' ) ); ?>"><?php echo esc_html( breeze_config( 'email' ) ); ?></a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>

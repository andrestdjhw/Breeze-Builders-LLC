<?php
/** Final CTA band. $args: title, lead. @package Breeze */
$a = wp_parse_args( $args, array(
	'title' => 'Ready to get it handled?',
	'lead'  => 'Tell us what your property needs. We\'ll give you a clear, honest estimate — no pressure.',
) );
?>
<section class="section section--navy cta-band">
	<div class="wrap wrap--sm">
		<h2><?php echo esc_html( $a['title'] ); ?></h2>
		<p class="lead"><?php echo esc_html( $a['lead'] ); ?></p>
		<div class="btn-row">
			<a class="btn btn--gold btn--lg" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Get My Free Estimate</a>
			<a class="btn btn--phone btn--lg" href="tel:<?php echo esc_attr( breeze_config( 'phone_href' ) ); ?>">Call <?php echo esc_html( breeze_config( 'phone_display' ) ); ?></a>
		</div>
	</div>
</section>

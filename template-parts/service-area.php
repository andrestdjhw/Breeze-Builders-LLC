<?php
/**
 * Service area — city chips as a continuous marquee (matches the trust strip).
 * The chip group renders twice (second copy aria-hidden) for a seamless loop.
 * @package Breeze
 */
$cities = breeze_config( 'cities' );
?>
<section class="section section--tight section--mist">
	<div class="wrap">
		<span class="eyebrow">Where we work</span>
		<h2 style="margin-bottom:1.2rem;">Proudly serving the Las Vegas valley.</h2>
	</div>
	<div class="chips-marquee" aria-label="Cities we serve">
		<div class="chips-marquee__inner">
			<?php for ( $copy = 0; $copy < 2; $copy++ ) : ?>
				<div class="chips-marquee__group"<?php echo $copy ? ' aria-hidden="true"' : ''; ?>>
					<?php foreach ( $cities as $city ) : ?>
						<span class="chip"><?php echo esc_html( $city ); ?></span>
					<?php endforeach; ?>
					<span class="chip">&amp; surrounding communities</span>
				</div>
			<?php endfor; ?>
		</div>
	</div>
	<div class="wrap">
		<p class="disclaimer" style="margin-top:1rem;">Extended coverage: <?php echo esc_html( breeze_config( 'extended' ) ); ?>. <em>(Nevada is home base; CA/AZ availability confirmed per project.)</em></p>
	</div>
</section>
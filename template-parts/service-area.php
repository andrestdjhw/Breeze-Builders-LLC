<?php
/** Service area chips. @package Breeze */
?>
<section class="section section--tight section--mist">
	<div class="wrap">
		<span class="eyebrow">Where we work</span>
		<h2 style="margin-bottom:1.2rem;">Proudly serving the Las Vegas valley.</h2>
		<div class="chips">
			<?php foreach ( breeze_config( 'cities' ) as $city ) : ?>
				<span class="chip"><?php echo esc_html( $city ); ?></span>
			<?php endforeach; ?>
			<span class="chip">&amp; surrounding communities</span>
		</div>
		<p class="disclaimer" style="margin-top:1rem;">Extended coverage: <?php echo esc_html( breeze_config( 'extended' ) ); ?>. <em>(Nevada is home base; CA/AZ availability confirmed per project.)</em></p>
	</div>
</section>

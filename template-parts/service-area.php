<?php
/**
 * Service area — city chips as a continuous marquee (matches the trust strip).
 * The chip group renders twice (second copy aria-hidden) for a seamless loop.
 * $args (all optional):
 *   photo   — background image path (relative to /wp-content/); switches to the dark photo variant
 *   eyebrow, title — heading copy
 *   body    — array of paragraphs shown above the chips (home: local SEO copy)
 * @package Breeze
 */
$a = wp_parse_args( $args, array(
	'photo'   => '',
	'eyebrow' => 'Where we work',
	'title'   => 'Proudly serving the Las Vegas valley.',
	'body'    => array(),
) );
$cities = breeze_config( 'cities' );
$photo  = ! empty( $a['photo'] );
?>
<section class="section <?php echo $photo ? 'section--photo service-area--photo' : 'section--tight section--mist'; ?>">
	<?php if ( $photo ) : ?>
		<div class="section__bg" aria-hidden="true">
			<img src="<?php echo esc_url( content_url( $a['photo'] ) ); ?>" alt="" loading="lazy" decoding="async">
			<span class="section__scrim"></span>
		</div>
	<?php endif; ?>
	<div class="wrap<?php echo $a['body'] ? ' wrap--sm' : ''; ?>">
		<span class="eyebrow"><?php echo esc_html( $a['eyebrow'] ); ?></span>
		<h2 style="margin-bottom:1.2rem;"><?php echo esc_html( $a['title'] ); ?></h2>
		<?php foreach ( $a['body'] as $para ) : ?>
			<p><?php echo esc_html( $para ); ?></p>
		<?php endforeach; ?>
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
	<div class="wrap<?php echo $a['body'] ? ' wrap--sm' : ''; ?>">
		<p class="disclaimer" style="margin-top:1rem;">Extended coverage: <?php echo esc_html( breeze_config( 'extended' ) ); ?>. <em>(Nevada is home base; CA/AZ availability confirmed per project.)</em></p>
	</div>
</section>

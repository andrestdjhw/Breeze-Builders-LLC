<?php
/**
 * Template Name: Locations
 * Counties we serve (inc/locations.php): a county map + office details, then a map card per community.
 * @package Breeze
 */
get_header();

breeze_part( 'hero', array(
	'eyebrow' => 'Locations',
	'title'   => 'Your contractor across the *Las Vegas valley*.',
	'lead'    => 'One licensed, insured team serving Henderson, Las Vegas, North Las Vegas, and the communities in between.',
	'pattern' => true,
) );

foreach ( breeze_locations() as $i => $county ) :
	?>
	<section class="section<?php echo $i % 2 ? ' section--mist' : ''; ?>">
		<div class="wrap">
			<div class="county">
				<div class="county__info">
					<span class="eyebrow"><?php echo esc_html( $county['state'] ); ?><?php echo ! empty( $county['badge'] ) ? ' &middot; ' . esc_html( $county['badge'] ) : ''; ?></span>
					<h2><?php echo esc_html( $county['name'] ); ?></h2>
					<p><?php echo esc_html( $county['blurb'] ); ?></p>
					<ul class="lead-map__nap">
						<li><strong>Office</strong><a href="https://www.google.com/maps/search/?api=1&amp;query=<?php echo esc_attr( rawurlencode( breeze_config( 'address' ) ) ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( breeze_config( 'address' ) ); ?></a></li>
						<li><strong>Call us</strong><a href="tel:<?php echo esc_attr( breeze_config( 'phone_href' ) ); ?>"><?php echo esc_html( breeze_config( 'phone_display' ) ); ?></a></li>
						<li><strong>Communities</strong><?php echo esc_html( count( $county['areas'] ) ); ?> served across <?php echo esc_html( $county['name'] ); ?></li>
					</ul>
				</div>
				<div class="map-embed county__map">
					<iframe src="<?php echo esc_url( breeze_map_embed( $county['map'], 9 ) ); ?>" title="<?php echo esc_attr( $county['name'] . ', ' . $county['state'] ); ?> map" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
				</div>
			</div>

			<h3 class="county__areas-title">Communities we serve in <?php echo esc_html( $county['name'] ); ?></h3>
			<div class="area-grid">
				<?php foreach ( $county['areas'] as $area ) : ?>
					<article class="area-card">
						<div class="area-card__map">
							<iframe src="<?php echo esc_url( breeze_map_embed( $area[1], 12 ) ); ?>" title="<?php echo esc_attr( $area[0] ); ?> map" loading="lazy" referrerpolicy="no-referrer-when-downgrade" tabindex="-1"></iframe>
						</div>
						<div class="area-card__body">
							<h4><?php echo esc_html( $area[0] ); ?></h4>
							<p><?php echo esc_html( $area[2] ); ?></p>
							<a class="card__link" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Get an estimate in <?php echo esc_html( $area[0] ); ?> <span class="card__arrow" aria-hidden="true">&rarr;</span></a>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
endforeach;
?>
<section class="section section--tight section--mist">
	<div class="wrap wrap--sm">
		<span class="eyebrow">Extended coverage</span>
		<h2>Beyond Nevada, by project.</h2>
		<p><?php echo esc_html( breeze_config( 'extended' ) ); ?>. Nevada is home base; availability in California and Arizona is confirmed per project. Tell us where your property is and we'll give you a straight answer.</p>
	</div>
</section>
<?php
breeze_part( 'cta-band' );
get_footer();

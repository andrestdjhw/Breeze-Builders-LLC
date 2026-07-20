<?php
/**
 * Trust strip — animated marquee of proof points under the hero.
 * The item group is rendered twice (second copy aria-hidden) so the
 * CSS translateX(-50%) loop is seamless.
 * @package Breeze
 */
$items = array(
	array( 'Licensed', breeze_config( 'license' ) ),
	array( 'Insured', breeze_config( 'insured' ) ),
	array( 'Since ' . breeze_config( 'since' ), 'in the valley' ),
	array( '4.9 &#9733;', '## Google reviews (TODO #4)' ),
	array( 'One team', 'Remodeling &middot; HVAC &middot; Electrical' ),
	array( 'Free estimates', 'no pressure, no scare tactics' ),
	array( 'Financing available', 'pay monthly, not all at once' ),
);
?>
<section class="trust-strip" aria-label="Why homeowners trust Breeze Builders">
	<div class="trust-marquee">
		<?php for ( $copy = 0; $copy < 2; $copy++ ) : ?>
			<div class="trust-marquee__group"<?php echo $copy ? ' aria-hidden="true"' : ''; ?>>
				<?php foreach ( $items as $item ) : ?>
					<div class="trust-item">
						<span class="dot">&#9679;</span>
						<strong><?php echo wp_kses_post( $item[0] ); ?></strong>
						<span><?php echo wp_kses_post( $item[1] ); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endfor; ?>
	</div>
</section>
<?php
/**
 * Reusable service-page layout. Drives HVAC / Electrical / Remodeling / GC from an $args array:
 * eyebrow, title, lead, primary, secondary, intro_head, intro_body,
 * list_head, list (array), expect_head, expect (array),
 * prices (array of [label,value]) | null, prices_note, closing_head, closing_body.
 * @package Breeze
 */
$a = wp_parse_args( $args, array(
	'eyebrow' => '', 'title' => '', 'lead' => '',
	'primary' => array( 'label' => 'Get a Free Estimate', 'url' => home_url( '/contact/' ) ),
	'secondary' => null,
	'intro_head' => '', 'intro_body' => '',
	'list_head' => 'What we do', 'list' => array(),
	'expect_head' => 'What you can expect', 'expect' => array(),
	'prices' => null, 'prices_note' => '',
	'closing_head' => '', 'closing_body' => '',
	'image' => '',
) );

breeze_part( 'hero', array(
	'eyebrow' => $a['eyebrow'], 'title' => $a['title'], 'lead' => $a['lead'],
	'primary' => $a['primary'], 'secondary' => $a['secondary'],
	'image'   => $a['image'],
) );
?>
<section class="section">
	<div class="wrap">
		<div class="split">
			<div>
				<?php if ( $a['intro_head'] ) : ?><h2><?php echo esc_html( $a['intro_head'] ); ?></h2><?php endif; ?>
				<?php if ( $a['intro_body'] ) : ?><p><?php echo esc_html( $a['intro_body'] ); ?></p><?php endif; ?>
				<?php if ( $a['closing_head'] ) : ?>
					<h3 style="margin-top:2rem;"><?php echo esc_html( $a['closing_head'] ); ?></h3>
					<p><?php echo esc_html( $a['closing_body'] ); ?></p>
				<?php endif; ?>
			</div>
			<div>
				<?php if ( ! empty( $a['list'] ) ) : ?>
					<h3><?php echo esc_html( $a['list_head'] ); ?></h3>
					<ul class="ticks"><?php foreach ( $a['list'] as $li ) : ?><li><?php echo esc_html( $li ); ?></li><?php endforeach; ?></ul>
				<?php endif; ?>
				<?php if ( ! empty( $a['expect'] ) ) : ?>
					<h3 style="margin-top:1.5rem;"><?php echo esc_html( $a['expect_head'] ); ?></h3>
					<ul class="ticks"><?php foreach ( $a['expect'] as $li ) : ?><li><?php echo esc_html( $li ); ?></li><?php endforeach; ?></ul>
				<?php endif; ?>
				<?php if ( ! empty( $a['prices'] ) ) : ?>
					<h3 style="margin-top:1.5rem;">Investment ranges</h3>
					<div class="price-list">
						<?php foreach ( $a['prices'] as $p ) : ?><div><span><?php echo esc_html( $p[0] ); ?></span><b><?php echo esc_html( $p[1] ); ?></b></div><?php endforeach; ?>
					</div>
					<?php if ( $a['prices_note'] ) : ?><p class="disclaimer" style="margin-top:.6rem;"><?php echo esc_html( $a['prices_note'] ); ?></p><?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php
breeze_part( 'financing' );
breeze_part( 'service-area' );
breeze_part( 'cta-band' );
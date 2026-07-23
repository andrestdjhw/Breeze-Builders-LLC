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
	'faqs' => array(),
) );

breeze_part( 'hero', array(
	'eyebrow' => $a['eyebrow'], 'title' => $a['title'], 'lead' => $a['lead'],
	'primary' => $a['primary'], 'secondary' => $a['secondary'],
	'image'   => $a['image'],
) );
?>
<section class="section">
	<div class="wrap">
		<div class="book" data-book>
			<div class="book__page book__page--left">
				<?php if ( $a['intro_head'] ) : ?><h2><?php echo esc_html( $a['intro_head'] ); ?></h2><?php endif; ?>
				<?php if ( $a['intro_body'] ) : ?><p><?php echo esc_html( $a['intro_body'] ); ?></p><?php endif; ?>
				<?php if ( $a['closing_head'] ) : ?>
					<h3 style="margin-top:2rem;"><?php echo esc_html( $a['closing_head'] ); ?></h3>
					<p><?php echo esc_html( $a['closing_body'] ); ?></p>
				<?php endif; ?>
			</div>
			<div class="book__page book__page--right">
				<?php if ( ! empty( $a['list'] ) ) : ?>
					<h3><?php echo esc_html( $a['list_head'] ); ?></h3>
					<ul class="ticks"><?php foreach ( $a['list'] as $li ) : ?><li><?php echo esc_html( $li ); ?></li><?php endforeach; ?></ul>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php if ( ! empty( $a['expect'] ) ) : ?>
<section class="section section--tight section--mist">
	<div class="wrap">
		<div class="expect-band" data-reveal>
			<h2><?php echo esc_html( $a['expect_head'] ); ?></h2>
			<ul class="ticks ticks--grid" style="margin-top:1.2rem;"><?php foreach ( $a['expect'] as $li ) : ?><li><?php echo esc_html( $li ); ?></li><?php endforeach; ?></ul>
		</div>
	</div>
</section>
<?php endif; ?>
<?php if ( ! empty( $a['prices'] ) ) : ?>
<section class="section section--tight">
	<div class="wrap wrap--sm">
		<div class="price-band" data-reveal>
			<span class="eyebrow">Investment ranges</span>
			<h2>What projects like yours typically run.</h2>
			<div class="price-list" style="margin-top:1.2rem;">
				<?php foreach ( $a['prices'] as $p ) : ?><div><span><?php echo esc_html( $p[0] ); ?></span><b><?php echo esc_html( $p[1] ); ?></b></div><?php endforeach; ?>
			</div>
			<?php if ( $a['prices_note'] ) : ?><p class="disclaimer" style="margin-top:.8rem;"><?php echo esc_html( $a['prices_note'] ); ?></p><?php endif; ?>
		</div>
	</div>
</section>
<?php endif; ?>
<?php
if ( ! empty( $a['faqs'] ) ) {
	breeze_part( 'faq', array( 'items' => $a['faqs'] ) );
}
breeze_part( 'service-area' );
breeze_part( 'cta-band' );
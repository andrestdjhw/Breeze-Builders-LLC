<?php
/**
 * Hero — parameterized. $args: eyebrow, title, lead, primary (label/url), secondary (label/url), media_note.
 * @package Breeze
 */
$a = wp_parse_args( $args, array(
	'eyebrow'   => '',
	'title'     => '',
	'lead'      => '',
	'primary'   => array( 'label' => 'Get a Free Estimate', 'url' => home_url( '/contact/' ) ),
	'secondary' => null,
	'media_note'=> 'Hero image — before/after or team on site (TODO #3)',
) );
?>
<section class="hero">
	<div class="wrap">
		<div class="hero__grid">
			<div>
				<?php if ( $a['eyebrow'] ) : ?><span class="eyebrow"><?php echo esc_html( $a['eyebrow'] ); ?></span><?php endif; ?>
				<h1><?php echo esc_html( $a['title'] ); ?></h1>
				<p class="lead"><?php echo esc_html( $a['lead'] ); ?></p>
				<div class="btn-row">
					<a class="btn btn--gold btn--lg" href="<?php echo esc_url( $a['primary']['url'] ); ?>"><?php echo esc_html( $a['primary']['label'] ); ?></a>
					<?php if ( ! empty( $a['secondary'] ) ) : ?>
						<a class="btn btn--ghost btn--lg" href="<?php echo esc_url( $a['secondary']['url'] ); ?>"><?php echo esc_html( $a['secondary']['label'] ); ?></a>
					<?php endif; ?>
				</div>
			</div>
			<div class="hero__media"><span><?php echo esc_html( $a['media_note'] ); ?></span></div>
		</div>
	</div>
</section>
<?php breeze_part( 'trust-strip' ); ?>

<?php
/**
 * Hero — full-bleed background media (video or image) with a contrast scrim.
 * $args: eyebrow, title, lead, primary (label/url), secondary (label/url),
 *        video (path relative to /wp-content/), image (same), poster.
 * Video wins if both are supplied.
 * @package Breeze
 */
$a = wp_parse_args( $args, array(
	'eyebrow'   => '',
	'title'     => '',
	'lead'      => '',
	'primary'   => array( 'label' => 'Get a Free Estimate', 'url' => home_url( '/contact/' ) ),
	'secondary' => null,
	// Background video runs on the front page by default. To use it on another
	// page, pass 'video' => breeze_config('hero_video') in that template's args.
	'video'     => is_front_page() ? breeze_config( 'hero_video' ) : '',
	'image'     => '',
	'poster'    => breeze_config( 'hero_poster' ),
	'pattern'   => false, // true = footer-style stripes + cube lattice background
) );

$has_video = ! empty( $a['video'] );
$has_image = ! $has_video && ! empty( $a['image'] );
$has_media = $has_video || $has_image;
?>
<section class="hero<?php echo $has_media ? ' hero--media' : ''; ?><?php echo ( ! $has_media && $a['pattern'] ) ? ' hero--pattern' : ''; ?>">
	<?php if ( $has_media ) : ?>
		<div class="hero__bg" aria-hidden="true">
			<?php if ( $has_video ) : ?>
				<video
					class="hero__media-el"
					autoplay
					muted
					loop
					playsinline
					preload="metadata"
					<?php if ( ! empty( $a['poster'] ) ) : ?>poster="<?php echo esc_url( content_url( $a['poster'] ) ); ?>"<?php endif; ?>
				>
					<source src="<?php echo esc_url( content_url( $a['video'] ) ); ?>" type="video/mp4">
				</video>
			<?php else : ?>
				<img
					class="hero__media-el"
					src="<?php echo esc_url( content_url( $a['image'] ) ); ?>"
					alt=""
					loading="eager"
					fetchpriority="high"
					decoding="async"
				>
			<?php endif; ?>
			<span class="hero__scrim"></span>
		</div>
	<?php endif; ?>

	<div class="wrap">
		<div class="hero__content">
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
	</div>
</section>
<?php breeze_part( 'trust-strip' ); ?>
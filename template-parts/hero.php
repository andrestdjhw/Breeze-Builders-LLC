<?php
/**
 * Hero — full-bleed background media (video or image) with a contrast scrim.
 * $args: eyebrow, title, lead, primary (label/url), secondary (label/url),
 *        video (path relative to /wp-content/), image (same), poster.
 * Video wins if both are supplied.
 * Wrap words of the title in *asterisks* to set them in the Ember accent.
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
	'pattern'   => false, // true = brand pattern strip on the right edge (no-media heroes)
	'badges'    => false, // true = "Licensed. Insured. Local." credentials row
) );

$has_video = ! empty( $a['video'] );
$has_image = ! $has_video && ! empty( $a['image'] );
$has_media = $has_video || $has_image;

$title_html = preg_replace( '/\*(.+?)\*/', '<span class="accent">$1</span>', esc_html( $a['title'] ) );
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
		<?php // Line work (desktop split layout): extends the frame's diagonal, then a step across the photo. Coordinates match .hero__bg's clip-path. ?>
		<svg class="hero__lines" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true" focusable="false">
			<line class="faint" x1="66.5" y1="0" x2="38" y2="50"/>
			<polyline class="bright" points="62,100 62,72 76,72 100,46"/>
		</svg>
	<?php endif; ?>

	<div class="wrap">
		<div class="hero__content">
			<?php if ( $a['eyebrow'] ) : ?><span class="eyebrow"><?php echo esc_html( $a['eyebrow'] ); ?></span><?php endif; ?>
			<h1><?php echo $title_html; // phpcs:ignore -- escaped above, only accent spans added ?></h1>
			<p class="lead"><?php echo esc_html( $a['lead'] ); ?></p>
			<div class="btn-row">
				<a class="btn btn--gold btn--lg" href="<?php echo esc_url( $a['primary']['url'] ); ?>"><?php echo esc_html( $a['primary']['label'] ); ?></a>
				<?php if ( ! empty( $a['secondary'] ) ) : ?>
					<a class="btn btn--ghost btn--lg" href="<?php echo esc_url( $a['secondary']['url'] ); ?>"><?php echo esc_html( $a['secondary']['label'] ); ?></a>
				<?php endif; ?>
			</div>
			<?php if ( $a['badges'] ) : ?>
				<div class="hero-badges">
					<p class="hero-badges__title">Licensed. Insured. Local.</p>
					<ul class="hero-badges__list">
						<li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><rect x="5" y="4" width="14" height="17" rx="1"/><path d="M9 4V2.5h6V4M8.5 10h7M8.5 14h7M8.5 18h4"/></svg><span><strong>Licensed</strong>B + C-2</span></li>
						<li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M12 2.5l8 3v6c0 5-3.4 8.6-8 10-4.6-1.4-8-5-8-10v-6z"/><path d="M8.5 12l2.5 2.5 4.5-5"/></svg><span><strong>Insured</strong>For your protection</span></li>
						<li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6M15 14.5c3 0 6 2 6 5.5"/></svg><span><strong><?php echo esc_html( breeze_config( 'team' ) ); ?>+</strong>Team members</span></li>
						<li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M12 21s-7-6.2-7-11.5a7 7 0 0114 0C19 14.8 12 21 12 21z"/><circle cx="12" cy="9.5" r="2.5"/></svg><span><strong>Las Vegas</strong>Based</span></li>
					</ul>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php breeze_part( 'trust-strip' ); ?>
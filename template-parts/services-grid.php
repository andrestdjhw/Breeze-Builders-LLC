<?php
/**
 * Home services — image carousel (scroll-snap + prev/next controls).
 * Cards reuse the same photos as each service page hero.
 * @package Breeze
 */
$icons = array(
	'home'  => '<path d="M3 11l9-8 9 8"/><path d="M5 10v10h14V10"/>',
	'wind'  => '<path d="M4 8h12a3 3 0 100-6"/><path d="M2 12h18a3 3 0 110 6"/><path d="M4 16h9a2 2 0 110 4"/>',
	'bolt'  => '<path d="M13 2L4 14h7l-1 8 9-12h-7z"/>',
	'grid'  => '<rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>',
);

$services = array(
	array(
		'icon'  => 'home',
		'key'   => 'remodeling',
		'title' => 'Remodeling',
		'alt'   => 'Kitchen and bathroom remodeling in the Las Vegas valley',
		'text'  => 'Kitchens, baths, additions, and whole-home renovations that protect and raise your property\'s value. We handle design, structure, systems, and finish under one roof, so your remodel never stalls waiting on an outside trade.',
		'url'   => '/remodeling/',
		'cta'   => 'Explore remodeling',
	),
	array(
		'icon'  => 'wind',
		'key'   => 'hvac',
		'title' => 'HVAC',
		'alt'   => 'HVAC repair and AC replacement for Las Vegas homes',
		'text'  => 'Repair, replacement, and high-efficiency upgrades built for Las Vegas heat. You get honest repair-vs-replace guidance backed by real numbers — comfort and efficiency, never a scare tactic.',
		'url'   => '/hvac/',
		'cta'   => 'See HVAC',
	),
	array(
		'icon'  => 'bolt',
		'key'   => 'electrical',
		'title' => 'Electrical',
		'alt'   => 'Licensed electrical panel and wiring work in Henderson, NV',
		'text'  => 'Panel upgrades, wiring, EV chargers, lighting, and safety work, done to code by a C-2 licensed team. Because we self-perform electrical, your critical systems never get handed to an unknown subcontractor.',
		'url'   => '/electrical/',
		'cta'   => 'See electrical',
	),
	array(
		'icon'  => 'grid',
		'key'   => 'general-contractor',
		'title' => 'General Contracting',
		'alt'   => 'General contractor managing a multi-trade project in Las Vegas',
		'text'  => 'One company coordinating the permits, the trades, and the timeline — the single point of accountability that keeps a multi-trade project on schedule and on budget.',
		'url'   => '/general-contractor/',
		'cta'   => 'See general contracting',
	),
);
?>
<section class="section section--mist">
	<div class="wrap">
		<span class="eyebrow">What we do</span>
		<h2>Four connected services most valley contractors can only subcontract.</h2>
		<p class="lead" style="max-width:64ch;margin-bottom:2.5rem;">We self-perform remodeling, HVAC, and electrical, and coordinate every trade as your general contractor — so one team is accountable from the first walkthrough to the final inspection.</p>

		<div class="carousel" data-carousel>
			<div class="carousel__track" data-carousel-track tabindex="0" role="group" aria-label="Our services">
				<?php
				// Rendered twice (second copy aria-hidden) so the continuous
				// marquee scroll can loop without a visible seam.
				for ( $copy = 0; $copy < 2; $copy++ ) :
					foreach ( $services as $s ) :
					?>
					<?php $img = breeze_hero_image( $s['key'] ); ?>
					<article class="scard"<?php echo $copy ? ' aria-hidden="true" tabindex="-1"' : ''; ?>>
						<div class="scard__media">
							<?php if ( $img ) : ?>
								<img src="<?php echo esc_url( content_url( $img ) ); ?>" alt="<?php echo esc_attr( $s['alt'] ); ?>" loading="lazy" decoding="async">
							<?php endif; ?>
							<span class="scard__icon">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><?php echo $icons[ $s['icon'] ]; // phpcs:ignore -- static inline icon markup ?></svg>
							</span>
						</div>
						<div class="scard__body">
							<h3><?php echo esc_html( $s['title'] ); ?></h3>
							<p><?php echo esc_html( $s['text'] ); ?></p>
							<a class="card__link" href="<?php echo esc_url( home_url( $s['url'] ) ); ?>"><?php echo esc_html( $s['cta'] ); ?> &rarr;</a>
						</div>
					</article>
					<?php
					endforeach;
				endfor;
				?>
			</div>

			<button class="carousel__btn carousel__btn--prev" type="button" data-carousel-prev aria-label="Previous services">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
			</button>
			<button class="carousel__btn carousel__btn--next" type="button" data-carousel-next aria-label="Next services">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
			</button>
		</div>
	</div>
</section>
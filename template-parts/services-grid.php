<?php
/**
 * Home services — image carousel (scroll-snap + prev/next controls).
 * Cards reuse the same photos as each service page hero.
 * @package Breeze
 */
$services = breeze_services();
?>
<section class="section section--mist">
	<div class="wrap">
		<span class="eyebrow">What we do</span>
		<h2>Four connected services most valley contractors can only subcontract.</h2>
		<p class="lead" style="max-width:64ch;margin-bottom:2.5rem;">We self-perform remodeling, HVAC, and electrical, and coordinate every trade as your general contractor, so one team is accountable from the first walkthrough to the final inspection.</p>
	</div>

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
								<?php $set = breeze_image_set( $img ); ?>
								<img src="<?php echo esc_url( $set['src'] ); ?>"<?php if ( $set['srcset'] ) : ?> srcset="<?php echo esc_attr( $set['srcset'] ); ?>" sizes="(max-width: 620px) 85vw, (max-width: 900px) 50vw, 390px"<?php endif; ?> alt="<?php echo esc_attr( $s['alt'] ); ?>" loading="lazy" decoding="async">
							<?php endif; ?>
							<span class="scard__icon">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><?php echo breeze_service_icon( $s['icon'] ); // phpcs:ignore -- static inline icon markup ?></svg>
							</span>
						</div>
						<div class="scard__body">
							<h3><?php echo esc_html( $s['title'] ); ?></h3>
							<p><?php echo esc_html( $s['text'] ); ?></p>
							<a class="card__link" href="<?php echo esc_url( home_url( $s['url'] ) ); ?>"><?php echo esc_html( $s['cta'] ); ?> <span class="card__arrow" aria-hidden="true">&rarr;</span></a>
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
</section>
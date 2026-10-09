<?php
/** Proof — reviews + before/after slider. @package Breeze */
?>
<section class="section">
	<div class="wrap">
		<div class="proof-grid">
			<div>
				<span class="eyebrow">The proof</span>
				<h2>See the work. Read the reviews.</h2>
				<div class="rating" style="margin:1rem 0;">
					<span class="rating__num">4.9</span>
					<span class="rating__stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
				</div>
				<p>Homeowners across Henderson and Las Vegas trust Breeze with their kitchens, their comfort, and their safety. <em>(Embed live Google reviews, TODO #4 / #10.)</em></p>
				<a class="btn btn--ghost" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Get a Free Estimate</a>
			</div>
			<?php
			// Same kitchen, same angle: cabinets set (before) → finished with the stone island (after).
			$before = breeze_image_set( '/uploads/2026/10/11.webp', '1536x1536' );
			$after  = breeze_image_set( '/uploads/2026/10/12.webp', '1536x1536' );
			?>
			<figure class="ba" data-ba style="--pos: 50%;">
				<img class="ba__img" src="<?php echo esc_url( $before['src'] ); ?>"<?php if ( $before['srcset'] ) : ?> srcset="<?php echo esc_attr( $before['srcset'] ); ?>" sizes="(max-width: 820px) 100vw, 55vw"<?php endif; ?> alt="Kitchen during the remodel, cabinets set before countertops" loading="lazy" decoding="async">
				<div class="ba__after">
					<img class="ba__img" src="<?php echo esc_url( $after['src'] ); ?>"<?php if ( $after['srcset'] ) : ?> srcset="<?php echo esc_attr( $after['srcset'] ); ?>" sizes="(max-width: 820px) 100vw, 55vw"<?php endif; ?> alt="The same kitchen finished with a stone waterfall island" loading="lazy" decoding="async">
				</div>
				<span class="ba__divider" aria-hidden="true"><span class="ba__knob"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l-6 6 6 6M15 6l6 6-6 6"/></svg></span></span>
				<span class="ba__label ba__label--before">Before</span>
				<span class="ba__label ba__label--after">After</span>
				<input class="ba__range" type="range" min="0" max="100" value="50" aria-label="Drag to compare the kitchen before and after">
				<figcaption class="ba__caption">Kitchen remodel, Las Vegas valley: drag to compare.</figcaption>
			</figure>
		</div>
	</div>
</section>
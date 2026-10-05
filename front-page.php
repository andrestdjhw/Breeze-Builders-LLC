<?php
/**
 * Front page (Home).
 * Extended for SEO depth (~1,150 words on-page): intro, multi-trade advantage,
 * local-SEO block, and an FAQ section with FAQPage JSON-LD.
 * @package Breeze
 */
get_header();

breeze_part( 'hero', array(
	'eyebrow'   => 'Licensed Las Vegas Contractor',
	// H1 leads with the city + the three trades people search for; the brand line is the accent.
	'title'     => 'Las Vegas remodeling, HVAC & electrical. *One team.*',
	'lead'      => 'One crew and one estimate, accountable through final inspection.',
	'primary'   => array( 'label' => 'Get a Free Estimate', 'url' => home_url( '/contact/' ) ),
	'secondary' => array( 'label' => 'AC out? Call now', 'url' => 'tel:' . breeze_config( 'phone_href' ) ),
	'badges'    => true,
) );
?>

<?php breeze_part( 'services-grid' ); ?>

<!-- Intro / category framing -->
<section class="section section--pattern">
	<div class="wrap">
		<div class="intro-split">
			<div class="intro-split__copy">
				<span class="eyebrow">One contractor for the whole property</span>
				<h2>Remodeling, HVAC, and electrical from one licensed team in the Las Vegas valley.</h2>
				<p>Most homeowners in Henderson, Las Vegas, and North Las Vegas end up juggling three or four contractors for a single project: a remodeler for the kitchen, an HVAC company for the new system, an electrician for the panel, and a general contractor to tie it all together. Breeze Builders replaces that with one licensed, insured team that self-performs remodeling, HVAC, and electrical work and manages the entire job as your general contractor.</p>
				<p>That structure isn't a marketing line; it's how we're licensed and staffed. We hold a Nevada B (General) and C-2 (Electrical) license, carry full insurance, and run a 14-person crew that has served the valley since 2021. When one company is accountable for the permits, the trades, the timeline, and the finish, you get fewer surprises, fewer subcontractors, and fewer points of failure. You carry the project, not the risk.</p>
			</div>
			<figure class="intro-split__media">
				<img
					src="<?php echo esc_url( content_url( '/uploads/2026/10/07-1536x1024.png' ) ); ?>"
					srcset="<?php echo esc_url( content_url( '/uploads/2026/10/07-768x512.png' ) ); ?> 768w, <?php echo esc_url( content_url( '/uploads/2026/10/07-1024x683.png' ) ); ?> 1024w, <?php echo esc_url( content_url( '/uploads/2026/10/07-1536x1024.png' ) ); ?> 1536w, <?php echo esc_url( content_url( '/uploads/2026/10/07-scaled.png' ) ); ?> 2560w"
					sizes="(max-width: 860px) 100vw, 50vw"
					width="1536" height="1024"
					alt="Breeze Builders billboard: Your whole property. One responsibility."
					loading="lazy" decoding="async"
				>
			</figure>
		</div>
	</div>
</section>

<!-- Multi-trade advantage -->
<section class="section">
	<div class="wrap">
		<div class="book" data-book>
			<div class="book__page book__page--left">
				<span class="eyebrow">The multi-trade advantage</span>
				<h2>One company. One responsibility. Less risk on you.</h2>
				<p>A single-trade contractor sees only their piece. The HVAC company sizes a system without touching the electrical panel it depends on; the remodeler subcontracts the wiring and the ductwork and hopes the schedules line up. When something goes wrong, you're the one chasing four phone numbers.</p>
				<p>Breeze works differently. Because we hold both a general and an electrical license and self-execute the core trades, we plan your project as one connected scope: the remodel, the comfort system, and the electrical capacity it all needs. One estimate, one project manager, one crew that shows up when it says it will, and one company standing behind the finished work.</p>
			</div>
			<div class="book__page book__page--right">
				<h3>What that means for you</h3>
				<ul class="ticks">
					<li>A single point of contact from estimate to final inspection</li>
					<li>Trades that are scheduled together, not stitched together</li>
					<li>Permits, code, and inspections handled for you</li>
					<li>A clean site, a clear price, and no finger-pointing between trades</li>
				</ul>
			</div>
		</div>
	</div>
</section>

<?php
breeze_part( 'fear-answer' );
breeze_part( 'proof' );
?>

<!-- Local SEO + service area (photo background, city marquee) -->
<?php
breeze_part( 'service-area', array(
	'photo'   => breeze_config( 'serving_bg' ),
	'eyebrow' => 'Serving the Las Vegas valley',
	'title'   => 'Your neighborhood contractor across Henderson, Las Vegas, and North Las Vegas.',
	'body'    => array(
		'Breeze Builders works throughout the valley, from established, high-equity neighborhoods like Green Valley, Anthem, Seven Hills, Summerlin, and Southern Highlands to the growing communities of North Las Vegas. Many of these homes were built in the 1990s and 2000s, which means aging HVAC systems, original electrical panels, and kitchens and baths that are ready for an update. Those are exactly the projects we\'re built for.',
		'Wherever you are in the valley, you get the same licensed, insured team and the same honest process. We know the local permitting, the codes, and what our extreme summers do to a home\'s systems, and we build every recommendation around protecting the value of the property you already own.',
	),
) );
?>

<!-- FAQ -->
<?php
breeze_part( 'faq', array(
	'eyebrow' => 'Common questions',
	'title'   => 'What homeowners ask before they call.',
	'items'   => breeze_faqs( 'general' ),
) );
?>

<?php
breeze_part( 'lead-map' );
breeze_part( 'cta-band' );
get_footer();
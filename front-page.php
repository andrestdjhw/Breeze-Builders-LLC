<?php
/**
 * Front page (Home).
 * Extended for SEO depth (~1,150 words on-page): intro, multi-trade advantage,
 * local-SEO block, and an FAQ section with FAQPage JSON-LD.
 * @package Breeze
 */
get_header();

breeze_part( 'hero', array(
	'eyebrow'   => 'Remodeling · HVAC · Electrical · General Contracting',
	'title'     => 'One team. Every trade. Your whole property handled right.',
	'lead'      => 'Breeze Builders is a licensed, insured contractor serving Las Vegas, Henderson, and North Las Vegas. We bring remodeling, HVAC, and electrical together under one roof, one crew, and one company that owns the outcome, so your property is handled by a team that stays accountable from the first estimate to the final inspection.',
	'primary'   => array( 'label' => 'Get a Free Estimate', 'url' => home_url( '/contact/' ) ),
	'secondary' => array( 'label' => 'AC out? Call now', 'url' => 'tel:' . breeze_config( 'phone_href' ) ),
) );
?>

<!-- Intro / category framing -->
<section class="section">
	<div class="wrap wrap--sm">
		<span class="eyebrow">One contractor for the whole property</span>
		<h2>Remodeling, HVAC, and electrical from one licensed team in the Las Vegas valley.</h2>
		<p>Most homeowners in Henderson, Las Vegas, and North Las Vegas end up juggling three or four contractors for a single project: a remodeler for the kitchen, an HVAC company for the new system, an electrician for the panel, and a general contractor to tie it all together. Breeze Builders replaces that with one licensed, insured team that self-performs remodeling, HVAC, and electrical work and manages the entire job as your general contractor.</p>
		<p>That structure isn't a marketing line; it's how we're licensed and staffed. We hold a Nevada B (General) and C-2 (Electrical) license, carry full insurance, and run a 14-person crew that has served the valley since 2021. When one company is accountable for the permits, the trades, the timeline, and the finish, you get fewer surprises, fewer subcontractors, and fewer points of failure. You carry the project, not the risk.</p>
	</div>
</section>

<?php breeze_part( 'services-grid' ); ?>

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

<!-- Local SEO -->
<section class="section section--photo">
	<div class="section__bg" aria-hidden="true">
		<img src="<?php echo esc_url( content_url( breeze_config( 'serving_bg' ) ) ); ?>" alt="" loading="lazy" decoding="async">
		<span class="section__scrim"></span>
	</div>
	<div class="wrap wrap--sm">
		<span class="eyebrow">Serving the Las Vegas valley</span>
		<h2>Your neighborhood contractor across Henderson, Las Vegas, and North Las Vegas.</h2>
		<p>Breeze Builders works throughout the valley, from established, high-equity neighborhoods like Green Valley, Anthem, Seven Hills, Summerlin, and Southern Highlands to the growing communities of North Las Vegas. Many of these homes were built in the 1990s and 2000s, which means aging HVAC systems, original electrical panels, and kitchens and baths that are ready for an update. Those are exactly the projects we're built for.</p>
		<p>Wherever you are in the valley, you get the same licensed, insured team and the same honest process. We know the local permitting, the codes, and what our extreme summers do to a home's systems, and we build every recommendation around protecting the value of the property you already own.</p>
	</div>
</section>

<?php
breeze_part( 'service-area' );
?>

<!-- FAQ -->
<section class="section">
	<div class="wrap wrap--sm">
		<span class="eyebrow">Common questions</span>
		<h2>What homeowners ask before they call.</h2>
		<div class="faq" style="margin-top:1.5rem;border-top:1px solid var(--line);">
			<details style="border-bottom:1px solid var(--line);padding:1rem 0;">
				<summary style="font-weight:600;color:var(--navy);cursor:pointer;font-size:1.05rem;">Are you licensed and insured?</summary>
				<p style="margin:.7rem 0 0;">Yes. Breeze Builders holds a Nevada B (General Contractor) and C-2 (Electrical) license and carries General Liability, Workers' Comp, and Umbrella coverage. The risk of the project stays with us, not you.</p>
			</details>
			<details style="border-bottom:1px solid var(--line);padding:1rem 0;">
				<summary style="font-weight:600;color:var(--navy);cursor:pointer;font-size:1.05rem;">Do you really do remodeling, HVAC, and electrical in-house?</summary>
				<p style="margin:.7rem 0 0;">We self-perform all three and coordinate them as your general contractor. That means one estimate, one schedule, and one company accountable for the whole job instead of four subcontractors you have to manage.</p>
			</details>
			<details style="border-bottom:1px solid var(--line);padding:1rem 0;">
				<summary style="font-weight:600;color:var(--navy);cursor:pointer;font-size:1.05rem;">How fast can you respond, especially for a broken AC?</summary>
				<p style="margin:.7rem 0 0;">HVAC failures in Las Vegas heat are emergencies, so we prioritize them. Call us and we'll get you a clear answer fast, and if a repair makes more sense than a full replacement, we'll tell you that honestly.</p>
			</details>
			<details style="border-bottom:1px solid var(--line);padding:1rem 0;">
				<summary style="font-weight:600;color:var(--navy);cursor:pointer;font-size:1.05rem;">What will my project cost?</summary>
				<p style="margin:.7rem 0 0;">Every property is different, so we build your estimate around your actual scope, with a clear price and financing options up front, and no surprises between the estimate and the invoice.</p>
			</details>
		</div>
	</div>
</section>

<script type="application/ld+json">
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[
{"@type":"Question","name":"Are you licensed and insured?","acceptedAnswer":{"@type":"Answer","text":"Breeze Builders holds a Nevada B (General Contractor) and C-2 (Electrical) license and carries General Liability, Workers Comp, and Umbrella coverage. The risk of the project stays with us, not you."}},
{"@type":"Question","name":"Do you do remodeling, HVAC, and electrical in-house?","acceptedAnswer":{"@type":"Answer","text":"We self-perform all three and coordinate them as your general contractor: one estimate, one schedule, and one company accountable for the whole job."}},
{"@type":"Question","name":"How fast can you respond for a broken AC?","acceptedAnswer":{"@type":"Answer","text":"HVAC failures in Las Vegas heat are emergencies, so we prioritize them and give honest repair-versus-replace guidance backed by numbers."}},
{"@type":"Question","name":"What will my project cost?","acceptedAnswer":{"@type":"Answer","text":"Every property is different, so we build your estimate around your actual scope, with a clear price and financing options up front and no surprises between the estimate and the invoice."}}
]}
</script>

<?php
breeze_part( 'cta-band' );
get_footer();
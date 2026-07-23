<?php
/**
 * Template Name: About / Why Breeze
 * Assign to the "About" page, or rename to page-about.php slug match.
 * @package Breeze
 */
get_header();

breeze_part( 'hero', array(
	'eyebrow' => 'About Breeze Builders',
	'title'   => 'The contractor that does what most only subcontract.',
	'lead'    => 'Breeze Builders was built to be the one company a homeowner can trust with the whole property, not four separate specialists hoping they coordinate.',
	'media_note' => 'Team photo / fleet (TODO #3)',
	'pattern'    => true,
) );
?>
<section class="section">
	<div class="wrap wrap--sm">
		<span class="eyebrow">Who we are</span>
		<h2>Structure most small contractors don't have.</h2>
		<p>Founded in <?php echo esc_html( breeze_config( 'since' ) ); ?>, Breeze Builders brought remodeling, HVAC, and electrical under a single licensed operation. Today our 14-person team serves the Las Vegas valley with real licenses (B general + C-2 electrical), full insurance, and the capacity to self-perform multiple trades on one project.</p>
	</div>
</section>
<section class="section section--mist">
	<div class="wrap">
		<span class="eyebrow">What makes us different</span>
		<div class="cards" style="margin-top:1.5rem;">
			<div class="card"><h3>Multi-trade under one roof</h3><p>Remodel, HVAC, electrical, and general contracting from one accountable team.</p></div>
			<div class="card"><h3>Licensed &amp; insured</h3><p>B + C-2, plus General Liability, Workers' Comp, and Umbrella coverage.</p></div>
			<div class="card"><h3>Honest by policy</h3><p>We tell you when to repair and when to replace, even when replacing pays us more.</p></div>
			<div class="card"><h3>Local &amp; responsive</h3><p>Based in the valley, built for the valley's heat, homes, and homeowners.</p></div>
		</div>
	</div>
</section>
<?php
breeze_part( 'cta-band', array( 'title' => 'Meet the team behind your project.', 'lead' => 'Get a clear, honest estimate from a licensed, insured team.' ) );
get_footer();
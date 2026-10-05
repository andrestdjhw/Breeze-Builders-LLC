<?php
/**
 * Template Name: FAQs
 * Every FAQ group from inc/faqs.php on one page, with a jump bar and a single FAQPage schema.
 * @package Breeze
 */
get_header();

$groups = breeze_faqs();

breeze_part( 'hero', array(
	'eyebrow' => 'FAQs',
	'title'   => 'Straight answers before you *call*.',
	'lead'    => 'Licensing, pricing, permits, timelines, and how we handle remodeling, HVAC, electrical, and general contracting across the Las Vegas valley.',
	'pattern' => true,
) );
?>
<nav class="faq-jump" aria-label="FAQ topics">
	<div class="wrap">
		<?php foreach ( $groups as $key => $group ) : ?>
			<a class="chip" href="#faq-<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $group['label'] ); ?></a>
		<?php endforeach; ?>
	</div>
</nav>
<?php
$titles = array(
	'general'            => 'What homeowners ask before they call.',
	'remodeling'         => 'Remodeling questions.',
	'hvac'               => 'HVAC questions.',
	'electrical'         => 'Electrical questions.',
	'general-contractor' => 'General contracting questions.',
);
$entities = array();
foreach ( $groups as $key => $group ) {
	breeze_part( 'faq', array(
		'id'      => 'faq-' . $key,
		'eyebrow' => $group['label'],
		'title'   => isset( $titles[ $key ] ) ? $titles[ $key ] : $group['label'],
		'items'   => $group['items'],
		'schema'  => false,
	) );
	foreach ( $group['items'] as $item ) {
		$entities[] = array(
			'@type'          => 'Question',
			'name'           => wp_strip_all_tags( $item['q'] ),
			'acceptedAnswer' => array( '@type' => 'Answer', 'text' => wp_strip_all_tags( $item['a'] ) ),
		);
	}
}
?>
<script type="application/ld+json"><?php echo wp_json_encode( array( '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $entities ) ); ?></script>
<?php
breeze_part( 'cta-band', array(
	'title' => 'Still have a question?',
	'lead'  => 'Call us or send the short form. We\'ll give you a clear, honest answer, no pressure.',
) );
get_footer();

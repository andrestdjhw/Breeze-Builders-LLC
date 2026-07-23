<?php
/**
 * FAQ — reusable accordion + auto-generated FAQPage JSON-LD.
 * $args:
 *   eyebrow (string), title (string),
 *   items (array of [ 'q' => question, 'a' => answer ]).
 * Schema is built from the same array, so markup and rich results never drift.
 * @package Breeze
 */
$a = wp_parse_args( $args, array(
	'eyebrow' => 'Common questions',
	'title'   => 'What homeowners ask before they call.',
	'items'   => array(),
) );

if ( empty( $a['items'] ) ) {
	return;
}

$schema_entities = array();
foreach ( $a['items'] as $item ) {
	$schema_entities[] = array(
		'@type'          => 'Question',
		'name'           => wp_strip_all_tags( $item['q'] ),
		'acceptedAnswer' => array(
			'@type' => 'Answer',
			'text'  => wp_strip_all_tags( $item['a'] ),
		),
	);
}
$schema = array(
	'@context'   => 'https://schema.org',
	'@type'      => 'FAQPage',
	'mainEntity' => $schema_entities,
);
?>
<section class="section">
	<div class="wrap wrap--sm">
		<span class="eyebrow"><?php echo esc_html( $a['eyebrow'] ); ?></span>
		<h2><?php echo esc_html( $a['title'] ); ?></h2>
		<div class="faq">
			<?php foreach ( $a['items'] as $item ) : ?>
				<details class="faq-item">
					<summary class="faq-item__q">
						<span><?php echo esc_html( $item['q'] ); ?></span>
						<span class="faq-item__chevron" aria-hidden="true">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
						</span>
					</summary>
					<p class="faq-item__a"><?php echo esc_html( $item['a'] ); ?></p>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<script type="application/ld+json"><?php echo wp_json_encode( $schema ); ?></script>
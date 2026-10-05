<?php
/**
 * FAQ — reusable accordion + auto-generated FAQPage JSON-LD.
 * $args:
 *   eyebrow (string), title (string),
 *   items (array of [ 'q' => question, 'a' => answer ]),
 *   id (optional section anchor), schema (bool, default true — the FAQs page emits one combined schema instead),
 *   more (bool) — adds a "See all FAQs" link to the FAQs page.
 * Schema is built from the same array, so markup and rich results never drift.
 * @package Breeze
 */
$a = wp_parse_args( $args, array(
	'eyebrow' => 'Common questions',
	'title'   => 'What homeowners ask before they call.',
	'items'   => array(),
	'id'      => '',
	'schema'  => true,
	'more'    => false,
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
<section class="section"<?php echo $a['id'] ? ' id="' . esc_attr( $a['id'] ) . '"' : ''; ?>>
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
		<?php if ( $a['more'] ) : ?>
			<a class="card__link faq__more" href="<?php echo esc_url( breeze_page_url( 'faqs' ) ); ?>">See all FAQs <span class="card__arrow" aria-hidden="true">&rarr;</span></a>
		<?php endif; ?>
	</div>
</section>
<?php if ( $a['schema'] ) : ?>
<script type="application/ld+json"><?php echo wp_json_encode( $schema ); ?></script>
<?php endif; ?>
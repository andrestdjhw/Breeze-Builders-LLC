<?php
/**
 * Legal page layout (Privacy Policy, Terms & Conditions).
 * $args: title, updated (human date), sections (array of [heading, html]).
 * Section HTML is static theme copy, passed through wp_kses_post.
 * @package Breeze
 */
$a = wp_parse_args( $args, array(
	'title'    => '',
	'updated'  => '',
	'sections' => array(),
) );
?>
<section class="hero hero--pattern hero--legal">
	<div class="wrap">
		<div class="hero__content">
			<span class="eyebrow">Legal</span>
			<h1><?php echo esc_html( $a['title'] ); ?></h1>
			<?php if ( $a['updated'] ) : ?><p class="lead">Last updated: <?php echo esc_html( $a['updated'] ); ?></p><?php endif; ?>
		</div>
	</div>
</section>

<section class="section">
	<div class="wrap legal">
		<nav class="legal__toc" aria-label="On this page">
			<p class="legal__toc-title">On this page</p>
			<ol>
				<?php foreach ( $a['sections'] as $i => $s ) : ?>
					<li><a href="#legal-<?php echo (int) $i + 1; ?>"><?php echo esc_html( $s[0] ); ?></a></li>
				<?php endforeach; ?>
			</ol>
		</nav>
		<article class="legal__body">
			<?php foreach ( $a['sections'] as $i => $s ) : ?>
				<section id="legal-<?php echo (int) $i + 1; ?>" class="legal__section">
					<h2><?php echo esc_html( ( $i + 1 ) . '. ' . $s[0] ); ?></h2>
					<?php echo wp_kses_post( $s[1] ); ?>
				</section>
			<?php endforeach; ?>
		</article>
	</div>
</section>

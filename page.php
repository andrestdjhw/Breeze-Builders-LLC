<?php
/** Generic page fallback. @package Breeze */
get_header();
while ( have_posts() ) : the_post(); ?>
	<section class="section">
		<div class="wrap wrap--sm">
			<h1><?php the_title(); ?></h1>
			<div class="stack"><?php the_content(); ?></div>
		</div>
	</section>
<?php endwhile;
get_footer();

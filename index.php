<?php
/** Fallback index. @package Breeze */
get_header(); ?>
<section class="section">
	<div class="wrap wrap--sm">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article style="margin-bottom:2rem;">
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php the_excerpt(); ?>
			</article>
		<?php endwhile; else : ?>
			<p>Nothing here yet.</p>
		<?php endif; ?>
	</div>
</section>
<?php get_footer();

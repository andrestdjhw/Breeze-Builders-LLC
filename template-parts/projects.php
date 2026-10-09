<?php
/**
 * Projects gallery — real job photos with optional category filters and a lightbox (main.js).
 * Tiles link to the large image, so it still works without JavaScript.
 * $args: id, eyebrow, title, lead, cats (slugs to include; empty = all), limit, filters (bool),
 *        more (bool: link to the full gallery on About), mist (bool: alt background).
 * @package Breeze
 */
$a = wp_parse_args( $args, array(
	'id'      => 'projects',
	'eyebrow' => 'Our work',
	'title'   => 'Real projects across the valley.',
	'lead'    => '',
	'cats'    => array(),
	'limit'   => 0,
	'filters' => false,
	'more'    => false,
	'mist'    => false,
) );
$items    = breeze_projects( $a['cats'], $a['limit'] );
$all_cats = breeze_project_cats();
$present  = array_unique( wp_list_pluck( $items, 'cat' ) );
if ( ! $items ) {
	return;
}
?>
<section class="section<?php echo $a['mist'] ? ' section--mist' : ''; ?>" id="<?php echo esc_attr( $a['id'] ); ?>">
	<div class="wrap">
		<div class="projects__head">
			<div>
				<span class="eyebrow"><?php echo esc_html( $a['eyebrow'] ); ?></span>
				<h2><?php echo esc_html( $a['title'] ); ?></h2>
				<?php if ( $a['lead'] ) : ?><p class="lead projects__lead"><?php echo esc_html( $a['lead'] ); ?></p><?php endif; ?>
			</div>
			<?php if ( $a['more'] ) : ?>
				<a class="card__link" href="<?php echo esc_url( home_url( '/about/#projects' ) ); ?>">See all our work <span class="card__arrow" aria-hidden="true">&rarr;</span></a>
			<?php endif; ?>
		</div>

		<?php if ( $a['filters'] && count( $present ) > 1 ) : ?>
			<div class="projects__filters" role="group" aria-label="Filter projects">
				<button type="button" class="chip is-active" data-filter="all" aria-pressed="true">All</button>
				<?php foreach ( $all_cats as $slug => $label ) : ?>
					<?php if ( in_array( $slug, $present, true ) ) : ?>
						<button type="button" class="chip" data-filter="<?php echo esc_attr( $slug ); ?>" aria-pressed="false"><?php echo esc_html( $label ); ?></button>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div class="project-grid" data-gallery>
			<?php foreach ( $items as $item ) : ?>
				<?php
				$set  = breeze_image_set( $item['file'] );
				$id   = attachment_url_to_postid( content_url( $item['file'] ) );
				$full = $id ? wp_get_attachment_image_url( $id, '1536x1536' ) : content_url( $item['file'] );
				?>
				<figure class="project" data-cat="<?php echo esc_attr( $item['cat'] ); ?>">
					<a class="project__link" href="<?php echo esc_url( $full ? $full : content_url( $item['file'] ) ); ?>" data-lightbox data-caption="<?php echo esc_attr( $item['title'] ); ?>">
						<img src="<?php echo esc_url( $set['src'] ); ?>"<?php if ( $set['srcset'] ) : ?> srcset="<?php echo esc_attr( $set['srcset'] ); ?>" sizes="(max-width: 560px) 100vw, (max-width: 1000px) 50vw, 360px"<?php endif; ?> alt="<?php echo esc_attr( $item['title'] ); ?>" width="768" height="432" loading="lazy" decoding="async">
						<figcaption>
							<span class="project__cat"><?php echo esc_html( $all_cats[ $item['cat'] ] ); ?></span>
							<span class="project__title"><?php echo esc_html( $item['title'] ); ?></span>
						</figcaption>
					</a>
				</figure>
			<?php endforeach; ?>
		</div>
	</div>
</section>

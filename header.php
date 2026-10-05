<?php
/**
 * Header — midnight utility bar (phone · licenses · social) + white masthead.
 *
 * @package Breeze
 */
$phone_display = breeze_config( 'phone_display' );
$phone_href    = breeze_config( 'phone_href' );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
	<div class="utility-bar">
		<div class="wrap">
			<div class="utility-bar__contact">
				<a class="utility-bar__phone" href="tel:<?php echo esc_attr( $phone_href ); ?>">
					Call <?php echo esc_html( $phone_display ); ?>
				</a>
				<a class="utility-bar__email" href="mailto:<?php echo esc_attr( breeze_config( 'email_topbar' ) ); ?>">
					<?php echo esc_html( breeze_config( 'email_topbar' ) ); ?>
				</a>
			</div>

			<?php $address = breeze_config( 'address' ); ?>
			<a class="utility-bar__location" href="https://www.google.com/maps/search/?api=1&amp;query=<?php echo esc_attr( rawurlencode( $address ) ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $address . ' (opens Google Maps)' ); ?>">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><path d="M12 21s-7-6.2-7-11.5a7 7 0 0114 0C19 14.8 12 21 12 21z"/><circle cx="12" cy="9.5" r="2.5"/></svg>
				<?php echo esc_html( $address ); ?>
			</a>

			<?php breeze_social_links( 'utility-bar__social' ); ?>
		</div>
	</div>

	<div class="masthead">
		<div class="wrap">
			<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img class="brand__logo" src="<?php echo esc_url( content_url( breeze_config( 'logo' ) ) ); ?>" alt="<?php echo esc_attr( breeze_config( 'brand' ) ); ?>" decoding="async">
			</a>

			<nav class="nav" aria-label="Primary">
				<button class="nav-toggle" aria-expanded="false" aria-label="Toggle menu">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M3 12h18M3 18h18"/></svg>
				</button>
				<?php
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'nav-menu',
						'fallback_cb'    => false,
					) );
				} else {
					// Theme navigation: Home · About · Services (mega menu) · FAQs · Locations · Contact.
					// Assigning a "Primary" menu in wp-admin replaces this (without the mega menu).
					$is_service = is_page_template( array( 'template-remodeling.php', 'template-hvac.php', 'template-electrical.php', 'template-general-contractor.php' ) );
					$current    = function ( $on ) {
						return $on ? ' class="current-menu-item"' : '';
					};
					?>
					<ul class="nav-menu">
						<li<?php echo $current( is_front_page() ); // phpcs:ignore -- static attribute ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
						<li<?php echo $current( is_page( 'about' ) ); // phpcs:ignore -- static attribute ?>><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a></li>
						<li class="has-mega<?php echo $is_service ? ' current-menu-item' : ''; ?>" data-mega>
							<button class="mega-toggle" type="button" aria-expanded="false" aria-controls="mega-services">
								Services
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 9l6 6 6-6"/></svg>
							</button>
							<div class="mega" id="mega-services">
								<div class="wrap mega__inner">
									<div class="mega__grid">
										<?php foreach ( breeze_services() as $svc ) : ?>
											<a class="mega__item" href="<?php echo esc_url( home_url( $svc['url'] ) ); ?>">
												<?php $img = breeze_hero_image( $svc['key'] ); ?>
												<?php if ( $img ) : $set = breeze_image_set( $img ); ?>
													<img class="mega__bg" src="<?php echo esc_url( $set['src'] ); ?>"<?php if ( $set['srcset'] ) : ?> srcset="<?php echo esc_attr( $set['srcset'] ); ?>" sizes="(max-width: 900px) 100vw, 520px"<?php endif; ?> alt="" loading="lazy" decoding="async" fetchpriority="low">
												<?php endif; ?>
												<span class="mega__icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><?php echo breeze_service_icon( $svc['icon'] ); // phpcs:ignore -- static inline icon markup ?></svg></span>
												<span class="mega__text">
													<strong><?php echo esc_html( $svc['title'] ); ?></strong>
													<span><?php echo esc_html( $svc['short'] ); ?></span>
												</span>
											</a>
										<?php endforeach; ?>
									</div>
									<aside class="mega__aside">
										<p class="mega__aside-title">One team. Every trade.</p>
										<p>Remodeling, HVAC, and electrical self-performed and coordinated by one licensed, insured contractor.</p>
										<a class="btn btn--gold" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Get a Free Estimate</a>
										<a class="mega__phone" href="tel:<?php echo esc_attr( $phone_href ); ?>">or call <?php echo esc_html( $phone_display ); ?></a>
									</aside>
								</div>
							</div>
						</li>
						<li<?php echo $current( is_page( 'faqs' ) ); // phpcs:ignore -- static attribute ?>><a href="<?php echo esc_url( breeze_page_url( 'faqs' ) ); ?>">FAQs</a></li>
						<li<?php echo $current( is_page( 'locations' ) ); // phpcs:ignore -- static attribute ?>><a href="<?php echo esc_url( breeze_page_url( 'locations' ) ); ?>">Locations</a></li>
						<li<?php echo $current( is_page( 'contact' ) ); // phpcs:ignore -- static attribute ?>><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a></li>
					</ul>
					<?php
				}
				?>
				<a class="btn btn--gold" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Get a Free Estimate</a>
			</nav>
		</div>
	</div>
</header>

<main id="main">
<?php
/**
 * Header — utility trust bar + masthead nav.
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
			<a class="utility-bar__phone" href="tel:<?php echo esc_attr( $phone_href ); ?>">
				Call <?php echo esc_html( $phone_display ); ?>
			</a>

			<div class="utility-bar__trust">
				<span><strong>Licensed</strong> <?php echo esc_html( breeze_config( 'license' ) ); ?></span>
				<span><strong>Fully insured</strong> <?php echo esc_html( breeze_config( 'insured' ) ); ?></span>
				<span>Serving the valley since <strong><?php echo esc_html( breeze_config( 'since' ) ); ?></strong></span>
			</div>

			<?php breeze_social_links( 'utility-bar__social' ); ?>
		</div>
	</div>

	<div class="masthead">
		<div class="wrap">
			<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<span class="brand__mark">B</span>
				<span>Breeze Builders</span>
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
					// Scaffold fallback so the theme renders before menus are assigned.
					echo '<ul class="nav-menu">';
					echo '<li><a href="' . esc_url( home_url( '/remodeling/' ) ) . '">Remodeling</a></li>';
					echo '<li><a href="' . esc_url( home_url( '/hvac/' ) ) . '">HVAC</a></li>';
					echo '<li><a href="' . esc_url( home_url( '/electrical/' ) ) . '">Electrical</a></li>';
					echo '<li><a href="' . esc_url( home_url( '/general-contractor/' ) ) . '">General Contracting</a></li>';
					echo '<li><a href="' . esc_url( home_url( '/about/' ) ) . '">About</a></li>';
					echo '</ul>';
				}
				?>
				<a class="btn btn--gold" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Get a Free Estimate</a>
			</nav>
		</div>
	</div>
</header>

<main id="main">
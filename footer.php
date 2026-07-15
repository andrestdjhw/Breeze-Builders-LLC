<?php
/**
 * Footer — NAP, licensing, service area, sticky mobile call.
 *
 * @package Breeze
 */
$phone_display = breeze_config( 'phone_display' );
$phone_href    = breeze_config( 'phone_href' );
?>
</main><!-- #main -->

<footer class="site-footer">
	<div class="wrap">
		<div class="footer-grid">
			<div>
				<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color:#fff;margin-bottom:1rem;">
					<span class="brand__mark">B</span><span>Breeze Builders</span>
				</a>
				<p>One licensed, insured team for remodeling, HVAC, and electrical across Las Vegas, Henderson &amp; North Las Vegas. One company. One responsibility.</p>
				<p><?php echo esc_html( breeze_config( 'license' ) ); ?> &middot; <?php echo esc_html( breeze_config( 'insured' ) ); ?></p>
			</div>

			<div>
				<h4>Services</h4>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/remodeling/' ) ); ?>">Remodeling</a></li>
					<li><a href="<?php echo esc_url( home_url( '/hvac/' ) ); ?>">HVAC</a></li>
					<li><a href="<?php echo esc_url( home_url( '/electrical/' ) ); ?>">Electrical</a></li>
					<li><a href="<?php echo esc_url( home_url( '/general-contractor/' ) ); ?>">General Contracting</a></li>
				</ul>
			</div>

			<div>
				<h4>Get in touch</h4>
				<ul>
					<li><a href="tel:<?php echo esc_attr( $phone_href ); ?>"><?php echo esc_html( $phone_display ); ?></a></li>
					<li><a href="mailto:<?php echo esc_attr( breeze_config( 'email' ) ); ?>"><?php echo esc_html( breeze_config( 'email' ) ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Get a Free Estimate</a></li>
				</ul>
				<h4 style="margin-top:1.5rem;">Service area</h4>
				<p><?php echo esc_html( implode( ' · ', breeze_config( 'cities' ) ) ); ?></p>
				<p style="font-size:.85rem;">Extended: <?php echo esc_html( breeze_config( 'extended' ) ); ?></p>
				<p style="font-size:.85rem;"><?php echo esc_html( breeze_config( 'address' ) ); ?></p>
			</div>
		</div>

		<div class="footer-bottom">
			<span>&copy; <span data-year>2026</span> Breeze Builders LLC. All rights reserved.</span>
			<span>Site by 828 Marketing Solutions</span>
		</div>
	</div>
</footer>

<div class="sticky-call">
	<a class="btn btn--phone" href="tel:<?php echo esc_attr( $phone_href ); ?>">Call now</a>
	<a class="btn btn--gold" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Free estimate</a>
</div>

<?php wp_footer(); ?>
</body>
</html>

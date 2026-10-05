<?php
/**
 * Estimate (lead) form — posts to admin-post.php, handled by breeze_handle_lead().
 * Shared by the Contact page and the home "Visit / reach us" section.
 * $args: prefix (unique id prefix per page), anchor (id to return to after submit), submit (button label).
 * @package Breeze
 */
$a = wp_parse_args( $args, array(
	'prefix' => 'lead',
	'anchor' => 'estimate',
	'submit' => 'Request My Estimate',
) );
$p      = sanitize_key( $a['prefix'] );
$status = isset( $_GET['lead'] ) ? sanitize_key( wp_unslash( $_GET['lead'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification -- display-only flag
$notes  = array(
	'sent'    => array( 'success', 'Thanks! We got your request and will call you shortly. For an AC emergency, call us now at ' . breeze_config( 'phone_display' ) . '.' ),
	'invalid' => array( 'error', 'Please add your name and a phone number so we can reach you.' ),
	'error'   => array( 'error', 'Something went wrong sending your request. Please call us at ' . breeze_config( 'phone_display' ) . '.' ),
);
?>
<?php if ( isset( $notes[ $status ] ) ) : ?>
	<div class="form-notice form-notice--<?php echo esc_attr( $notes[ $status ][0] ); ?>" role="status"><?php echo esc_html( $notes[ $status ][1] ); ?></div>
<?php endif; ?>
<form class="estimate-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
	<input type="hidden" name="action" value="breeze_lead">
	<input type="hidden" name="redirect" value="<?php echo esc_url( get_permalink() ? get_permalink() : home_url( '/' ) ); ?>">
	<input type="hidden" name="anchor" value="<?php echo esc_attr( $a['anchor'] ); ?>">
	<?php wp_nonce_field( 'breeze_lead', 'breeze_lead_nonce' ); ?>
	<?php // Honeypot: hidden from people, bots tend to fill it. ?>
	<div class="estimate-form__hp" aria-hidden="true">
		<label for="<?php echo esc_attr( $p ); ?>-company">Company</label>
		<input id="<?php echo esc_attr( $p ); ?>-company" name="company" type="text" tabindex="-1" autocomplete="off">
	</div>

	<div class="field-row">
		<div class="field"><label for="<?php echo esc_attr( $p ); ?>-name">Name</label><input id="<?php echo esc_attr( $p ); ?>-name" name="name" type="text" autocomplete="name" required></div>
		<div class="field"><label for="<?php echo esc_attr( $p ); ?>-phone">Phone</label><input id="<?php echo esc_attr( $p ); ?>-phone" name="phone" type="tel" autocomplete="tel" required></div>
	</div>
	<div class="field-row">
		<div class="field"><label for="<?php echo esc_attr( $p ); ?>-email">Email</label><input id="<?php echo esc_attr( $p ); ?>-email" name="email" type="email" autocomplete="email"></div>
		<div class="field"><label for="<?php echo esc_attr( $p ); ?>-city">City or ZIP</label><input id="<?php echo esc_attr( $p ); ?>-city" name="city" type="text" autocomplete="postal-code"></div>
	</div>
	<div class="field"><label for="<?php echo esc_attr( $p ); ?>-service">Service needed</label>
		<select id="<?php echo esc_attr( $p ); ?>-service" name="service">
			<option>Remodeling</option><option>HVAC</option><option>Electrical</option>
			<option>General Contracting</option><option>Commercial</option><option>Not sure yet</option>
		</select>
	</div>
	<div class="field"><label for="<?php echo esc_attr( $p ); ?>-details">Project details</label><textarea id="<?php echo esc_attr( $p ); ?>-details" name="details"></textarea></div>
	<button class="btn btn--gold btn--lg" type="submit"><?php echo esc_html( $a['submit'] ); ?></button>
</form>

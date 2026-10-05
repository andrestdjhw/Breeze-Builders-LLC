<?php
/**
 * Template Name: Terms & Conditions
 * Draft copy — have the client's attorney review before launch.
 * @package Breeze
 */
get_header();

$brand   = 'Breeze Builders LLC';
$email   = esc_html( breeze_config( 'email' ) );
$phone   = esc_html( breeze_config( 'phone_display' ) );
$address = esc_html( breeze_config( 'address' ) );
$license = esc_html( breeze_config( 'license' ) );

breeze_part( 'legal-page', array(
	'title'    => 'Terms & Conditions',
	'updated'  => 'October 1, 2026',
	'sections' => array(
		array( 'Acceptance of these terms', "<p>These Terms &amp; Conditions govern your use of the website operated by {$brand} (\"Breeze Builders,\" \"we,\" \"us,\" or \"our\"). By using this website you agree to these terms. If you do not agree, please do not use the website.</p>" ),
		array( 'About our services', "<p>Breeze Builders provides remodeling, HVAC, electrical, and general contracting services in the Las Vegas valley, Nevada ({$license}). Information on this website describes our services in general terms and is not an offer to perform any specific work.</p>" ),
		array( 'Estimates and pricing', '<p>Submitting an estimate request does not create a contract or obligate either party. Any price ranges shown on this website are general guidance only; actual pricing depends on your property, scope, materials, permits, and site conditions, and is confirmed only in a written estimate after we review your project.</p>' ),
		array( 'Written contracts govern the work', '<p>All work we perform is governed by a separate written agreement signed by you and Breeze Builders. That agreement sets out the scope, price, schedule, payment terms, warranties, and other conditions of the project. If anything on this website conflicts with your signed agreement, the signed agreement controls.</p>' ),
		array( 'Financing', '<p>Financing, when offered, is provided by third-party lenders and is subject to their credit approval, terms, and conditions. Breeze Builders is not a lender and does not guarantee approval or specific rates.</p>' ),
		array( 'Website content', '<p>We work to keep the information on this website accurate and current, but it is provided "as is" for general information. Photos may show representative projects and are not a guarantee of the results of any particular job. We may change or remove content at any time without notice.</p>' ),
		array( 'Intellectual property', '<p>The Breeze Builders name, logo, brand graphics, text, and images on this website belong to Breeze Builders or its licensors and are protected by law. You may not copy, reproduce, or use them for commercial purposes without our written permission.</p>' ),
		array( 'Acceptable use', '<p>You agree not to misuse this website, including by submitting false or misleading information, sending spam through our forms, attempting to gain unauthorized access to our systems, or interfering with the website\'s operation.</p>' ),
		array( 'Third-party links and services', '<p>This website may include links to or features from third parties, such as Google Maps or social media platforms. We are not responsible for the content, policies, or practices of those third parties.</p>' ),
		array( 'Limitation of liability', '<p>To the fullest extent permitted by law, Breeze Builders is not liable for any indirect, incidental, or consequential damages arising from your use of, or inability to use, this website. Nothing in these terms limits any warranty or obligation contained in a signed project agreement or required by Nevada law.</p>' ),
		array( 'Privacy', '<p>Your use of this website is also governed by our <a href="' . esc_url( home_url( '/privacy-policy/' ) ) . '">Privacy Policy</a>, which explains how we collect and use your information.</p>' ),
		array( 'Governing law', '<p>These terms are governed by the laws of the State of Nevada, without regard to its conflict-of-law rules. Any dispute relating to this website will be handled in the state or federal courts located in Clark County, Nevada.</p>' ),
		array( 'Changes to these terms', '<p>We may update these Terms &amp; Conditions from time to time. The updated version will be posted on this page with a new "Last updated" date. Continued use of the website after changes means you accept the updated terms.</p>' ),
		array( 'Contact us', "<p>Questions about these terms? Contact us:</p>
<p>{$brand}<br>{$address}<br>Phone: {$phone}<br>Email: <a href=\"mailto:{$email}\">{$email}</a></p>" ),
	),
) );

get_footer();

<?php
/**
 * Template Name: Privacy Policy
 * Draft copy — have the client's attorney review before launch.
 * @package Breeze
 */
get_header();

$brand   = 'Breeze Builders LLC';
$email   = esc_html( breeze_config( 'email' ) );
$phone   = esc_html( breeze_config( 'phone_display' ) );
$address = esc_html( breeze_config( 'address' ) );

breeze_part( 'legal-page', array(
	'title'    => 'Privacy Policy',
	'updated'  => 'October 1, 2026',
	'sections' => array(
		array( 'Who we are', "<p>This website is operated by {$brand} (\"Breeze Builders,\" \"we,\" \"us,\" or \"our\"), a licensed general and electrical contractor based in Nevada. This Privacy Policy explains what information we collect when you visit our website or contact us, how we use it, and the choices you have.</p>" ),
		array( 'Information we collect', '<p>We collect information you choose to give us and limited information collected automatically:</p>
<ul>
<li><strong>Estimate and contact requests.</strong> When you use our estimate form we collect your name, phone number, email address, city or ZIP code, the service you are interested in, and any project details you share.</li>
<li><strong>Calls, texts, and emails.</strong> If you call, text, or email us, we keep a record of that communication and the contact details you use.</li>
<li><strong>Usage information.</strong> Like most websites, our servers and service providers automatically receive technical information such as your IP address, browser type, device, pages visited, and the date and time of your visit.</li>
</ul>' ),
		array( 'How we use your information', '<p>We use the information we collect to:</p>
<ul>
<li>respond to your estimate request and contact you about your project;</li>
<li>schedule site visits, prepare estimates, and provide our services;</li>
<li>send you service-related messages, such as appointment confirmations and follow-ups;</li>
<li>operate, secure, and improve our website; and</li>
<li>comply with legal, licensing, and insurance obligations.</li>
</ul>
<p>We do not sell your personal information, and we do not share it with third parties for their own marketing.</p>' ),
		array( 'Calls and text messages', '<p>By submitting your phone number through our website, you agree that Breeze Builders may call or text you at that number about your request. These messages are related to your inquiry; message and data rates may apply. You can ask us to stop contacting you at any time by replying STOP to a text or by telling us on a call or by email.</p>' ),
		array( 'Third-party services', '<p>Our website uses a few third-party services that may receive technical information about your visit:</p>
<ul>
<li><strong>Google Maps</strong>, to show our location. Google\'s use of data is governed by the <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">Google Privacy Policy</a>.</li>
<li><strong>Google Fonts</strong>, to display our typography.</li>
<li><strong>Hosting and email providers</strong>, which store our website and deliver the messages you send us.</li>
</ul>
<p>We may also share information with subcontractors, suppliers, or financing partners only when needed to deliver the services you request, and with authorities when required by law.</p>' ),
		array( 'Cookies', '<p>Our website uses only the cookies needed for it to work and to keep it secure. Third-party services such as Google Maps may set their own cookies. You can block or delete cookies in your browser settings; some features may not work as intended if you do.</p>' ),
		array( 'How long we keep information', '<p>We keep estimate requests and project records for as long as needed to respond to you, perform our work, honor warranties, and meet legal, tax, licensing, and insurance requirements. When information is no longer needed, we delete or anonymize it.</p>' ),
		array( 'How we protect information', '<p>We use reasonable administrative, technical, and physical safeguards to protect your information. No method of transmission over the internet or electronic storage is completely secure, so we cannot guarantee absolute security.</p>' ),
		array( 'Your choices and rights', '<p>You may ask us to access, correct, or delete the personal information we hold about you, or to stop contacting you. Nevada residents may also submit a request directing us not to sell their covered information; although we do not sell personal information, you may still send us that request. To make any request, contact us using the details below.</p>' ),
		array( 'Children\'s privacy', '<p>Our website and services are intended for adults. We do not knowingly collect personal information from children under 13. If you believe a child has provided us information, contact us and we will delete it.</p>' ),
		array( 'Changes to this policy', '<p>We may update this Privacy Policy from time to time. When we do, we will post the updated version on this page and change the "Last updated" date above.</p>' ),
		array( 'Contact us', "<p>If you have questions about this Privacy Policy or your information, contact us:</p>
<p>{$brand}<br>{$address}<br>Phone: {$phone}<br>Email: <a href=\"mailto:{$email}\">{$email}</a></p>" ),
	),
) );

get_footer();

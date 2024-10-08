<?php
/**
 * Customer note email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-note.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php /* translators: %s: Customer first name */ ?>
<p><?php printf( esc_html__( 'Hi %s,', 'woocommerce' ), esc_html( (!empty($name)) ? $name : $company ) ); ?></p>
<?php if ( empty($tracking_codes) ) : ?>
	<p><?php esc_html_e( 'We are writing to let you know that a tracking number has been generated for your shipment.', 'omnivalt' ); ?><br/><?php printf( esc_html__( 'Your tracking number is %s.', 'omnivalt' ), '<a href="' . esc_html( $tracking_link ) . '" target="_blank">' . esc_html( $tracking_code ) . '</a>' ); ?></p>
<?php else : ?>
	<?php
	$tracking_codes_links = array();
	foreach ( $tracking_codes as $code => $link ) {
		$tracking_codes_links[] = '<a href="' . esc_html( $link ) . '" target="_blank">' . esc_html( $code ) . '</a>';
	}
	?>
	<p><?php esc_html_e( 'We are writing to let you know that your order is being prepared for shipment.', 'omnivalt' ); ?><br/><?php printf( esc_html__( 'Your shipment tracking numbers are %s.', 'omnivalt' ), implode(', ', $tracking_codes_links) ); ?></p>
<?php endif; ?>

<p><?php esc_html_e( 'As a reminder, here are your order details:', 'woocommerce' ); ?></p>

<?php

/*
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );

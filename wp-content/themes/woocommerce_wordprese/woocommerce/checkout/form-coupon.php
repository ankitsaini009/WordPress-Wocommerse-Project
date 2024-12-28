<?php

/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

if (! wc_coupons_enabled()) { // @codingStandardsIgnoreLine.
	return;
}

?>

<div class="woocommerce-form-coupon-toggle">
	<?php
	wc_print_notice(
		apply_filters(
			'woocommerce_checkout_coupon_message',
			'<svg width="15" height="15" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                <g>
                    <path d="M 29.080,0c-0.012,0-0.024,0-0.036,0c-0.006,0-0.012,0-0.018,0c-0.002,0-0.004,0-0.006,0 c-0.010,0-0.018,0-0.026,0c-0.004,0-0.008,0-0.012,0L 18.406,0 C 18.1,0.016, 17.404,0.494, 17.314,0.584L 4.584,13.312 c-0.78,0.78-0.78,2.044,0,2.824l 1.588,1.588L 4.584,19.312c-0.78,0.78-0.78,2.044,0,2.824l 9.292,9.292 c 0.39,0.39, 0.9,0.584, 1.412,0.584c 0.51,0, 1.022-0.194, 1.412-0.584l 12.728-12.73C 29.52,18.608, 30,17.992, 30,17.608L 30,0.994 C 30.028,0.436, 29.628,0, 29.080,0z M 28.022,17.27c-0.006,0.010-0.010,0.016-0.008,0.016c0,0,0,0,0,0l-12.724,12.73l-9.292-9.288 l 1.588-1.588l 6.29,6.29c 0.39,0.39, 0.9,0.584, 1.412,0.584c 0.51,0, 1.022-0.194, 1.412-0.584l 11.322-11.322L 28.022,17.27 z M 28.022,8l0,3.27 c-0.006,0.010-0.010,0.016-0.008,0.016l0,0c0,0,0,0,0,0l-12.724,12.73L 5.998,14.728l 12.644-12.642C 18.68,2.058, 18.726,2.028, 18.772,2 l 9.25,0 L 28.022,8 zM 24.022,4.992A1,1 1080 1 0 26.022,4.992A1,1 1080 1 0 24.022,4.992z"></path>
                </g>
            </svg> ' .
				esc_html__('Have a coupon?', 'woocommerce') .
				' <a href="#" class="showcoupon">' . esc_html__('Click here to enter your code', 'woocommerce') . '</a>'
		),
		'notice'
	);
	?>
</div>


<form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">

	<p><?php esc_html_e('If you have a coupon code, please apply it below.', 'woocommerce'); ?></p>

	<p class="form-row form-row-first">
		<label for="coupon_code" class="screen-reader-text"><?php esc_html_e('Coupon:', 'woocommerce'); ?></label>
		<input placeholder="Enter Your Coupon Code" type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" id="coupon_code" value="" />
	</p>

	<p class="form-row form-row-last">
		<button type="submit" class="cupponebutn button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>"><?php esc_html_e('Apply coupon', 'woocommerce'); ?></button>
	</p>

	<div class="clear"></div>
</form>
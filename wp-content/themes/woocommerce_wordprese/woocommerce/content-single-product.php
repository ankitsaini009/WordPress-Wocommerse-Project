<?php

/**
 * Display single product reviews (comments)
 *
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */
$base_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
defined('ABSPATH') || exit;

global $product;
if (! comments_open()) {
	return;
}
/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>

	<section class="product-details spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="product__details__pic">
						<div class="product__details__pic__left product__thumb nice-scroll">
							<?php
							$attachment_ids = $product->get_gallery_image_ids();
							foreach ($attachment_ids as $attachment_id) {
								$image_link = wp_get_attachment_url($attachment_id);
								echo '<a class="pt" href="#' . $attachment_id . '"><img src="' . $image_link . '" alt=""></a>';
							}
							?>
						</div>
						<div class="product__details__slider__content">
							<div class="product__details__pic__slider owl-carousel">
								<?php
								$image_url = wp_get_attachment_url($product->get_image_id());
								echo '<img data-hash="product-1" class="product__big__img" src="' . $image_url . '" alt="">';
								foreach ($attachment_ids as $attachment_id) {
									$image_url = wp_get_attachment_url($attachment_id);
									echo '<img data-hash="product-' . $attachment_id . '" class="product__big__img" src="' . $image_url . '" alt="">';
								}
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="product__details__text">
						<h3><?php the_title(); ?> <span>Brand: <?php echo $product->get_attribute('pa_brand'); ?></span></h3>
						<div class="rating">
							<?php
							$rating_count = $product->get_rating_count();
							$average = $product->get_average_rating();
							for ($i = 0; $i < 5; $i++) {
								if ($i < $average) {
									echo '<i class="fa fa-star"></i>';
								} else {
									echo '<i class="fa fa-star-o"></i>';
								}
							}
							?>
							<span>( <?php echo $rating_count; ?> reviews )</span>
						</div>
						<div class="product__details__price"><?php echo wc_price($product->get_price()); ?> <span><?php echo wc_price($product->get_regular_price()); ?></span></div>
						<p><?php echo wp_kses_post($product->get_description()); ?></p>
						<div class="product__details__button">
							<form class="add-to-cart-form" action="<?php echo esc_url(home_url('/')); ?>" method="get">
								<input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>">
								<div class="quantity">
									<span>Quantity:</span>
									<div class="pro-qty">
										<input type="number" name="quantity" value="1" min="1">
									</div>
								</div>
								<button type="submit" class="add-to-cart-button cart-btn">
									<svg width="18" height="18" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#fff8f8">
										<g>
											<path d="M 6,32l 20,0 c 1.104,0, 2-0.896, 2-2L 28,8 c0-1.104-0.896-2-2-2l-4.010,0 C 21.942,2.678, 19.282,0, 16,0S 10.058,2.678, 10.010,6 L 6,6 C 4.896,6, 4,6.896, 4,8l0,22 C 4,31.104, 4.896,32, 6,32z M 26,8l0,22 L 6,30 L 6,8 L 26,8 z M 16,2c 2.174,0, 3.942,1.786, 3.99,4L 12.010,6 C 12.058,3.786, 13.826,2, 16,2zM 13,12l 6,0 C 19.552,12, 20,11.552, 20,11C 20,10.448, 19.552,10, 19,10l-6,0 C 12.448,10, 12,10.448, 12,11C 12,11.552, 12.448,12, 13,12z "></path>
										</g>
									</svg> Add to cart
								</button>
							</form>

							<ul>
								<li><a
										href="<?php echo esc_url(wp_nonce_url(add_query_arg('add_to_wishlist', $product->get_id(), $base_url), 'add_to_wishlist')); ?>"
										class="<?php echo esc_attr($link_classes); ?>"
										data-product-id="<?php echo esc_attr($product_id); ?>"
										data-product-type="<?php echo esc_attr($product_type); ?>"
										data-original-product-id="<?php echo esc_attr($parent_product_id); ?>"
										data-title="<?php echo esc_attr(apply_filters('yith_wcwl_add_to_wishlist_title', $label)); ?>"
										rel="nofollow"><svg width="20" height="20" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
											<g>
												<path d="M 31.984,13.834C 31.9,8.926, 27.918,4.552, 23,4.552c-2.844,0-5.35,1.488-7,3.672 C 14.35,6.040, 11.844,4.552, 9,4.552c-4.918,0-8.9,4.374-8.984,9.282L0,13.834 c0,0.030, 0.006,0.058, 0.006,0.088 C 0.006,13.944,0,13.966,0,13.99c0,0.138, 0.034,0.242, 0.040,0.374C 0.48,26.872, 15.874,32, 15.874,32s 15.62-5.122, 16.082-17.616 C 31.964,14.244, 32,14.134, 32,13.99c0-0.024-0.006-0.046-0.006-0.068C 31.994,13.89, 32,13.864, 32,13.834L 31.984,13.834 z M 29.958,14.31 c-0.354,9.6-11.316,14.48-14.080,15.558c-2.74-1.080-13.502-5.938-13.84-15.596C 2.034,14.172, 2.024,14.080, 2.010,13.98 c 0.002-0.036, 0.004-0.074, 0.006-0.112C 2.084,9.902, 5.282,6.552, 9,6.552c 2.052,0, 4.022,1.048, 5.404,2.878 C 14.782,9.93, 15.372,10.224, 16,10.224s 1.218-0.294, 1.596-0.794C 18.978,7.6, 20.948,6.552, 23,6.552c 3.718,0, 6.916,3.35, 6.984,7.316 c0,0.038, 0.002,0.076, 0.006,0.114C 29.976,14.080, 29.964,14.184, 29.958,14.31z"></path>
											</g>
										</svg></a></span></a>
								</li>

								<li class="btn-icon">
									<?php echo do_shortcode('[yith_compare_button]'); ?>
								</li>
							</ul>
						</div>
						<div class="product__details__widget">
							<ul>
								<li>
									<span>Availability:</span>
									<div class="stock__checkbox">
										<label for="stockin">
											<?php echo $product->is_in_stock() ? 'In Stock' : 'Out of Stock'; ?>
											<input type="checkbox" id="stockin" <?php echo $product->is_in_stock() ? 'checked' : ''; ?>>
											<span class="checkmark"></span>
										</label>
									</div>
								</li>
								<li>
									<span>Available color:</span>
									<div class="color__checkbox">
										<?php
										$colors = $product->get_attribute('pa_color'); // Assuming you use a "Color" attribute
										$colors_array = explode(',', $colors);
										foreach ($colors_array as $color) {
											echo '<label for="' . sanitize_title($color) . '">
                                                <input type="radio" name="color__radio" id="' . sanitize_title($color) . '" ' . checked($color, 'red', false) . '>
                                                <span class="checkmark ' . strtolower($color) . '-bg"></span>
                                              </label>';
										}
										?>
									</div>
								</li>
								<li>
									<span>Available size:</span>
									<div class="size__btn">
										<?php
										$sizes = $product->get_attribute('pa_size'); // Assuming you use a "Size" attribute
										$sizes_array = explode(',', $sizes);
										foreach ($sizes_array as $size) {
											echo '<label for="' . sanitize_title($size) . '" class="active">
                                                <input type="radio" id="' . sanitize_title($size) . '">
                                                ' . strtoupper($size) . '
                                              </label>';
										}
										?>
									</div>
								</li>
								<li>
									<span>Promotions:</span>
									<p>Free shipping</p>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="product__details__tab">
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Specification</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Reviews ( <?php echo $rating_count; ?> )</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tabs-1" role="tabpanel">
								<h6>Description</h6>
								<p><?php echo wp_kses_post($product->get_description()); ?></p>
							</div>
							<div class="tab-pane" id="tabs-2" role="tabpanel">
								<h6>Specification</h6>
								<p><?php echo wp_kses_post($product->get_meta('specification')); ?></p>
							</div>
							<div class="tab-pane" id="tabs-3" role="tabpanel">
								<?php
								// Display the product reviews section
								comments_template();
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="related__title">
						<h5>RELATED PRODUCTS</h5>
					</div>
				</div>
				<?php
				$related_products = wc_get_related_products($product->get_id(), 4); // Get 4 related products
				foreach ($related_products as $related_product_id) {
					$related_product = wc_get_product($related_product_id);
					echo '<div class="col-lg-3 col-md-4 col-sm-6">';
					echo '<div class="product__item">';
					echo '<div class="product__item__pic set-bg" data-setbg="' . wp_get_attachment_url($related_product->get_image_id()) . '">';
					if (!$related_product->is_in_stock()) {
						echo '<div class="label stockout">out of stock</div>';
					}
					echo '<ul class="product__hover">
                                    <li><a href="' . wp_get_attachment_url($related_product->get_image_id()) . '" class="image-popup"> <svg width="24" height="24" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                                                <g>
                                                    <path d="M 29.922,2.618c-0.102-0.244-0.296-0.44-0.54-0.54C 29.26,2.026, 29.13,2, 29,2l-8,0 C 20.448,2, 20,2.448, 20,3 C 20,3.552, 20.448,4, 21,4l 5.586,0 L 18.292,12.292c-0.39,0.39-0.39,1.024,0,1.414c 0.39,0.39, 1.024,0.39, 1.414,0L 28,5.414L 28,11 C 28,11.552, 28.448,12, 29,12S 30,11.552, 30,11l0-8 l0,0C 30,2.87, 29.974,2.74, 29.922,2.618zM 3,20C 2.448,20, 2,20.448, 2,21l0,8 c0,0.002,0,0.002,0,0.004c0,0.13, 0.026,0.258, 0.076,0.378 c 0.048,0.118, 0.12,0.224, 0.208,0.314c 0.004,0.004, 0.004,0.008, 0.008,0.012c 0.002,0.002, 0.006,0.002, 0.008,0.006 c 0.090,0.088, 0.198,0.162, 0.316,0.21C 2.74,29.974, 2.87,30, 3,30l 8,0 C 11.552,30, 12,29.552, 12,29C 12,28.448, 11.552,28, 11,28L 5.414,28 l 8.292-8.292c 0.39-0.39, 0.39-1.024,0-1.414c-0.39-0.39-1.024-0.39-1.414,0L 4,26.586L 4,21 C 4,20.448, 3.552,20, 3,20z"></path>
                                                </g>
                                            </svg></a></li>
                                    <li><a href="#"><svg width="24" height="24" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                                                <g>
                                                    <path d="M 31.984,13.834C 31.9,8.926, 27.918,4.552, 23,4.552c-2.844,0-5.35,1.488-7,3.672 C 14.35,6.040, 11.844,4.552, 9,4.552c-4.918,0-8.9,4.374-8.984,9.282L0,13.834 c0,0.030, 0.006,0.058, 0.006,0.088 C 0.006,13.944,0,13.966,0,13.99c0,0.138, 0.034,0.242, 0.040,0.374C 0.48,26.872, 15.874,32, 15.874,32s 15.62-5.122, 16.082-17.616 C 31.964,14.244, 32,14.134, 32,13.99c0-0.024-0.006-0.046-0.006-0.068C 31.994,13.89, 32,13.864, 32,13.834L 31.984,13.834 z M 29.958,14.31 c-0.354,9.6-11.316,14.48-14.080,15.558c-2.74-1.080-13.502-5.938-13.84-15.596C 2.034,14.172, 2.024,14.080, 2.010,13.98 c 0.002-0.036, 0.004-0.074, 0.006-0.112C 2.084,9.902, 5.282,6.552, 9,6.552c 2.052,0, 4.022,1.048, 5.404,2.878 C 14.782,9.93, 15.372,10.224, 16,10.224s 1.218-0.294, 1.596-0.794C 18.978,7.6, 20.948,6.552, 23,6.552c 3.718,0, 6.916,3.35, 6.984,7.316 c0,0.038, 0.002,0.076, 0.006,0.114C 29.976,14.080, 29.964,14.184, 29.958,14.31z"></path>
                                                </g>
                                            </svg></a></li>
                                    <li><a href="?add-to-cart=' . $related_product->get_id() . '"> <svg width="24" height="24" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                                                        <g>
                                                            <path d="M 6,32l 20,0 c 1.104,0, 2-0.896, 2-2L 28,8 c0-1.104-0.896-2-2-2l-4.010,0 C 21.942,2.678, 19.282,0, 16,0S 10.058,2.678, 10.010,6 L 6,6 C 4.896,6, 4,6.896, 4,8l0,22 C 4,31.104, 4.896,32, 6,32z M 26,8l0,22 L 6,30 L 6,8 L 26,8 z M 16,2c 2.174,0, 3.942,1.786, 3.99,4L 12.010,6 C 12.058,3.786, 13.826,2, 16,2zM 13,12l 6,0 C 19.552,12, 20,11.552, 20,11C 20,10.448, 19.552,10, 19,10l-6,0 C 12.448,10, 12,10.448, 12,11C 12,11.552, 12.448,12, 13,12z "></path>
                                                        </g>
                                                    </svg></a></li>
                                  </ul>';
					echo '</div>';
					echo '<div class="product__item__text">';
					echo '<h6><a href="' . get_permalink($related_product->get_id()) . '">' . $related_product->get_name() . '</a></h6>';
					echo '<div class="rating">';
					for ($i = 0; $i < 5; $i++) {
						if ($i < $related_product->get_average_rating()) {
							echo '<i class="fa fa-star"></i>';
						} else {
							echo '<i class="fa fa-star-o"></i>';
						}
					}
					echo '</div>';
					echo '<div class="product__price">' . wc_price($related_product->get_price()) . '</div>';
					echo '</div>';
					echo '</div>';
					echo '</div>';
				}
				?>
			</div>
		</div>
	</section>
	<div class="instagram">
		<div class="container-fluid">
			<div class="row">
				<?php if (have_rows('shop_page_section_insta_imgs_repeater', 'option')): ?>
					<?php while (have_rows('shop_page_section_insta_imgs_repeater', 'option')): the_row();
						$image = get_sub_field('shop_page_section_insta_imgs_repeater_img', 'option');
					?>
						<div class="col-lg-2 col-md-4 col-sm-4 p-0">
							<div class="instagram__item set-bg" data-setbg="<?php echo esc_url($image['url']); ?>">
								<div class="instagram__text">
									<i class="fa fa-instagram"></i>
									<a href="#"><?php echo get_sub_field('shop_page_section_insta_imgs_repeater_button_url', 'option'); ?></a>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	//do_action('woocommerce_after_single_product_summary');
	?>
</div>

<?php do_action('woocommerce_after_single_product'); ?>
<?php
defined('ABSPATH') || exit;

global $product;


$base_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

// Check if the product is valid and visible
if (!is_a($product, WC_Product::class) || !$product->is_visible()) {
	return;
}
?>

<li <?php wc_product_class('', $product); ?>>
	<div>
		<div class="product__item">
			<!-- Product Image -->
			<div class="product__item__pic set-bg" data-setbg="<?php echo esc_url(get_the_post_thumbnail_url($product->get_id(), 'medium')); ?>">
				<?php if ($product->is_on_sale()) : ?>
					<div class="label new">Sale</div>
				<?php elseif ($product->is_featured()) : ?>
					<div class="label new">Featured</div>
				<?php endif; ?>

				<!-- Hover Buttons -->
				<ul class="product__hover">
					<li> <a href="<?php echo esc_url(get_the_post_thumbnail_url($product->get_id(), 'full')); ?>" class="image-popup">

							<svg width="24" height="24" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
								<g>
									<path d="M 29.922,2.618c-0.102-0.244-0.296-0.44-0.54-0.54C 29.26,2.026, 29.13,2, 29,2l-8,0 C 20.448,2, 20,2.448, 20,3 C 20,3.552, 20.448,4, 21,4l 5.586,0 L 18.292,12.292c-0.39,0.39-0.39,1.024,0,1.414c 0.39,0.39, 1.024,0.39, 1.414,0L 28,5.414L 28,11 C 28,11.552, 28.448,12, 29,12S 30,11.552, 30,11l0-8 l0,0C 30,2.87, 29.974,2.74, 29.922,2.618zM 3,20C 2.448,20, 2,20.448, 2,21l0,8 c0,0.002,0,0.002,0,0.004c0,0.13, 0.026,0.258, 0.076,0.378 c 0.048,0.118, 0.12,0.224, 0.208,0.314c 0.004,0.004, 0.004,0.008, 0.008,0.012c 0.002,0.002, 0.006,0.002, 0.008,0.006 c 0.090,0.088, 0.198,0.162, 0.316,0.21C 2.74,29.974, 2.87,30, 3,30l 8,0 C 11.552,30, 12,29.552, 12,29C 12,28.448, 11.552,28, 11,28L 5.414,28 l 8.292-8.292c 0.39-0.39, 0.39-1.024,0-1.414c-0.39-0.39-1.024-0.39-1.414,0L 4,26.586L 4,21 C 4,20.448, 3.552,20, 3,20z"></path>
								</g>
							</svg>
						</a></li>
					<li>
						<a
							href="<?php echo esc_url(wp_nonce_url(add_query_arg('add_to_wishlist', $product->get_id(), $base_url), 'add_to_wishlist')); ?>"
							class="<?php echo esc_attr($link_classes); ?>"
							data-product-id="<?php echo esc_attr($product_id); ?>"
							data-product-type="<?php echo esc_attr($product_type); ?>"
							data-original-product-id="<?php echo esc_attr($parent_product_id); ?>"
							data-title="<?php echo esc_attr(apply_filters('yith_wcwl_add_to_wishlist_title', $label)); ?>"
							rel="nofollow"> <svg width="24" height="24" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
								<g>
									<path d="M 31.984,13.834C 31.9,8.926, 27.918,4.552, 23,4.552c-2.844,0-5.35,1.488-7,3.672 C 14.35,6.040, 11.844,4.552, 9,4.552c-4.918,0-8.9,4.374-8.984,9.282L0,13.834 c0,0.030, 0.006,0.058, 0.006,0.088 C 0.006,13.944,0,13.966,0,13.99c0,0.138, 0.034,0.242, 0.040,0.374C 0.48,26.872, 15.874,32, 15.874,32s 15.62-5.122, 16.082-17.616 C 31.964,14.244, 32,14.134, 32,13.99c0-0.024-0.006-0.046-0.006-0.068C 31.994,13.89, 32,13.864, 32,13.834L 31.984,13.834 z M 29.958,14.31 c-0.354,9.6-11.316,14.48-14.080,15.558c-2.74-1.080-13.502-5.938-13.84-15.596C 2.034,14.172, 2.024,14.080, 2.010,13.98 c 0.002-0.036, 0.004-0.074, 0.006-0.112C 2.084,9.902, 5.282,6.552, 9,6.552c 2.052,0, 4.022,1.048, 5.404,2.878 C 14.782,9.93, 15.372,10.224, 16,10.224s 1.218-0.294, 1.596-0.794C 18.978,7.6, 20.948,6.552, 23,6.552c 3.718,0, 6.916,3.35, 6.984,7.316 c0,0.038, 0.002,0.076, 0.006,0.114C 29.976,14.080, 29.964,14.184, 29.958,14.31z"></path>
								</g>
							</svg></a>
						<!-- <a href="#" class="add-to-wishlist custom-wishlist-icon" data-product-id="<?php echo get_the_ID(); ?>">
							<svg width="24" height="24" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
								<g>
									<path d="M 31.984,13.834C 31.9,8.926, 27.918,4.552, 23,4.552c-2.844,0-5.35,1.488-7,3.672 C 14.35,6.040, 11.844,4.552, 9,4.552c-4.918,0-8.9,4.374-8.984,9.282L0,13.834 c0,0.030, 0.006,0.058, 0.006,0.088 C 0.006,13.944,0,13.966,0,13.99c0,0.138, 0.034,0.242, 0.040,0.374C 0.48,26.872, 15.874,32, 15.874,32s 15.62-5.122, 16.082-17.616 C 31.964,14.244, 32,14.134, 32,13.99c0-0.024-0.006-0.046-0.006-0.068C 31.994,13.89, 32,13.864, 32,13.834L 31.984,13.834 z M 29.958,14.31 c-0.354,9.6-11.316,14.48-14.080,15.558c-2.74-1.080-13.502-5.938-13.84-15.596C 2.034,14.172, 2.024,14.080, 2.010,13.98 c 0.002-0.036, 0.004-0.074, 0.006-0.112C 2.084,9.902, 5.282,6.552, 9,6.552c 2.052,0, 4.022,1.048, 5.404,2.878 C 14.782,9.93, 15.372,10.224, 16,10.224s 1.218-0.294, 1.596-0.794C 18.978,7.6, 20.948,6.552, 23,6.552c 3.718,0, 6.916,3.35, 6.984,7.316 c0,0.038, 0.002,0.076, 0.006,0.114C 29.976,14.080, 29.964,14.184, 29.958,14.31z"></path>
								</g>
							</svg>
						</a> -->
					</li>



					<li>
						<!-- Quantity Input -->
						<form class="add-to-cart-form" action="<?php echo esc_url(get_permalink($product->get_id())); ?>" method="get">
							<input type="hidden" name="quantity" value="1" min="1" class="quantity" />
							<button type="submit" class="add-to-cart-button addcartbtn">
								<a href="#">
									<svg width="24" height="24" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
										<g>
											<path d="M 6,32l 20,0 c 1.104,0, 2-0.896, 2-2L 28,8 c0-1.104-0.896-2-2-2l-4.010,0 C 21.942,2.678, 19.282,0, 16,0S 10.058,2.678, 10.010,6 L 6,6 C 4.896,6, 4,6.896, 4,8l0,22 C 4,31.104, 4.896,32, 6,32z M 26,8l0,22 L 6,30 L 6,8 L 26,8 z M 16,2c 2.174,0, 3.942,1.786, 3.99,4L 12.010,6 C 12.058,3.786, 13.826,2, 16,2zM 13,12l 6,0 C 19.552,12, 20,11.552, 20,11C 20,10.448, 19.552,10, 19,10l-6,0 C 12.448,10, 12,10.448, 12,11C 12,11.552, 12.448,12, 13,12z "></path>
										</g>
									</svg>
								</a> <!-- Add to Cart icon -->
							</button>
							<input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" />
						</form>
					</li>
				</ul>
			</div>

			<!-- Product Text -->
			<div class="product__item__text">
				<!-- Product Title -->
				<h6>
					<a href="<?php echo esc_url(get_permalink($product->get_id())); ?>">
						<?php echo esc_html(get_the_title($product->get_id())); ?>
					</a>
				</h6>

				<!-- Product Rating -->
				<!-- <div class="rating">
					<?php
					// Display product rating
					if ($rating = wc_get_rating_html($product->get_average_rating())) {
						echo $rating;
					} else {
						echo '<span>No ratings</span>';
					}
					?>
				</div> -->
				<div class="rating">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
				</div>
				<!-- Product Price -->
				<div class="product__price">
					<?php if (!empty($product->get_regular_price())) { ?>
						Rs. <?php echo $product->get_regular_price(); ?>
					<?php } else { ?>
						Rs. 0
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</li>
<script>
	jQuery(document).ready(function($) {
		$('a.add-to-cart').on('click', function(e) {
			e.preventDefault();

			var productUrl = $(this).attr('href');
			var $this = $(this);

			// Perform the AJAX request to add to cart
			$.get(productUrl, function(response) {
				// After adding to cart, you can update the cart icon or show a message
				// alert('Product added to cart!');
				// You can also update the cart count or cart icon dynamically here
			});
		});
	});

	jQuery(function($) {
		// When the Add to Wishlist button is clicked
		$('body').on('click', '.custom-wishlist-icon', function(e) {
			e.preventDefault();

			var product_id = $(this).data('product-id'); // Get the product ID from data attribute

			// Send AJAX request to add product to wishlist
			$.ajax({
				url: wishlist_ajax_obj.ajax_url,
				type: 'POST',
				data: {
					action: 'add_to_wishlist', // WordPress action hook
					product_id: product_id, // Send product ID
				},
				success: function(response) {
					if (response.success) {
						alert(response.data.message); // Success message
					} else {
						alert(response.data.message); // Error message
					}
				}
			});
		});
	});
</script>
<?php

/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i> Home</a>
                    <span>Shopping cart</span>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .shop-cart {
        padding: 50px 0;
    }

    .shop__cart__table table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
    }

    .shop__cart__table thead th {
        font-weight: bold;
        text-align: left;
        padding: 10px;
    }

    .shop__cart__table tbody tr {
        border-bottom: 1px solid #ddd;
    }

    .cart__product__item {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .cart__product__item__title h6 {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
    }

    .cart__price,
    .cart__total {
        color: #e53637;
        font-weight: bold;
    }

    .pro-qty {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .qtybtn {
        background: #f5f5f5;
        padding: 5px 10px;
        cursor: pointer;
        font-size: 14px;
    }

    .cart__close {
        text-align: center;
        font-size: 18px;
        color: #999;
        cursor: pointer;
    }

    .cart__close:hover {
        color: #e53637;
    }

    .woocommerce-cart-form table {
        border: 1px solid white;
    }
</style>
<section class="shop-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shop__cart__table">
                    <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">

                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) : ?>
                                    <?php
                                    $_product   = $cart_item['data'];
                                    $product_id = $cart_item['product_id'];

                                    // Product data
                                    $product_permalink = $_product->is_visible() ? $_product->get_permalink($cart_item) : '';
                                    $thumbnail         = $_product->get_image();
                                    $product_name      = $_product->get_name();
                                    $product_price     = WC()->cart->get_product_price($_product);
                                    $product_subtotal  = WC()->cart->get_product_subtotal($_product, $cart_item['quantity']);
                                    ?>
                                    <tr>
                                        <!-- Product Thumbnail and Name -->
                                        <td class="cart__product__item">
                                            <?php echo $thumbnail; // Product image 
                                            ?>
                                            <div class="cart__product__item__title">
                                                <?php if ($product_permalink) : ?>
                                                    <h6><a href="<?php echo esc_url($product_permalink); ?>"><?php echo esc_html($product_name); ?></a></h6>
                                                <?php else : ?>
                                                    <h6><?php echo esc_html($product_name); ?></h6>
                                                <?php endif; ?>
                                                <div class="rating">
                                                    <!-- Replace with your own logic to fetch ratings -->
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Product Price -->
                                        <td class="cart__price"><?php echo wp_kses_post($product_price); ?></td>

                                        <!-- Product Quantity -->
                                        <td class="cart__quantity">
                                            <div class="pro-qty">
                                                <span class="dec qtybtn">-</span>
                                                <?php
                                                // Quantity input field
                                                woocommerce_quantity_input(array(
                                                    'input_name'  => "cart[{$cart_item_key}][qty]",
                                                    'input_value' => $cart_item['quantity'],
                                                    'max_value'   => $_product->get_max_purchase_quantity(),
                                                    'min_value'   => 1,
                                                ), $_product);
                                                ?>
                                                <span class="inc qtybtn">+</span>
                                            </div>
                                        </td>

                                        <!-- Product Subtotal -->
                                        <td class="cart__total"><?php echo wp_kses_post($product_subtotal); ?></td>

                                        <!-- Remove Product -->
                                        <td class="cart__close">
                                            <a href="<?php echo esc_url(wc_get_cart_remove_url($cart_item_key)); ?>"><svg width="32" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                                                    <g>
                                                        <path d="M 10.050,23.95c 0.39,0.39, 1.024,0.39, 1.414,0L 17,18.414l 5.536,5.536c 0.39,0.39, 1.024,0.39, 1.414,0 c 0.39-0.39, 0.39-1.024,0-1.414L 18.414,17l 5.536-5.536c 0.39-0.39, 0.39-1.024,0-1.414c-0.39-0.39-1.024-0.39-1.414,0 L 17,15.586L 11.464,10.050c-0.39-0.39-1.024-0.39-1.414,0c-0.39,0.39-0.39,1.024,0,1.414L 15.586,17l-5.536,5.536 C 9.66,22.926, 9.66,23.56, 10.050,23.95z"></path>
                                                    </g>
                                                </svg></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Discount Section -->
            <div class="col-lg-6">
                <div class="discount__content">
                    <h6>Discount codes</h6>
                    <form method="post" action="">
                        <?php if (wc_coupons_enabled()) { ?>
                            <input type="text" name="coupon_code" class="input-text" id="coupon_code" placeholder="Enter your coupon code" value="">
                            <button type="submit" class="site-btn" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>">Apply</button>
                            <?php do_action('woocommerce_cart_coupon'); ?>
                        <?php } ?>
                    </form>
                </div>
            </div>

            <!-- Cart Totals Section -->
            <div class="col-lg-4 offset-lg-2">
                <div class="cart__total__procced">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Subtotal <span><?php echo WC()->cart->get_cart_subtotal(); ?></span></li>
                        <li>Total <span><?php echo WC()->cart->get_total(); ?></span></li>
                    </ul>
                    <a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="primary-btn">Proceed to checkout</a>
                </div>
            </div>
        </div>

    </div>
</section>
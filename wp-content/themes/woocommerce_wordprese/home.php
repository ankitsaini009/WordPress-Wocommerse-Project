<?php

/**
 * Template Name: Home Page
 */

/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */
$base_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if (! defined('ABSPATH')) {
    //exit; // Exit if accessed directly.
}

get_header(); ?>
<style>
    .categories__item {
        background-size: cover;
        background-position: center;
    }

    .in-wishlist svg {
        fill: red;
    }
</style>
<section class="categories">
    <div class="container-fluid">
        <div class="row">
            <?php
            // Fetch all product categories
            $product_categories = get_terms(array(
                'taxonomy'   => 'product_cat',
                'hide_empty' => true,
                'number' => 5 // Only show categories with products
            ));

            // echo '<pre>';
            // print_r($product_categories);

            if (! empty($product_categories) && ! is_wp_error($product_categories)) {
                $index = 0; // Counter for large category styling

                foreach ($product_categories as $category) {
                    // Get category image
                    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                    $category_img = wp_get_attachment_url($thumbnail_id);
                    if ($index === 0) { ?>
                        <div class="col-lg-6 p-0">
                            <div class="categories__item categories__large__item set-bg"
                                data-setbg="<?php echo esc_url($category_img); ?>">
                                <div class="categories__text">
                                    <h1><?php echo esc_html($category->name); ?></h1>
                                    <p><?php echo esc_html($category->description); ?></p>
                                    <a href="<?php echo esc_url(get_term_link($category)); ?>">Shop now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                            <?php } else { ?>

                                <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                                    <div class="categories__item set-bg" data-setbg="<?php echo esc_url($category_img); ?>">
                                        <div class="categories__text">
                                            <h4><?php echo esc_html($category->name); ?></h4>
                                            <p><?php echo esc_html($category->count); ?> items</p>
                                            <a href="<?php echo esc_url(get_term_link($category)); ?>">Shop now</a>
                                        </div>
                                    </div>
                                </div>

                    <?php }
                        $index++;
                    }
                }
                    ?>
                            </div>
                        </div>
        </div>
    </div>
</section>

<!-- Categories Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="section-title">
                    <h4>New Products</h4>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
                <ul class="filter__controls">
                    <li class="active" data-filter="*">All</li>
                    <?php
                    // Fetch product categories (parent categories only)
                    $categories = get_terms(array(
                        'taxonomy'   => 'product_cat', // WooCommerce product categories
                        'hide_empty' => true,           // Exclude categories with no products
                        'parent'     => 0,              // Get only parent categories
                        'orderby'    => 'name',         // Sort alphabetically (optional)
                    ));

                    // Check if categories exist and loop through them
                    if (!empty($categories) && !is_wp_error($categories)) {
                        foreach ($categories as $category) {
                            echo '<li data-filter=".' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</li>';
                        }
                    } else {
                        echo '<li>No categories available.</li>';
                    }
                    ?>
                </ul>
            </div>

        </div>
        <div class="row property__gallery">
            <?php
            // Query WooCommerce products
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 8, // Number of products to display
                'orderby' => 'date', // Order by latest
                'order' => 'DESC',
            );
            $products = new WP_Query($args);

            if ($products->have_posts()) {
                while ($products->have_posts()) {
                    $products->the_post();

                    // Get product details
                    global $product;
                    $categories = wc_get_product_category_list($product->get_id()); // Get categories
                    // echo "<pre>";
                    // print_r(strtolower($categories));
                    $price = $product->get_price_html(); // Get price
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'full')[0]; // Get product image
                    $link = get_permalink($product->get_id()); // Get product link
                    $title = get_the_title();
            ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mix <?php echo esc_attr(join(' ', wc_get_product_category_slugs($product->get_id()))); ?>">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="<?php echo esc_url($image); ?>">
                                <ul class="product__hover">
                                    <li><a href="<?php echo esc_url($image); ?>" class="image-popup">
                                            <svg width="24" height="24" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                                                <g>
                                                    <path d="M 29.922,2.618c-0.102-0.244-0.296-0.44-0.54-0.54C 29.26,2.026, 29.13,2, 29,2l-8,0 C 20.448,2, 20,2.448, 20,3 C 20,3.552, 20.448,4, 21,4l 5.586,0 L 18.292,12.292c-0.39,0.39-0.39,1.024,0,1.414c 0.39,0.39, 1.024,0.39, 1.414,0L 28,5.414L 28,11 C 28,11.552, 28.448,12, 29,12S 30,11.552, 30,11l0-8 l0,0C 30,2.87, 29.974,2.74, 29.922,2.618zM 3,20C 2.448,20, 2,20.448, 2,21l0,8 c0,0.002,0,0.002,0,0.004c0,0.13, 0.026,0.258, 0.076,0.378 c 0.048,0.118, 0.12,0.224, 0.208,0.314c 0.004,0.004, 0.004,0.008, 0.008,0.012c 0.002,0.002, 0.006,0.002, 0.008,0.006 c 0.090,0.088, 0.198,0.162, 0.316,0.21C 2.74,29.974, 2.87,30, 3,30l 8,0 C 11.552,30, 12,29.552, 12,29C 12,28.448, 11.552,28, 11,28L 5.414,28 l 8.292-8.292c 0.39-0.39, 0.39-1.024,0-1.414c-0.39-0.39-1.024-0.39-1.414,0L 4,26.586L 4,21 C 4,20.448, 3.552,20, 3,20z"></path>
                                                </g>
                                            </svg>
                                        </a></li>
                                    <li><a
                                            href="<?php echo esc_url(wp_nonce_url(add_query_arg('add_to_wishlist', $product->get_id(), $base_url), 'add_to_wishlist')); ?>"
                                            class="<?php echo esc_attr($link_classes); ?>"
                                            data-product-id="<?php echo esc_attr($product_id); ?>"
                                            data-product-type="<?php echo esc_attr($product_type); ?>"
                                            data-original-product-id="<?php echo esc_attr($parent_product_id); ?>"
                                            data-title="<?php echo esc_attr(apply_filters('yith_wcwl_add_to_wishlist_title', $label)); ?>"
                                            rel="nofollow"><svg width="24" height="24" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                                                <g>
                                                    <path d="M 31.984,13.834C 31.9,8.926, 27.918,4.552, 23,4.552c-2.844,0-5.35,1.488-7,3.672 C 14.35,6.040, 11.844,4.552, 9,4.552c-4.918,0-8.9,4.374-8.984,9.282L0,13.834 c0,0.030, 0.006,0.058, 0.006,0.088 C 0.006,13.944,0,13.966,0,13.99c0,0.138, 0.034,0.242, 0.040,0.374C 0.48,26.872, 15.874,32, 15.874,32s 15.62-5.122, 16.082-17.616 C 31.964,14.244, 32,14.134, 32,13.99c0-0.024-0.006-0.046-0.006-0.068C 31.994,13.89, 32,13.864, 32,13.834L 31.984,13.834 z M 29.958,14.31 c-0.354,9.6-11.316,14.48-14.080,15.558c-2.74-1.080-13.502-5.938-13.84-15.596C 2.034,14.172, 2.024,14.080, 2.010,13.98 c 0.002-0.036, 0.004-0.074, 0.006-0.112C 2.084,9.902, 5.282,6.552, 9,6.552c 2.052,0, 4.022,1.048, 5.404,2.878 C 14.782,9.93, 15.372,10.224, 16,10.224s 1.218-0.294, 1.596-0.794C 18.978,7.6, 20.948,6.552, 23,6.552c 3.718,0, 6.916,3.35, 6.984,7.316 c0,0.038, 0.002,0.076, 0.006,0.114C 29.976,14.080, 29.964,14.184, 29.958,14.31z"></path>
                                                </g>
                                            </svg></a></li>
                                    <li>
                                        <form class="add-to-cart-form" action="" method="get">
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
                            <div class="product__item__text">
                                <h6><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price"><?php echo $price; ?></div>
                            </div>
                        </div>
                    </div>
            <?php
                }
                wp_reset_postdata();
            } else {
                echo '<p>No products found.</p>';
            }
            ?>
        </div>
    </div>
</section>
<!-- <section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="section-title">
                    <h4>New product</h4>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
                <ul class="filter__controls">
                    <li class="active" data-filter="*">All</li>
                    <li data-filter=".women">Women’s</li>
                    <li data-filter=".men">Men’s</li>
                    <li data-filter=".kid">Kid’s</li>
                    <li data-filter=".accessories">Accessories</li>
                    <li data-filter=".cosmetic">Cosmetics</li>
                </ul>
            </div>
        </div>
        <div class="row property__gallery">

            <?php
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 8, // Number of products to display
                'order' => 'DESC',
            );

            echo '<pre>';
            print_r($products);

            ?>

            <div class="col-lg-3 col-md-4 col-sm-6 mix women">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/product/product-1.jpg">
                        <div class="label new">New</div>
                        <ul class="product__hover">
                            <li><a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/product/product-1.jpg" class="image-popup"><span
                                        class="arrow_expand"></span></a></li>
                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                            <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">Buttons tweed blazer</a></h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__price">$ 59.0</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix men">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/product/product-2.jpg">
                        <ul class="product__hover">
                            <li><a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/product/product-2.jpg" class="image-popup"><span
                                        class="arrow_expand"></span></a></li>
                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                            <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">Flowy striped skirt</a></h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__price">$ 49.0</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix accessories">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/product/product-3.jpg">
                        <div class="label stockout">out of stock</div>
                        <ul class="product__hover">
                            <li><a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/product/product-3.jpg" class="image-popup"><span
                                        class="arrow_expand"></span></a></li>
                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                            <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">Cotton T-Shirt</a></h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__price">$ 59.0</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix cosmetic">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/product/product-4.jpg">
                        <ul class="product__hover">
                            <li><a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/product/product-4.jpg" class="image-popup"><span
                                        class="arrow_expand"></span></a></li>
                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                            <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">Slim striped pocket shirt</a></h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__price">$ 59.0</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix kid">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/product/product-5.jpg">
                        <ul class="product__hover">
                            <li><a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/product/product-5.jpg" class="image-popup"><span
                                        class="arrow_expand"></span></a></li>
                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                            <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">Fit micro corduroy shirt</a></h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__price">$ 59.0</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix women men kid accessories cosmetic">
                <div class="product__item sale">
                    <div class="product__item__pic set-bg" data-setbg="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/product/product-6.jpg">
                        <div class="label sale">Sale</div>
                        <ul class="product__hover">
                            <li><a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/product/product-6.jpg" class="image-popup"><span
                                        class="arrow_expand"></span></a></li>
                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                            <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">Tropical Kimono</a></h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__price">$ 49.0 <span>$ 59.0</span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix women men kid accessories cosmetic">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/product/product-7.jpg">
                        <ul class="product__hover">
                            <li><a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/product/product-7.jpg" class="image-popup"><span
                                        class="arrow_expand"></span></a></li>
                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                            <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">Contrasting sunglasses</a></h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__price">$ 59.0</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix women men kid accessories cosmetic">
                <div class="product__item sale">
                    <div class="product__item__pic set-bg" data-setbg="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/product/product-8.jpg">
                        <div class="label">Sale</div>
                        <ul class="product__hover">
                            <li><a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/product/product-8.jpg" class="image-popup"><span
                                        class="arrow_expand"></span></a></li>
                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                            <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">Water resistant backpack</a></h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__price">$ 49.0 <span>$ 59.0</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- Product Section End -->

<!-- Banner Section Begin -->
<?php $image = get_field('home_page_salider_section_background_image'); ?>
<section class="banner set-bg" data-setbg="<?php echo esc_url($image['url']); ?>">
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-8 m-auto">
                <div class="banner__slider owl-carousel">
                    <?php if (have_rows('home_page_salider_section_repeater')): ?>
                        <?php while (have_rows('home_page_salider_section_repeater')): the_row();
                        ?>
                            <div class="banner__item">
                                <div class="banner__text">
                                    <span><?php echo get_sub_field('home_page_salider_section_repeater_title'); ?></span>
                                    <h1><?php echo get_sub_field('home_page_salider_section_repeater_heading'); ?></h1>
                                    <a href="<?php echo get_sub_field('home_page_salider_section_repeater_url'); ?>"><?php echo get_sub_field('home_page_salider_section_repeater_button_name'); ?></a>
                                </div>
                            </div>

                        <?php endwhile; ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->

<!-- Trend Section Begin -->
<section class="trend spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Hot Trend</h4>
                    </div>
                    <?php
                    $hot_trend_products = wc_get_products(array(
                        'limit' => 3, // Number of products to display
                        'orderby' => 'date',
                        'order' => 'DESC', // Newest products first
                        'status' => 'publish'
                    ));

                    foreach ($hot_trend_products as $product) {
                    ?>
                        <div class="trend__item">
                            <div class="trend__item__pic">
                                <a href="<?php echo esc_url($product->get_permalink()); ?>">
                                    <img width="70px" src="<?php echo esc_url(wp_get_attachment_url($product->get_image_id())); ?>" alt="<?php echo esc_attr($product->get_name()); ?>">
                                </a>
                            </div>
                            <div class="trend__item__text">
                                <h6><a style="color: #1e1d1d;" href="<?php echo esc_url($product->get_permalink()); ?>"><?php echo esc_html($product->get_name()); ?></a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price" style="color: #1e1d1d;"><?php echo $product->get_price_html(); ?></div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <!-- Best Seller Section -->
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Best Seller</h4>
                    </div>
                    <?php
                    $best_seller_products = wc_get_products(array(
                        'limit' => 3,
                        'orderby' => 'meta_value_num',
                        'meta_key' => 'total_sales',
                        'order' => 'DESC',
                        'status' => 'publish'
                    ));

                    foreach ($best_seller_products as $product) {
                    ?>
                        <div class="trend__item">
                            <div class="trend__item__pic">
                                <a href="<?php echo esc_url($product->get_permalink()); ?>">
                                    <img width="70px" src="<?php echo esc_url(wp_get_attachment_url($product->get_image_id())); ?>" alt="<?php echo esc_attr($product->get_name()); ?>">
                                </a>
                            </div>
                            <div class="trend__item__text">
                                <h6><a style="color: #1e1d1d;" href="<?php echo esc_url($product->get_permalink()); ?>"><?php echo esc_html($product->get_name()); ?></a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price" style="color: #1e1d1d;"><?php echo $product->get_price_html(); ?></div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <!-- Feature Section -->
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Feature</h4>
                    </div>
                    <?php
                    $featured_products = wc_get_products(array(
                        'limit' => 3,
                        'featured' => true,
                        'status' => 'publish'
                    ));

                    foreach ($featured_products as $product) {
                    ?>
                        <div class="trend__item">
                            <div class="trend__item__pic">
                                <a href="<?php echo esc_url($product->get_permalink()); ?>">
                                    <img width="70px" src="<?php echo esc_url(wp_get_attachment_url($product->get_image_id())); ?>" alt="<?php echo esc_attr($product->get_name()); ?>">
                                </a>
                            </div>
                            <div class="trend__item__text">
                                <h6><a style="color: #1e1d1d;" href="<?php echo esc_url($product->get_permalink()); ?>"><?php echo esc_html($product->get_name()); ?></a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price" style="color: #1e1d1d;"><?php echo $product->get_price_html(); ?></div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Trend Section End -->

<!-- Discount Section Begin -->
<section class="discount">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 p-0">
                <div class="discount__pic">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/discount.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-6 p-0">
                <div class="discount__text">
                    <div class="discount__text__title">
                        <span>Discount</span>
                        <h2><?php echo get_field('home_page_section_discount'); ?></h2>
                        <h5><span>Sale</span> <?php echo get_field('home_page_section_discount_reat'); ?></h5>
                    </div>
                    <div class="discount__countdown" id="countdown-time">
                        <div class="countdown__item">
                            <span>22</span>
                            <p>Days</p>
                        </div>
                        <div class="countdown__item">
                            <span>18</span>
                            <p>Hour</p>
                        </div>
                        <div class="countdown__item">
                            <span>46</span>
                            <p>Min</p>
                        </div>
                        <div class="countdown__item">
                            <span>05</span>
                            <p>Sec</p>
                        </div>
                    </div>
                    <a href="<?php echo get_field('home_page_section_discount_buttone_url'); ?>"><?php echo get_field('home_page_section_discount__button_name'); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Discount Section End -->
<br>
<!-- Services Section End -->

<!-- Instagram Begin -->
<div class="instagram">
    <div class="container-fluid">
        <div class="row">
            <?php if (have_rows('home_page_section_instagram__images_repeater')): ?>
                <?php while (have_rows('home_page_section_instagram__images_repeater')): the_row();
                    $image = get_sub_field('home_page_section_instagram_repeater_images_');
                ?>
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="<?php echo esc_url($image['url']); ?>">
                            <div class="instagram__text">
                                <i class="fa fa-instagram"></i>
                                <a href="#"><?php echo get_sub_field('home_page_section_instagram_repeater_button_name'); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function($) {
        $(".filter__controls li").click(function() {
            var filterValue = $(this).attr("data-filter");

            // Show all products if "All" is selected
            if (filterValue === "*") {
                $(".property__gallery .mix").show();
            } else {
                $(".property__gallery .mix").hide();
                $(".property__gallery " + filterValue).show();
            }

            // Update active class
            $(".filter__controls li").removeClass("active");
            $(this).addClass("active");
        });
    });
    jQuery(document).ready(function($) {
        $('a.add-to-cart').on('click', function(e) {
            alert('hallo');
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
</script>
<!-- Instagram End -->
<?php get_footer(); ?>
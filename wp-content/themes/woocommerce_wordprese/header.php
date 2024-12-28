<?php

/**
 * The header for Astra Theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

?>
<!DOCTYPE html>
<?php astra_html_before(); ?>
<html <?php language_attributes(); ?>>

<head>
    <?php //astra_head_top(); 
    ?>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    if (apply_filters('astra_header_profile_gmpg_link', true)) {
    ?>
        <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php
    }
    ?>
    <?php wp_head(); ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/style.css" type="text/css">

    <?php // astra_head_bottom(); 
    ?>
</head>

<body <?php //astra_schema_body(); 
        ?> <?php body_class(); ?>>
    <?php //astra_body_top(); 
    ?>
    <?php //wp_body_open(); 
    ?>

    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>
            <li><a href="#"><span class="icon_heart_alt"></span>
                    <div class="tip">2</div>
                </a></li>
            <li><a href="#"><span class="icon_bag_alt"></span>
                    <div class="tip">2</div>
                </a></li>
        </ul>
        <div class="offcanvas__logo">
            <a href="./index.html"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.png" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            <a href="#">Login</a>
            <a href="#">Register</a>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-2">
                    <div class="header__logo">
                        <a href="/woocommerce_wordprese/">
                            <?php
                            $imageLog = get_field('header_section_logo', 'option');
                            if (!empty($imageLog)) {
                            ?>
                                <img src="<?php echo esc_url($imageLog['url']); ?>" alt="<?php echo esc_url($imageLog['alt']); ?>">
                            <?php } ?>
                        </a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7">
                    <nav class="header__menu">
                        <ul>

                            <?php
                            $menu = 'Header Menu';
                            $args = array(
                                'order' => 'DESC',
                                'orderby' => 'menu_order',
                                'post_type' => 'nav_menu_item',
                                'post_status' => 'publish',
                                'output' => ARRAY_A,
                                'output_key' => 'menu_order',
                                'nopaging' => true,
                                'update_post_term_cache' => false
                            );
                            $items = wp_get_nav_menu_items($menu, $args);
                            //echo "<pre>"; print_r($items); echo "</pre>";

                            global $wp_query;

                            $pagename = '';
                            if ($wp_query->queried_object) {
                                $pagename = isset($wp_query->queried_object->post_title) ? $wp_query->queried_object->post_title : '';
                            }

                            $current_page_url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                            ?>
                            <?php for ($i = 0; $i < count($items); $i++) { ?>
                                <li>
                                    <a href="<?php echo $items[$i]->url; ?>" class="nav-link text-blue  <?php if ($current_page_url == $items[$i]->url) { ?> active <?php } ?>"><?php echo $items[$i]->title; ?></a>
                                </li>
                            <?php }
                            ?>
                        </ul>
                    </nav>
                </div>
                <style>
                    /* Style for the search icon */
                    .search-icon svg {
                        cursor: pointer;
                        width: 24px;
                        height: 24px;
                        transition: all 0.3s ease;
                    }

                    /* Style the search form */
                    #search-bar {
                        position: absolute;
                        top: 50px;
                        /* Adjust this value as needed */
                        left: 50%;
                        transform: translateX(-50%);
                        background-color: white;
                        border: 1px solid #ccc;
                        padding: 10px;
                        width: 300px;
                        display: none;
                        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
                        z-index: 1000;
                    }

                    /* Optional: Add a background overlay when the search bar is visible */
                    #search-bar.open {
                        display: block;
                        animation: slideIn 0.3s ease-out;
                    }

                    .searchform {
                        border-radius: 47px;
                        margin-left: 5px;
                        margin-top: -6px;
                    }

                    /* Optional: Add some animation */
                    @keyframes slideIn {
                        from {
                            opacity: 0;
                            transform: translateX(-50%) translateY(-20px);
                        }

                        to {
                            opacity: 1;
                            transform: translateX(-50%) translateY(0);
                        }

                        element.style {
                            border-radius: 47px;
                            margin-left: 5px;
                            margin-top: -6px;
                        }
                    }
                </style>
                <div class="col-lg-3">
                    <div class="header__right">
                        <!-- <div class="header__right__auth">
                            <a href="#">Login</a>
                            <a href="#">Register</a>
                        </div> -->
                        <ul class="header__right__widget">
                            <li>
                                <!-- Link that will trigger the search form -->
                                <a href="#" id="search-toggle" class="search-icon">
                                    <svg width="24" height="24" viewBox="0 0 32.24800109863281 32.24800109863281" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                                        <g>
                                            <path d="M 19,0C 11.82,0, 6,5.82, 6,13c0,3.090, 1.084,5.926, 2.884,8.158l-8.592,8.592c-0.54,0.54-0.54,1.418,0,1.958 c 0.54,0.54, 1.418,0.54, 1.958,0l 8.592-8.592C 13.074,24.916, 15.91,26, 19,26c 7.18,0, 13-5.82, 13-13S 26.18,0, 19,0z M 19,24 C 12.934,24, 8,19.066, 8,13S 12.934,2, 19,2S 30,6.934, 30,13S 25.066,24, 19,24z"></path>
                                        </g>
                                    </svg>
                                </a>
                            </li>

                            <!-- Search form (hidden by default) -->
                            <div id="search-bar" style="display: none;">
                                <?php get_product_search_form(); ?>
                            </div>

                            <script>
                                document.getElementById('search-toggle').addEventListener('click', function(e) {
                                    e.preventDefault();
                                    var searchForm = document.getElementById('search-bar');

                                    // Toggle the visibility of the search form
                                    if (searchForm.style.display === 'none' || searchForm.style.display === '') {
                                        searchForm.style.display = 'block'; // Show the search form
                                        searchForm.classList.add('open'); // Optional animation
                                    } else {
                                        searchForm.style.display = 'none'; // Hide the search form
                                        searchForm.classList.remove('open'); // Remove animation class
                                    }
                                });
                            </script>
                            <li>
                                <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>">

                                    <svg width="24px" height="24px" xmlns="http://www.w3.org/2000/svg" fill="none" class="icon icon-account" viewBox="0 0 18 19">
                                        <path fill="currentColor" fill-rule="evenodd" d="M6 4.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-4a4 4 0 1 0 0 8 4 4 0 0 0 0-8m5.58 12.15c1.12.82 1.83 2.24 1.91 4.85H1.51c.08-2.6.79-4.03 1.9-4.85C4.66 11.75 6.5 11.5 9 11.5s4.35.26 5.58 1.15M9 10.5c-2.5 0-4.65.24-6.17 1.35C1.27 12.98.5 14.93.5 18v.5h17V18c0-3.07-.77-5.02-2.33-6.15-1.52-1.1-3.67-1.35-6.17-1.35" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </li>
                            <li><a href="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()); ?>">
                                    <svg width="24" height="24" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                                        <g>
                                            <path d="M 31.984,13.834C 31.9,8.926, 27.918,4.552, 23,4.552c-2.844,0-5.35,1.488-7,3.672 C 14.35,6.040, 11.844,4.552, 9,4.552c-4.918,0-8.9,4.374-8.984,9.282L0,13.834 c0,0.030, 0.006,0.058, 0.006,0.088 C 0.006,13.944,0,13.966,0,13.99c0,0.138, 0.034,0.242, 0.040,0.374C 0.48,26.872, 15.874,32, 15.874,32s 15.62-5.122, 16.082-17.616 C 31.964,14.244, 32,14.134, 32,13.99c0-0.024-0.006-0.046-0.006-0.068C 31.994,13.89, 32,13.864, 32,13.834L 31.984,13.834 z M 29.958,14.31 c-0.354,9.6-11.316,14.48-14.080,15.558c-2.74-1.080-13.502-5.938-13.84-15.596C 2.034,14.172, 2.024,14.080, 2.010,13.98 c 0.002-0.036, 0.004-0.074, 0.006-0.112C 2.084,9.902, 5.282,6.552, 9,6.552c 2.052,0, 4.022,1.048, 5.404,2.878 C 14.782,9.93, 15.372,10.224, 16,10.224s 1.218-0.294, 1.596-0.794C 18.978,7.6, 20.948,6.552, 23,6.552c 3.718,0, 6.916,3.35, 6.984,7.316 c0,0.038, 0.002,0.076, 0.006,0.114C 29.976,14.080, 29.964,14.184, 29.958,14.31z"></path>
                                        </g>
                                    </svg>
                                    <div class="tip"><?php echo get_wishlist_count(); ?></div>
                                </a></li>
                            <li>
                                <a href="<?php echo esc_url(wc_get_cart_url()); ?>">

                                    <svg width="24" height="24" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                                        <g>
                                            <path d="M 6,32l 20,0 c 1.104,0, 2-0.896, 2-2L 28,8 c0-1.104-0.896-2-2-2l-4.010,0 C 21.942,2.678, 19.282,0, 16,0S 10.058,2.678, 10.010,6 L 6,6 C 4.896,6, 4,6.896, 4,8l0,22 C 4,31.104, 4.896,32, 6,32z M 26,8l0,22 L 6,30 L 6,8 L 26,8 z M 16,2c 2.174,0, 3.942,1.786, 3.99,4L 12.010,6 C 12.058,3.786, 13.826,2, 16,2zM 13,12l 6,0 C 19.552,12, 20,11.552, 20,11C 20,10.448, 19.552,10, 19,10l-6,0 C 12.448,10, 12,10.448, 12,11C 12,11.552, 12.448,12, 13,12z "></path>
                                        </g>
                                    </svg>
                                    <div class="tip"> <?php echo WC()->cart->get_cart_contents_count(); ?></div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="canvas__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
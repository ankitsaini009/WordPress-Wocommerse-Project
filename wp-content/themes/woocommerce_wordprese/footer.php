<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
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

<?php
//astra_footer();
?>
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-7">
                <div class="footer__about">
                    <div class="footer__logo">
                        <?php
                        $imageLog = get_field('footer_section_logo', 'option');
                        if (!empty($imageLog)) {
                        ?>
                            <a href="woocommerce_wordprese/">
                                <img src="<?php echo esc_url($imageLog['url']); ?>" alt="<?php echo esc_url($imageLog['alt']); ?>"></a>
                        <?php } ?>
                    </div>
                    <p><?php echo get_field('footer_section_description', 'option'); ?></p>
                    <div class="footer__payment">

                        <?php if (have_rows('footer_section_payment_icons', 'option')): ?>
                            <?php while (have_rows('footer_section_payment_icons', 'option')): the_row();
                                $image = get_sub_field('footer_section_payment_icons_repeater', 'option');
                            ?>
                                <a href="#"><img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_url($image['url']); ?>"></a>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-5">
                <div class="footer__widget">
                    <h6>Quick links</h6>
                    <ul>
                        <?php
                        $menu = 'Footer Quick links Menu';
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
                                <a href="<?php echo $items[$i]->url; ?>"><?php echo $items[$i]->title; ?></a>
                            </li>
                        <?php }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="footer__widget">
                    <h6>Account</h6>
                    <ul>
                        <?php
                        $menu = 'Footer Account Menu';
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
                                <a href="<?php echo $items[$i]->url; ?>"><?php echo $items[$i]->title; ?></a>
                            </li>
                        <?php }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-8">
                <div class="footer__newslatter">
                    <h6>NEWSLETTER</h6>
                    <form action="#">
                        <input type="text" placeholder="Email">
                        <button type="submit" class="site-btn">Subscribe</button>
                    </form>
                    <div class="footer__social">
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                <div class="footer__copyright__text">
                    <p>Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This
                        template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a
                            href="https://colorlib.com" target="_blank">Colorlib</a>
                    </p>
                </div>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Search Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<!-- Search End -->

<!-- Js Plugins -->
<?php
wp_footer();
?>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery-ui.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/mixitup.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.countdown.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.slicknav.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/owl.carousel.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.nicescroll.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/main.js"></script>

</body>

</html>
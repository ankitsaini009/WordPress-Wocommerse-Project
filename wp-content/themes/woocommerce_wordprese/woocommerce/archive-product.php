<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined('ABSPATH') || exit;

get_header('shop'); ?>
<?php

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');

/**
 * Hook: woocommerce_shop_loop_header.
 *
 * @since 8.6.0
 *
 * @hooked woocommerce_product_taxonomy_archive_header - 10
 */
if (woocommerce_product_loop()) {
?>
    <style>
        .pagination__option {
            display: inline-block;
            margin-top: 20px;
        }

        .pagination__option a,
        .pagination__option span {
            display: inline-block;
            padding: 10px 15px;
            margin: 0 5px;
            background: #f8f8f8;
            color: #333;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .pagination__option a:hover {
            background: #333;
            color: #fff;
        }

        .pagination__option .current {
            background: #333;
            color: #fff;
            font-weight: bold;
        }

        .ui-slider {
            background: #ccc;
            height: 10px;
        }

        .ui-slider-range {
            background: #ff6600;
        }

        .ui-slider-handle {
            background: #ff6600;
            border: 1px solid #ff6600;
        }

        #product-list p {
            text-align: center;
            font-size: 18px;
            color: #333;
        }

        input[type="checkbox"]+.checkmark {
            display: inline-block;
            width: 16px;
            height: 16px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            margin-left: 10px;
            cursor: pointer;
        }

        input[type="checkbox"]:checked+.checkmark {
            background-color: #0071a1;
            border-color: #0071a1;
        }
    </style>
    <!-- jQuery CDN -->
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery UI CDN -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="shop__sidebar">
                        <div class="sidebar__categories">
                            <div class="section-title">
                                <h4>Categories</h4>
                            </div>
                            <div class="categories__accordion">
                                <div class="accordion" id="accordionExample">
                                    <?php
                                    // Get WooCommerce product categories
                                    $args = array(
                                        'taxonomy'     => 'product_cat', // WooCommerce product category
                                        'show_count'   => 1,             // Show product count
                                        'pad_counts'   => 0,             // Don't pad the counts
                                        'hierarchical' => 1,             // Enable hierarchy
                                        'title_li'     => '',             // Remove default title
                                        'number'       => 4,
                                        'parent'       => 0,
                                    );
                                    $categories = get_categories($args);

                                    // Loop through categories and display them
                                    foreach ($categories as $category) {
                                        // Get category URL
                                        $category_url = get_term_link($category);
                                    ?>
                                        <div class="card">
                                            <div class="card-heading">
                                                <a data-toggle="collapse" data-target="#collapse-<?php echo $category->term_id; ?>"><?php echo $category->name; ?></a>
                                            </div>
                                            <div id="collapse-<?php echo $category->term_id; ?>" class="collapse" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <?php
                                                    // Fetch subcategories if any
                                                    $subcategories = get_terms(array(
                                                        'taxonomy' => 'product_cat',
                                                        'parent'   => $category->term_id,
                                                        'orderby'  => 'name'
                                                    ));

                                                    if ($subcategories) {
                                                        echo '<ul>';
                                                        foreach ($subcategories as $subcategory) {
                                                            echo '<li><a href="' . get_term_link($subcategory) . '">' . $subcategory->name . '</a></li>';
                                                        }
                                                        echo '</ul>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar__filter">
                            <div class="section-title">
                                <h4>Shop by price</h4>
                            </div>
                            <div class="filter-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="33" data-max="500">
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <p>Price:</p>
                                        <input type="text" id="minamount" value="0" readonly>
                                        <input type="text" id="maxamount" value="500" readonly style="padding: 0px;">
                                    </div>
                                </div>
                            </div>
                            <a href="javascript:void(0)" id="filter-price">Filter</a>
                        </div>


                        <div class="sidebar__sizes">
                            <div class="section-title">
                                <h4>Shop by size</h4>
                            </div>
                            <div class="size__list">
                                <?php
                                // Get all terms for the 'pa_size' attribute
                                $sizes = get_terms('pa_size', array('hide_empty' => true));
                                foreach ($sizes as $size) :
                                ?>
                                    <label>
                                        <?php echo esc_html($size->name); ?>
                                        <input type="checkbox" class="size-filter" value="<?php echo esc_attr($size->slug); ?>">
                                        <span class="checkmark"></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="sidebar__color">
                            <div class="section-title">
                                <h4>Shop by color</h4>
                            </div>
                            <div class="color__list">
                                <?php
                                // Get all terms for the 'pa_color' attribute
                                $colors = get_terms('pa_color', array('hide_empty' => true));
                                foreach ($colors as $color) :
                                ?>
                                    <label>
                                        <?php echo esc_html($color->name); ?>
                                        <input type="checkbox" class="color-filter" value="<?php echo esc_attr($color->slug); ?>">
                                        <span class="checkmark"></span>
                                    </label><br>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="">
                        <div class="grid" id="product-list">
                            <?php
                            // WooCommerce product loop
                            if (woocommerce_product_loop()) {
                                woocommerce_product_loop_start();

                                // Loop through the products
                                while (have_posts()) {
                                    the_post();

                                    /**
                                     * Hook: woocommerce_shop_loop.
                                     */
                                    do_action('woocommerce_shop_loop');

                                    // Load product template
                                    wc_get_template_part('content', 'product');
                                }

                                woocommerce_product_loop_end();
                            } else {
                                // If no products are found
                                do_action('woocommerce_no_products_found');
                            }
                            ?>
                        </div>

                        <!-- Custom Pagination -->
                        <div class="col-lg-12 text-center">
                            <div class="pagination__option">
                                <?php
                                // Add pagination
                                global $wp_query;

                                $big = 999999999; // An unlikely integer for pagination replacement
                                echo paginate_links(array(
                                    'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                                    'format'    => '?paged=%#%',
                                    'current'   => max(1, get_query_var('paged')),
                                    'total'     => $wp_query->max_num_pages,
                                    'prev_text' => '<i class="fa fa-angle-left"></i>', // Previous page
                                    'next_text' => '<i class="fa fa-angle-right"></i>', // Next page
                                ));
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
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
    <script>
        jQuery(document).ready(function($) {
            // Function to collect selected filters
            function getSelectedFilters() {
                let selectedSizes = [];
                let selectedColors = [];

                // Get selected sizes
                $(".size-filter:checked").each(function() {
                    selectedSizes.push($(this).val());
                });

                // Get selected colors
                $(".color-filter:checked").each(function() {
                    selectedColors.push($(this).val());
                });

                return {
                    sizes: selectedSizes,
                    colors: selectedColors,
                };
            }

            // Event listener for filter change
            $(".size-filter, .color-filter").change(function() {
                let filters = getSelectedFilters();

                // AJAX call to filter products
                $.ajax({
                    url: woocommerce_params.ajax_url, // WooCommerce provides this global object
                    method: "GET",
                    data: {
                        action: "filter_products", // Custom action hook
                        sizes: filters.sizes,
                        colors: filters.colors,
                    },
                    beforeSend: function() {
                        $('#product-list').html('<p>Loading...</p>'); // Show loading state
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update product list with returned HTML
                            $('#product-list').html(response.data.html);
                        } else {
                            console.error(response.data.message);
                        }
                    },
                    error: function(error) {
                        console.error('AJAX Error:', error);
                    },
                });
            });
        });

        $(document).ready(function() {
            var minPrice = 0; // Minimum price (set dynamically or hardcoded)
            var maxPrice = 500; // Maximum price (set dynamically or hardcoded)

            // Initialize the jQuery UI slider
            $(".price-range").slider({
                range: true, // To allow selecting a range
                min: 0, // Minimum value
                max: 500, // Maximum value
                step: 1, // Step size
                values: [0, 500], // Default values
                slide: function(event, ui) {
                    // Update the text inputs as the slider moves
                    $("#minamount").val(ui.values[0]);
                    $("#maxamount").val(ui.values[1]);
                }
            });
            // Initialize the inputs with the default values
            $("#minamount").val("₹" + minPrice);
            $("#maxamount").val("₹" + maxPrice);

            // Filter button functionality
            $("#filter-price").click(function(e) {
                e.preventDefault();

                var minPrice = $("#minamount").val().replace("$", "");
                var maxPrice = $("#maxamount").val().replace("$", "");

                // Apply the price filter via URL query string
                window.location.href = "?min_price=" + minPrice + "&max_price=" + maxPrice;
            });
        });
    </script>
<?php

} else {
    /**
     * Hook: woocommerce_no_products_found.
     *
     * @hooked wc_no_products_found - 10
     */
    do_action('woocommerce_no_products_found');
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action('woocommerce_sidebar');

get_footer('shop');

<?php

/**
 * Template Name: All Blogs
 */

get_header(); // Include the header template part

// Query arguments to fetch all posts
$args = [
    "post_type"      => "post",
    "orderby"        => "ID",
    "post_status"    => "publish",
    "order"          => "DESC",
    "posts_per_page" => -1, // Retrieve all published posts
];
$result = new WP_Query($args);
?>
<br>
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="<?php echo home_url(); ?>"><i class="fa fa-home"></i> Home</a>
                    <span>Blog</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($result->have_posts()) : ?>
    <section class="blog spad">
        <div class="container">
            <div class="row">
                <?php
                // Loop through the posts
                while ($result->have_posts()) : $result->the_post(); ?>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="blog__item">
                            <!-- Display dynamic featured image -->
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="blog__item__pic large__item set-bg"> <?php
                                                                                    // Display featured image if available
                                                                                    if (has_post_thumbnail()) {
                                                                                        the_post_thumbnail('medium'); // Adjust size as needed
                                                                                    }
                                                                                    ?>
                                </div>

                            <?php endif; ?>

                            <div class="blog__item__text">
                                <!-- Dynamic blog title and permalink -->
                                <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>

                                <!-- Blog meta information -->
                                <ul>
                                    <li>by <span><?php the_author(); ?></span></li>
                                    <li><?php echo get_the_date(); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
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
    wp_reset_postdata(); // Reset the global $post object
else :
    echo "<p>No blog posts found.</p>";
endif;
?>
<?php
get_footer(); // Include the footer template part
?>
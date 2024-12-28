<?php

/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Astra
 * @since 1.0.0
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<div id="primary" <?php astra_primary_class(); ?>>
	<?php
	/**
	 * Template Name: Blog Details
	 */
	get_header(); // Include the header template part

	if (have_posts()) : while (have_posts()) : the_post();
	?>
			<br>
			<div class="breadcrumb-option" style="background-color: white;margin-bottom: -45px;">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="breadcrumb__links">
								<a href="<?php echo home_url(); ?>"><i class="fa fa-home"></i> Home</a>
								<a href="<?php echo home_url(); ?>">Blog</a>
								<span><?php the_title(); ?></span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<section class="blog-details spad" style="background-color: white;">
				<div class="container">
					<div class="row">
						<!-- Blog Main Content -->
						<div class="col-lg-8 col-md-8">
							<div class="blog__details__content">
								<div class="blog__details__item">
									<!-- Featured Image -->
									<?php if (has_post_thumbnail()) : ?>
										<img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>">
									<?php endif; ?>
									<div class="blog__details__item__title">
										<!-- Post Categories -->
										<span class="tip">
											<?php
											$categories = get_the_category();
											if (!empty($categories)) {
												echo esc_html($categories[0]->name);
											}
											?>
										</span>
										<h4><?php the_title(); ?></h4>
										<ul>
											<li>by <span><?php the_author(); ?></span></li>
											<li><?php echo get_the_date(); ?></li>
											<li><?php comments_number('No Comments', '1 Comment', '% Comments'); ?></li>
										</ul>
									</div>
								</div>
								<div class="blog__details__desc">
									<!-- Post Content -->
									<p><?php the_content(); ?></p>
								</div>
								<!-- Post Tags -->
								<div class="blog__details__tags">
									<?php the_tags('', '', ''); ?>
								</div>

								<!-- Next and Previous Posts -->
								<div class="blog__details__btns">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-6">
											<div class="blog__details__btn__item">
												<h6>
													<?php previous_post_link('%link', '<i class="fa fa-angle-left"></i> Previous Post'); ?>
												</h6>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6">
											<div class="blog__details__btn__item blog__details__btn__item--next">
												<h6>
													<?php next_post_link('%link', 'Next Post <i class="fa fa-angle-right"></i>'); ?>
												</h6>
											</div>
										</div>
									</div>
								</div>

								<!-- Comments Section -->
								<div class="blog__details__comment">
									<h5><?php comments_number('No Comments', '1 Comment', '% Comments'); ?></h5>
									<a href="#comment-form" class="leave-btn">Leave a comment</a>
									<?php
									// Display Comments
									if (comments_open() || get_comments_number()) {
										comments_template();
									}
									?>
								</div>
							</div>
						</div>

						<!-- Blog Sidebar -->
						<div class="col-lg-4 col-md-4">
							<div class="blog__sidebar">
								<!-- Categories -->
								<div class="blog__sidebar__item">
									<div class="section-title">
										<h4>Categories</h4>
									</div>
									<ul>
										<?php
										$categories = get_categories();
										foreach ($categories as $category) {
											echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . ' <span>(' . $category->count . ')</span></a></li>';
										}
										?>
									</ul>
								</div>

								<!-- Featured Posts -->
								<div class="blog__sidebar__item">
									<div class="section-title">
										<h4>Feature Posts</h4>
									</div>
									<?php
									$featured_posts = new WP_Query([
										'posts_per_page' => 3,
										'orderby'        => 'date',
										'order'          => 'DESC',
									]);

									while ($featured_posts->have_posts()) : $featured_posts->the_post();
									?>
										<a href="<?php the_permalink(); ?>" class="blog__feature__item">
											<div class="blog__feature__item__pic">
												<?php if (has_post_thumbnail()) : ?>
													<img width="110" height="73" src="<?php the_post_thumbnail_url('thumbnail'); ?>" alt="<?php the_title(); ?>">
												<?php endif; ?>
											</div>
											<div class="blog__feature__item__text">
												<h6><?php the_title(); ?></h6>
												<span><?php echo get_the_date(); ?></span>
											</div>
										</a>
									<?php endwhile;
									wp_reset_postdata(); ?>
								</div>

								<!-- Tag Cloud -->
								<div class="blog__sidebar__item">
									<div class="section-title">
										<h4>Tags Cloud</h4>
									</div>
									<div class="blog__sidebar__tags">
										<?php
										$tags = get_tags();
										foreach ($tags as $tag) {
											echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

	<?php
		endwhile;
	endif; ?>

</div>

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
<?php get_footer(); ?>
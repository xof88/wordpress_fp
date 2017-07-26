<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package purplous-lite
 */

	get_header();
	global $wp_query;
	$purplous_lite_theme_options = purplous_lite_options();
	$sidebar_class = purplous_lite_sidebar_positon();
	$wrapper_class = purplous_lite_sidebar_wrapper();
	purplous_lite_breadcrumb();
	$cat_name = get_queried_object();
	if ($cat_name) {
		$cat = $cat_name->term_id;
	}
?>
<section class="sec-content blog-page-content <?php if ($sidebar_class == 'fullwidth') { echo esc_attr__('no-sidebar', 'purplous-lite'); } else { echo esc_attr__('sidebar-page', 'purplous-lite');} ?>">
    <div class="container">
        <div class="row">
            <div class="<?php echo esc_attr($wrapper_class);?>">

				<?php
				if ( have_posts() ) : ?>

					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();
						?>
						<div class="post-pad bgwhite content-list">
		                    <div class="col-md-5">
		                    	<div class="post-content-wrap">
			                        <div class="post-thumb-overlay">
			                           <?php get_template_part( 'template-parts/content', get_post_format() ); ?>
			                        </div>
		                        </div>
		                    </div>
		                    <div class="col-md-7">
		                        <div class="post-content">
		                        <?php if (! is_category()) {
		                        		$catname = get_the_category($post->ID);
											foreach($catname as $cname) {
												$single_cat = $cname->name;
												$single_cat_id = $cname->term_id;
											}
		                        	?>
		                            <span class="post-cat"><a href="<?php echo esc_url(get_category_link($single_cat_id)); ?>" ><?php echo esc_html($single_cat); ?></a></span>
		                        <?php } else { ?>
		                        	<span class="post-cat"><a href="<?php echo esc_url(get_category_link($cat)); ?>"><?php echo esc_html(get_cat_name($cat)); ?></a></span>
		                        <?php } ?>
		                            <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
		                            <div class="metabar-wrap">
		                                <span class="article-full-date"><i class="fa fa-calendar" aria-hidden="true"></i><a href="<?php echo esc_url( purplous_lite_archive_link( $post ) ); ?>"><?php echo esc_html(get_the_date('F d, Y'));?></a></span>
		                                <span class="post-like-count"><a href="<?php echo esc_url(get_comments_link($post->ID)); ?>"><i class="fa fa-comments" aria-hidden="true"></i><?php echo esc_html(get_comments_number($post->ID)); ?></a></span>
		                            </div>
		                            <div class="post-desc">
		                                 <p><?php echo esc_html(purplous_lite_strip_url_content($post->ID, 22)); ?>
                    						</p>
		                            </div>
		                           <div class="continue-read"><a href="<?php the_permalink();?>"><span><?php echo esc_html__('Read More', 'purplous-lite');?></span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></div>
		                        </div>
		                    </div>
		                </div>
					<?php

					endwhile;

					the_posts_pagination();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>

  			</div>
  			<?php if ($sidebar_class != 'fullwidth') { ?>
                <div class="col-md-4 <?php echo esc_attr($sidebar_class); ?>">
                    <!-- place sidebar here -->
                    <?php dynamic_sidebar( 'sidebar' ); ?>
                </div>
            <?php } ?>
    	</div>
    </div>
</section>

<?php
get_footer();
<?php
/**
* The template for displaying author archive pages.
*
* Learn more: http://codex.wordpress.org/Template_Hierarchy
*
* @package Purplous Lite
*/
	get_header();
	$objs = get_queried_object();
	$purplous_lite_theme_options = purplous_lite_options();
	if (! empty($objs)) {
		$author_id = $objs->ID;
	}
    $author_name = get_the_author_meta('display_name', $author_id);

     if ( get_header_image() ) :
            $header_image = get_header_image();
        else:
            $header_image = '';
        endif; // End header image check.

 ?>
<div class="inner-banner-wrap" style="background-image:url(<?php echo esc_url($header_image); ?>)">
    <div class="container">
        <div class="row">
            <div class="inner-banner-content">
            	<h2><?php echo esc_html($author_name); ?></h2>
            </div>
        </div>
    </div>
 </div>

<section class="sec-content blog-page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
			 <?php
			 		purplous_lite_author($author_id);//Displays author description on author page

				if ( have_posts() ) : ?>

					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();
						$catname = get_the_category($post->ID);
											foreach($catname as $cname) {
												$single_cat = $cname->name;
												$single_cat_id = $cname->term_id;
											}
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
				                            <span class="post-cat"><a href="<?php echo esc_url(get_category_link($single_cat_id)); ?>" ><?php echo esc_html($single_cat); ?></a></span>
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

					?>
					<div class="post-pad bgwhite content-list">
						<header class="page-header">
							<?php
	                            //the_post();
	                            printf(  '<h1 class="page-title title-font">'.esc_html(__('There are no posts by', 'purplous-lite')).' <span>'. esc_html( $author_name ).'</span></h1>', 'purplous-lite' );
	                         ?>
						</header><!-- .page-header -->
					</div>
				<?php

				endif; ?>
			</div>
			<div class="col-md-4">
				<?php dynamic_sidebar( 'sidebar' ); ?>
			</div>
    	</div>
    </div>
</section>
<?php get_footer();?>
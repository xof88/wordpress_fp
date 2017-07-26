<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package purplous-lite
 */
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
            <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
            <div class="metabar-wrap">
                <span class="article-full-date"><i class="fa fa-calendar" aria-hidden="true"></i><a href="<?php echo esc_url(purplous_lite_archive_link( $post )); ?>"><?php echo esc_html(get_the_date('F d, Y'));?></a></span>
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
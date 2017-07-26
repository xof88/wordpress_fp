<?php
global $post;
$purplous_lite_theme_options = purplous_lite_options();
$sidebar_class = purplous_lite_sidebar_positon();
$wrapper_class = purplous_lite_sidebar_wrapper();
$category = purplous_lite_display_random_catname($post->ID, 'category');
purplous_lite_breadcrumb();
?>
<!-- Breadcrumb -->

<!-- End of breadcrumb sec -->

<!-- Start of single page content -->
<section class="sec-content blog-page-content <?php if ($sidebar_class == 'fullwidth') { echo 'no-sidebar'; } else { echo 'sidebar-page';} ?>">
    <div class="container">
        <div class="row">
            <div class="<?php echo esc_attr($wrapper_class);?>">
                <div class="blog-post-wrapper bgwhite">
                    <div class="post-content-wrap post-pad">
                           <?php get_template_part( 'template-parts/content', get_post_format() ); ?>
                            <div class="metabar-wrap">
                                <span class="post-cat"><a href="<?php echo esc_url($category['link']); ?>" ><?php echo esc_html($category['name']); ?></a></span>
                                <span class="article-full-date"><i class="fa fa-calendar" aria-hidden="true"></i><a href="<?php echo esc_url( purplous_lite_archive_link($post) );?>"><?php echo esc_html(get_the_date('F d, Y')); ?></a></span>
                                <span class="post-like-count"><i class="fa fa-comments" aria-hidden="true"></i><a href="<?php echo esc_url(get_comments_link()); ?>"><?php echo esc_html(get_comments_number()).esc_html__(' Comments', 'purplous-lite');?></a></span>
                            </div>
                            <div class="post-content">
                                <h2><a href="#"><?php the_title();?></a></h2>
                                <div class="post-desc">
                                    <p><?php if ( has_post_format('gallery')) {  echo strip_shortcodes($post->post_content); } else { the_content();} ?></p>
                                </div>

                                    <?php
                                        $posttags = get_the_tags();
                                        $tagid = purplous_lite_all_taxonomy_link($post->ID, 'category');

                                        if ($posttags) {
                                            echo '<span class="tags-links">';
                                            echo '<i class="fa fa-tags" aria-hidden="true"></i>';
                                            echo esc_html__('Tags:', 'purplous-lite');

                                            foreach( $posttags as $tags) {

                                                purplous_lite_tag_link( $tags, $tagid);
                                            }
                                            echo '</span>';
                                        }
                                    ?>

                             </div>
                    </div>
                </div>

                <?php purplous_lite_single_navigation($post->ID); ?>

                <!-- Start of related post -->
                <?php purplous_lite_single_related_post($post->ID); ?>
                <!-- End of related post -->

                <!-- Start of author bio -->
                <?php purplous_lite_single_author($post->ID); ?>
                <!-- End of author bio -->

                <!-- Start of comment box -->
                <div class="bgwhite post-pad">
                        <h2 class="comments-title"><?php echo esc_html__('Comments on this post', 'purplous-lite'); ?></h2>
                        <span><?php echo esc_attr(get_comments_number()). esc_html__(' Comments', 'purplous-lite'); ?></span>
                        <?php $comment_number = get_comments_number();

                              $holded_comment = purplous_lite_hold_comments($post->ID);
                            if ($comment_number == 0 && $holded_comment == 0  ){ echo '</div>'; }
                         ?>
                          <!-- </div> bgwhite post-pad since comment form and comments are in different divs -->
                         <?php
                                // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;
                            ?>

                        <!-- End comment wrap -->
                <!-- End of comment box -->

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
<!-- End of single page content -->
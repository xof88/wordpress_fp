<?php
/**
 *
 * Template Name: Homepage - Template
 * Description: A page template that displays the Homepage or a Front page as in theme main page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package purplous-lite
 */
get_header();

$purplous_lite_theme_options = purplous_lite_options();
$sidebar_class = purplous_lite_sidebar_positon();
$wrapper_class = purplous_lite_sidebar_wrapper();
?>

<!-- Start of main slider -->
<?php purplous_lite_featured_section_homepage(); ?>
<!-- End of main slider -->

        <!-- Start of content section -->
        <section class="blog-page-content home-<?php echo esc_attr($sidebar_class);?>">
            <div class="container">
                <div class="row">
                    <div class="<?php echo esc_attr($wrapper_class);?>">
                        <!-- Start of home blog post list -->
                        <?php purplous_lite_blog_post();?>
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

       <!-- Start of top article section -->
<?php get_footer(); ?>
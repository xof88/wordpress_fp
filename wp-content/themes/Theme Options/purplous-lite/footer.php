 <?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package purplous-lite
 */

?>
<?php
    $purplous_lite_theme_options = purplous_lite_options();
    $enable_pre_footer = $purplous_lite_theme_options['pre_footer_checkbox'];
?>
<!-- Start of footer section -->
<?php if ( $enable_pre_footer != '') : ?>
        <section class="footer-sec">
            <div class="container">
                <div class="row">
                    <?php if ( is_active_sidebar( 'pre-footer-widget-1' ) ) { ?>
                        <div class="col-md-4 mob-margin-top">
                            <?php dynamic_sidebar( 'pre-footer-widget-1' ); ?>
                        </div>
                    <?php } else {
                          if (is_user_logged_in() && current_user_can('edit_theme_options') ) {
                            echo '<div class="col-md-4 mob-margin-top"><h4 class="widget-title"><a href="'.esc_url(admin_url('customize.php')).'"><i class="fa fa-plus-circle"></i> '.esc_html__('Assign a Widget', 'purplous-lite').'</a></h4></div>';
                          }
                    } ?>

                    <?php if ( is_active_sidebar( 'pre-footer-widget-2' ) ) { ?>
                        <div class="col-md-4 mob-margin-top">
                            <?php dynamic_sidebar( 'pre-footer-widget-2' ); ?>
                        </div>
                    <?php } else {
                          if (is_user_logged_in() && current_user_can('edit_theme_options') ) {
                            echo '<div class="col-md-4 mob-margin-top"><h4 class="widget-title"><a href="'.esc_url(admin_url('customize.php')).'"><i class="fa fa-plus-circle"></i> '.esc_html__('Assign a Widget', 'purplous-lite').'</a></h4></div>';
                          }
                    } ?>

                    <?php if ( is_active_sidebar( 'pre-footer-widget-3' ) ) { ?>
                        <div class="col-md-4 mob-margin-top">
                            <?php dynamic_sidebar( 'pre-footer-widget-3' ); ?>
                        </div>
                    <?php } else {
                          if (is_user_logged_in() && current_user_can('edit_theme_options') ) {
                            echo '<div class="col-md-4 mob-margin-top"><h4 class="widget-title"><a href="'.esc_url(admin_url('customize.php')).'"><i class="fa fa-plus-circle"></i> '.esc_html__('Assign a Widget', 'purplous-lite').'</a></h4></div>';
                          }
                    } ?>

                </div>
            </div>
        </section>
<?php endif; ?>
        <!-- End of footer section -->

        <!-- Start of bottom footer section -->
        <section class="bot-footer">
            <div class="container">
            <p><?php echo esc_html__('Made with ', 'purplous-lite'); ?>  <span>  <i class="fa fa-heart"></i>  </span><?php echo esc_html__('By ', 'purplous-lite'); ?><a href="<?php echo esc_url('https://codethemes.co/');?>" target="_blank"><?php echo esc_html__('Code Themes', 'purplous-lite'); ?></a></p>
            </div>
        </section>
        <div><!-- boxed layout or full-width layout end -->
    </div>
    <?php wp_footer(); ?>
  </body>
</html>
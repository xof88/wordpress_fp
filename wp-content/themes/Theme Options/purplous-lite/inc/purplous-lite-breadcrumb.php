<?php
if (! function_exists('purplous_lite_breadcrumb')) {
	function purplous_lite_breadcrumb(){
        global $post;

        if ( get_header_image() ) :
            $header_image = get_header_image();
        else:
            $header_image = '';
        endif; // End header image check.

        echo '<div class="inner-banner-wrap" style="background-image:url('.esc_url($header_image).')">
                <div class="container">
                    <div class="row">
                        <div class="inner-banner-content">';

            if ( !is_home() ) {

               if ( is_single() ) {
                    ?>
                            <h2><?php the_title();?></h2>
                    <?php
                } elseif ( is_search() ) {
                     ?>
                            <h2><?php echo esc_html__('Search For : ', 'purplous-lite'); ?><?php echo esc_html(get_search_query()); ?></h2>
                    <?php
                }  elseif ( is_404() ) {
                     ?>
                            <h2><?php echo esc_html__('404 Not Found', 'purplous-lite'); ?></h2>
                    <?php
                } elseif ( is_archive() ) {
                            the_archive_title( '<h2 class="page-title">', '</h2>' );
                            the_archive_description( '<div class="taxonomy-description">', '</div>' );
                     ?>

                    <?php
                }  elseif ( is_page() ) {
                    ?>
                            <h2><?php the_title();?></h2>

                    <?php
                }
            }

        echo '</div></div></div></div>';
    }
}
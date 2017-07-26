<?php
/**
 *  Template Name: Page with left sidebar
 * This is the template that displays the contents in full Width
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package purplous-lite
 */

get_header();
purplous_lite_breadcrumb();
$purplous_lite_theme_options = purplous_lite_options();
 ?>

 <section class="sec-content blog-page-content">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-8 right">

					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>
				</div>
				<div class="col-md-4 left-sidebar">
					<?php dynamic_sidebar( 'sidebar' ); ?>
				</div>
			</div>
		</div><!-- #container -->
	</section><!-- #section -->

<?php
get_footer();
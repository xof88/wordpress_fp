<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package purplous-lite
 */

get_header();
purplous_lite_breadcrumb(); ?>
<section class="sec-content blog-page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
				<?php
				if ( have_posts() ) : ?>

					<header class="page-header">
						<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'purplous-lite' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					</header><!-- .page-header -->

					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'search' );

					endwhile;

					the_posts_pagination();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>
			</div>
			<div class="col-md-4">
				<?php dynamic_sidebar( 'sidebar' ); ?>
			</div>
    	</div>
    </div>
</section>
<?php
get_footer();
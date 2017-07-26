<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package purplous-lite
 */

get_header();
purplous_lite_breadcrumb();?>
<section class="sec-content blog-page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'purplous-lite' ); ?></h1>
				</header><!-- .page-header -->

				<div class="post-pad bgwhite content-list">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'purplous-lite' ); ?></p>

					<?php
						get_search_form();
					?>

				</div><!-- .page-content -->
			</div>
			<div class="col-md-4">
				<?php dynamic_sidebar( 'sidebar' ); ?>
			</div>
    	</div>
    </div>
</section>

<?php
get_footer();
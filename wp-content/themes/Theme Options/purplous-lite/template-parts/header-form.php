<?php
/**
 * Header search form
 *
 * @package purplous-lite
 */
?>
<div class="search-box-wrap">
	<div class="container">
		<div class="row">
			<form autocomplete="off" role="search" method="get" id="header-search" class="header-search-form search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			    <label>
			        <span class="screen-reader-text"><?php echo esc_html__( 'Search for:' , 'purplous-lite' ); ?></span>
			        <input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Start Typing and Hit Enter' , 'purplous-lite' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php esc_attr_e( 'Search for:' , 'purplous-lite' ); ?>" >
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
			    </label>
			</form>
		</div>
	</div>
</div>
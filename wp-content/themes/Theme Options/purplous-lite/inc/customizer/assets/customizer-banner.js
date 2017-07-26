/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

jQuery( document ).ready(function() {


    var post_or_cat = jQuery("#post-or-category input[type='radio']:checked").val();
        if(post_or_cat == 'latest-post'){
             jQuery("#blog-category").hide();
        }

        if(post_or_cat == 'latest-post-category'){
             jQuery("#blog-category").show();
        }
    var author = jQuery("#customize-control-purplous_lite-author_checkbox").find("input").val();
        if (author == 1) {
            jQuery("#author-description").removeClass('author-show-hide');
        }
        if (author == '') {
            jQuery("#author-description").addClass('author-show-hide');
        }
});

jQuery(document).on( 'change' , '[name="blog"]' , function(){
    var post_cat = jQuery("#post-or-category input[type='radio']:checked").val();
        if (post_cat == 'latest-post') {
            jQuery("#blog-category").hide();
        }
        else if (post_cat == 'latest-post-category') {
             jQuery("#blog-category").show();
        }
});

jQuery(document).on('change', '[id="customize-control-purplous_lite-author_checkbox"]', function(){
     jQuery('#author-description').toggleClass('author-show-hide');
});
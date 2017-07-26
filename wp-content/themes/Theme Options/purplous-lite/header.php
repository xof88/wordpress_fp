<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
    <?php $layout = purplous_lite_theme_layout(); ?>
  </head>
  <body <?php body_class($layout);?>>

<?php $purplous_lite_theme_options = purplous_lite_options(); ?>
<div class="<?php if ($layout == 'fullwidth-layout') { echo esc_attr__('fullwidth-layout', 'purplous-lite');} else { echo esc_attr__('boxed-layout container site-wrapper', 'purplous-lite');} ?>">
  <div class="row">
  <!-- Start of header section -->
  <header class="site-header" role="banner">
     <?php if ( $purplous_lite_theme_options['social_checkbox_header'] != '' ) { purplous_lite_social_icons(); } ?>
    <!-- End Top Header -->
    <!-- Start of Naviation -->
    <div class="nav-wrapper">
      <div class="container">
          <nav id="primary-nav"class="navbar navbar-default">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                  <span class="sr-only"><?php echo esc_html__('Toggle navigation', 'purplous-lite');?></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <?php
                    if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
                        the_custom_logo();
                    }  else {
                    ?>
                        <div class="navbar-brand">
                          <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span><?php bloginfo('name'); ?></span></a>
                          <?php if ($purplous_lite_theme_options['display_tagline'] == 1 ) { ?>
                              <p class="site-description"><?php bloginfo('description'); ?></p>
                          <?php  }
                        echo '</div>';
                        } ?>
                </div>

                 <?php
                      if ( has_nav_menu('primary') ) :
                            wp_nav_menu( array(
                                'theme_location' => 'primary',
                                'menu_id' => '',
                                'container' => 'div',
                                'container_class' => 'collapse navbar-collapse',
                                'container_id'    => 'navbar-collapse',
                                'menu_class' => 'nav navbar-nav navbar-right',
                                'menu_id'   => '',
                                'depth' => 6,
                                'walker'    => new wp_bootstrap_navwalker(),
                            ));
                      else : ?>
                        <ul id="menu-main-menu-1" class="nav navbar-nav navbar-right">
                            <?php
                               if (is_user_logged_in() && current_user_can('edit_theme_options') ) {
                                  echo  '<li class="menu-item"><a href="'.esc_url(admin_url('nav-menus.php')).'" target="_blank"><i class="fa fa-plus-circle"></i> '.esc_html__('Assign a menu', 'purplous-lite').'</a></li>';
                              }
                            ?>
                        </ul>
                <?php endif; ?>
            </nav>
        </div>
    </div>
      <!-- End of Navigation -->
    <div id="header-search-wrap" style="display:none">
      <?php get_template_part( 'template-parts/header', 'form' ); ?>
    </div>

  </header>
  <!-- End of site header -->
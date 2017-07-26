<?php

if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;


    /**
     * Class to create a post control
     */
    class Purplous_Lite_Post_Dropdown_control extends WP_Customize_Control {
          /**
           * Render the content on the theme customizer page
           */
          public function render_content() {?>

                <label>
                    <span class="customize-post-dropdown"><?php echo esc_html( $this->label ); ?></span>
                    <select data-customize-setting-link="<?php echo $this->id; ?>">
                        <option value="none" <?php selected( get_theme_mod($this->id), 'none' ); ?>><?php _e( 'None','purplous-lite' ); ?></option>
                            <?php  $posts = get_posts( array( 'posts_per_page'=> -1, 'post_type'=>'post' ) );
                            foreach ( $posts as $post ) { ?>
                                 <option value="<?php echo esc_attr($post->ID); ?>" <?php selected( get_theme_mod($this->id), $post->ID); ?>><?php echo $post->post_title; ?></option>
							<?php } ?>
                    </select>
                </label>
                <?php
            }
        }

//radio button to choose latest post or category in blog
if ( ! class_exists( 'WP_Customize_Control' ) )
     return NULL;
        /**
         * Adds radio support to the theme customizer
         */
        class Purplous_Lite_Blog_Customize_Radio_Control extends WP_Customize_Control {
            public $type = 'radio';
            public function render_content() {
                ?>
              <span class="customize-control-title"><?php esc_attr_e('Choose latest post or category', 'purplous-lite');?></span>
                    <label id="post-or-category" class="input-group">
                        <label>
                            <input type="radio" name="blog"   value="latest-post" data-customize-setting-link="<?php echo esc_attr($this->id); ?>" ><?php esc_attr_e('Show From Latest Post', 'purplous-lite');?>
                        </label>
                        <label>
                            <input type="radio" name="blog"   value="latest-post-category" data-customize-setting-link="<?php echo esc_attr($this->id); ?>"><?php esc_attr_e('Show From Category', 'purplous-lite');?>
                        </label>
                    </label>
                <?php
        }
}

if ( ! class_exists( 'WP_Customize_Control' ) )
     return NULL;
/**
*
* Class to create custom category dropdown section
*
**/
    class Purplous_Lite_Category_dropdown_control extends WP_Customize_Control {

        public function render_content() {
            $cat_args = array(
                    'taxonomy' => 'category',
                    'orderby' => 'name',
                );
            $categories = get_categories( $cat_args ); ?>
            <label id="blog-category" class="input-group">
                <span class="customize-control-title"><?php esc_attr_e('Choose category', 'purplous-lite');?></span>
                    <select data-customize-setting-link="<?php echo $this->id; ?>">
                        <option value="none" <?php selected( get_theme_mod($this->id), 'none' ); ?>><?php _e( 'None','purplous-lite' ); ?></option>
                        <?php foreach ( $categories as $post ) { ?>
                                <option value="<?php echo $post->term_id; ?>" <?php selected( $post->term_id); ?>><?php echo $post->name; ?></option>
                        <?php } ?>
                    </select> <br /><br />
            </label>
            <?php
        }
    }

if ( ! class_exists( 'WP_Customize_Control' ) )
     return NULL;
/**
*
* Class to create custom category dropdown section
*
**/
    class Purplous_Lite_Author_Dropdown_Control extends WP_Customize_Control {

        public function render_content() {
            $args = array(
                'role__in' => array('administrator', 'author'),
                );
            $users = get_users($args);
 ?>
            <label id="author-description" class="input-group">
                <span class="customize-control-title"><?php esc_attr_e('Choose Author', 'purplous-lite');?></span>
                    <select data-customize-setting-link="<?php echo $this->id; ?>">
                    <option value="none" <?php selected( get_theme_mod($this->id), 'none' ); ?>><?php _e( 'None','purplous-lite' ); ?></option>
                        <?php foreach ( $users as $user ) { ?>
                                <option value="<?php echo $user->ID; ?>" <?php selected( $user->user_nicename); ?>><?php echo $user->user_nicename; ?></option>
                        <?php } ?>
                    </select> <br /><br />
            </label>
            <?php
        }
    }
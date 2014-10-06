<?php

define( 'THEMENAME', 'wpblank');
define( 'NO_HEADER_TEXT', true );

include TEMPLATEPATH . '/lib/classes/class-setup.php';
//include TEMPLATEPATH . '/lib/classes/class-text.php';
include TEMPLATEPATH . '/lib/classes/class-section.php';
//include TEMPLATEPATH . '/lib/classes/class-video.php';
//include TEMPLATEPATH . '/lib/classes/class-music.php';
//include TEMPLATEPATH . '/lib/classes/class-questions.php';

include TEMPLATEPATH . '/lib/classes/class-walker.php';
//include TEMPLATEPATH . '/lib/classes/class-theme-options.php';
//include TEMPLATEPATH . '/lib/classes/customize/customizer.php';
include TEMPLATEPATH . '/lib/classes/class-customize.php';

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 *
 */

add_filter( 'use_default_gallery_style', '__return_false' );

function change_comment_classes( $classes, $class, $comment_id, $post_id ) {
    $comment = get_comment( $comment_id );
    if ( user_can( $comment->user_id, 'administrator' ) || user_can( $comment->user_id, 'dj' )  ) {
        $classes[] = 'boss';
    }
    return $classes;
}

//add_filter( 'comment_class' , 'change_comment_classes', 10, 4 );
function is_ipad() { // if the user is on an iPad
    $is_ipad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');
    if ($is_ipad)
        return true;
    else return false;
}
function is_iphone() { // if the user is on an iPhone
    $cn_is_iphone = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPhone');
    if ($cn_is_iphone)
        return true;
    else return false;
}
function is_ipod() { // if the user is on an iPod Touch
    $cn_is_iphone = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPod');
    if ($cn_is_iphone)
        return true;
    else return false;
}
function is_ios() { // if the user is on any iOS Device
    if (is_iphone() || is_ipad() || is_ipod())
        return true;
    else return false;
}
function is_android() { // detect ALL android devices
    $is_android = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'Android');
    if ($is_android)
        return true;
    else return false;
}
function is_android_mobile() { // detect only Android phones
    $is_android = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'Android');
    $is_android_m = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'Mobile');
    if ($is_android && $is_android_m)
        return true;
    else return false;
}
function is_android_tablet() { // detect only Android tablets
    if (is_android() && !is_android_mobile())
        return true;
    else return false;
}
function is_mobile_device() { // detect Android Phones, iPhone or iPod
    if (is_android_mobile() || is_iphone() || is_ipod())
        return true;
    else return false;
}
function is_tablet() { // detect Android Tablets and iPads
    if ((is_android() && !is_android_mobile()) || is_ipad())
        return true;
    else return false;
}

function add_more_buttons($buttons) {
    $buttons[] = 'fontselect';
    $buttons[] = 'fontsizeselect';
    $buttons[] = 'styleselect';
    $buttons[] = 'backcolor';
    $buttons[] = 'charmap';
    $buttons[] = 'hr';
    $buttons[] = 'del';
    $buttons[] = 'sub';
    $buttons[] = 'sup';

    return $buttons;
}
add_filter("mce_buttons_2", "add_more_buttons");

add_filter( 'tiny_mce_before_init', 'myformatTinyMCE' );
function myformatTinyMCE( $in ) {

    $in['wordpress_adv_hidden'] = FALSE;

    return $in;
}

//add_action( 'do_meta_boxes', 'move_image_box' );
//function move_image_box() {
//    $types = array ('video', 'image', 'text', 'music');
//    foreach($types as $type) :
//        remove_meta_box( 'postimagediv', $type, 'side' );
//        add_meta_box( 'postimagediv', __( 'Featured image' ), 'post_thumbnail_meta_box', $type, 'normal', 'high' );    endforeach;
//}

add_filter( 'post_thumbnail_html', 'wc_post_thumbnail_fallback', 20, 5 );
function wc_post_thumbnail_fallback( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
    if ($html) {
        return $html;
    }else {
        $args = array(
            'numberposts' => 1,
            'order' => 'ASC',
            'post_mime_type' => 'image',
            'post_parent' => $post_id,
            'post_status' => null,
            'post_type' => 'attachment',
        );

        $images = get_children($args);

        if ($images) {
            foreach ($images as $image) {
                return wp_get_attachment_image($image->ID, $size);
            }
        }else{
            printf('<img src="%s" height="%s" width="%s" />'
                ,get_template_directory_uri().'/images/featured/featured.jpg'
                ,get_option( 'thumbnail_size_w' )
                ,get_option( 'thumbnail_size_h' ));
        }

    }
}

// remove_meta_box('postimagediv', 'link', 'normal');

remove_shortcode('gallery');
add_shortcode('gallery', 'parse_gallery_shortcode');

function parse_gallery_shortcode($atts) {

    global $post;

    if ( ! empty( $atts['ids'] ) ) {
        // 'ids' is explicitly ordered, unless you specify otherwise.
        if ( empty( $atts['orderby'] ) )
            $atts['orderby'] = 'post__in';
        $atts['include'] = $atts['ids'];
    }

    extract(shortcode_atts(array(
        'orderby' => 'menu_order ASC, ID ASC',
        'include' => '',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'medium',
        'link' => 'file'
    ), $atts));


    $args = array(
        'post_type' => 'attachment',
        'post_status' => 'inherit',
        'post_mime_type' => 'image',
        'orderby' => $orderby
    );

    if ( !empty($include) )
        $args['include'] = $include;
    else {
        $args['post_parent'] = $id;
        $args['numberposts'] = -1;
    }

    $images = get_posts($args);

    echo '<div id="erevan_gallery">
                <div class="gallery_controls">
                    <a title="Următoarea" class="gallery_nav prev" href="#"><i class="icon-left-open"></i></a>
                    <a title="Anterioara" class="gallery_nav next" href="#"><i class="icon-right-open"></i></a>
                    <span class="pager"></span>
                </div>
            <ul class="erevan_slideshow cycle-slideshow"
                data-cycle-slides="> li"
                data-cycle-timeout="0"
                data-cycle-prev="#erevan_gallery .prev"
                data-cycle-next="#erevan_gallery .next"
                data-cycle-caption="#erevan_gallery .pager "
                data-cycle-caption-template="{{slideNum}}/{{slideCount}}"
                data-cycle-fx="scrollHorz"
                data-allow-wrap="false"
                data-cycle-auto-height=container
                >';

    foreach ( $images as $image ) {
        echo '<li class="gallery_item">';
        $caption = $image->post_excerpt;

        $description = $image->post_content;
        if($description == '') $description = $image->post_title;

        $image_alt = get_post_meta($image->ID,'_wp_attachment_image_alt', true);

        // render your gallery here
        $src = wp_get_attachment_image_src($image->ID, 'large');
        $full = wp_get_attachment_image_src($image->ID, 'full');

        echo '<a target="_blank" href="'.$full[0].'" class="zoom lightbox"><i class="icon-zoom-in"></i></a>';
        echo '<img class="next" src="'.$src[0].'" alt="'.$image_alt.'" title="'.$description.'" />';
        echo '</li>';
    }
    echo '<li class="last_gallery">
            <a href="#" class="restart_gallery"><i class="icon-ccw"></i></a>
          </li>';
    echo '</ul></div>';
}

// Add custom Fonts to the Fonts list
if ( ! function_exists( 'membership_mce_google_fonts_array' ) ) {
    function membership_mce_google_fonts_array( $initArray ) {
        $initArray['font_formats'] = 'Josefin Slab=Josefin Slab,Times New Roman,Times,serif;Open Sans=Open Sans, Arial, Helvetica, sans-serif;Arvo=Arvo,Times New Roman,Times,serif;Lato=Lato, Arial, Helvetica, sans-serif;Vollkorn=Vollkorn,Times New Roman,Times,serif;Abril Fatface=Abril Fatface, arial, helvetica, sans-serif, cursive;Ubuntu=Ubuntu, Arial, Helvetica, sans-serif;Ubuntu Condensed=Ubuntu Condensed, Arial, Helvetica, sans-serif;PT Sans=PT Sans, Arial, Helvetica, sans-serif;PT Serif=PT Serif,Times New Roman,Times,serif;Merriweather=Merriweather,Times New Roman,Times,serif;Old Standard TT=Old Standard TT,Times New Roman,Times,serif;Droid Sans=Droid Sans, Arial, Helvetica, sans-serif;Roboto=Roboto, Arial, Helvetica, sans-serif;Exo=Exo, Arial, Helvetica, sans-serif;Montserrat=Montserrat, Arial, Helvetica, sans-serif;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats';
        return $initArray;
    }
}
add_filter( 'tiny_mce_before_init', 'membership_mce_google_fonts_array' );

// Add Google Scripts for use with the editor
if ( ! function_exists( 'membership_mce_google_fonts_styles' ) ) {
    function membership_mce_google_fonts_styles() {
        $font_url = 'http://fonts.googleapis.com/css?family=Josefin+Slab:400,700|Open+Sans:400,300,700|Arvo|Lato:400,700|Vollkorn|Abril+Fatface|Ubuntu:400,300,700|Ubuntu+Condensed|PT+Sans:400,700|PT+Serif:400,700|Old+Standard+TT|Droid+Sans|Roboto|Exo|Montserrat|Merriweather:400,300,700';
        add_editor_style( str_replace( ',', '%2C', $font_url ) );
    }
}
add_action( 'init', 'membership_mce_google_fonts_styles' );

// Customize mce editor font sizes
if ( ! function_exists( 'membership_mce_text_sizes' ) ) {
    function membership_mce_text_sizes( $initArray ){
        $initArray['fontsize_formats'] = "1em 1.2em 1.4em 1.6em 1.8em 2em 2.4em 2.8em 4em 5em 6em";
        return $initArray;
    }
}
add_filter( 'tiny_mce_before_init', 'membership_mce_text_sizes' );

// Add Formats Dropdown Menu To MCE
if ( ! function_exists( 'mp_style_select' ) ) {
    function mp_style_select( $buttons ) {
        array_push( $buttons, 'styleselect' );
        array_push( $buttons, 'backcolor' );
        return $buttons;
    }
}
add_filter( 'mce_buttons2', 'mp_style_select' );


// Add new styles to the TinyMCE "formats" menu dropdown
if ( ! function_exists( 'mp_styles_dropdown' ) ) {
    function mp_styles_dropdown( $settings ) {

        // Create array of new styles
        $new_styles = array(
            array(
                'title'	=> __( 'IQ Styles', 'mp' ),
                'items'	=> array(
                    array(
                        'title'		=> __('Theme Button','mp'),
                        'selector'	=> 'a',
                        'classes'	=> 'button'
                    ),
                    array(
                        'title'		=> __('Custom Button','mp'),
                        'inline'	=> 'span',
                        'classes'	=> 'custom-button'
                    ),
                    array(
                        'title'		=> __('Huge first letter','mp'),
                        'selector'	=> 'p',
                        'classes'	=> 'huge-letter'
                    ),
                    array(
                        'title'		=> __('Zoom In','mp'),
                        'block'	=> 'div',
                        'classes'	=> 'zoom',
                    ),
                    array(
                        'title'		=> __('Image Circle','mp'),
                        'selector'	=> 'img',
                        'classes'	=> 'circle'
                    ),
                ),
            ),
            array(
                'title'	=> __( 'IQ Table Styles', 'mp' ),
                'items'	=> array(
                    array(
                        'title'		=> __('Table Style IQ','mp'),
                        'selector'	=> 'table',
                        'classes'	=> 'iq-table',
                    ),
                    array(
                        'title'		=> __('Table Style IQ - Big','mp'),
                        'selector'	=> 'table.iq-table',
                        'classes'	=> 'zoom',
                    ),
                    array(
                        'title'		=> __('Table Style IQ - Red','mp'),
                        'selector'	=> 'table.iq-table',
                        'classes'	=> 'red',
                    ),
                ),
            ),
            array(
                'title'	=> __( 'IQ ScrollFX', 'mp' ),
                'items'	=> array(
                    array(
                        'title'		=> __('Fade In','mp'),
                        'block'	=> 'div',
                        'classes'	=> 'scrollfx fxfade',
                        'wrapper'   => true
                    ),
                    array(
                        'title'		=> __('Pulse','mp'),
                        'block'	=> 'div',
                        'classes'	=> 'scrollfx fxpulse',
                        'wrapper'   => true
                    ),
                    array(
                        'title'		=> __('Bounce In','mp'),
                        'block'	=> 'div',
                        'classes'	=> 'scrollfx fxbounce',
                        'wrapper'   => true
                    ),
                    array(
                        'title'		=> __('Bounce In Left','mp'),
                        'block'	=> 'div',
                        'classes'	=> 'scrollfx fxbounceleft',
                        'wrapper'   => true
                    ),

                    array(
                        'title'		=> __('Bounce In Right','mp'),
                        'block'	=> 'div',
                        'classes'	=> 'scrollfx fxbounceright',
                        'wrapper'   => true
                    ),

                    array(
                        'title'		=> __('Flip','mp'),
                        'block'	=> 'div',
                        'classes'	=> 'scrollfx fxflip',
                        'wrapper'   => true
                    ),

                    array(
                        'title'		=> __('Tada','mp'),
                        'block'	=> 'div',
                        'classes'	=> 'scrollfx fxtada',
                        'wrapper'   => true
                    ),

                    array(
                        'title'		=> __('Zoom In, Tilt Left','mp'),
                        'block'	=> 'div',
                        'classes'	=> 'zoomInTiltLeft',
                        'wrapper'   => true
                    ),

                    array(
                        'title'		=> __('Zoom In, Tilt Right','mp'),
                        'block'	=> 'div',
                        'classes'	=> 'zoomInTiltRight',
                        'wrapper'   => true
                    ),
                ),
            ),
            array(
                'title'	=> __( 'IQ HoverFX', 'mp' ),
                'items'	=> array(
                    array(
                        'title'		=> __('Pulse','mp'),
                        'classes'	=> 'hoverFx pulseHover animated',
                        'block' => 'div',
                        'wrapper'   => false
                    ),
                    array(
                        'title'		=> __('Bounce','mp'),
                        'block'	=> 'div',
                        'classes'	=> 'hoverFx bounceHover animated',
                        'wrapper'   => true
                    ),
                    array(
                        'title'		=> __('Flash','mp'),
                        'block'	=> 'div',
                        'classes'	=> 'hoverFx flashHover animated',
                        'wrapper'   => true
                    ),

                    array(
                        'title'		=> __('Rubber','mp'),
                        'block'	=> 'div',
                        'classes'	=> 'hoverFx rubberHover animated',
                        'wrapper'   => true
                    ),
                    array(
                        'title'		=> __('Tada','mp'),
                        'block'	=> 'div',
                        'classes'	=> 'hoverFx tadaHover animated',
                        'wrapper'   => true
                    ),
                    array(
                        'title'		=> __('Shake','mp'),
                        'block'	=> 'div',
                        'classes'	=> 'hoverFx shakeHover animated',
                        'wrapper'   => true
                    ),
                    array(
                        'title'		=> __('Swing','mp'),
                        'block'	=> 'div',
                        'classes'	=> 'hoverFx swingHover animated',
                        'wrapper'   => true
                    ),
                    array(
                        'title'		=> __('Zoom In, Tilt Left','mp'),
                        'block'	=> 'div',
                        'classes'	=> 'hoverFx zoomInTiltLeftHover',
                        'wrapper'   => true
                    ),
                    array(
                        'title'		=> __('Zoom In, Tilt Right','mp'),
                        'block'	=> 'div',
                        'classes'	=> 'hoverFx zoomInTiltRightHover',
                        'wrapper'   => true
                    ),
                ),
            ),
            array(
                'title'	=> __( 'IQ Text Outline', 'mp' ),
                'items'	=> array(
                    array(
                        'title'		=> __('Dark','mp'),
                        'classes'	=> 'text-outline-dark',
                        'inline' => 'span',
                        'wrapper'   => false
                    ),
                    array(
                        'title'		=> __('Light','mp'),
                        'classes'	=> 'text-outline-light',
                        'inline' => 'span',
                        'wrapper'   => false
                    ),
                    array(
                        'title'		=> __('Red','mp'),
                        'classes'	=> 'text-outline-red',
                        'inline' => 'span',
                        'wrapper'   => false
                    ),
                    array(
                        'title'		=> __('Green','mp'),
                        'classes'	=> 'text-outline-green',
                        'inline' => 'span',
                        'wrapper'   => false
                    ),
                    array(
                        'title'		=> __('Blue','mp'),
                        'classes'	=> 'text-outline-blue',
                        'inline' => 'span',
                        'wrapper'   => false
                    ),
                    
                ),
            ),
            array(
                'title'	=> __( 'IQ Letter Spacing', 'mp' ),
                'items'	=> array(
                    array(
                        'title'		=> __('Tight','mp'),
                        'classes'	=> 'letters-tight',
                        'inline' => 'span',
                        'wrapper'   => false
                    ),
                    array(
                        'title'		=> __('Tight x2','mp'),
                        'classes'	=> 'letters-tight2',
                        'inline' => 'span',
                        'wrapper'   => false
                    ),
                    array(
                        'title'		=> __('Loose','mp'),
                        'classes'	=> 'letter-loose',
                        'inline' => 'span',
                        'wrapper'   => false
                    ),
                    array(
                        'title'		=> __('Loose x2','mp'),
                        'classes'	=> 'letter-loose2',
                        'inline' => 'span',
                        'wrapper'   => false
                    ),

                ),
            ),
            array(
                'title'	=> __( 'IQ Line Spacing', 'mp' ),
                'items'	=> array(
                    array(
                        'title'		=> __('Tight','mp'),
                        'classes'	=> 'line-height1',
                        'block' => 'div',
                        'wrapper'   => true
                    ),
                    array(
                        'title'		=> __('Tight x2','mp'),
                        'classes'	=> 'line-height2',
                        'block' => 'div',
                        'wrapper'   => true
                    ),
                    array(
                        'title'		=> __('Loose','mp'),
                        'classes'	=> 'line-height3',
                        'block' => 'div',
                        'wrapper'   => true
                    ),
                    array(
                        'title'		=> __('Loose x2','mp'),
                        'classes'	=> 'line-height4',
                        'block' => 'div',
                        'wrapper'   => true
                    ),

                ),
            ),

        );

        // Merge old & new styles
        $settings['style_formats_merge'] = true;

        // Add new styles
        $settings['style_formats'] = json_encode( $new_styles );

        // Return New Settings
        return $settings;

    }
}
add_filter( 'tiny_mce_before_init', 'mp_styles_dropdown' );


// Hooks your functions into the correct filters
function iq_add_mce_button() {
    // check user permissions
    if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
        return;
    }
    // check if WYSIWYG is enabled
    if ( 'true' == get_user_option( 'rich_editing' ) ) {
        add_filter( 'mce_external_plugins', 'iq_add_tinymce_plugin' );
        add_filter( 'mce_buttons', 'iq_register_mce_button' );
    }
}
add_action('admin_head', 'iq_add_mce_button');

// Declare script for new button
function iq_add_tinymce_plugin( $plugin_array ) {
    $plugin_array['iq_mce_button'] = get_template_directory_uri() .'/lib/js/mce-button.js';
    return $plugin_array;
}

// Register new button in the editor
function iq_register_mce_button( $buttons ) {
    array_push( $buttons, 'iq_mce_button' );
    array_push( $buttons, 'columns_mce_button' );
    return $buttons;
}


add_action( 'before_wp_tiny_mce', 'css_tinymce_callback' );
function css_tinymce_callback() {

    $sb = get_theme_mod('sidebar_size');
    if($sb == 0 ) : $w = '200px';
    elseif($sb==2) : $w = '300px';
    elseif($sb==3) : $w = '350px';
    else : $w = '200px'; endif; ?>

    <script type="text/javascript">
        (function(){
            var mp_style = "a, .site-color-text, #wrapper a, [type=submit], button, .button, .custom-button { color: <?php echo get_theme_mod('site_color'); ?> } "
                + "body { border-color: <?php echo get_theme_mod('site_color'); ?>; max-width: calc( <?php echo get_theme_mod('site_width'); ?> - 60px ); }"
                + "body:before { content:''; position: fixed; top: 0; left: calc( <?php echo get_theme_mod('site_width'); ?> - 70px ); z-index: 10; height: 20px; width: 3px; background: #dedede }"
                + "body:after {content:''; position: fixed; top: 0; left: calc(<?php echo get_theme_mod('site_width') ?> - <?php echo $w ?> - 40px); z-index: 10; height: 10px; width: 3px; background: #dedede }"
                +"[type=submit], button, .button, .custom-button { background-color: <?php echo get_theme_mod('site_color'); ?> }";
            var checkInterval = setInterval( function() {
                if ( typeof(tinyMCE) !== "undefined" ) {
                    if ( tinyMCE.activeEditor && ! tinyMCE.activeEditor.isHidden() ) {
                        jQuery( "#content_ifr" ).contents().find( "head" ).append( "<style type=\'text/css\'>" + mp_style + "</style>" );
                        clearInterval( checkInterval );
                    }
                }
            }, 500);
        }());
    </script>
<?php }

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/lib/classes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'iq_theme_register_easyfancybox_plugins' );
function iq_theme_register_easyfancybox_plugins() {
    $plugins = array(
        array(
            'name'			=> 'Easy FancyBox', // The plugin name
            'slug'			=> 'easy-fancybox', // The plugin slug (typically the folder name)
            'source'			=> get_stylesheet_directory() . '/easy-fancybox.zip', // The plugin source
            'required'			=> true, // If false, the plugin is only 'recommended' instead of required
            'version'			=> '1.5.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'		=> '', // If set, overrides default API URL and points to an external URL
        )
    );
    $theme_text_domain = 'iqtheme';


    $config = array(
        'domain'		=> $theme_text_domain, // Text domain - likely want to be the same as your theme.
        'default_path'		=> '', // Default absolute path to pre-packaged plugins
        'parent_menu_slug'	=> 'themes.php', // Default parent menu slug
        'parent_url_slug'	=> 'themes.php', // Default parent URL slug
        'menu'			=> 'install-required-plugins', // Menu slug
        'has_notices'		=> true, // Show admin notices or not
        'is_automatic'		=> true, // Automatically activate plugins after installation or not
        'message'		=> '', // Message to output right before the plugins table
        'strings'		=> array(
            'page_title'			=> __( 'Install Required Plugins', $theme_text_domain ),
            'menu_title'			=> __( 'Install Plugins', $theme_text_domain ),
            'installing'			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
            'oops'				=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
            'notice_can_install_required'	=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'	=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'		=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'	=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'	=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'		=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'		=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update'		=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'				=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
            'plugin_activated'			=> __( 'Plugin activated successfully.', $theme_text_domain ),
            'complete'				=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
            'nag_type'				=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );
    tgmpa( $plugins, $config );
}

function iq_login_logo() { ?>
    <style type="text/css">
        body.login {
            background-color: #efefef;
            background-image: url('<?php echo get_theme_mod('login_bg'); ?>');
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        body.login div#login {
            width: 500px;
            height: 100%;
            background-color: rgba(255,255,255,.8);
            box-shadow: 0 0 20px rgba(255,255,255,.3);
            padding: 0;
        }

        body.login form#loginform {
            background: transparent;
            box-shadow: none;
        }

        body.login div#login h1 {
            padding-top: 18%;
        }

        body.login div#login form#loginform p label {
            text-transform: uppercase;
            color: #aaa;
        }

        body.login div#login form#loginform input#user_login,
        body.login div#login form#loginform input#user_pass {
            background: #fff;
            border: 1px solid #bbb;
            box-shadow: 0 0 10px rgba(0,0,0,.2);
            border-radius: 2px;
            font-size: 2em;
            margin-bottom: 5px;
            padding: .2em .5em;
            font-family: 'Open Sans', Arial, Helvetica, sans-serif;
            font-weight: 400;
            transition: all .25s;
            text-shadow: 1px 1px 1px #fff;
        }

        body.login div#login form#loginform input#user_login:hover,
        body.login div#login form#loginform input#user_pass:hover,
        body.login div#login form#loginform input#user_login:focus,
        body.login div#login form#loginform input#user_pass:focus {
            border-color: <?php echo get_theme_mod('site_color'); ?>;
            box-shadow: 0 0 10px rgba(0,0,0,.4);
        }

        body.login div#login h1 a {
            background-image: url(<?php echo get_header_image() ?>);
            padding-bottom: 30px;
            margin: 0;
            width: 100%;
            background-size: contain;
        }

        body.login div#login form#loginform p.forgetmenot {
            margin-top: 1.5em;
        }

        body.login div#login form#loginform p.forgetmenot label {
            color: #666
        }

        body.login div#login form#loginform p.submit input#wp-submit {
            background: <?php echo get_theme_mod('site_color'); ?>;
            box-sizing: border-box;
            color: #fff !important;
            margin-top: 1em;
            padding: .5em 3em;
            font-size: 1.5em;
            position: relative;
            transition: all .25s;
            border: 1px solid;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            opacity: .9;
            height: auto;
            line-height: 1;
            position: relative;
            z-index: 100;
        }

        body.login div#login form#loginform p.submit input#wp-submit:hover,
        body.login div#login form#loginform p.submit input#wp-submit:focus {
            box-shadow: 0 0 3px rgba(0,0,0,.5), 0 0 0 100px rgba(0,0,0,.2) inset;
            opacity: 1;
            border-radius: 2px;
        }

        body.login div#login p#nav {
            position: relative;
            top: -90px;
            left: 0;
        }

        body.login #backtoblog {
            display: none;
        }

        body.login div#login p#nav a:hover {
            color: <?php echo get_theme_mod('site_color'); ?>;
        }

    </style>
<?php }
add_action( 'login_enqueue_scripts', 'iq_login_logo' );

function iq_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'iq_login_logo_url' );
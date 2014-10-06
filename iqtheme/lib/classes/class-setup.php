<?php

class Setup {

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which runs
     * before the init hook. The init hook is too late for some features, such as indicating
     * support post thumbnails.
     *
     * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
     * @uses register_nav_menus() To add support for navigation menus.
     * @uses add_custom_background() To add support for a custom background.
     * @uses add_editor_style() To style the visual editor.
     * @uses load_theme_textdomain() For translation/localization support.
     * @uses add_custom_image_header() To add support for a custom header.
     * @uses register_default_headers() To register the default custom header smoothness provided with the theme.
     * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
     *
     */

    public function theme_setup()
    {

        // This theme styles the visual editor with editor-style.css to match the theme style.
        add_editor_style('editor-style.css');

        // This theme uses post thumbnails
        add_theme_support( 'post-thumbnails' );

        // Add default posts and comments RSS feed links to head
        add_theme_support( 'automatic-feed-links' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary' => __( 'Primary Navigation', 'twentyten' ),
//            'footer' => __( 'Footer Navigation', 'twentyten')
        ) );

        // This theme allows users to set a custom background
        add_theme_support( 'custom-background', array(
            'default-color' => 'ffffff',
        ) );

        // Add support for custom headers.
        add_theme_support( 'custom-header', array(
            'default-text-color' => '000',
            'default-image' => '',
//            'default-image' => get_template_directory_uri() . '/lib/images/logo.png',
            'uploads' => true,
            'flex-width' => true,
            'flex-height' => true,
            'header-text' => true,
            'height' => '60',
            'width' => '230',
        ) );
    }

    /**
     * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
     * @uses register_sidebar
     */

    public function register_widget_areas()
    {
        register_sidebar( array(
            'name' => __( 'Blog Sidebar', THEMENAME ),
            'id' => 'blog-sidebar',
            'description' => __( '', THEMENAME ),
            'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title sideblog-title">',
            'after_title' => '</h3>',
        ) );

        register_sidebar( array(
            'name' => __( 'Footer Sidebar 1', THEMENAME ),
            'id' => 'footer-sidebar-1',
            'description' => __( 'Use the theme customizer for more options.', THEMENAME ),
            'before_widget' => '<li id="%1$s" class="footer-sidebar widget-container %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title site-color-text">',
            'after_title' => '</h3>',
        ) );

        register_sidebar( array(
            'name' => __( 'Footer Sidebar 2', THEMENAME ),
            'id' => 'footer-sidebar-2',
            'description' => __( 'Use the theme customizer for more options.', THEMENAME ),
            'before_widget' => '<li id="%1$s" class="footer-sidebar widget-container %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title site-color-text">',
            'after_title' => '</h3>',
        ) );

        register_sidebar( array(
            'name' => __( 'Footer Sidebar 3', THEMENAME ),
            'id' => 'footer-sidebar-3',
            'description' => __( 'Use the theme customizer for more options.', THEMENAME ),
            'before_widget' => '<li id="%1$s" class="footer-sidebar widget-container %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title site-color-text">',
            'after_title' => '</h3>',
        ) );

        register_sidebar( array(
            'name' => __( 'Footer Sidebar 4', THEMENAME ),
            'id' => 'footer-sidebar-4',
            'description' => __( 'Use the theme customizer for more options.', THEMENAME ),
            'before_widget' => '<li id="%1$s" class="footer-sidebar widget-container %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title site-color-text">',
            'after_title' => '</h3>',
        ) );

    }

    /**
     * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
     * @param $args
     * @return array
     */

    public function page_menu_args( $args ) {
        $args['show_home'] = true;
        return $args;
    }

    /**
     * Sets the post excerpt length to 40 characters.
     * @param int $length
     * @return int
     */

    public function excerpt_length( $length ) {
        return 60;
    }

    /**
     * Return the ajax response
     * @param $status
     * @param array $extra
     */

    public static function ajax_return( $status, $extra = array() )
    {
        die( json_encode( array_merge( array( 'status' => $status ), $extra )));
    }

    public function wpbeginner_remove_version() {
        return '';
    }

    public function theme_head() { ?>
        <?php global $post ?>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <?php if (is_singular()) : ?>
            <?php if(wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ))) :
                $img = wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ));
            else :
                $img = get_bloginfo('template_url').'/screenshot.png';
            endif;    ?>
            <meta property="og:title" content="<?php single_post_title(''); ?>" />
            <meta property="og:type" content="article" />
            <meta property="og:image" content="<?php echo $img ?>" />
            <link rel="image_src" href="<?php echo $img ?>" />
        <?php else : ?>
            <meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
            <meta property="og:type" content="website" />
            <meta property="og:image" content="<?php echo get_bloginfo('template_url') ?>/screenshot.png" />
            <link rel="image_src" href="<?php echo get_bloginfo('template_url') ?>/screenshot.png" />
        <?php endif; ?>
        <link rel="shortcut icon" href="<?php echo get_bloginfo('template_url') ?>/lib/images/favicon.png" >
        <link href='http://fonts.googleapis.com/css?family=Josefin+Slab:400,700|Open+Sans:400,300,700|Arvo|Lato:400,700|Vollkorn|Abril+Fatface|Ubuntu:400,300,700|Ubuntu+Condensed|PT+Sans:400,700|PT+Serif:400,700|Old+Standard+TT|Droid+Sans|Roboto|Exo|Montserrat|Merriweather:400,300,700' rel='stylesheet' type='text/css'>
        <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">
    <?php
    }

    public function backend_head() { ?>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/lib/font/backend/css/membershipadmin.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/lib/font/backend/css/animation.css"><!--[if IE 7]><link rel="stylesheet" href="css/membershipadmin-ie7.css"><![endif]-->
        <script>
            function toggleCodes(on) {
                var obj = document.getElementById('icons');

                if (on) {
                    obj.className += ' codesOn';
                } else {
                    obj.className = obj.className.replace(' codesOn', '');
                }
            }

        </script>
    <?php }

    public function remove_thumbnail_dimensions( $html ) {
        $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
        return $html;
    }

    public function getnuburl($url, $id) {
        $nuburl = @file_get_contents("http://nub.ro/yourls-api.php?signature=8bc0413888&action=shorturl&format=simple&url=".$url);
        if(!$nuburl === FALSE) :
            return $nuburl;
        else :
            $error = get_permalink($id);
            return $error;
        endif;
    }

    public function add_frontend_scripts()
    {
        global $dts;

        // Always enqueue the following

//        wp_enqueue_style( 'membership', get_bloginfo('template_url') . '/lib/css/membership.css' );
        wp_enqueue_style( 'membership.animation', get_bloginfo('template_url') . '/lib/css/animation.css' );

//        wp_enqueue_script( 'jquery.cycle', get_bloginfo('template_url') . '/lib/js/jquery.cycle2.min.js', array( 'jquery' ));
//        wp_enqueue_script( 'sharrre', get_bloginfo('template_url') . '/lib/js/jquery.sharrre.min.js', array( 'jquery' ));
        wp_enqueue_script( 'scrolly', get_bloginfo('template_url') . '/lib/js/jquery.scrolly.js', array( 'jquery' ));
//        wp_enqueue_script( 'fitvids', get_bloginfo('template_url') . '/lib/js/jquery.fitvids.js', array( 'jquery' ));
        wp_enqueue_script( 'viewPort', get_bloginfo('template_url') . '/lib/js/jquery.viewportchecker.js', array( 'jquery' ));
        wp_enqueue_script( 'countdown', get_bloginfo('template_url') . '/lib/js/jquery.countdown.js', array( 'jquery' ));

        // Enqueue on Desktop, except Mobile if $dts exists
        if(!$dts or $dts->device == 'active') :
//            wp_enqueue_style( 'css.lionbars', get_bloginfo('template_url') . '/lib/css/jquery-lionbars.css' );
//            wp_enqueue_style( 'jquery.uniform-css', get_bloginfo('template_url') . '/lib/css/uniform.default.css' );

//            wp_enqueue_script( 'js.lionbars', get_bloginfo('template_url') . '/lib/js/jquery-lionbars.js', array( 'jquery' ));
//            wp_enqueue_script( 'jknav', get_bloginfo('template_url') . '/lib/js/jquery.jknav.min.js', array( 'jquery' ));
//            wp_enqueue_script( 'jquery.uniform', get_bloginfo('template_url') . '/lib/js/jquery.uniform.min.js', array( 'jquery' ));
            wp_enqueue_script( 'frontend', get_bloginfo('template_url') . '/lib/js/frontend.js', array( 'jquery' ));
//            if(is_single() and get_post_type() == 'text') :
//                wp_enqueue_script( 'mousewheel', get_bloginfo('template_url') . '/lib/js/mousewheel.js', array('jquery') );
//                wp_enqueue_script( 'jquery.columnizer', get_bloginfo('template_url') . '/lib/js/jquery.columnizer.js', array( 'jquery' ));
//            endif;
        endif;
//        if(is_singular()) :
//            wp_enqueue_script( 'sticky.kit', get_bloginfo('template_url') . '/lib/js/jquery.sticky-kit.min.js', array( 'jquery' ));
            wp_enqueue_script( 'sticky', get_bloginfo('template_url') . '/lib/js/jquery.sticky.js', array( 'jquery' ));
//        endif;

//        wp_enqueue_script( 'scroller', get_bloginfo('template_url') . '/lib/js/jquery.scroller.js', array( 'jquery' ));

        if (is_singular() && get_option('thread_comments')) wp_enqueue_script('comment-reply');
        if (is_404() ) :
            wp_enqueue_script('jquery-core');
            wp_enqueue_script('jquery-effects-core');
        endif;

//        wp_deregister_style( 'wti_like_post');


    }

    public function add_backend_scripts()
    {
        wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_style( 'backend', get_bloginfo('template_url') . '/lib/css/backend.css' );
        wp_enqueue_script( 'backend', get_bloginfo('template_url') . '/lib/js/backend.js', array( 'jquery' ));
        wp_enqueue_script( 'feather', get_bloginfo('template_url') . '/lib/js/featherlight.min.js', array( 'jquery' ));
        wp_enqueue_script( 'back.upload', get_bloginfo('template_url') . '/lib/js/back.upload.js', array( 'jquery' ));
        wp_enqueue_style( 'feather.css', get_bloginfo('template_url') . '/lib/js/featherlight.min.css' );
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
        wp_enqueue_script( 'jquery-effects-core' );
        wp_enqueue_script( 'jquery-effects-pulsate' );
    }

    /*
 * Comments Template
 */

    public function comment_layout( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
            case '' :
                ?>
                <?php if ( $comment->comment_approved == '0' ) :
                    $waiting = '<em class="comment-awaiting-moderation">Your comment is being moderated.</em><br />';
                    $waiting_class = 'waiting-mod';
                endif; ?>
                <li <?php comment_class($waiting_class); ?> id="li-comment-<?php comment_ID(); ?>">
                <?php
                $slug = get_the_author_meta("user_nicename", $comment->user_id );;
                if ( user_can( $comment->user_id, 'administrator' ) || user_can( $comment->user_id, 'author' )  ) :
                    $boss = 'comment-boss';
                endif; ?>
                <div id="comment-<?php comment_ID(); ?>" class="comment-container <?php echo $boss?>">
                    <?php echo $waiting ?>
                    <div class="comment-body">
                        <div class="comment-meta">
                            <div class="comment-author site-background">
                                <?php if(get_comment_author_url()) : ?>
                                <a href="<?php comment_author_url(); ?>"><?php comment_author(); ?></a>
                                <?php else : ?>
                                <?php comment_author(); ?>
                                <?php endif; ?>
                            </div>
                            <div class="comment-meta">
                            <?php $url = esc_url(wp_nonce_url( admin_url() . "comment.php?action=deletecomment&p=$comment->comment_post_ID&c=$comment->comment_ID", "delete-comment_$comment->comment_ID" )); ?>

                            <a class="date" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                                <?php printf( __( '%1$s', 'twentyten' ), get_comment_date(),  get_comment_time() ); ?>
                            </a>
                            <a class="date" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                                <?php comment_time('G:i'); ?>
                            </a>
                            <span class="comment-info">
                                <?php edit_comment_link( __( 'Edit', 'twentyten' ), ' ' ); ?>
                                <?php if ( current_user_can('edit_post', $comment->comment_post_ID) ) : ?>
                                    <script type="text/javascript">
                                        jQuery(document).ready(function() {
                                            jQuery('a.confirm').click(function(event) {
                                                event.preventDefault();
                                                var url = jQuery(this).attr('href');
                                                var confirm_box = confirm('Are you sure you want to delete this comment?');
                                                if (confirm_box) {
                                                    window.location = url;
                                                }
                                            });
                                        });
                                    </script>
                                    <a class="confirm" href="<?php echo $url ?>">Delete</a>
                                <?php endif; ?>
                                <?php if(!is_page()) :
                                    comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '<i class="icon-reply"></i>Reply' ) ) );
                                endif; ?>
                            </span>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="comment-text">
                            <?php comment_text(); ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div><!-- #comment-##  -->

                <?php
                break;
            case 'pingback'  : break;
            case 'trackback' : break;
        endswitch;
    }


    /**
     * Extend section sizes
     * @return void
     */

    public function extend_image_sizes()
    {
        add_image_size( '100_thumb', 100, 100, true );
        add_image_size( 'small_thumb', 50, 50, true );
        add_image_size( 'featured', 640, 480, false );
        add_image_size( 'big_featured', 640, 9000, false );
    }

    /**
     * Add custom metaboxes
     * @return void
     */

    public function add_meta_boxes()
    {
        $types = array ('page');
        foreach($types as $type) :
            add_meta_box( 'iq_options', 'iQ Options', array( $this, 'iq_options' ), $type, 'normal', 'high' );
        endforeach;

        $cpt = get_post_types();
        unset($cpt['page'], $cpt['attachment'], $cpt['revision'], $cpt['nav_menu_item'], $cpt['section']);

        foreach($cpt as $type) :
            add_meta_box( 'post_options', 'iQ Options', array( $this, 'post_options' ), $type, 'side', 'high' );
        endforeach;
    }

    /**
     * "Post Options" content
     * @param $post
     * @return void
     */

    public function post_options( $post )
    {
        $has_sidebar = get_post_meta($post->ID, 'has_sidebar', true);
        $has_postmeta = get_post_meta($post->ID, 'has_postmeta', true);
        if( $has_sidebar == 'yes' ) $sidebar_checked = ' checked="checked"';
        if( $has_postmeta == 'yes' ) $postmeta_checked = ' checked="checked"';
        wp_nonce_field( 'postoptions_nonce', 'postoptions_metabox_nonce' ); ?>

        <input style="padding-right: 5px;" type="checkbox" name="has_sidebar" id="has_sidebar" value="yes"<?php echo $sidebar_checked; ?> />
        <label for="has_sidebar">Hide Sidebar<br /><span class="description">Only the Sections will be visible</span></label>
        <hr />
        <input style="padding-right: 5px;" type="checkbox" name="has_postmeta" id="has_postmeta" value="yes"<?php echo $postmeta_checked; ?> />
        <label for="has_postmeta">Hide Post Meta</label><br />
        <span class="description">Hide the author, date, category and comment link.</span>
    <?php
    }

    public function iq_options( $post )
    { ?>
        <?php

        $meta_fields = array(
            'section',
            'hide_title',
            'hide_sidebar',
//            'full_width',
            'showmenu',
            'section_menu_bg',
            'section_menu_color',
            'scrollnote',
            'popup'
        );

        foreach ($meta_fields as $key ) :
            $cf_array = get_post_meta( $post->ID, $key, true );
            if($cf_array) :
                $cf[$key] = $cf_array;
            endif;
        endforeach;
        if( $cf['hide_title'] == 'yes' ) $hidetitle_checked = ' checked="checked"';
        if( $cf['hide_sidebar'] == 'yes' ) $hidesidebar_checked = ' checked="checked"';
//        if( $cf['full_width'] == 'yes' ) $fullwidth_checked = ' checked="checked"';
        if( $cf['scrollnote']['check'] == 'yes' ) $scrollnote_checked = ' checked="checked"';
        if( $cf['popup']['check'] == 'yes' ) $popup_checked = ' checked="checked"';
        if( $cf['showmenu'] == 'yes' ) $showmenu_checked = ' checked="checked"';

        wp_nonce_field( 'section_nonce', 'section_metabox_nonce' ); ?>

        <div id="membership_options">
            <div class="membership_sidebar">
                <ul>
                    <li id="membership_sections"><a class="membership_tabgo active" href="#"><i class="icon-section"></i> Sections</a></li>
                    <li id="membership_page"><a class="membership_tabgo" href="#"><i class="icon-page"></i> Page</a></li>
                    <li id="membership_display"><a href="#" class="membership_tabgo"><i class="icon-settings"></i> Display</a></li>
                    <li id="membership_indiv"><a href="#" class="membership_tabgo"><i class="icon-notes"></i>Notes</a></li>
                </ul>
            </div>
            <div class="membership_content">
                <div class="membership_tab membership_sections active">
                <select id="section_list">
                <?php
                    $args = array(
                        'showposts' => '-1',
                        'post_type' => 'section',
    //                    'meta_query' => array(
    //                        array(
    //                            'key' => 'disabled',
    //                            'value' => 'yes',
    //                            'compare' => '!='
    //                        )
    //                    )
                    );

                    $sections_loop = new WP_Query($args);
                    while( $sections_loop->have_posts()): $sections_loop->the_post(); ?>
                        <option id="section_<?php the_ID(); ?>"><?php the_title(); ?></option>
                    <?php endwhile; ?>
                    </select>
                    <button id="add_section" class="button button-primary">Add Section</button> <a data-featherlight="ajax" class="preview button mp-preview" href="<?php echo get_permalink($post->ID) ?>?preview=true&preview_id=<?php echo $post->ID ?>">Preview</a>
                    <br />

                    <ul id="sections">

                        <?php ksort($cf['section']);
                        foreach($cf['section'] as $section=>$id) :
                            if(!empty($id['id']) and is_numeric($id['id'])) :
                            $column_checked = '';
                            $break_checked = '';
                            $custom_checked = '';
                            $hidesectiontitle_checked = '';
                            $fullsection_checked = '';
                                $middlealign_checked = '';
                                $parallax_checked = '';
                            if( $id['column'] == 'yes' ) $column_checked = ' checked="checked"';
                            if( $id['break'] == 'yes' ) $break_checked = ' checked="checked"';
                            if( $id['custom'] == 'yes' ) $custom_checked = ' checked="checked"';
                            if( $id['hidesectiontitle'] == 'yes' ) $hidesectiontitle_checked = ' checked="checked"';
                            if( $id['fullsection'] == 'yes' ) $fullsection_checked = ' checked="checked"';
                            if( $id['middlealign'] == 'yes' ) $middlealign_checked = ' checked="checked"';
                            if( $id['parallax'] == 'yes' ) $parallax_checked = ' checked="checked"';
                                ?>
                            <li class="section_container" data-post-id="<?php echo $section ?>">
                                <input type="hidden" value="<?php echo $section ?>" name="section[]" class="section_order">
                                <input type="hidden" value="<?php echo $id['id'] ?>" name="section[<?php echo $section ?>][id]" class="section_id replace_id">
                                <h3 class="section_title">
                                    <i class="icon-page"></i>
                                    <?php echo get_the_title($id['id']) ?>
                                    <button class="alignright button delete_section">Delete</button>
                                    <span class="alignright"><a class="button button-small" href="<?php echo site_url(); ?>/wp-admin/post.php?post=<?php echo $id['id'] ?>&action=edit" target="_blank">Edit</a> </span>
                                    <span class="alignright"><a href="#" class="toggle_mo button button-small button-primary">Customize</a></span>
                                </h3>
                                <div class="membership_options_container" style="display: none;">
                                    <br />
                                    <hr />
                                    <br />
                                <div class="membership_column">
                                    <div class="membership_option">
                                        <label class="membership_label" for="custom[<?php echo $section ?>]"><i class="icon-style"></i> <strong>Use this style for section</strong></label>
                                        <input style="padding-right: 5px;" type="checkbox" name="section[<?php echo $section ?>][custom]" id="custom[<?php echo $section ?>]" class="replace_id" value="yes"<?php echo $custom_checked ; ?> />
                                        <label for="custom[<?php echo $section ?>]">Yes</label>
                                    </div>
                                    <br />
                                    <div class="membership_option">
                                        <label class="membership_label" for="sectiontitle[<?php echo $section ?>">Optional Title:</label>
                                        <input size="20" maxlength="20" type="text" id="sectiontitle[<?php echo $section ?>" value="<?php echo $id['sectiontitle'] ?>" name="section[<?php echo $section ?>][sectiontitle]" class="replace_id" /><br />
                                        <span class="description">Replaces the section title and it also creates the Section Menu item for the section.<br />
                                    </div>
                                    <div class="membership_option">
                                        <label class="membership_label" for="section_background_color_<?php echo $section ?>">Background Color <i class="icon-color" style="color: <?php echo $id['background_color'] ?>; text-shadow: 0 0 2px rgba(0,0,0,.4)"></i></label>
                                        <input id="section_background_color_<?php echo $section ?>" type="text" value="<?php echo $id['background_color'] ?>" name="section[<?php echo $section ?>][background_color]" data-preview="background-color" class="section_preview section_preview membership_color colorPreview replace_id">
                                    </div>
                                    <div class="membership_option">
                                        <label class="membership_label" for="section_body_color_<?php echo $section ?>">Font Color <i class="icon-color" style="color: <?php echo $id['body_color'] ?>; text-shadow: 0 0 2px rgba(0,0,0,.4)"></i></label>
                                        <input id="section_body_color_<?php echo $section ?>" type="text" value="<?php echo $id['body_color'] ?>" name="section[<?php echo $section ?>][body_color]" data-preview="color" class="section_preview section_preview membership_color colorPreview replace_id">
                                    </div>
                                    <div class="membership_option">
                                        <label class="membership_label" for="section_body_align<?php echo $section ?>">Content Align</label>
                                        <select data-preview="text-align" class="section_preview replace_id" name="section[<?php echo $section ?>][body_align]" id="section_body_align[<?php echo $section ?>]">
                                            <?php
                                            $i = 0;
                                            $position = array (
                                                'inherit' => 'Default',
                                                'left' => 'Left',
                                                'center' => 'Center',
                                                'right' => 'Right'
                                            );
                                            foreach( $position as $checkbox => $label) :
                                                $check = '';
                                                if( $id['body_align'] == $checkbox) $check = ' selected="selected"'; ?>
                                                <option<?php echo $check ?> value="<?php echo $checkbox ?>" ><?php echo $label ?></option>

                                                <?php $i++; endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="membership_option">
                                        <label class="membership_label" for="middlealign[<?php echo $section ?>]">Align Vertically</label>
                                        <input style="padding-right: 5px;" type="checkbox" name="section[<?php echo $section ?>][middlealign]" id="middlealign[<?php echo $section ?>]" data-preview="display" data-value="table" data-value-none="inline-block" class="section_preview replace_id" value="yes"<?php echo $middlealign_checked; ?> />
                                        <label for="middlealign[<?php echo $section ?>]">Yes</label>
                                    </div>

                                    <div class="membership_option">
                                        <label class="membership_label" for="column[<?php echo $section ?>]"><i class="icon-column"></i> Column</label>
                                        <input style="padding-right: 5px;" type="checkbox" name="section[<?php echo $section ?>][column]" id="column[<?php echo $section ?>]" class="replace_id" value="yes"<?php echo $column_checked ; ?> />
                                        <label for="column[<?php echo $section ?>]">Yes</label>
                                    </div>


                                    <div class="membership_option">
                                        <label class="membership_label" for="break[<?php echo $section ?>]"><i class="icon-break"></i> Last Column</label>
                                        <input style="padding-right: 5px;" type="checkbox" name="section[<?php echo $section ?>][break]" id="break[<?php echo $section ?>]" class="replace_id" value="yes"<?php echo $break_checked ; ?> />
                                        <label for="break[<?php echo $section ?>]">Yes</label>
                                    </div>

                                    <div class="membership_option">
                                        <label class="membership_label" for="hidesectiontitle[<?php echo $section ?>]"><i class="icon-title"></i> Hide Title (hides Optional Title)</label>
                                        <input style="padding-right: 5px;" type="checkbox" name="section[<?php echo $section ?>][hidesectiontitle]" id="hidesectiontitle[<?php echo $section ?>]" class="replace_id" value="yes"<?php echo $hidesectiontitle_checked ; ?> />
                                        <label for="hidesectiontitle[<?php echo $section ?>]">Yes</label>
                                    </div>
                                    <div class="membership_option">
                                            <label class="membership_label" for="content_width[<?php echo $section ?>">Content Width (px):</label>
                                            <input style="width: 70px;" type="number" size="3" max="2000" id="content_width[<?php echo $section ?>" value="<?php echo $id['content_width'] ?>" name="section[<?php echo $section ?>][content_width]" class="replace_id" />
                                    </div>
                                    <div class="membership_option">
                                        <label class="membership_label" for="section_width[<?php echo $section ?>">Section Width:</label>
                                        <input style="width: 70px;" type="number" size="3" max="2000" id="section_width[<?php echo $section ?>" value="<?php echo $id['section_width'] ?>" name="section[<?php echo $section ?>][section_width]" class="replace_id" />
                                        <select name="section[<?php echo $section ?>][section_width_size]" id="section_width_size<?php echo $i ?>">
                                            <?php
                                            $i = 0;
                                            $position = array (
                                                'auto' => 'Auto',
                                                'px' => 'px',
                                                '%' => '%'
                                            );
                                            foreach( $position as $checkbox => $label) :
                                                $check = '';
                                                if( $id['section_width_size'] == $checkbox) $check = ' selected="selected"'; ?>
                                                <option<?php echo $check ?> value="<?php echo $checkbox ?>"><?php echo $label ?></option>
                                                <?php $i++; endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="membership_option">
                                        <label class="membership_label" for="content_paddding[<?php echo $section ?>">Content Padding:</label>
                                        <input style="width: 70px;" type="number" size="3" max="2000" id="content_paddding[<?php echo $section ?>" value="<?php echo $id['content_paddding'] ?>" name="section[<?php echo $section ?>][content_paddding]"  />
                                        <select name="section[<?php echo $section ?>][content_paddding_size]" id="content_paddding_size<?php echo $i ?>">
                                            <?php
                                            $i = 0;
                                            $position = array (
                                                'def' => 'Default',
                                                'px' => 'px',
                                                'em' => 'em'
                                            );
                                            foreach( $position as $checkbox => $label) :
                                                $check = '';
                                                if( $id['content_paddding_size'] == $checkbox) $check = ' selected="selected"'; ?>
                                                <option<?php echo $check ?> value="<?php echo $checkbox ?>"><?php echo $label ?></option>
                                                <?php $i++; endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="membership_option">
                                        <label class="membership_label" for="section_height[<?php echo $section ?>">Section Height <strong>(in px)</strong>:</label>
                                        <input style="width: 70px;" type="number" size="3" max="2000" id="section_height[<?php echo $section ?>" value="<?php echo $id['section_height'] ?>" name="section[<?php echo $section ?>][section_height]" class="replace_id" />
                                        <select name="section[<?php echo $section ?>][section_height_size]" id="section_height_size<?php echo $i ?>">
                                            <?php
                                            $i = 0;
                                            $position = array (
                                                'auto' => 'Auto',
                                                'px' => 'px',
                                                '%' => '%'
                                            );
                                            foreach( $position as $checkbox => $label) :
                                                $check = '';
                                                if( $id['section_height_size'] == $checkbox) $check = ' selected="selected"'; ?>
                                                <option<?php echo $check ?> value="<?php echo $checkbox ?>"><?php echo $label ?></option>
                                                <?php $i++; endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="membership_option">
                                        <label class="membership_label" for="fullsection[<?php echo $section ?>]"><i class="icon-fullsize"></i> Fullsize (Width 100%, Height 100%;)</label>
                                        <input style="padding-right: 5px;" type="checkbox" name="section[<?php echo $section ?>][fullsection]" id="fullsection[<?php echo $section ?>]" class="replace_id" value="yes"<?php echo $fullsection_checked ; ?> />
                                        <label for="fullsection[<?php echo $section ?>]">Yes</label>
                                    </div>
                                </div>
                                <div class="membership_column">
                                    <div class="membership_option">
                                        <label class="membership_label">Background Image</label>
                                        <?php $bg = $id['background_image'];
                                        $bg_src = wp_get_attachment_image_src( $bg, 'small' );
                                        if (empty($bg)) : ?>
                                            <a class="button-primary change-image button none" href="#" data-uploader-title="Select an image" data-uploader-button-text="Select an image">Change</a>
                                            <a class="button-primary membership-add button" href="#" data-uploader-title="Select an image" data-uploader-button-text="Select an image">Upload</a>
                                            <a class="remove-image button none" href="#">Remove</a> <br />
                                        <?php else : ?>
                                            <a class="button-primary change-image button" href="#" data-uploader-title="Select an image" data-uploader-button-text="Select an image">Change</a>
                                            <a class="button-primary membership-add button none" href="#" data-uploader-title="Select an image" data-uploader-button-text="Select an image">Upload</a>
                                            <a class="remove-image button" href="#">Remove</a>
                                        <?php endif; ?>
                                        <p class="description"> Select an image</p>
                                    </div>

                                    <div class="membership_option">
                                        <?php print_r($id['bgpost']) ?>
                                        <label class="membership_label" for="bgpos[<?php echo $section ?>]">Background Position</label>
                                            <div class="bgpos_wrapper">
                                                <?php
                                                $i = 1;
                                                $position = array (
                                                    'top left' => 'Top Left',
                                                    'top center' => 'Top Center',
                                                    'top right' => 'Top Right',
                                                    'center left' => 'Middle Left',
                                                    'center center' => 'Middle Center',
                                                    'center right' => 'Middle Right',
                                                    'bottom left' => 'Bottom Left',
                                                    'bottom center' => 'Bottom Center',
                                                    'bottom right' => 'Bottom Right'
                                                );
                                                foreach( $position as $checkbox => $label) :
                                                    $check = '';
                                                    if( $id['bgpos'] == $checkbox) $check = ' selected="selected"'; ?>
                                                    <input type="radio" <?php echo $check ?> value="<?php echo $checkbox ?>" data-preview="background-position" class="section_preview bgpos replace_id" data-bg-pos="top left" id="bgpos[<?php echo $section ?>]" name="section[<?php echo $section ?>][bgpos]" />
                                                    <?php
                                                    if($i % 3 == 0) echo '<br />';
                                                    $i++; endforeach; ?>
                                            </div>
                                    </div>

                                    <div class="membership_option">
                                        <label class="membership_label" for="bgpos_h[<?php echo $section ?>]">Horizontal Position</label>
                                        <select data-preview="background-position" class="section_preview bgpos replace_id" data-bg-y="" id="bgpos_h[<?php echo $section ?>]" name="section[<?php echo $section ?>][bgpos_h]">

                                            <?php
                                            $i = 0;
                                            $position = array (
                                                'left' => 'Left',
                                                'center' => 'Center',
                                                'right' => 'Right'
                                            );
                                            foreach( $position as $checkbox => $label) :
                                                $check = '';
                                                if( $id['bgpos_h'] == $checkbox) $check = ' selected="selected"'; ?>
                                                <option<?php echo $check ?> value="<?php echo $checkbox ?>"><?php echo $label ?></option>
                                                <?php $i++; endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="membership_option">
                                        <label class="membership_label" for="bgpos_v_<?php echo $i ?>">Vertical Position</label>
                                        <select data-preview="background-position" class="section_preview bgpos replace_id" data-bg-x="" name="section[<?php echo $section ?>][bgpos_v]" id="bgpos_v_<?php echo $i ?>">
                                        <?php
                                        $i = 0;
                                        $position = array (
                                            'top' => 'Top',
                                            'center' => 'Middle',
                                            'bottom' => 'Bottom'
                                        );
                                        foreach( $position as $checkbox => $label) :
                                            $check = '';
                                            if( $id['bgpos_v'] == $checkbox) $check = ' selected="selected"'; ?>
                                            <option<?php echo $check ?> value="<?php echo $checkbox ?>"><?php echo $label ?></option>
                                            <?php $i++; endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="membership_option">
                                        <label for="bgpos_r_<?php echo $i ?>" class="membership_label">Repeat Background</label>
                                        <select data-preview="background-repeat" class="section_preview replace_id" name="section[<?php echo $section ?>][bgpost_r]" id="bgpos_r_<?php echo $i ?>">
                                            <?php
                                            $i = 0;
                                            $position = array (
                                                'repeat' => 'Yes',
                                                'repeat-x' => 'Vertically',
                                                'repeat-y' => 'Horizontally',
                                                'no-repeat' => 'No'
                                            );
                                            foreach( $position as $checkbox => $label) :
                                                $check = '';
                                                if( $id['bgpost_r'] == $checkbox) $check = ' selected="selected"'; ?>
                                                <option<?php echo $check ?> value="<?php echo $checkbox ?>"><?php echo $label ?></option>
                                                <?php $i++; endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="membership_option">
                                        <label for="bgpos_s_<?php echo $i ?>" class="membership_label">Background Size</label>
                                        <select data-preview="background-size" class="section_preview replace_id" name="section[<?php echo $section ?>][bgpos_s]" id="bgpos_s_<?php echo $i ?>">
                                            <?php
                                            $i = 0;
                                            $position = array (
                                                'none' => 'Auto (Original Size)',
                                                'cover' => 'Covers the entire Section',
                                                'contain' => 'Contain in Section'
                                            );
                                            foreach( $position as $checkbox => $label) :
                                                $check = '';
                                                if( $id['bgpos_s'] == $checkbox) $check = ' selected="selected"'; ?>
                                                <option<?php echo $check ?> value="<?php echo $checkbox ?>"><?php echo $label ?></option>
                                                <?php $i++; endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="membership_option">
                                        <label class="membership_label" for="parallax[<?php echo $section ?>]"><i class="icon-parallax"></i> Parallax</label>
                                        <input style="padding-right: 5px;" type="checkbox" name="section[<?php echo $section ?>][parallax]" id="parallax[<?php echo $section ?>]" class="replace_id" value="yes"<?php echo $parallax_checked; ?> />
                                        <label for="hidesectiontitle[<?php echo $section ?>]">Yes</label>
                                    </div>

                                    <div class="membership_option">
                                        <label for="parallax_size_<?php echo $i ?>" class="membership_label">Parallax Amount</label>
                                        <select name="section[<?php echo $section ?>][parallax_size]" class="replace_id" id="parallax_size_<?php echo $i ?>">
                                            <?php
                                            $i = 0;
                                            $position = array (
                                                'low' => 'Low',
                                                'medium' => 'Medium',
                                                'large' => 'Large'
                                            );
                                            foreach( $position as $checkbox => $label) :
                                                $check = '';
                                                if( $id['parallax_size'] == $checkbox) $check = ' selected="selected"'; ?>
                                                <option<?php echo $check ?> value="<?php echo $checkbox ?>"><?php echo $label ?></option>
                                                <?php $i++; endforeach; ?>
                                        </select>
                                    </div>

                                <?php $bg_style = ''; $p_style='';
                                    $bg_style.='background-image: url('.$bg_src[0].'); ';
                                    $bg_style.="background-position: ".$id['bgpos_h']." ".$id['bgpos_v']."; ";
                                    $bg_style.="background-repeat: ".$id['bgpost_r']."; ";
                                    $bg_style.="background-size: ".$id['bgpos_s']."; ";
                                    $bg_style.="background-color: ".$id['background_color']."; ";
                                    $bg_style.="color: ".$id['body_color']."; ";
                                    $bg_style.="text-align: ".$id['body_align']."; ";
                                    $p_style.="width: ".$id['section_width']."".$id['section_width_size']."; ";
                                    if($id['middlealign'] == 'yes') $bg_style.="display: table;";
                                    ?>
                                <div class="image_preview" style="<?php echo $bg_style ?>">
                                    <input type="hidden" class="membership_tb replace_id" name="section[<?php echo $section ?>][background_image]" value="<?php echo $bg ?>">
                                    <p style="<?php echo $p_style ?>">Lorem ipsum dolor sit amet, nulla senectus vel, congue ultricies justo mauris tellus, posuere enim sed, pharetra dui justo in tortor sollicitudin, integer et. Urna a in nunc risus litora tristique, sit donec mattis. Enim ante, etiam suspendisse wisi pellentesque et earum. Libero risus parturient consequat et porta amet, quisque commodo eos dis neque nibh. </p>
                                </div>
                                <div class="preview_update" style="display: none;">Updated</div>
                                </div>
                                    <br />
                                    <hr />
                                    <br />
                                </div>
                            </li>
                        <?php endif; endforeach; ?>
                    </ul>
<!--                    <pre>--><?php //print_r ($cf['section']) ?><!--</pre>-->

                </div>
                <div class="membership_tab membership_page">

                    <ul class="page_tabs">
                        <li id="membership_page_image"><a class="membership_pagego button button-small active" href="#">Scroll Notification</a></li>
                        <li id="membership_page_popup"><a href="#" class="membership_pagego button button-small"> Pop-up Delay</a></li>
<!--                        <li id="membership_page_custom"><a href="#" class="membership_pagego button button-small"><i class="icon-custom"></i> Custom Embed</a></li>-->
                    </ul>
                    <hr />


                    <div class="page_tab membership_page_image active">
                        <div class="section_container">
                        <div class="page_options">
                            <input style="padding-right: 5px;" type="checkbox" name="scrollnote[check]" id="scrollcheck" value="yes"<?php echo $scrollnote_checked; ?> />
                            <label for="scrollcheck">Enable Scroll Notification</label>
                            <br />
                            <br />
                            <?php wp_editor( $cf['scrollnote']['content'], 'content_scroll', $settings = array('wpautop' => 'false', 'textarea_name' => 'scrollnote[content]', 'media_buttons' => 'true', ' textarea_rows' => 5) ); ?>
                            <br />
                            <span class="description">Scroll Notification Content</span>
                            <hr />
                            <br />
                            <?php $tb = $cf['scrollnote']['image'];
                                  $tb_src = wp_get_attachment_image_src( $tb, 'medium' );
                            if (empty($tb)) : ?>
                                <a class="button-primary change-image button none" href="#" data-uploader-title="Select an image" data-uploader-button-text="Select an image">Change</a>
                                <a class="button-primary membership-add button" href="#" data-uploader-title="Select an image" data-uploader-button-text="Select an image">Upload</a>
                                <a class="remove-image button none" href="#">Remove</a> <br />
                            <?php else : ?>
                                <a class="button-primary change-image button" href="#" data-uploader-title="Select an image" data-uploader-button-text="Select an image">Change</a>
                                <a class="button-primary membership-add button none" href="#" data-uploader-title="Select an image" data-uploader-button-text="Select an image">Upload</a>
                                <a class="remove-image button" href="#">Remove</a>
                            <?php endif; ?>
                            <br />

                            <br/>
                        </div>
                        <p class="description">Select an image</p>

                            <input type="hidden" class="membership_tb" name="scrollnote[image]" value="<?php echo $tb ?>">
                            <div class="image_preview" style="width: 300px; height: 300px; background-size: contain; background-position: center center; background-repeat: no-repeat; background-image: url('<?php echo $tb_src[0] ?>')"></div>
                            <br />
                            <hr />
                            <br />
                            <div class="membership_option">
                                <label class="membership_label" for="scrollnote_bg">Background Color <i class="icon-color"  style="color: <?php echo $cf['scrollnote']['bg'] ?>; text-shadow: 0 0 2px rgba(0,0,0,.4)"></i></label>
                                <input id="scrollnote_bg" data-default-color="#fff" type="text" value="<?php echo $cf['scrollnote']['bg'] ?>" name="scrollnote[bg]" class="membership_color">
                            </div>
                            <div class="membership_option">
                                <label class="membership_label" for="scrollnote_color">Text Color <i class="icon-color"  style="color: <?php echo $cf['scroll_color']['color'] ?>; text-shadow: 0 0 2px rgba(0,0,0,.4)"></i></label>
                                <input id="scrollnote_color" data-default-color="#fff" type="text" value="<?php echo $cf['scrollnote']['color'] ?>" name="scrollnote[color]" class="membership_color">
                            </div>
                            <div class="membership_option">
                                <label class="membership_label" for="scrollnote_px">Show after scrolling X pixels</label>
                                <input  size="5" placeholder="300" id="scrollnote_px" type="text" value="<?php echo $cf['scrollnote']['px'] ?>" name="scrollnote[px]">
                                <span class="description">Default is <strong>300</strong></span>
                            </div>
                        </div>
                    </div>



                    <div class="membership_page_popup page_tab">
                        <div class="section_container">
                            <div class="page_options">
                                <span class="description">This feature uses the Easy Fancybox plugin (included with the theme). Please navigate to <strong>Dashboard > Settings > Media</strong> and enable Fancybox for <strong>Inline content</strong>.</span><br />
                                <input style="padding-right: 5px;" type="checkbox" name="popup[check]" id="popupcheck" value="yes"<?php echo $popup_checked; ?> />
                                <label for="popupcheck">Enable Delayed Pop-up</label><br /><br />
                                <?php wp_editor( $cf['popup']['content'], 'content_popup', $settings = array('wpautop' => 'false', 'textarea_name' => 'popup[content]', 'media_buttons' => 'true', ' textarea_rows' => 5) ); ?>
                                <br />
                                <span class="description">Delayed Pop-up Content</span>
                                <br />
                            </div>
                            <div class="membership_option">
                                <label class="membership_label" for="popup_sec">Delay pop-up for X seconds</label>
                                <input  size="5" placeholder="10" id="popup_sec" type="text" value="<?php echo $cf['popup']['sec'] ?>" name="popup[sec]">
                                <span class="description">Default is <strong>10</strong></span>
                            </div>
                            <div class="membership_option">
                                <label class="membership_label" for="popup_w">Width (px)</label>
                                <input  size="5" placeholder="460" id="popup_w" type="text" value="<?php echo $cf['popup']['w'] ?>" name="popup[w]">
                            </div>
                            <div class="membership_option">
                                <label class="membership_label" for="popup_h">Height (px)</label>
                                <input  size="5" placeholder="380" id="popup_h" type="text" value="<?php echo $cf['popup']['h'] ?>" name="popup[h]">
                            </div><br />
                            <span class="description">You can let the pop-up autoresize itself (and leave the width and height blank) by checking <strong>Try to adjust size to inline/html content.</strong> in the Easy Fancybox settings page (Dashboard > Settings > Media)</span>
                        </div>
                    </div>
                    <div class="membership_page_custom page_tab">
                        <?php // wp_editor( $cf['panic_embedded'], 'content_long', $settings = array('wpautop' => 'false', 'textarea_name' => 'panic_embedded', 'media_buttons' => 'true', ' textarea_rows' => 5) ); ?>
                    </div>
                </div>
                <div class="membership_tab membership_display">
                    <input style="padding-right: 5px;" type="checkbox" name="hide_title" id="hide_title" value="yes"<?php echo $hidetitle_checked; ?> />
                    <label for="hide_title">Hide Page Content<br /><span class="description">Only the Sections will be visible</span></label>
                    <hr />
                    <input style="padding-right: 5px;" type="checkbox" name="hide_sidebar" id="hide_sidebar" value="yes"<?php echo $hidesidebar_checked; ?> />
                    <label for="hide_sidebar">Hide Sidebar</label>
<!--                    <hr />-->
<!--                    <input style="padding-right: 5px;" type="checkbox" name="full_width" id="full_width" value="yes"--><?php //echo $fullwidth_checked; ?><!-- />-->
<!--                    <label for="full_width">Full Width </label>-->
<!--                    <span class="description">The page (and sections) width will be limited to the site width.</span>-->
                    <hr />
                    <input style="padding-right: 5px;" type="checkbox" name="showmenu" id="show_menu" value="yes"<?php echo $showmenu_checked; ?> />
                    <label for="show_menu">Enable Section Menu</label>
                    <div class="membership_option">
                        <label class="membership_label" for="section_menu_bg">Background Color <i class="icon-color"  style="color: <?php echo $cf['section_menu_bg'] ?>; text-shadow: 0 0 2px rgba(0,0,0,.4)"></i></label>
                        <input id="section_menu_bg" data-default-color="#fff" type="text" value="<?php echo $cf['section_menu_bg'] ?>" name="section_menu_bg" class="membership_color replace_id">
                    </div>
                    <div class="membership_option">
                        <label class="membership_label" for="section_menu_color">Text Color <i class="icon-color"  style="color: <?php echo $cf['section_menu_color'] ?>; text-shadow: 0 0 2px rgba(0,0,0,.4)"></i></label>
                        <input id="section_menu_color" data-default-color="#fff" type="text" value="<?php echo $cf['section_menu_color'] ?>" name="section_menu_color" class="membership_color replace_id">
                    </div>
                    <br />
                    <span class="description"><strong>Important!</strong> To add a Section to the menu, you first have to enter the Optional Title.</span>
                </div>
                <div class="membership_tab membership_indiv">
                    <?php wp_editor( $cf['article_notes'], 'content_notes', $settings = array('wpautop' => 'false', 'textarea_name' => 'article_notes', 'media_buttons' => 'true', ' textarea_rows' => 5) ); ?>
                </div>
            </div>
            <div class="clear"></div>
        </div>


    <?php
    }

    /**
     * Save custom Post data
     * @param $post_id
     */

    public function save_options_data( $post_id ) {
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
        if ( !wp_verify_nonce( $_POST['section_metabox_nonce'], 'section_nonce' )) return;
        if ( 'section' == $_POST['post_type'] ):
            if ( !current_user_can( 'edit_post', $post_id ) ) return;
        endif;

        $meta_fields = array(
            'section',
            'hide_title',
            'hide_sidebar',
//            'full_width',
            'showmenu',
            'section_menu_bg',
            'section_menu_color',
            'scrollnote',
            'popup'
        );

        foreach ($meta_fields as $key ) :
            delete_post_meta($post_id, $key, $_POST[$key]);
            update_post_meta($post_id, $key, $_POST[$key]);
        endforeach;
    }

    public function save_postoptions_data( $post_id ) {

        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
        if ( !wp_verify_nonce( $_POST['postoptions_metabox_nonce'], 'postoptions_nonce' )) return;
        if ( !current_user_can( 'edit_post', $post_id ) ) return;

        $meta_fields = array(
            'has_sidebar',
            'has_postmeta',
            'hide_sidebar'
        );

        foreach ($meta_fields as $key ) :
            delete_post_meta($post_id, $key, $_POST[$key]);
            update_post_meta($post_id, $key, $_POST[$key]);
        endforeach;
    }

    public function add_admin_menu_separator($position) {
        global $menu;
        $index = 8;
        foreach($menu as $offset => $section) {
            if (substr($section[2],0,9)=='separator')
                $index++;
            if ($offset>=$position) {
                $menu[$position] = array('','read',"separator{$index}",'','wp-menu-separator');
                break;
            }
        }
        ksort( $menu );
    }

    public function admin_menu_separator() {
        $this->add_admin_menu_separator(81);
    }

    // Profile Fields

    public function profile_fields( $user ) { ?>

        <h3>Other Fields</h3>

        <table class="form-table">

            <tr>
                <th><label for="twitter">Twitter username</label></th>

                <td>
                    <input type="text" placeholder="@user" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
                </td>
            </tr>
            <tr>
                <th><label for="twitter">Facebook </label></th>
                <td>
                    <input type="text" placeholder="Facebook Username" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
                    <input type="text" placeholder="Facebook URL (opt.)" name="facebook_url" id="facebook_url" value="<?php echo esc_attr( get_the_author_meta( 'facebook_url', $user->ID ) ); ?>" class="regular-text" /><br />
                </td>
            </tr>
            <tr>
                <th><label for="twitter">Google+ </label></th>
                <td>
                    <input type="text" placeholder="Google+ Username" name="gplus" id="gplus" value="<?php echo esc_attr( get_the_author_meta( 'gplus', $user->ID ) ); ?>" class="regular-text" /><br />
                    <input type="text" placeholder="Google+ URL" name="gplus_url" id="gplus_url" value="<?php echo esc_attr( get_the_author_meta( 'gplus_url', $user->ID ) ); ?>" class="regular-text" /><br />
                </td>
            </tr>
            <tr>
                <th><label for="twitter">Website </label></th>
                <td>
                    <input type="text" placeholder="Website Name" name="url_name" id="url_name" value="<?php echo esc_attr( get_the_author_meta( 'url_name', $user->ID ) ); ?>" class="regular-text" /><br />
                    <input type="text" placeholder="Website URL" name="url" id="url" value="<?php echo esc_attr( get_the_author_meta( 'url', $user->ID ) ); ?>" class="regular-text" /><br />
                </td>
            </tr>

        </table>
    <?php }

    public function membership_profile_fields( $user_id ) {

        if ( !current_user_can( 'edit_user', $user_id ) )
            return false;

        /* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
        update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
        update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
        update_user_meta( $user_id, 'facebook_url', $_POST['facebook_url'] );
        update_user_meta( $user_id, 'gplus', $_POST['gplus'] );
        update_user_meta( $user_id, 'gplus_url', $_POST['gplus_url'] );
        update_user_meta( $user_id, 'url_name', $_POST['url_name'] );

    }

    public function fix_img_caption_shortcode($val, $attr, $content = null) {
        extract(shortcode_atts(array(
            'id'    => '',
            'align' => '',
            'width' => '',
            'caption' => ''
        ), $attr));

        if ( 1 > (int) $width || empty($caption) ) return $val;

        return '<div id="' . $id . '" class="wp-caption ' . esc_attr($align) . '">' . do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
    }

    public function remove_default_post_type() {
        remove_menu_page('edit.php');
    }

    /** RSS */

    public function membership_feed_request($qv) {
        if (isset($qv['feed']) && !isset($qv['post_type']))
            $qv['post_type'] = array('image', 'audio', 'section', 'text', 'questions');
        return $qv;
    }

    public function featuredtoRSS($content) {
        global $post;
        if ( has_post_thumbnail( $post->ID ) ){
            $content = '<a href="'.get_permalink($post->ID).'">' . get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'style' => 'margin-bottom: 10px; display: inline-block;ha' ) ) . '</a><br />' . $content;
        }
        return $content;
    }

    public function remove_comments_rss( $for_comments ) {
        return '';
    }


    public function comment_author_boss( $classes, $class, $comment_id, $post_id ) {
        $comment = get_comment( $comment_id );
        if ( user_can( $comment->user_id, 'administrator' ) || user_can( $comment->user_id, 'dj' )  ) {
            $classes[] = 'boss';
        }
        return $classes;
    }

    public function encrypt($str){
        $key = "R4d103r3v4n43v4h";
        for($i=0; $i<strlen($str); $i++) {
            $char = substr($str, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)+ord($keychar));
            $result.=$char;
        }
        return urlencode(base64_encode($result));
    }


    public function decrypt($str){
        $str = base64_decode(urldecode($str));
        $result = '';
        $key = "R4d103r3v4n43v4h";
        for($i=0; $i<strlen($str); $i++) {
            $char = substr($str, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)-ord($keychar));
            $result.=$char;
        }
        return $result;
    }

    public function menu_set_dropdown( $sorted_menu_items, $args ) {
        $last_top = 0;
        foreach ( $sorted_menu_items as $key => $obj ) {
            // it is a top lv item?
            if ( 0 == $obj->menu_item_parent ) {
                // set the key of the parent
                $last_top = $key;
            } else {
                $sorted_menu_items[$last_top]->classes['dropdown'] = 'dropdown';
            }
        }
        return $sorted_menu_items;
    }

    public 	function membership_mce_google_fonts_styles() {
        $font_url = 'http://fonts.googleapis.com/css?family=Lato:300,400,700';
        add_editor_style( str_replace( ',', '%2C', $font_url ) );
    }

}

$Setup = new Setup();
add_action( 'after_setup_theme', array( $Setup, 'theme_setup' ));
add_filter( 'wp_page_menu_args', array( $Setup, 'page_menu_args' ));
add_filter( 'excerpt_length', array( $Setup, 'excerpt_length' ));

add_filter('the_generator', array($Setup, 'wpbeginner_remove_version'));
add_action('wp_head', array($Setup, 'theme_head'));
add_action('admin_head', array($Setup, 'backend_head'));
add_filter( 'post_thumbnail_html', array($Setup, 'remove_thumbnail_dimensions'), 10 );
add_filter( 'image_send_to_editor', array($Setup, 'remove_thumbnail_dimensions'), 10 );
add_filter('post_comments_feed_link_html', array($Setup, 'remove_comments_rss'));

add_action( 'admin_enqueue_scripts', array( $Setup, 'add_backend_scripts' ));
add_action( 'wp_enqueue_scripts', array( $Setup, 'add_frontend_scripts' ));
add_filter( 'wp_nav_menu_objects', array( $Setup, 'menu_set_dropdown'), 10, 2 );


// Register section section Size
add_action( 'init', array( $Setup, 'extend_image_sizes' ));

// Custom Metaboxes
add_action( 'admin_init', array( $Setup, 'add_meta_boxes' ));
add_action( 'save_post', array( $Setup, 'save_options_data' ));
add_action( 'save_post', array( $Setup, 'save_postoptions_data' ));

add_action('admin_menu',array($Setup, 'admin_menu_separator'));

add_action( 'show_user_profile', array($Setup, 'profile_fields' ));
add_action( 'edit_user_profile', array($Setup, 'profile_fields' ));

add_action( 'personal_options_update', array($Setup, 'membership_profile_fields' ));
add_action( 'edit_user_profile_update', array($Setup, 'membership_profile_fields' ));

add_filter('img_caption_shortcode', array($Setup, 'fix_img_caption_shortcode'), 10, 3);
//add_action('admin_menu', array($Setup, 'remove_default_post_type'));
add_filter('request', array($Setup, 'membership_feed_request'));
add_filter('the_excerpt_rss', array($Setup, 'featuredtoRSS'));
add_filter('the_content_feed', array($Setup, 'featuredtoRSS'));
add_action('init', array($Setup, 'dj_author_base'));
add_action('pre_get_posts', array($Setup, 'cpt_query'));
add_action('admin_bar_menu', array($Setup, 'clean_toolbar'), 100);
add_filter( 'comment_class' , array($Setup, 'comment_author_boss'), 10, 4 );
add_action( 'widgets_init', array( $Setup, 'register_widget_areas' ));


/**
 * Remove junk from <head>
 */

remove_action('wp_head', array($Setup, 'rsd_link'));
remove_action('wp_head', array($Setup, 'wp_generator'));
remove_action('wp_head', array($Setup, 'feed_links'), 2);
remove_action('wp_head', array($Setup, 'index_rel_link'));
remove_action('wp_head', array($Setup, 'wlwmanifest_link'));
remove_action('wp_head', array($Setup, 'start_post_rel_link'), 10, 0);
remove_action('wp_head', array($Setup, 'parent_post_rel_link'), 10, 0);
remove_action('wp_head', array($Setup, 'adjacent_posts_rel_link'), 10, 0);
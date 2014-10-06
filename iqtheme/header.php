<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<?php global $post ?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php
        /*
       * Print the <title> tag based on what is being viewed.
       */
        global $page, $paged, $wp_query;

        wp_title( '|', true, 'right' );

        // Add the blog name.
        bloginfo( 'name' );

        // Add the blog description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );

        if(isset( $wp_query->query['features-amenities'] ))
            echo ' - Features & Amenities';

        if(isset( $wp_query->query['floor-plans'] ))
            echo ' - Floorplans';

        if(isset( $wp_query->query['site-plan'] ))
            echo ' - Site Plan';

        if(isset( $wp_query->query['video-photo-gallery'] ))
            echo ' - Photo Gallery';

        if(isset( $wp_query->query['lend2lease'] ))
            echo ' - Contact';

        if(isset( $wp_query->query['area-map'] ))
            echo ' - Area Map';

        if ( $site_description && ( is_home() || is_front_page() ) )
            echo " | $site_description";

        // Add a page number if necessary:
        if ( $paged >= 2 || $page >= 2 )
            echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );


        ?></title>
    <?php wp_head(); ?>
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/lib/css/mp.css">
    <script type="text/javascript">
        var template_url = "<?php bloginfo( 'template_url' ); ?>",
            ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>",
            wpurl = "<?php echo home_url('/'); ?>";
    </script>
    <style id="svg-filters" type="text/css">
        .blur {
            filter: url('<?php the_permalink() ?>#blur');
            -webkit-filter: url('#blur');
            filter:progid:DXImageTransform.Microsoft.Blur(PixelRadius='5');
        }

        .shadow {
            -webkit-filter: drop-shadow(6px 6px 3px rgba(0,0,0,0.5));
            filter: url('<?php the_permalink() ?>#shadow');
            -ms-filter: "progid:DXImageTransform.Microsoft.Dropshadow(OffX=6, OffY=6, Color='#444')";
            filter: "progid:DXImageTransform.Microsoft.Dropshadow(OffX=6, OffY=6, Color='#444')";
        }

        header.site-header {
            -webkit-filter: drop-shadow(0 0 3px rgba(0,0,0,0.3));
<!--            filter: url('--><?php //the_permalink() ?><!--#menushadow');-->
            -ms-filter: "progid:DXImageTransform.Microsoft.Dropshadow(OffX=0, OffY=3, Color='#444')";
            filter: "progid:DXImageTransform.Microsoft.Dropshadow(OffX=0, OffY=3, Color='#444')";
        }
    </style>
</head>

<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=197845670250233";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<div id="wrapper">
    <!-- Begin header -->
    <?php $fxd = get_theme_mod('fixed_header');
          $header_class = '';
          if( !empty($fxd) ) $header_class .= 'fixed ';

          $header_fontsize = get_theme_mod('header_fontsize');
          if( !empty($header_fontsize) ) $header_class .= $header_fontsize;

          $font_menu = get_theme_mod('font_menu');
          if( !empty($font_menu) ) $font_menu = 'header-font '?>
    <header class="site-header header-background <?php echo $header_class ?>">
        <div id="header">
            <div id="logo" class="animated">
                <?php $header_image = get_header_image();
                if  ( empty( $header_image ) or !$header_image ) : ?>
                    <a class="header-color" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                        <h1 class="site-title header-font"><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></h1>
                        <?php $desc = get_theme_mod('hide_desc'); if(!empty($desc)) $desc_opacity = 'style="opacity: 0"'; ?>
                        <h2 <?php echo $desc_opacity ?> class="site-description"><?php echo esc_attr( get_bloginfo( 'description', 'display' ) ); ?></h2>
                    </a>
                <?php else : ?>
                    <a class="site-title" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                        <img src="<?php echo esc_url( $header_image ); ?>" class="header-image" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
                    </a>
                <?php endif; ?>
            </div>
            <a class="open_menu" href="#"><i class="icon-menu"></i><span>Menu</span></a>
            <nav id="nav" class="header-color<?php echo $font_menu ?>">
                <?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary', 'walker' => new Description_Walker() ) ); ?>
            </nav>
            <div class="header-search header-color">
                <i class="icon-search"></i>
                <?php get_search_form(); ?>
            </div>
        </div>
    </header>
    <!--    <div class="clear"></div>-->
    <!-- End header -->
    <!-- Begin container -->
    <div id="container">
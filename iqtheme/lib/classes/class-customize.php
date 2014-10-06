<?php new theme_customizer();

class theme_customizer
{
    public function __construct()
    {
        add_action ('admin_menu', array(&$this, 'customizer_admin'));
        add_action( 'customize_register', array(&$this, 'customize_manager_demo' ));
    }

    /**
     * Add the Customize link to the admin menu
     * @return void
     */
    public function customizer_admin() {
        add_theme_page( 'Customize', 'Customize', 'edit_theme_options', 'customize.php' );
    }

    /**
     * Customizer manager demo
     * @param  WP_Customizer_Manager $wp_customize
     * @return void
     */
    public function customize_manager_demo( $wp_customize )
    {
        $this->demo_section( $wp_customize );
    }

    public function demo_section( $wp_customize )
    {
        $wp_customize->add_section( 'customiser_membership', array(
            'title'          => 'iQ  Design',
            'priority'       => 1,
        ) );

        $wp_customize->add_section( 'customiser_social', array(
            'title'          => 'Social Links',
            'priority'       => 2,
        ) );

        $wp_customize->add_section( 'customiser_footer', array(
            'title'          => 'Footer  Design',
            'priority'       => 3,
        ) );

        $wp_customize->add_section( 'customiser_header', array(
            'title'          => 'Header Design',
            'priority'       => 3,
        ) );


        // Checkbox control
        $wp_customize->add_setting( 'hide_desc', array() );

        $wp_customize->add_control( 'hide_desc', array(
            'label'   => 'Hide Logo Description',
            'section' => 'customiser_header',
            'type'    => 'checkbox',
            'priority' => 20,
            'transport' => 'postMessage',
        ) );

        // Checkbox control
        $wp_customize->add_setting( 'font_menu', array(
            'default'        => '',
        ) );

        $wp_customize->add_control( 'font_menu', array(
            'label'   => 'Change Font For Menu',
            'section' => 'customiser_header',
            'type'    => 'checkbox',
            'priority' => 32,
            'transport' => 'postMessage',
        ) );

        // Checkbox control
        $wp_customize->add_setting( 'header_size', array(
        ) );

        $wp_customize->add_control( 'header_size', array(
            'label'   => 'Contain Background',
            'section' => 'customiser_header',
            'type'    => 'checkbox',
            'priority' => 61,
            'transport' => 'postMessage',
        ) );

        // Checkbox control
        $wp_customize->add_setting( 'footer_size', array(
        ) );

        $wp_customize->add_control( 'footer_size', array(
            'label'   => 'Contain Background',
            'section' => 'customiser_footer',
            'type'    => 'checkbox',
            'priority' => 7,
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_setting( 'footer_copy', array(
            'default'        => '',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( 'footer_copy', array(
            'label'   => 'Custom Text (leave empty for default)',
            'section' => 'customiser_footer',
            'type'    => 'text',
            'priority' => 70,
        ) );


        // Checkbox control
        $wp_customize->add_setting( 'fixed_header', array() );

        $wp_customize->add_control( 'fixed_header', array(
            'label'   => 'Fixed Header',
            'section' => 'customiser_header',
            'type'    => 'checkbox',
            'priority' => 1,
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_setting( 'hide_search', array());

        $wp_customize->add_control( 'hide_search', array(
            'label'   => 'Hide Header Search Icon',
            'section' => 'customiser_header',
            'type'    => 'checkbox',
            'priority' => 30,
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_setting( 'hide_social', array());

        $wp_customize->add_control( 'hide_social', array(
            'label'   => 'Hide Social Icons',
            'section' => 'customiser_footer',
            'type'    => 'checkbox',
            'priority' => 2,
            'transport' => 'postMessage',
        ) );

        // Radio control
        $wp_customize->add_setting( 'sidebar_size', array(
            'default'        => '2',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( 'sidebar_size', array(
            'label'   => 'Sidebar Size',
            'section' => 'customiser_membership',
            'type'    => 'radio',
            'choices' => array("Small", "Medium", "Large", "Very Large"),
            'priority' => 3
        ) );

        // Select control
        $wp_customize->add_setting( 'footer_style', array(
            'default'        => '1',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( 'footer_style', array(
            'label'   => 'Footer Style',
            'section' => 'customiser_footer',
            'type'    => 'select',
            'choices' => array(
                "Compact (Default)", "Flexible", "Rows"
            ),
            'priority' => 1
        ) );

        // Select control
        $wp_customize->add_setting( 'body_font', array(
            'default'        => 'Lato, Arial, Helvetica, sans-serif',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( 'body_font', array(
            'label'   => 'Theme Font',
            'section' => 'customiser_membership',
            'type'    => 'select',
            'choices' => array(
                'Lato, Arial, Helvetica, sans-serif' => 'Lato (Default)',
                'Josefin Slab,Times New Roman,Times,serif' => 'Josefin Slab',
                'Open Sans, Arial, Helvetica, sans-serif' => 'Open Sans',
                'Arvo,Times New Roman,Times,serif' => 'Arvo',
                'Vollkorn,Times New Roman,Times,serif' => 'Vollkorn',
                'Abril Fatface, arial, helvetica, sans-serif, cursive' => 'Abril Fatface',
                'Ubuntu, Arial, Helvetica, sans-serif' => 'Ubuntu',
                'Ubuntu Condensed, Arial, Helvetica, sans-serif' => 'Ubuntu Condensed',
                'PT Sans, Arial, Helvetica, sans-serif' => 'PT Sans',
                'PT Serif,Times New Roman,Times,serif' => 'PT Serif',
                'Merriweather,Times New Roman,Times,serif' => 'Merriweather',
                'Old Standard TT,Times New Roman,Times,serif' => 'Old Standard TT',
                'Droid Sans, Arial, Helvetica, sans-serif' => 'Droid Sans',
                'Roboto, Arial, Helvetica, sans-serif' => 'Roboto',
                'Exo, Arial, Helvetica, sans-serif' => 'Exo',
                'Montserrat, Arial, Helvetica, sans-serif' => 'Montserrat',
                'arial,helvetica,sans-serif' => 'Arial',
                'arial black,avant garde' => 'Arial Black',
                'book antiqua,palatino' => 'Book Antiqua',
                'comic sans ms,sans-serif' => 'Comic Sans MS',
                'courier new,courier' => 'Courier New',
                'georgia,palatino' => 'Georgia',
                'tahoma,arial,helvetica,sans-serif' => 'Tahoma',
                'terminal,monaco' => 'Terminal',
                'times new roman,times' => 'Times New Roman',
                'trebuchet ms,geneva' => 'Trebuchet MS',
                'verdana,geneva' => 'Verdana'
            ),
            'priority' => 2
        ) );

        // Select control
        $wp_customize->add_setting( 'header_font', array(
            'default'        => 'PT Serif,Times New Roman,Times,serif',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( 'header_font', array(
            'label'   => 'Header Font',
            'section' => 'customiser_header',
            'type'    => 'select',
            'choices' => array(
                'PT Serif,Times New Roman,Times,serif' => 'PT Serif (Default)',
                'Josefin Slab,Times New Roman,Times,serif' => 'Josefin Slab',
                'Open Sans, Arial, Helvetica, sans-serif' => 'Open Sans',
                'Arvo,Times New Roman,Times,serif' => 'Arvo',
                'Lato, Arial, Helvetica, sans-serif' => 'Lato',
                'Vollkorn,Times New Roman,Times,serif' => 'Vollkorn',
                'Abril Fatface, arial, helvetica, sans-serif, cursive' => 'Abril Fatface',
                'Ubuntu, Arial, Helvetica, sans-serif' => 'Ubuntu',
                'Ubuntu Condensed, Arial, Helvetica, sans-serif' => 'Ubuntu Condensed',
                'PT Sans, Arial, Helvetica, sans-serif' => 'PT Sans',
                'Merriweather,Times New Roman,Times,serif' => 'Merriweather',
                'Old Standard TT,Times New Roman,Times,serif' => 'Old Standard TT',
                'Droid Sans, Arial, Helvetica, sans-serif' => 'Droid Sans',
                'Roboto, Arial, Helvetica, sans-serif' => 'Roboto',
                'Exo, Arial, Helvetica, sans-serif' => 'Exo',
                'Montserrat, Arial, Helvetica, sans-serif' => 'Montserrat',
                'arial,helvetica,sans-serif' => 'Arial',
                'arial black,avant garde' => 'Arial Black',
                'book antiqua,palatino' => 'Book Antiqua',
                'comic sans ms,sans-serif' => 'Comic Sans MS',
                'courier new,courier' => 'Courier New',
                'georgia,palatino' => 'Georgia',
                'tahoma,arial,helvetica,sans-serif' => 'Tahoma',
                'terminal,monaco' => 'Terminal',
                'times new roman,times' => 'Times New Roman',
                'trebuchet ms,geneva' => 'Trebuchet MS',
                'verdana,geneva' => 'Verdana'
            ),
            'priority' => 31
        ) );

        // Select control
        $wp_customize->add_setting( 'site_width', array(
            'default'        => '980px',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( 'site_width', array(
            'label'   => 'Site Width',
            'section' => 'customiser_membership',
            'type'    => 'select',
            'choices' => array(
                '1024px' => '1042px',
                '980px' => '980px',
                '960px' => '960px',
                '900px' => '900px',
                '800px' => '800px'
            ),
            'priority' => 1
        ) );

//        // Dropdown pages control
//        $wp_customize->add_setting( 'dropdown_pages_setting', array(
//            'default'        => '1',
//        ) );
//
//        $wp_customize->add_control( 'dropdown_pages_setting', array(
//            'label'   => 'Dropdown Pages Setting',
//            'section' => 'customiser_membership',
//            'type'    => 'dropdown-pages',
//            'priority' => 5
//        ) );

        // Color control
        $wp_customize->add_setting( 'site_color', array(
            'default'        => '#000000',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_color', array(
            'label'   => 'Theme Color (Links, Buttons, Borders etc.)',
            'section' => 'colors',
            'settings'   => 'site_color',
            'priority' => 10
        ) ) );

        // Color control
        $wp_customize->add_setting( 'header_background', array(
            'default'        => '#FFFFFF',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background', array(
            'label'   => 'Header Background Color',
            'section' => 'customiser_header',
            'settings'   => 'header_background',
            'priority' => 59
        ) ) );

        // Color control
        $wp_customize->add_setting( 'footer_background', array(
            'default'        => '#FFFFFF',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_background', array(
            'label'   => 'Footer Background Color',
            'section' => 'customiser_footer',
            'settings'   => 'footer_background',
            'priority' => 2
        ) ) );

        // Color control
        $wp_customize->add_setting( 'footer_color', array(
            'default'        => '#FFFFFF',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_color', array(
            'label'   => 'Footer Text Color',
            'section' => 'customiser_footer',
            'settings'   => 'footer_color',
            'priority' => 3
        ) ) );

        // Color control
        $wp_customize->add_setting( 'header_color', array(
            'default'        => '#FFFFFF',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color', array(
            'label'   => 'Header Text Color',
            'section' => 'customiser_header',
            'settings'   => 'header_color',
            'priority' => 70
        ) ) );

//        // WP_Customize_Upload_Control
//        $wp_customize->add_setting( 'upload_setting', array(
//            'default'        => '',
//        ) );
//
//        $wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, 'upload_setting', array(
//            'label'   => 'Upload Setting',
//            'section' => 'customiser_membership',
//            'settings'   => 'upload_setting',
//            'priority' => 7
//        ) ) );

        // WP_Customize_Image_Control
        $wp_customize->add_setting( 'header_bg', array(
            'default'        => '',
        ) );

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_bg', array(
            'label'   => 'Header Background',
            'section' => 'customiser_header',
            'settings'   => 'header_bg',
            'priority' => 60
        ) ) );

        // WP_Customize_Image_Control
        $wp_customize->add_setting( 'footer_bg', array(
            'default'        => '',
        ) );

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_bg', array(
            'label'   => 'Footer Page Background',
            'section' => 'customiser_footer',
            'settings'   => 'footer_bg',
            'priority' => 4
        ) ) );

        // Select control
        $wp_customize->add_setting( 'header_fontsize', array(
            'default'        => '',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( 'header_fontsize', array(
            'label'   => 'Header Size',
            'section' => 'customiser_header',
            'type'    => 'select',
            'choices' => array(
                '' => 'Small',
                'size-medium' => 'Medium',
                'size-large' => 'Large'
            ),
            'priority' => 33
        ) );

        // Select control
        $wp_customize->add_setting( 'header_pos', array(
            'default'        => 'repeat',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( 'header_pos', array(
            'label'   => 'Background Repeat',
            'section' => 'customiser_header',
            'type'    => 'select',
            'choices' => array(
                'repeat' => 'Repeat',
                'no-repeat' => 'No Repeat',
                'repeat-x' => 'Repeat Horizontally',
                'repeat-y' => 'Repeat Vertically'
            ),
            'priority' => 80
        ) );

        // Select control
        $wp_customize->add_setting( 'footer_pos', array(
            'default'        => 'repeat',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( 'footer_pos', array(
            'label'   => 'Background Repeat',
            'section' => 'customiser_footer',
            'type'    => 'select',
            'choices' => array(
                'repeat' => 'Repeat',
                'no-repeat' => 'No Repeat',
                'repeat-x' => 'Repeat Horizontally',
                'repeat-y' => 'Repeat Vertically'
            ),
            'priority' => 5
        ) );

        // Select control
        $wp_customize->add_setting( 'footer_align', array(
            'default'        => 'top left',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( 'footer_align', array(
            'label'   => 'Background Position',
            'section' => 'customiser_footer',
            'type'    => 'select',
            'choices' => array(
                'top left' => 'Left',
                'top center' => 'Center',
                'top right' => 'Right',
                'center center' => 'Middle'
            ),
            'priority' => 5
        ) );

        // Select control
        $wp_customize->add_setting( 'header_align', array(
            'default'        => 'top left',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( 'header_align', array(
            'label'   => 'Background Position',
            'section' => 'customiser_header',
            'type'    => 'select',
            'choices' => array(
                'top left' => 'Left',
                'top center' => 'Center',
                'top right' => 'Right',
                'center center' => 'Middle'
            ),
            'priority' => 81
        ) );

        // WP_Customize_Image_Control
        $wp_customize->add_setting( 'login_bg', array(
            'default'        => '',
        ) );

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'login_bg', array(
            'label'   => 'Log In Page Background',
            'section' => 'customiser_membership',
            'settings'   => 'login_bg',
            'priority' => 10
        ) ) );


        // Textbox control
        $wp_customize->add_setting( 'social_facebook', array(
            'default'        => '',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( 'social_facebook', array(
            'label'   => 'Facebook',
            'section' => 'customiser_social',
            'type'    => 'text',
            'priority' => 1
        ) );

        $wp_customize->add_setting( 'social_twitter', array(
            'default'        => '',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( 'social_twitter', array(
            'label'   => 'Twitter',
            'section' => 'customiser_social',
            'type'    => 'text',
            'priority' => 1
        ) );

        $wp_customize->add_setting( 'social_linkedin', array(
            'default'        => '',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( 'social_linkedin', array(
            'label'   => 'LinkedIn',
            'section' => 'customiser_social',
            'type'    => 'text',
            'priority' => 1
        ) );

        $wp_customize->add_setting( 'social_gplus', array(
            'default'        => '',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( 'social_gplus', array(
            'label'   => 'Google+',
            'section' => 'customiser_social',
            'type'    => 'text',
            'priority' => 1
        ) );

        $wp_customize->add_setting( 'social_pinterest', array(
            'default'        => '',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( 'social_pinterest', array(
            'label'   => 'Pinterest',
            'section' => 'customiser_social',
            'type'    => 'text',
            'priority' => 1
        ) );

        $wp_customize->add_setting( 'social_tumblr', array(
            'default'        => '',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( 'social_tumblr', array(
            'label'   => 'Tumblr',
            'section' => 'customiser_social',
            'type'    => 'text',
            'priority' => 1
        ) );

        $wp_customize->get_setting( 'header_color' )->transport = 'postMessage';
        $wp_customize->get_setting( 'header_background' )->transport = 'postMessage';
        $wp_customize->get_setting( 'header_bg' )->transport = 'postMessage';
        $wp_customize->get_setting( 'footer_background' )->transport = 'postMessage';
        $wp_customize->get_setting( 'footer_bg' )->transport = 'postMessage';
        $wp_customize->get_setting( 'footer_color' )->transport = 'postMessage';
        $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
        $wp_customize->get_setting( 'site_color' )->transport = 'postMessage';
        $wp_customize->get_setting( 'fixed_header' )->transport = 'postMessage';
        $wp_customize->get_setting( 'footer_copy' )->transport = 'postMessage';
        $wp_customize->get_setting( 'hide_search' )->transport = 'postMessage';
        $wp_customize->get_setting( 'hide_social' )->transport = 'postMessage';
        $wp_customize->get_setting( 'hide_desc' )->transport = 'postMessage';
        $wp_customize->get_setting( 'font_menu' )->transport = 'postMessage';
        $wp_customize->get_setting( 'header_size' )->transport = 'postMessage';
        $wp_customize->get_setting( 'header_fontsize' )->transport = 'postMessage';
        $wp_customize->get_setting( 'footer_size' )->transport = 'postMessage';
        $wp_customize->get_setting( 'footer_style' )->transport = 'postMessage';
        $wp_customize->get_setting( 'sidebar_size' )->transport = 'postMessage';
        $wp_customize->get_setting( 'body_font' )->transport = 'postMessage';
//        $wp_customize->get_setting( 'header_font' )->transport = 'postMessage';

//        $wp_customize->get_setting( 'social_facebook' )->transport = 'postMessage';
//        $wp_customize->get_setting( 'social_twitter' )->transport = 'postMessage';
//        $wp_customize->get_setting( 'social_linkedin' )->transport = 'postMessage';
//        $wp_customize->get_setting( 'social_gplus' )->transport = 'postMessage';
//        $wp_customize->get_setting( 'social_pinterest' )->transport = 'postMessage';
//        $wp_customize->get_setting( 'social_tumblr' )->transport = 'postMessage';
    }

    /**
     * This will output the custom WordPress settings to the live theme's WP head.
     *
     * Used by hook: 'wp_head'
     *
     * @see add_action('wp_head',$func)
     * @since MyTheme 1.0
     */
    public static function header_output() {
        ?>
        <!--Customizer CSS-->
        <style type="text/css">
            <?php
            $sb = get_theme_mod('sidebar_size');
            $hs = get_theme_mod('header_size');
            $fs = get_theme_mod('footer_size');
            $social = get_theme_mod('hide_social');
            $search = get_theme_mod('hide_search');
            self::generate_css('.header-color .site-title, .header-color', 'color', 'header_color', '');
            self::generate_css('.footer-color', 'color', 'footer_color', '');
            self::generate_css('#header,.sections .post-content,article.post,article.page,#footer,#content.bloop,#comments', 'max-width', 'site_width', '');
            self::generate_css('body', 'font-family', 'body_font');
            self::generate_css('.header-font', 'font-family', 'header_font');
            self::generate_css('.site-header.header-background:after', 'background-color', 'header_background');
            self::generate_css('.footer-background', 'background-color', 'footer_background');
            self::generate_css('#header .site-description, .page-header h1, .site-background, input[type="submit"], button, .button, .more-link', 'background', 'site_color');
            self::generate_css('a, .site-color-text, #wrapper a, input[type="submit"], button, .button', 'color', 'site_color');
            self::generate_css('nav#nav .menu > li:hover > a, nav#nav .menu > li > a:hover', 'border-color', 'site_color');
            self::generate_css('.bg-text', 'color', 'background_color', "#");

            self::generate_css('.site-header', 'background-image', 'header_bg', 'url(', ')');
            self::generate_css('.site-header', 'background-repeat', 'header_pos');
            self::generate_css('.site-header', 'background-position', 'header_align');
            if($hs == 1) echo '.site-header { background-size: contain; }' ;

            self::generate_css('.site-footer', 'background-image', 'footer_bg', 'url(', ')');
            self::generate_css('.site-footer', 'background-repeat', 'footer_pos');
            self::generate_css('.site-footer', 'background-position', 'footer_align');
            if($fs == 1) echo '.site-footer { background-size: contain; }' ;
            if($social == 1) echo '.footer-social { display: none; }' ;
            if($search == 1) echo '.header-search { display: none; } #header nav#nav {right:0}' ;

            if($sb == 0 ) : ?>
            #sidebar {
                width: 200px;
                flex: 0 0 200px;
                -webkit-flex: 0 0 200px;
            }
            <?php elseif($sb==2) : ?>
            #sidebar {
                width: 300px;
                flex: 0 0 300px;
                -webkit-flex: 0 0 300px;
            }
            <?php elseif($sb==3) : ?>
            #sidebar {
                width: 350px;
                flex: 0 0 350px;
                -webkit-flex: 0 0 350px;
            }
            <?php else : ?>
            #sidebar {
                width: 250px;
                flex: 0 0 250px;
                -webkit-flex: 0 0 250px;
            }
            <?php endif; ?>
        </style>
        <!--/Customizer CSS-->
    <?php
    }

    /**
     * This will generate a line of CSS for use in header output. If the setting
     * ($mod_name) has no defined value, the CSS will not be output.
     *
     * @uses get_theme_mod()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $mod_name The name of the 'theme_mod' option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since MyTheme 1.0
     */
    public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
        $return = '';
        $mod = get_theme_mod($mod_name);
        if ( ! empty( $mod ) ) {
            $return = sprintf('%s { %s:%s; }',
                $selector,
                $style,
                $prefix.$mod.$postfix
            );
            if ( $echo ) {
                echo $return;
            }
        }
        return $return;
    }

    public static function live_preview()
    {
        wp_enqueue_script( 'mp-customizer', get_bloginfo('template_url') . '/lib/js/theme-customizer.js', array( 'jquery', 'customize-preview' ));

    }

}

// Output custom CSS to live site
add_action( 'wp_head' , array( 'theme_customizer' , 'header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'theme_customizer' , 'live_preview' ) );

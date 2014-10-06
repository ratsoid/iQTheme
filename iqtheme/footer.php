<div class="clear"></div>
</div>
<!-- End Container -->
</div>
<footer class="site-footer footer-background footer-color">
    <div id="footer">
        <?php $footer_style = get_theme_mod('footer_style');
        $footer_text = get_theme_mod('footer_copy');
        if($footer_style == 1) $footer_style = 'footer-flex';
        elseif($footer_style == 2) $footer_style = 'footer-row'?>
        <ul id="footer-widgets" class="<?php echo $footer_style ?>">
            <?php dynamic_sidebar( 'footer-sidebar-1' ); ?>
            <?php dynamic_sidebar( 'footer-sidebar-2' ); ?>
            <?php dynamic_sidebar( 'footer-sidebar-3' ); ?>
            <?php dynamic_sidebar( 'footer-sidebar-4' ); ?>
        </ul>
        <div class="footer-social">
            <?php $social = array (
                'social_facebook' => 'facebook',
                'social_twitter' => 'twitter',
                'social_linkedin' => 'linkedin',
                'social_gplus' => 'gplus',
                'social_pinterest' => 'pinterest',
                'social_tumblr' => 'tumblr'
            );
            foreach ($social as $net => $name) :
                $link = get_theme_mod($net);
                if(empty($link)) $hide = ' hide';
                echo '<a class="'.$net.''.$hide.'" '.$hide.'href="'.$link.'"><i class="icon-'.$name.'"></i></a>';
                $hide = '';
            endforeach;
            ?>
        </div>
        <div class="copyright site-color-text"><br /><?php if($footer_text == '') : ?>&copy; <?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> <?php echo date('Y') ?> &ndash; All Rights Reserved<?php else : echo $footer_text; endif; ?></div>
    </div>
    <div class="clear"></div>
</footer>

<svg version="1.1" xmlns="http://www.w3.org/2000/svg">
    <filter id="blur">
        <feGaussianBlur stdDeviation="3"/>
    </filter>
</svg>
<svg version="1.1" xmlns="http://www.w3.org/2000/svg">
    <filter id="menushadow">
        <feGaussianBlur in="SourceAlpha" stdDeviation="2.2"/>
        <feOffset dx="3" dy="3" result="offsetblur"/>
        <feFlood flood-color="rgba(0,0,0,0.3)"/>
        <feComposite in2="offsetblur" operator="in"/>
        <feMerge>
            <feMergeNode/>
            <feMergeNode in="SourceGraphic"/>
        </feMerge>

    </filter>
</svg>
<svg version="1.1" xmlns="http://www.w3.org/2000/svg">
    <filter id="shadow">
        <feGaussianBlur in="SourceAlpha" stdDeviation="2.2"/>
        <feOffset dx="3" dy="3" result="offsetblur"/>
        <feFlood flood-color="rgba(0,0,0,0.3)"/>
        <feComposite in2="offsetblur" operator="in"/>
        <feMerge>
            <feMergeNode/>
            <feMergeNode in="SourceGraphic"/>
        </feMerge>

    </filter>
</svg>

<!-- End Wrapper -->
<?php wp_footer(); ?>
</body>
</html>
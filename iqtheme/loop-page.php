<?php global $post;
if ( have_posts() ) :
    while (have_posts()) : the_post();
        $hide_content = get_post_meta($post->ID, 'hide_title', true);
        $hide_sidebar = get_post_meta($post->ID, 'hide_sidebar', true);
//        $full_width = get_post_meta($post->ID, 'full_width', true);
        $scroll = get_post_meta($post->ID, 'scrollnote', true);
        $popup = get_post_meta($post->ID, 'popup', true);
        $scroll_src = wp_get_attachment_image_src( $scroll['image'], 'thumbnail' );
        if($hide_content!=='yes'):
//            if($full_width=='yes') $full=' fullwidth' ?>
        <article id="article-<?php the_ID(); ?>" class="iqpost iqpage">
            <div class="post-content">
                <h1 class="page-title"><?php the_title(); ?></h1>
                <?php the_content(); ?>
            </div>
        </article>
        <?php endif; ?>
        <?php if($scroll['check'] == 'yes') :
            if(empty($scroll['px'])) : $px = 300;  else : $px = $scroll['px']; endif; ?>
            <input type="hidden" class="scrollpx" value="<?php echo $px ?>" />
        <div id="scrollnote" style="display: none; background-color: <?php echo $scroll['bg'] ?>; color: <?php echo $scroll['color'] ?>">
            <span class="closescroll">x</span>
            <?php if($scroll_src) echo '<img src="'.$scroll_src[0].'" alt="'.get_bloginfo( 'name', 'display' ).'" />' ?>
            <?php echo wpautop($scroll['content']) ?>
            <div class="clear"></div>
        </div>
        <?php endif; ?>
        <?php if($popup['check'] == 'yes') :
            if(!empty($popup['w'])) $w = $popup['w'].'px;';
            if(!empty($popup['h'])) $h = $popup['h'].'px;';
            $sec = '10';
            if(!empty($popup['sec'])) $sec = $popup['sec']; ?>
            <script type="text/javascript">
                jQuery(document).ready(function() {
                    setTimeout(function(){
                        jQuery('.iq-popup-open').trigger('click');
                    }, <?php echo $sec ?>000);
                });
            </script>
        <a style="display: none" href="#fancyboxID-<?php the_ID() ?>" class="fancybox-inline iq-popup-open">iQ Popup</a>

        <div style="display:none" class="fancybox-hidden iq-popup"><div id="fancyboxID-<?php the_ID() ?>" class="hentry" style="<?php echo $w.''.$h ?>">
                <?php echo wpautop($popup['content']) ?>
            </div></div>
        <?php endif; ?>

<?php endwhile;
    wp_reset_query();
endif; ?>
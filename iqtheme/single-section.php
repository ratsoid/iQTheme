<?php get_header(); ?>
<div id="content">
<?php global $post;
while (have_posts()) : the_post(); ?>
    <article id="article-<?php the_ID(); ?>" class="sections">
        <?php
        $css='';$section_css='';$post_style='';$the_css='';
        $section_post = $post;
        $meta = get_post_meta($post->ID, 'section', true);
        $the_css = $meta[$post->ID];
//        print_r($the_css);


        if($the_css['column']) $section_css .= ' column';
        if(!empty($the_css['background_image'])) :
            $bg = wp_get_attachment_image_src( $the_css['background_image'], 'full' );
            $css.= 'background: url(\''.$bg[0].'\')'.' ';
            $css.= $the_css['bgpos_h'].' ';
            $css.= $the_css['bgpos_v'].' ';
            $css.= $the_css['bgpost_r'].' ';
            $css.= $the_css['background_color'].'; ';

            $css.= 'background-size: '.$the_css['bgpos_s'].';';

        elseif(!empty($the_css['background_color']) and empty($the_css['background_image'])) :
            $css.='background: '.$the_css['background_color'].';';
        endif;
        $css.=' color: '.$the_css['body_color'].';';
        $css.=' text-align: '.$the_css['body_align'].';';
        if(!empty($the_css['section_height'])) $css.=' height: '.$the_css['section_height'].''.$the_css['section_height_size'].';';
        if($the_css['fullsection'] == 'yes') $section_css.=' fullsize ';
        $style = 'style="'.$css.'"';
//        if(is_numeric($the_css['id'])) :
            if($the_css['parallax'] == 'yes') {
                $section_css .= ' parallax ';
                if($the_css['parallax_size'] == 'low') {
                    $parallax_size = 'data-velocity="-.1"';
                } elseif($the_css['parallax_size'] == 'medium') {
                    $parallax_size = 'data-velocity=".5"';
                } elseif($the_css['parallax_size'] == 'large') {
                    $parallax_size = 'data-velocity="1"';
                }
            } ?>

            <section <?php echo $parallax_size ?> id="section-<?php echo $section_post->ID ?>" <?php echo $style ?> class="<?php echo $section_css ?>">
                <div id="<?php echo basename(get_permalink($section_post->ID)); ?>" class="post-container">
                    <?php if( $the_css['middlealign'] == 'yes' ) echo '<div class="post-cell">';
                    if(!empty($the_css['section_width'])) $post_style = "max-width: ". $the_css['section_width']."".$the_css['section_width_size']."; display: inline-block;";?>

                    <div class="post-content" style="<?php echo $post_style ?>">
                        <h2 class="section-title">
                            <?php if($the_css['sectiontitle'] and $the_css['hidesectiontitle'] !== 'yes') : ?>
                                <?php echo $the_css['sectiontitle'] ?>
                            <?php elseif($the_css['hidesectiontitle'] !== 'yes') : ?>
                                <?php the_title(); ?>
                            <?php endif; ?>
                        </h2>
                        <?php the_content(); ?>
                    </div>
                    <?php if( $the_css['middlealign'] == 'yes' ) echo '</div>'; ?>
                    <small><?php edit_post_link('<i class="icon-edit"></i>  Edit Section', '', '', $section_post->ID) ?></small>
                </div>
            </section>

            <?php if($the_css['break'] == 'yes') : ?><div class="clear" style="flex: 1 1 100% "></div><?php endif; ?>
<!--        --><?php //endif; ?>
    </article>
<?php endwhile;
wp_reset_query(); ?>
</div>

<?php get_footer(); ?>
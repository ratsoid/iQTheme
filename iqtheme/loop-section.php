<?php global $post;
if ( have_posts() ) :
    $menu = get_post_meta($post->ID, 'showmenu', true);
//    $full_width = get_post_meta($post->ID, 'full_width', true);
//    if($full_width == 'yes') $full_width = 'full_width';
    $sections = get_post_meta($post->ID, 'section', true);
    $bg = get_post_meta($post->ID, 'section_menu_bg', true);
    if(empty($bg)) $bg='#ffffff';
    $color = get_post_meta($post->ID, 'section_menu_color', true);
    if(empty($color)) $color = '#000000';

    ?>
    <?php if($menu == 'yes') : ?>
    <div id="section_menu" class="header-color">
    <ul>
    <?php foreach ($sections as $section) :
            if($section['custom'] == 'yes') {
                $section_post = get_post($section['id']);
                $menu_title = $section['sectiontitle'];
            } else {
                $section_post = get_post($section['id']);
                $menu_title = get_post_meta($section['id'], 'section', true);
                $menu_title = $menu_title[$section['id']]['sectiontitle'];
            }

        if(!empty($menu_title)) : ?>

        <li><a href="#-<?php echo sanitize_title($menu_title) ?>">
                <?php echo $menu_title; ?>
            </a></li>
        <?php endif; ?>

    <?php endforeach; ?>
    </ul>
    </div>
    <?php endif; ?>


    <?php while (have_posts()) : the_post(); ?>
        <article id="article-<?php the_ID(); ?>" class="sections <?php echo $full_width ?>">
            <?php ksort($sections);
            foreach ($sections as $section) :
                $css='';$section_css='';$post_style='';$the_css='';
                $section_post = get_post($section['id']);

                if($section['custom'] !== 'yes') {
                    $custom_section = get_post_meta($section['id'], 'section', true);
                    $the_css = $custom_section[$section_post->ID];

                } else {
                    $the_css = $section;
                }

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
                if($the_css['content_padding_size'] == 'def' or $the_css['content_padding'] == '') :
                    $css.=' padding: 2em;';
                else :
                    $css.=' padding: '.$the_css['content_padding'].''.$the_css['content_padding_size'].';';
                endif;
                if(!empty($the_css['section_width'])) $css.=' flex: 0 1 '.$the_css['section_width'].'px;';
                if($the_css['fullsection'] == 'yes') $section_css.=' fullsize ';
                $style = 'style="'.$css.'"';
                    if(is_numeric($the_css['id'])) :
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
                    <?php if(!empty($the_css['sectiontitle']) and $menu == 'yes' ) :
                        $section_id = sanitize_title($the_css['sectiontitle']);
                        else :
                            $section_id = basename(get_permalink($section_post->ID));
                        endif; ?>
                    <div id="-<?php echo $section_id ?>" class="post-container">
                        <?php if( $the_css['middlealign'] == 'yes' ) echo '<div class="post-cell">';
                        if(!empty($the_css['content_width'])) $post_style = "max-width: ". $the_css['content_width']."".$the_css['content_width_size']."; display: inline-block;";?>

                        <div class="post-content" style="<?php echo $post_style ?>">

                            <?php if($the_css['sectiontitle'] and $the_css['hidesectiontitle'] !== 'yes') : ?>
                                <h2 class="section-title"><?php echo $the_css['sectiontitle'] ?></h2>
                            <?php elseif($the_css['hidesectiontitle'] !== 'yes') : ?>
                                <h2 class="section-title"><?php echo $section_post->post_title ?></h2>
                            <?php endif; ?>

                            <?php echo wpautop(do_shortcode($section_post->post_content)); ?>
                            </div>
                        <?php if( $the_css['middlealign'] == 'yes' ) echo '</div>'; ?>
                        <small><?php edit_post_link('<i class="icon-edit"></i>  Edit Section', '', '', $section_post->ID) ?></small>
                    </div>
                </section>

                <?php if($the_css['break'] == 'yes') : ?><div class="clear" style="flex: 1 1 100% "></div><?php endif; ?>
            <?php endif; endforeach; ?>
        </article>
    <?php endwhile;
    wp_reset_query();
else : ?>
    404 :(
<?php endif; ?>
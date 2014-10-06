<?php

class Section
{
    /**
     * Register "Section" as a custom post type
     * @return void
     */

    public function section_register()
    {
        $labels = array(
            'name' => _x('Sections', 'post type general name'),
            'singular_name' => _x('Section', 'post type singular name'),
            'add_new' => _x('Add New', 'section item'),
            'add_new_item' => __('Add New Section'),
            'edit_item' => __('Edit Section'),
            'new_item' => __('New Section'),
            'view_item' => __('View Section'),
            'search_items' => __('Search Sections'),
            'not_found' =>  __('Nothing found'),
            'not_found_in_trash' => __('Nothing found in Trash'),
            'parent_item_colon' => '',
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'query_var' => true,
            'menu_icon' => 'dashicons-welcome-add-page',
            'rewrite' => array( 'slug' => 'section' ),
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_position' => 82,
            'supports' => array('title','editor','thumbnail','author','comments','revisions'),
            'taxonomies' => array('sections_category', 'post_tag'),
            'has_archive' => true,
            'yarpp_support' => true
        );

        register_post_type( 'section' , $args );
    }

    /**
     * Create a new taxonomy for the post type "Section"
     * @return void
     */

    public function register_section_taxonomy()
    {
        $labels = array(
            'name'              => _x( 'Section Categories', 'taxonomy general name' ),
            'singular_name'     => _x( 'Section Category', 'taxonomy singular name' ),
            'search_items'      => __( 'Search Section Categories' ),
            'all_items'         => __( 'All Section Categories' ),
            'parent_item'       => __( 'Parent Category' ),
            'parent_item_colon' => __( 'Parent Category:' ),
            'edit_item'         => __( 'Edit Category' ),
            'update_item'       => __( 'Update Category' ),
            'add_new_item'      => __( 'Add New Category' ),
            'new_item_name'     => __( 'New Category Name' ),
            'menu_name'         => __( 'Section Categories' ),
        );

        register_taxonomy( 'sections_category', array( 'section' ), array(
            'hierarchical' => true,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'i' ),
            'labels' => $labels
        ));
    }

    /**
     * Extend the columns when listing Section in the backend
     * @return array
     */

    public function section_edit_columns()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'thumbnail' => 'Icon',
            'title' => 'Section Title',
            'author' => 'Autor',
            'date' => 'Date'
        );
        return $columns;
    }

    /**
     * Fill the custom columns for Section
     * @param $column
     */

    public function section_custom_columns( $column )
    {
        global $post;
        switch ( $column ):
            case 'thumbnail':
                echo get_the_post_thumbnail( $post->ID, 'small_thumb' );
                break;
        endswitch;
    }

    public function add_section_category_automatically($post_ID) {
        global $wpdb;
        if(!has_term('','section_category',$post_ID)){
            $category = get_term_by( 'slug', 'modern', 'section_category' );
            $cat = array($category->slug);
            wp_set_object_terms($post_ID, $cat, 'section_category');
        }
    }

    /**
     * Add custom metaboxes
     * @return void
     */

    public function add_meta_boxes()
    {
        $types = array ('section');
        foreach($types as $type) :
            add_meta_box( 'post_options', 'iQ Options', array( $this, 'post_options' ), $type, 'normal', 'high' );
        endforeach;
    }

    /**
     * "Post Options" content
     * @param $post
     * @return void
     */

    public function post_options( $post )
    {
        wp_nonce_field( 'section_nonce', 'section_metabox_nonce' );
        $section = $post->ID;
        $meta = get_post_meta($post->ID, 'section', true);
        $id = $meta[$section];
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
            <div id="sections"><div class="section_container">
            <input type="hidden" name="section[<?php echo $section ?>][id]" value="<?php echo $post->ID ?>" />
            <div class="membership_column">
                <div class="membership_option">
                    <label class="membership_label" for="sectiontitle[<?php echo $section ?>">Optional Title:</label>
                    <input size="20" maxlength="20" type="text" id="sectiontitle[<?php echo $section ?>" value="<?php echo $id['sectiontitle'] ?>" name="section[<?php echo $section ?>][sectiontitle]"  /><br />
                    <span class="description">Replaces the section title and it also creates the Section Menu item for the section.<br />
                </div>
                <div class="membership_option">
                    <label class="membership_label" for="section_background_color_<?php echo $section ?>">Background Color <i class="icon-color" style="color: <?php echo $id['background_color'] ?>; text-shadow: 0 0 2px rgba(0,0,0,.4)"></i></label>
                    <input id="section_background_color_<?php echo $section ?>" type="text" value="<?php echo $id['background_color'] ?>" name="section[<?php echo $section ?>][background_color]" data-preview="background-color" class="section_preview section_preview membership_color colorPreview ">
                </div>
                <div class="membership_option">
                    <label class="membership_label" for="section_body_color_<?php echo $section ?>">Font Color <i class="icon-color" style="color: <?php echo $id['body_color'] ?>; text-shadow: 0 0 2px rgba(0,0,0,.4)"></i></label>
                    <input id="section_body_color_<?php echo $section ?>" type="text" value="<?php echo $id['body_color'] ?>" name="section[<?php echo $section ?>][body_color]" data-preview="color" class="section_preview section_preview membership_color colorPreview ">
                </div>
                <div class="membership_option">
                    <label class="membership_label" for="section_body_align<?php echo $section ?>">Content Align</label>
                    <select data-preview="text-align" class="section_preview" name="section[<?php echo $section ?>][body_align]" id="section_body_align[<?php echo $section ?>]">
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
                    <input style="padding-right: 5px;" type="checkbox" name="section[<?php echo $section ?>][middlealign]" id="middlealign[<?php echo $section ?>]" data-preview="display" data-value="table" data-value-none="inline-block" class="section_preview " value="yes"<?php echo $middlealign_checked; ?> />
                    <label for="middlealign[<?php echo $section ?>]">Yes</label>
                </div>

                <div class="membership_option">
                    <label class="membership_label" for="column[<?php echo $section ?>]"><i class="icon-column"></i> Column</label>
                    <input style="padding-right: 5px;" type="checkbox" name="section[<?php echo $section ?>][column]" id="column[<?php echo $section ?>]"  value="yes"<?php echo $column_checked ; ?> />
                    <label for="column[<?php echo $section ?>]">Yes</label>
                </div>


                <div class="membership_option">
                    <label class="membership_label" for="break[<?php echo $section ?>]"><i class="icon-break"></i> Last Column</label>
                    <input style="padding-right: 5px;" type="checkbox" name="section[<?php echo $section ?>][break]" id="break[<?php echo $section ?>]"  value="yes"<?php echo $break_checked ; ?> />
                    <label for="break[<?php echo $section ?>]">Yes</label>
                </div>

                <div class="membership_option">
                    <label class="membership_label" for="hidesectiontitle[<?php echo $section ?>]"><i class="icon-title"></i> Hide Title (hides Optional Title)</label>
                    <input style="padding-right: 5px;" type="checkbox" name="section[<?php echo $section ?>][hidesectiontitle]" id="hidesectiontitle[<?php echo $section ?>]"  value="yes"<?php echo $hidesectiontitle_checked ; ?> />
                    <label for="hidesectiontitle[<?php echo $section ?>]">Yes</label>
                </div>
                <div class="membership_option">
                    <label class="membership_label" for="content[<?php echo $section ?>">Content Width:</label>
                    <input style="width: 70px;" type="number" size="3" max="2000" id="content_width[<?php echo $section ?>" value="<?php echo $id['content_width'] ?>" name="section[<?php echo $section ?>][content_width]"  />
                    <select name="section[<?php echo $section ?>][content_width_size]" id="content_width_size<?php echo $i ?>">
                        <?php
                        $i = 0;
                        $position = array (
                            'auto' => 'Auto',
                            'px' => 'px',
                            '%' => '%'
                        );
                        foreach( $position as $checkbox => $label) :
                            $check = '';
                            if( $id['content_width_size'] == $checkbox) $check = ' selected="selected"'; ?>
                            <option<?php echo $check ?> value="<?php echo $checkbox ?>"><?php echo $label ?></option>
                            <?php $i++; endforeach; ?>
                    </select>
                </div>

                <div class="membership_option">
                    <label class="membership_label" for="content_padding[<?php echo $section ?>">Content Padding:</label>
                    <input style="width: 70px;" type="number" size="3" max="2000" id="content_padding[<?php echo $section ?>" value="<?php echo $id['content_padding'] ?>" name="section[<?php echo $section ?>][content_padding]"  />
                    <select name="section[<?php echo $section ?>][content_padding_size]" id="content_padding_size<?php echo $i ?>">
                        <?php
                        $i = 0;
                        $position = array (
                            'def' => 'Default',
                            'px' => 'px',
                            'em' => 'em'
                        );
                        foreach( $position as $checkbox => $label) :
                            $check = '';
                            if( $id['content_padding_size'] == $checkbox) $check = ' selected="selected"'; ?>
                            <option<?php echo $check ?> value="<?php echo $checkbox ?>"><?php echo $label ?></option>
                            <?php $i++; endforeach; ?>
                    </select>
                </div>

                <div class="membership_option">
                    <label class="membership_label" for="section_width[<?php echo $section ?>">Section Width:</label>
                    <input style="width: 70px;" type="number" size="3" max="2000" id="section_width[<?php echo $section ?>" value="<?php echo $id['section_width'] ?>" name="section[<?php echo $section ?>][section_width]"  />
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
                    <label class="membership_label" for="section_height[<?php echo $section ?>">Section Height <strong>(in px)</strong>:</label>
                    <input style="width: 70px;" type="number" size="3" max="2000" id="section_height[<?php echo $section ?>" value="<?php echo $id['section_height'] ?>" name="section[<?php echo $section ?>][section_height]"  />
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
                    <input style="padding-right: 5px;" type="checkbox" name="section[<?php echo $section ?>][fullsection]" id="fullsection[<?php echo $section ?>]"  value="yes"<?php echo $fullsection_checked ; ?> />
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
                    <label class="membership_label" for="bgpos_h[<?php echo $section ?>]">Horizontal Position</label>
                    <select data-preview="background-position" class="section_preview bgpos" data-bg-y="" id="bgpos_h[<?php echo $section ?>]" name="section[<?php echo $section ?>][bgpos_h]">

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
                    <select data-preview="background-position" class="section_preview bgpos" data-bg-x="" name="section[<?php echo $section ?>][bgpos_v]" id="bgpos_v_<?php echo $i ?>">
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
                            if( $id['bgpos'] == $checkbox) $check = ' checked="checked"'; ?>
                            <input type="radio" <?php echo $check ?> value="<?php echo $checkbox ?>" data-preview="background-position" class="section_preview bgpos replace_id" data-bg-pos="top left" id="bgpos[<?php echo $section ?>]" name="section[<?php echo $section ?>][bgpos]" />
                            <?php
                            if($i % 3 == 0) echo '<br />';
                            $i++; endforeach; ?>
                    </div>
                </div>

                <div class="membership_option">
                    <label for="bgpos_r_<?php echo $i ?>" class="membership_label">Repeat Background</label>
                    <select data-preview="background-repeat" class="section_preview" name="section[<?php echo $section ?>][bgpost_r]" id="bgpos_r_<?php echo $i ?>">
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
                    <select data-preview="background-size" class="section_preview" name="section[<?php echo $section ?>][bgpos_s]" id="bgpos_s_<?php echo $i ?>">
                        <?php
                        $i = 0;
                        $position = array (
                            'none' => 'Auto',
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
                    <input style="padding-right: 5px;" type="checkbox" name="section[<?php echo $section ?>][parallax]" id="parallax[<?php echo $section ?>]"  value="yes"<?php echo $parallax_checked; ?> />
                    <label for="hidesectiontitle[<?php echo $section ?>]">Yes</label>
                </div>

                <div class="membership_option">
                    <label for="parallax_size_<?php echo $i ?>" class="membership_label">Parallax Amount</label>
                    <select name="section[<?php echo $section ?>][parallax_size]" id="parallax_size_<?php echo $i ?>">
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
                $bg_style.="background-position: ".$id['bgpos']."; ";
                $bg_style.="background-repeat: ".$id['bgpost_r']."; ";
                $bg_style.="background-size: ".$id['bgpos_s']."; ";
                $bg_style.="background-color: ".$id['background_color']."; ";
                $bg_style.="color: ".$id['body_color']."; ";
                $bg_style.="text-align: ".$id['body_align']."; ";
                $p_style.="width: ".$id['section_width']."".$id['section_width_size']."; ";
                ?>
                <div class="image_preview" style="<?php echo $bg_style ?>">
                    <input type="hidden" class="membership_tb" name="section[<?php echo $section ?>][background_image]" value="<?php echo $bg ?>">
                    <p style="<?php echo $p_style ?>">Lorem ipsum dolor sit amet, nulla senectus vel, congue ultricies justo mauris tellus, posuere enim sed, pharetra dui justo in tortor sollicitudin, integer et. Urna a in nunc risus litora tristique, sit donec mattis. Enim ante, etiam suspendisse wisi pellentesque et earum. Libero risus parturient consequat et porta amet, quisque commodo eos dis neque nibh. </p>
                </div>
            </div>
        </div></div>
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
        );

        foreach ($meta_fields as $key ) :
            update_post_meta($post_id, $key, $_POST[$key]);
        endforeach;
    }



}

$Section = new Section;


add_action('publish_section', array( $Section, 'add_section_category_automatically'));

// Register Section
add_action( 'init', array( $Section, 'section_register' ));
add_action( 'init', array( $Section, 'register_section_taxonomy' ));

// Custom Colums
//add_action( 'manage_section_posts_custom_column',  array( $Section, 'section_custom_columns' ));
//add_filter( 'manage_edit-section_columns', array( $Section, 'section_edit_columns' ));

// Custom Metaboxes
add_action( 'admin_init', array( $Section, 'add_meta_boxes' ));
add_action( 'save_post', array( $Section, 'save_options_data' ));
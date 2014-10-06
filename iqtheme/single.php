<?php get_header();
    global $post;
    $nosidebar = get_post_meta($post->ID,'has_sidebar', true); ?>
    <div id="content" class="bloop">
        <?php get_template_part('loop', 'blog'); ?>
        <?php if(is_single() and !$nosidebar == 'yes' ) get_template_part('sidebar', 'blog'); ?>
    </div>
<?php
if ( comments_open() || get_comments_number() ) {
    comments_template();
} ?>
<?php get_footer(); ?>
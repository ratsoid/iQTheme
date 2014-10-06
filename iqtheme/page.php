<?php get_header();
global $post;
$hide_sidebar = get_post_meta($post->ID, 'hide_sidebar', true); ?>
    <div id="content" class="bloop">
        <?php get_template_part('loop', 'page'); ?>
        <?php if($hide_sidebar!='yes'): ?>
            <div id="sidebar">
                <ul class="sidebar">
                    <?php dynamic_sidebar( 'blog-sidebar' ); ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
    <?php get_template_part('loop', 'section'); ?>
<?php
if ( comments_open() || get_comments_number() ) {
    comments_template();
} ?>

<?php get_footer(); ?>
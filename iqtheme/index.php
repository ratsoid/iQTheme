<?php get_header();
      $id = get_option( 'page_for_posts' );
      $hide_sidebar = get_post_meta($id, 'hide_sidebar', true); ?>
    <div id="content" class="bloop">
        <?php get_template_part('loop', 'blog'); ?>
        <?php if($hide_sidebar!='yes') get_template_part('sidebar', 'blog'); ?>
    </div>
<?php get_footer(); ?>
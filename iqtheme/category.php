<?php get_header(); ?>
    <div id="content" class="bloop">
        <header class="page-header">
            <h1 class="header-title">
                <?php printf( __( '<i class="icon-tag"></i> Category Archives: <span>%s</span>', 'twentyfourteen' ), single_cat_title( '', false ) ); ?>
            </h1>
        </header>
        <?php get_template_part('loop', 'blog'); ?>
        <?php get_template_part('sidebar', 'blog'); ?>
    </div>
<?php get_footer(); ?>
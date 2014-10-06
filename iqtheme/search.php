<?php get_header(); ?>
    <div id="content" class="bloop">
        <header class="page-header">
            <h1 class="header-title">
                <?php printf( __( '<i class="icon-search"></i> Search Results for: <span>%s</span>', 'twentyfourteen' ), get_search_query() ); ?>
            </h1>
        </header>
        <?php get_template_part('loop', 'blog'); ?>
        <?php get_template_part('sidebar', 'blog'); ?>
    </div>
<?php get_footer(); ?>
<?php get_header(); ?>
    <div id="content" class="bloop">
        <header class="page-header">
            <h1 class="header-title">
                <?php
                /*
                 * Queue the first post, that way we know what author
                 * we're dealing with (if that is the case).
                 *
                 * We reset this later so we can run the loop properly
                 * with a call to rewind_posts().
                 */
                the_post();

                printf( __( 'All posts by <span>%s</span>', 'twentyfourteen' ), get_the_author() );
                ?>
            </h1>
        </header>
        <?php get_template_part('loop', 'blog'); ?>
        <?php get_template_part('sidebar', 'blog'); ?>
    </div>
<?php get_footer(); ?>
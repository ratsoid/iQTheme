<?php get_header(); ?>
    <div id="content" class="bloop">
        <header class="page-header">
            <h1 class="header-title">
                <?php
                if ( is_day() ) :
                    printf( __( '<i class="icon-archive"></i> Daily Archives: <span>%s</span>', 'twentyfourteen' ), get_the_date() );

                elseif ( is_month() ) :
                    printf( __( '<i class="icon-archive"></i> Monthly Archives: <span>%s</span>', 'twentyfourteen' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'twentyfourteen' ) ) );

                elseif ( is_year() ) :
                    printf( __( '<i class="icon-archive"></i> Yearly Archives: <span>%s</span>', 'twentyfourteen' ), get_the_date( _x( 'Y', 'yearly archives date format', 'twentyfourteen' ) ) );

                else :
                    _e( '<i class="icon-archive"></i>  Archives', 'twentyfourteen' );

                endif;
                ?>
            </h1>
        </header>
        <?php get_template_part('loop', 'blog'); ?>
        <?php get_template_part('sidebar', 'blog'); ?>
    </div>
<?php get_footer(); ?>
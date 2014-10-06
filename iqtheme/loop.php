<?php global $post;
if ( have_posts() ) :
    $nosidebar = get_post_meta($post->ID,'has_sidebar', true);
    $nometa = get_post_meta($post->ID,'has_postmeta', true);
    if($nosidebar == 'yes') $nosidebarx = " nosidebar"; ?>
    <section class="post-container<?php echo $nosidebarx ?>">
    <?php while (have_posts()) : the_post(); ?>
        <article id="article-<?php the_ID(); ?>" <?php post_class('iqpost'); ?>>
            <?php edit_post_link('<i class="icon-edit"></i> Edit Post', '', '', $section_post->ID) ?>
            <div class="post-meta">
                    <?php if(is_singular()) : ?>
                    <h1 class="post-title">
                        <?php the_title(); ?>
                    </h1>
                    <?php else : ?>
                        <h2 class="post-title">
                            <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                        </h2>
                    <?php endif; ?>
                <?php if($nometa !== 'yes') : ?>
                <span class="author vcard" itemprop="nickname">
                    by <?php the_author_posts_link(); ?> &ndash;
                </span>
                <span class="post-date">
                    <i class="icon-calendar"></i>
                    <a href="<?php echo site_url(); ?>/<?php the_time('Y/m'); ?>">
                    <?php the_time('l, F d'); ?>
                    </a>
                </span>
                <span class="post-category"><i class="icon-tag"></i> <?php echo get_the_category_list(',', 'multiple', $post->ID); ?></span>
                <span class="add-comment">
                    <i class="icon-reply"></i>
                    <a href="<?php the_permalink() ?>#respond">
                    <?php comments_number( 'No Replies', 'One Reply', '% Replies' ); ?></a>
                </span>
                <?php endif; ?>
            </div>
            <div class="post-content">
                <?php if(is_search() or is_archive()) : ?>
                    <?php the_excerpt(); ?>
                    <p><br /><a class="more-link" href="<?php the_permalink() ?>">Continue Reading <i class="icon-more"></i></a></p>
                <?php else :
                    the_content('Continue Reading <i class="icon-more"></i>'); endif; ?>
            </div>
        </article>
    <?php endwhile;
    wp_reset_query(); ?>
    </section>
<?php endif; ?>
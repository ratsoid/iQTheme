<?php if ( comments_open() ) : ?>
    <div id="comments">
        <div class="comments">
            <h3 class="comments-number site-background"><i class="icon-comment"></i> <?php comments_number( 'No comments', 'One comment', '% comments' ); ?></h3>

            <?php
            if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
                die ('Please do not load this page directly. Thanks!');

            if ( post_password_required() ) { ?>
                This post is password protected. Enter the password to view comments.
                <?php
                return;
            }
            ?>
            <?php if ( have_comments() ) : ?>
                <div class="clear"></div>
                <!--<div class="navigation">
                    <div class="next-posts"><?php // previous_comments_link() ?></div>
                    <div class="prev-posts"><?php // next_comments_link() ?></div>
                </div>-->

                <ol class="commentlist">
                    <?php $Setup = new Setup();
                    if(is_page()) :
                        wp_list_comments( array( 'reverse_top_level' => 'DESC', 'callback' => array( $Setup, 'comment_layout' )) );
                    else :
                        wp_list_comments( array( 'callback' => array( $Setup, 'comment_layout' )) );
                    endif; ?>
                </ol>

                <!--<div class="navigation">
                    <div class="next-posts"><?php // previous_comments_link() ?></div>
                    <div class="prev-posts"><?php // next_comments_link() ?></div>
                </div>-->

            <?php else : // this is displayed if there are no comments so far ?>
                <?php if ( !comments_open() ) : ?>
                    <div class="clear"></div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if ( comments_open() ) : ?>
                <div class="clear"></div>
                <div id="respond">
                    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
                        <div class="add-comment">

                            <?php if ( is_user_logged_in() ) : ?>

                                <p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>

                            <?php else : ?>

                                <div class="comment-fields">
                                    <input placeholder="Nume" type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
                                    <input placeholder="Email" type="email" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
                                    <input placeholder="http:// (optional)" type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" class="last" tabindex="3" />
                                </div>

                            <?php endif; ?>

                            <textarea placeholder="Your comment..." name="comment" id="comment" rows="3" tabindex="4"></textarea>
                        </div>

                        <div>
                            <button name="submit" type="submit" id="submit" class="button" tabindex="5"><i class="icon-reply"></i> Add Reply</button>
                            <?php cancel_comment_reply_link('Cancel reply'); ?>
                            <div class="clear"></div>
                            <?php // show_subscription_checkbox(); ?>
                            <?php comment_id_fields(); ?>
                        </div>

                        <?php do_action('comment_form', $post->ID); ?>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
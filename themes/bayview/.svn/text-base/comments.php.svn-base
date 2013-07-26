<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to bayview_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required())
    return;
?>

<div id="comments" class="comments-area">

    <?php // You can start editing here -- including this comment!  ?>

    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            printf(_n('One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'bayview'), number_format_i18n(get_comments_number()), '<span>' . get_the_title() . '</span>');
            ?>
        </h2>

        <ol class="commentlist">
            <?php wp_list_comments(array('callback' => 'bayview_comment', 'style' => 'ol')); ?>
        </ol><!-- .commentlist -->

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through  ?>
            <nav id="comment-nav-below" class="navigation" role="navigation">
                <h1 class="assistive-text section-heading"><?php _e('Comment navigation', 'bayview'); ?></h1>
                <div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'bayview')); ?></div>
                <div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'bayview')); ?></div>
            </nav>
        <?php endif; // check for comment navigation  ?>

        <?php
        /* If there are no comments and comments are closed, let's leave a note.
         * But we only want the note on posts and pages that had comments in the first place.
         */
        if (!comments_open() && get_comments_number()) :
            ?>
            <p class="nocomments"><?php _e('Comments are closed.', 'bayview'); ?></p>
        <?php endif; ?>

    <?php endif; // have_comments()  ?>
    <style>
        #commentform label{
            width: 200px;
            float:left;
        }
        #commentform input[type=text]{
            border: 1px solid #dbd8d3;
            width: 300px;
        }
        #commentform textarea{
            border: 1px solid #dbd8d3;
            width: 300px;
        }
        #commentform label.error{
            font-size: 12px;
            margin-left: 200px;
            background: #fbfcda;
            border:1px solid #dbdbd3;
            width:305px;
            margin-top:0px;
             margin-bottom: 5px;
            padding: 4px 2px;
        }
        #commentform p{
            margin-top:5px; 
            clear: both;
        }
        #commentform .required{
            color: #343434;
        }
    </style>
    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

        <?php if ($user_ID) : ?>

            <p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Log out »</a></p>

        <?php else : ?>

            <p><label for="author">Name <small><?php if ($req) echo "(required)"; ?></small></label>
                <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" class="required" size="22" tabindex="1" />
                </p>

            <p><label for="email">E-Mail <small><?php if ($req) echo "(required)"; ?></small></label>
                <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" class="required email" size="22" tabindex="2" />
                </p>

            <p><label for="url">Website<small></small></label><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" class="url" />
                </p>

        <?php endif; ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

        <p><label for="comment">comment<small> <?php if ($req) echo "(required)"; ?></small></label><textarea name="comment" id="comment" cols="100%" class="required" rows="10" tabindex="4" minlength="10" maxlength="100"></textarea></p>
        <p style="text-align:center;" ><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />

            <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
        </p>
        <?php do_action('comment_form', $post->ID); ?>

    </form>

    <script type="text/javascript">
        $().ready(function() {
            // validate the comment form when it is submitted
            $("#commentform").validate();
        });
    </script>

    <?php //comment_form(); ?>

</div><!-- #comments .comments-area -->
<?php
	/**********************************************************************
	***********************************************************************
	REVIEWS COMMENTS
	**********************************************************************/
_deprecated_file(
/* translators: %s: template name */
    sprintf( __( 'Theme without %s' ), basename( __FILE__ ) ),
    '3.0',
    null,
    /* translators: %s: template name */
    sprintf( __( 'Please include a %s template in your theme.' ), basename( __FILE__ ) )
);

// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>
    <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.'); ?></p>
    <?php
    return;
}
?>


    ?>
<?php if ( comments_open() ) :?>
	<?php if( have_comments() ): ?>
        <!-- You can start editing here. -->
            <h3 id="comments">
                <?php
                if ( 1 == get_comments_number() ) {
                    /* translators: %s: post title */
                    printf( __( 'One response to %s' ), '&#8220;' . get_the_title() . '&#8221;' );
                } else {
                    /* translators: 1: number of comments, 2: post title */
                    printf( _n( '%1$s response to %2$s', '%1$s responses to %2$s', get_comments_number() ),
                        number_format_i18n( get_comments_number() ), '&#8220;' . get_the_title() . '&#8221;' );
                }
                ?>
            </h3>
            <ol class="commentlist">
                <?php wp_list_comments();?>
            </ol>
        <!-- comments -->
        <div class="comment-content comments">
            <?php if( have_comments() ):?>
                <?php wp_list_comments( array(
                    'type' => 'comment',
                    'callback' => 'reviews_comments',
                    'reverse_top_level' => true,
                    'end-callback' => 'reviews_end_comments',
                    'style' => 'div'
                )); ?>
            <?php endif; ?>
        </div>
        <!-- .comments -->

        <!-- comments pagination -->
    <div class="text-center">
        <?php $cpage = get_comment_pages_count() ? get_comment_pages_count() : 1;

        if( $cpage > 1 ) {
            echo '<div class="reviews_comment_loadmore button green">More comments</div>
	<script>
	var ajaxurl = \'' . site_url('wp-admin/admin-ajax.php') . '\',
	    parent_post_id = ' . get_the_ID() . ',
    	    cpage = ' . $cpage . '
	</script>';
        } ?>
    </div>
        <!-- .comments pagination -->

		<!-- old comments pagination -->
		<!--?php $comment_links = paginate_comments_links(
				array(
					'echo' => true,
					'prev_next' => true,
					'separator' => ' ',
				)
			);
		?-->
		<!--?php if( !empty( $comment_links ) ): ?-->
<!--			<div class="comments-pagination-wrap">-->
<!--				<div class="pagination">-->
					<!--?php echo $comment_links; ?-->
<!--				</div>-->
<!--			</div>-->
		<!--?php endif; ?-->
		<!--old  .comments pagination -->
    <?php else : // this is displayed if there are no comments so far ?>

        <?php if ( comments_open() ) : ?>
            <!-- If comments are open, but there are no comments. -->

        <?php else : // comments are closed ?>
            <!-- If comments are closed. -->
            <p class="nocomments"><?php _e('Comments are closed.'); ?></p>

        <?php endif; ?>

    <?php endif; ?>
    <?php comment_form(); ?>

<?php endif; ?>
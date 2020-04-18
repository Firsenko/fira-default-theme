<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>
<article <?php post_class('flex-column-between animated fadeInUp'); ?> id="post-<?php the_ID(); ?>">
    <div class="post-description">
        <a href="<?php the_permalink();?>" rel="nofollow" ><?php the_post_thumbnail('thumbnail-blog' , array( 'class' => 'img-fluid','alt' => get_the_title($post->ID)));?></a>
        <a href="<?php the_permalink();?>" rel="nofollow" ><h2 class="blog-box_subtitle"><?php the_title();?></h2>  <span class="entry-meta"><?php fira_edit_link();?></span></a>
        <p><?php echo wp_trim_words( strip_shortcodes(get_the_excerpt()), 20, '...' );?></p>
    </div>
    <span class="date"><?php the_time('F j, Y'); ?></span>
<!--    <?= fira_get_post_views(get_the_ID());?>-->
</article>
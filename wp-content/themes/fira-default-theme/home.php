<?php
/**
 * Template name: Blog
 */
get_header(); ?>

<div id='blog' class="container box">
    <div class="row box">
        <div class="col-12">
            <h1 class="text-center title_h1"><?=get_the_title( get_option('page_for_posts', true) );?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9 col-12">
            <?php if ( have_posts() ) :?>
                <div class="blog-box">
                    <?php while ( have_posts() ) : the_post();?>
                        <article <?php post_class('box-shadow'); ?>>
                            <a href="<?php the_permalink();?>" rel="nofollow" >
                                <?php if( has_post_thumbnail() ): ?>
                                    <?php the_post_thumbnail('post-thumbnail' , array( 'class' => 'img-fluid'));?>
                                <?php endif;?>
                            </a>
                            <h2 class="subtitle"><?php the_title();?></h2>  <span class="entry-meta"><?php fira_edit_link();?></span>
                            <p><?php echo wp_trim_words( strip_shortcodes(get_the_excerpt()), 20, '...' );?></p>
                            <div class="text-right">
                                <a href="<?php the_permalink();?>" rel="nofollow"  class="btn"><?php _e('Read more','fira');?></a>
                            </div>
                            <div class="clearfix"></div>
                        </article>
                    <?php endwhile;?>
                </div>
            <?php endif;?>
            <?php
            global $wp_query; // you can remove this line if everything works for you
            // don't display the button if there are not enough posts
            if (  $wp_query->max_num_pages > 1 )
                echo '<div class="text-center box"><div class="loadmore btn">'. __('Load more','fira').'</div></div>'; // you can use <a> as well
            ?>
        </div>
        <?php if ( is_active_sidebar( 'right-sidebar-blog' ) ) : ?>
            <aside class="col-md-3 col-12">
                <ul>
                    <?php dynamic_sidebar('right-sidebar-blog');?>
                </ul>
            </aside>
        <?php endif;?>
    </div>
</div>

</main>
<?php get_footer(); ?>

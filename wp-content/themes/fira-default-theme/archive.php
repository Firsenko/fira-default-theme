<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */
get_header(); ?>

<div id='archive' class="container box">
    <div class="row box">
        <div class="col-12">
            <h1 class="page-title"><?=get_the_archive_title();?> </h1>
            <?php the_archive_description( '<div class="taxonomy-description">', '</div>' );?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <?php if ( have_posts() ) :?>
                <div class="blog-box">
                    <?php while ( have_posts() ) : the_post();?>
                        <?php get_template_part( 'template-parts/post/content', 'post' );?>
                    <?php endwhile;?>
                </div>
            <?php endif;?>
            <?php
            global $wp_query; // you can remove this line if everything works for you
            // don't display the button if there are not enough posts
            if (  $wp_query->max_num_pages > 1 )
                echo '<div class="text-center box"><div class="loadmore button">'. __('Show more','fira').'</div></div>'; // you can use <a> as well
            ?>
        </div>
    </div>
</div>

</main>
<?php get_footer(); ?>

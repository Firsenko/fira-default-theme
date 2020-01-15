<?php
/**
* Template name: Blog
*/
get_header(); ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center title_h1"><?php _e('Blog','fira');?></h1>
        </div>
    </div>
</div>
<div id='blog' class="container box">
    <div class="row">
       <div class="col-md-9 col-12">
        <?php if ( have_posts() ) :?>
			<?php while ( have_posts() ) : the_post();?>
				<article>
					<?php the_post_thumbnail();?>
					 <a href="<?php the_permalink();?>"><p class="subtitle"><?php the_title();?></p></a>
                    <p><?php echo wp_trim_words( strip_shortcodes(get_the_content()), 20, '...' );?></p>
                    <a href="<?php the_permalink();?>" class="button blue"><?php _e('Read more','fira');?></a>
                    <div class="clearfix"></div>
				</article>
			<?php endwhile;?>
		<?php endif;?>
		<?php the_posts_pagination(); ?>
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

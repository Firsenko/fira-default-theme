<?php get_header(); ?>
<section id="single" class="box blog">
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center"><?php the_title();?></h1>
        </div>
    </div>
</div>
<article>
	<?php if ( have_posts() ) :?>
		<?php while ( have_posts() ) : the_post();?>
				<div class="container box">
					<div class="row">
						<article class="<?=( is_active_sidebar( 'right-sidebar'  ? 'col-md-9' : 'col-12'));?>">
							<div class="desc text-center">
							    <?php if ( has_post_thumbnail() ) : ?>
                                    <?php
                                    add_filter( 'wp_get_attachment_image_attributes', 'reviews_lazy_load_product_images');
                                    the_post_thumbnail( 'reviews-box-thumb', array( 'class' => 'embed-responsive-item', 'sizes' => '(min-width: 414px) and (max-width: 768px) 768px, 360px' ) );
                                    remove_filter( 'wp_get_attachment_image_attributes', 'reviews_lazy_load_product_images');
                                    $post_id = get_the_ID();
                                    ?>
							    <?php endif;?>
								<?php the_content();?>
							</div>
					
						</article>
                    	<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
                    	<aside class="col-md-3 col-12">
                    	    <ul>
                    	        <?php dynamic_sidebar('right-sidebar');?>
                    	    </ul>
                    	 </aside>
                        <?php endif;?>
					</div>
				</div>
		<?php endwhile;?>
	<?php endif;?>
</article>
</section>
<?php get_footer(); ?>

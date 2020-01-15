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
							    <?php the_post_thumbnail();?>
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

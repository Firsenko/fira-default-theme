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
                                    the_post_thumbnail( 'reviews-box-thumb', array( 'class' => 'img-fluid'));
                                    $post_id = get_the_ID();
                                    ?>
							    <?php endif;?>
								<?php the_content();?>
							</div>
                            <?php if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif; ?>
                            <?php if ( 'post' === get_post_type()):?>
                                <span class="entry-meta">
                          <?=get_avatar( get_the_author_email(), '60' ); ?><span><?php the_author( );?></span><?=(get_the_author_meta( 'user_description', $post->post_author )) ? ', <span>'.get_the_author_meta( 'user_description', $post->post_author ).'</span>'  : '';?>
                       </span>
                            <?php endif;?>
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

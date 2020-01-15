<?php
/*
* Template name: Thanks
*/
 get_header(); ?>

	<div id="thanks">
	<div  class="box container">
			<?php if ( have_posts() ) :?>
		<?php while ( have_posts() ) : the_post();?>
	    <div class="row">
	        <div class="col-12">
	            <h1 class="text-center title_h1"><span class="check"><?php the_title();?></span></h1>
	            <div class="desc-title text-center"><?php the_content();?></div>
	        </div>
	    </div>
	</div>
	<article>
	<div class="tail-left"></div>
		<div class="container box">
			  <h4 class="text-center"><?php the_field('title_advanced');?></h4>
			<div class="row box desc text-center">
				<?php while( have_rows('repeater_advanced') ): the_row();?>
					<div class="col-md-4 col-12">
						<div class="image">
						<img src="<?php the_sub_field('icon');?>" height="63" alt="<?php the_sub_field('subtitle');?>">
						</div>
						<p class="subtitle"><?php the_sub_field('subtitle');?></p>
						<div class="answer"><?php the_sub_field('subdesc');?></div>
					</div>
	    			<?php endwhile; ?>
				</div>
			</div>
		</div>
	<?php endwhile;?>
	<?php endif;?>
	<div class="tail-right"></div>
	</article>
	
	
	<?php get_footer(); ?>
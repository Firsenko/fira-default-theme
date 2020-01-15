<?php
/*
* Template name: Sorry
*/
 get_header(); ?>

	<div id="feedback" class="box ">
	<div  class="container">
			<?php if ( have_posts() ) :?>
		<?php while ( have_posts() ) : the_post();?>
	    <div class="row">
	        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	            <h1 class="text-center title_h1"><span class="check"><?php the_title();?></span></h1>
	            <div class="desc-title text-center"><?php the_content();?></div>
	        </div>
	    </div>
	</div>
	<article>
	<div class="tail-left"></div>
		<div class="container">
			<div class="row desc text-center">
			 <div class="feedback-wrap">
                 <?php echo do_shortcode( '[contact-form-7 id="'.get_field('contact_form_sorry').'"]');?>
                    </div>
				</div>
			</div>
		</div>
	<?php endwhile;?>
	<?php endif;?>
	<div class="tail-right"></div>
	</article>
	
	
	<?php get_footer(); ?>
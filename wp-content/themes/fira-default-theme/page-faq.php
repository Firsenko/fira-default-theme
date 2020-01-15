<?php
/**

 * Template name: FAQ
*/
?>

<?php get_header(); ?>
<?php if ( have_posts() ) :?>
	<?php while ( have_posts() ) : the_post();?>
<section id="faq" class="box">
	<div class="faq-box container">
	    <div class="row">
	    	<div class="col-12">
	        	<p class="text-center title_h1"><?php the_field('title_faq');?></p>
	        </div>
	    </div>
	</div>
	<article class="faq">
			<div class="faq-box container">
			<?php while( have_rows('repeater_faq') ): the_row();?>
			    <div class="row">
					<div class="col-md-12 col--12">
						<p class="subtitle"><?php the_sub_field('question');?></p>
						<div class="answer"><?php the_sub_field('answer');?></div>
					</div>
			    </div>
	    	<?php endwhile; ?>
	    </div>
    </article>
	
</section>
	<?php endwhile;?>
<?php endif;?>

<?php get_footer(); ?>

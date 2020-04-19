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
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="faq_box" itemscope="" itemtype="https://schema.org/FAQPage">
                        <?php $i=1; while( have_rows('repeater_faq') ): the_row();?>
                            <div id="question-<?=$i;?>" class="faq_question" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                                <div class="faq_question__title" itemprop="name">
                                    <h5><?php the_sub_field('question');?></h5>
                                </div>
                                <div class="faq_answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                                    <div class="faq_answer__text" itemprop="text">
                                        <?php the_sub_field('answer');?>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; endwhile; ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
	    </div>
    </article>
	
</section>
	<?php endwhile;?>
<?php endif;?>

<?php get_footer(); ?>

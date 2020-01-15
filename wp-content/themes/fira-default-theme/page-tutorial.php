<?php
/**
* Template name: Tutorial
*/
get_header(); ?>
<section id="tutorial" class="box">
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1 class="text-center title_h1"><?php the_field('title_tutorial');?></h1>
        </div>
    </div>
</div>
<?php if( have_rows('repeater3')):?>
	<article>
	<div class="tail-left"></div>
		<div class="container">
			<?php $i=1; while( have_rows('repeater3') ): the_row();?>
	        <div class="row <?php if($i%2 == 0) echo 'row-rev';?> box">
			
				<div class="<?php if($i%2 == 0) echo 'col-md-offset-1';?> col-md-5 col-sm-6 col-xs-12 desc">
					<p class="subtitle"><?php the_sub_field('subtitle');?></p>
					<p class="info"><?php the_sub_field('desc');?></p>
				</div>
				<div class="<?php if($i%2 !== 0) echo 'col-md-offset-1 ';?>col-md-6 col-sm-6 col-xs-12">
				    <?php if(get_sub_field( 'video')){?>
					<div class="box-shadow">
					    <iframe class="youtube-player" width="555" height="300" src="<?php the_sub_field( 'video');?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					   
					<!--<video width="555" height="300" poster="<?php the_sub_field( 'poster');?>" class="main_video" muted controls>-->
     <!--                   <source src="<?php the_sub_field( 'video');?>" type="video/mp4">-->
     <!--                   <source src="<?php the_sub_field( 'video');?>" type="video/ogg">-->
     <!--                   Your browser does not support the video tag.-->
     <!--               </video>	-->
					</div>
					<?php } ?>
				</div>
		
	        </div>
	        <?php $i++; endwhile; ?>
		</div>
		<div class="tail-right"></div>
	</article>
 <?php endif;?>
</section>

<?php get_footer(); ?>
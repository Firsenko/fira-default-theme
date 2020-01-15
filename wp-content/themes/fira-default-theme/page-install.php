<?php
/**
* Template name: Install
*/
get_header(); ?>
<?php if ( have_posts() ) :?>
	<?php while ( have_posts() ) : the_post();?>
<section id="install" class="box">
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1 class="text-center title_h1"><?php the_field('title_how');?></h1>
            <?php the_content();?>
        </div>
    </div>
</div>

	<article class="install">
	<div class="tail-left"></div>
		<div class="container">
			<?php $i=1; while( have_rows('repeater_how') ): the_row();?>
	        <div class="row box">
				<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12 desc">
					<p class="subtitle"><?php the_sub_field('title');?>
					<?php if($i == 1){ ?>
					<a href="<?php the_field('file');?>" download >Octopus for LinkedIn</a>
				    <?php } ?>
					</p>
				</div>
		
				<div class="col-lg-6 col-md-6 <?= ($i == 1) ? 'col-sm-4' : ' col-sm-12';?> col-xs-12">
				<div class="box-shadow">
					<img src="<?php the_sub_field('image');?>" alt="" class="img-responsive"/>
					</div>
				</div>
	        </div>
	        <?php $i++; endwhile; ?>
		</div>
		<div class="tail-right"></div>
	</article>
<?php endwhile; ?>
 <?php endif;?>

</section>

<?php get_footer(); ?>
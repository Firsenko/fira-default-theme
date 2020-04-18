<?php get_header(); ?>
	<div id="main-section" class="align-items-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-12 text-center">
					<div class="main-info">
						<?php if(get_field('section1_title')){?>
							<h1 class="title"><?php the_field('section1_title');?></h1>
						<?php } else{ ?>
							<h1 class="title"><?php bloginfo('name');?></h1>
						<?php } ?>
						<?php if(get_field('section1_image')){?>
							<div class="text-center">
								<img src="<?php the_field('section1_image');?>" alt="<?php bloginfo('name');?>" class="img-fluid main-img">
							</div>
						<?php } ?>
						<?php if(get_field('section1_button_url')){?>
							<div class="col-12 text-center">
								<a href="<?php the_field('section1_button_url');?>" rel=nofollow class="button blue install-button"  target="_blank"><?php the_field('section1_button');?></a>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php if( have_rows('repeater2')):?>
	<div id="about" class="wow fadeIn wave">
		<div class="container box">
		<p class="title_h1 text-center"><?php the_field('section2_title');?></p>
			<div class="row">
					<?php while( have_rows('repeater2') ): the_row();?>
						<div class="col-md-4 col-12">
							<div class="about-item text-center wow fadeIn" data-wow-delay="0.<?=$i?>s">
								<div class="image">
								<img src="<?php the_sub_field('icon');?>" class="img-fluid" alt="<?php the_sub_field('subtitle');?>" >
								</div> 
								<p class="subtitle"><?php the_sub_field('subtitle');?></p>
								<p class="info"><?php the_sub_field('desc');?></p>
							</div>
						</div>
					<?php endwhile; ?>

			</div>
		</div>
		<?php endif;?>
	</div>
	<?php if( have_rows('repeater3')):?>
	<div id="features" class="bg-color wave">
		<div class="container">
			<?php $i=1; while( have_rows('repeater3') ): the_row();?>
	        <div class="row wow <?=($i%2 == 0) ? 'row-rev slideInRight':'slideInLeft';?> box" data-wow-delay="0.0<?=$i?>s">
				<div class="col-md-6 col-12">
					 <img src="<?php the_sub_field('image');?>" alt="<?php the_sub_field('subtitle');?>" class="img-fluid" >
				</div>
				<div class="col-md-offset-1 col-md-5 col-sm-6 col-12 desc">
				<div class="info">
					<p class="title_h2"><?php the_sub_field('subtitle');?></p>
					<?php the_sub_field('desc');?></div>
				</div>
	        </div>
	        <?php $i++; endwhile; ?>
	        
		</div>
		
	</div>
 <?php endif;?>

    <?php get_footer(); ?>

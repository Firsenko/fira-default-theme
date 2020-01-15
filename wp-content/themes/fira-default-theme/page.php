<?php get_header(); ?>
<section id="page" class="box">
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
						<div class="col-12">
							<div class="desc text-center">
								<?php the_content();?>
							</div>
						</div>
					</div>
				</div>
		<?php endwhile;?>
	<?php endif;?>
</article>
</section>
<?php get_footer(); ?>

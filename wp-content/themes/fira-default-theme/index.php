<?php

get_header(); ?>
<div class="container box blog">
	<div class="row">
	    <h1 class="text-center title_h1"><?php the_title();?></h1>
		<?php if ( have_posts() ) :?>
			<?php while ( have_posts() ) : the_post();?>
				<article <?php post_class('col-md-9 col-12'); ?>>
					<?php the_post_thumbnail();?>
					<?php the_content();?>
				</article>
			<?php endwhile;?>
		<?php endif;?>
		<?php if ( is_active_sidebar( 'right-sidebar-blog' ) ) : ?>
	<aside class="col-md-3 col-12">
	    <ul>
	        <?php dynamic_sidebar('right-sidebar-blog');?>
	    </ul>
	</aside>
	<?php endif;?>
	</div>
	</div>
</main>
<?php get_footer(); ?>

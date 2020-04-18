<?php
/**
* Template name: Contact
*/
get_header(); ?>

<?php if ( have_posts() ) :?>
    <?php while ( have_posts() ) : the_post();?>

<section id="contact-form" class="box">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1> <?php the_field('title_contact');?></h1>
                <div class="description"> <?php the_field('description_contact');?></div>
            </div>
        </div>
    </div>
    <?php
    $location = get_field('map', 'option');
    if( $location ): ?>
        <div class="acf-map" data-zoom="14">
            <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
        </div>
    <?php endif; ?>
    <div class="container box">
        <div class="row">
            <div class="col-md-6 col-12">
            <p class="subtitle"><?php the_field('subtitle1');?></p>
                <div class="desc"> <?php the_field('subdesc1');?></div>
                <?php if(get_field('contact_form')):?>
                    <div class="contact-wrap">
                        <?php echo do_shortcode( '[contact-form-7 id="'.get_field('contact_form').'"]');?>
                    </div>
                <?php else:?>
                    <?php get_template_part('inc/contact-form'); ?>
                <?php endif;?>
            </div>
            <div class="col-md-offset-1 col-md-5 col-12">
                <p class="subtitle"><?php the_field('subtitle2');?></p>
                <div class="desc"> <?php the_field('subdesc2');?></div>
                <?php if (have_rows('repeater_team') ) :?>
                    <div class="team-wrap">
            <?php $i=1; while( have_rows('repeater_team') ): the_row();?>
                    <?php if(get_sub_field('image')):?>
                        <div class="team-row">
                        <img src="<?php the_sub_field('image');?>" alt="image">
                    <?php endif;?>
                    <div class="team-info">
                       <span class="name"><?php the_sub_field('name');?></span><br>
                       <span><?php the_sub_field('position');?></span><br>
                       <a href="mailto:<?php the_sub_field('email');?>" class="email"><?php the_sub_field('email');?></a>
                    </div>
                    </div>
               <?php endwhile; ?>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</section>
<?php endwhile; ?>
 <?php endif;?>

<?php get_footer(); ?>

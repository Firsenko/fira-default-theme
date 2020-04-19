<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>-->
	<?php wp_head();?>
</head>

<body <?php body_class();?>>
<?php the_field('theme_options_code_in_head','options');?>
<div class="wrapper">
	<header id="header" >
		<div class="container">
			<div class="row align-items-center">
				<div class="col-6">
                    <div class="site-branding" itemscope itemtype="http://schema.org/Organization">
                        <?php if (!(get_theme_mod( 'fira_header_logo' ))): ?>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url" rel="home"><span itemprop="name"><?php bloginfo( 'name' ); ?></span></a>
                        <?php else: ?>
                            <a href='<?php echo esc_url( home_url( '/' ) ); ?>' itemprop="url" data-small-img="<?php echo esc_url( get_theme_mod( 'fira_header_small_logo' ) ); ?>" data-big-img="<?php echo esc_url( get_theme_mod( 'fira_header_logo' ) ); ?>">
                                <img class='main_logo' src="<?php echo esc_url( get_theme_mod( 'fira_header_logo' ) ); ?>" itemprop="logo"  alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>
                        <?php endif ?>
                    </div><!-- .site-branding -->
				</div>
				<div class="col-6">
				 <nav class="navbar navbar-expand-lg <?=( get_field('navbar_theme_dark') == true )? 'navbar-dark' : 'navbar-light' ;?>  justify-content-end">
		            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		              <span class="navbar-toggler-icon"></span>
		            </button>
		            <div class="collapse navbar-collapse  justify-content-end" id="navbarSupportedContent">
							<?php wp_nav_menu( array(
								'theme_location'  => 'header',
								'menu'            => '',
								'menu_id' => 'mainmenu',
								'container'       => false,
								'walker'          => false,

							) );

							?>
						<?php if(get_theme_mod( 'fira_header_button_url' ) || get_theme_mod( 'fira_header_button' )) {?>
							<a id="calltoaction-button" rel=nofollow href="<?=get_theme_mod( 'fira_header_button_url' ); ?>"  target="_blank" class="button blue"><?= get_theme_mod( 'fira_header_button' ); ?></a>
						<?php }  ?>
				 	</div>		
					</nav>
				</div>
			</div>
		</div>
	</header>
    <?php
    $breadcrumbs = fira_breadcrumbs();
    $breadcrumbs_on = false;
    if( !empty( $breadcrumbs ) && $breadcrumbs_on == true ): ?>
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php echo  $breadcrumbs; ?>
                </div>
            </div>
        </div>
    </div>
    <?php else:?>
    <?php
    if ( function_exists('yoast_breadcrumb') && !is_front_page()) {
        yoast_breadcrumb( '<div id="breadcrumbs" class="breadcrumbs">
                <div class="container">
                    <div class="row">
                        <div class="col-12">','</div> </div> </div></div>' );
    }
    ?>
    <?php endif; ?>
	<main class="content <?php if(is_front_page()) echo 'bg-main';?>">

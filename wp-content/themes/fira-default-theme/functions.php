<?php
/**
 * Setup main theme options
 */
show_admin_bar(false);
add_action('after_setup_theme', 'fira_theme_setup');
function fira_theme_setup()
{

    load_theme_textdomain('fira', get_template_directory() . '/languages');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    // Enable support WooCommerce
    add_theme_support('woocommerce');

    // Add support for Block Styles.
    add_theme_support( 'wp-block-styles' );

    // Add support for full and wide align images.
    add_theme_support( 'align-wide' );
// Add custom editor font sizes.
    add_theme_support(
        'editor-font-sizes',
        array(
            array(
                'name'      => __( 'Small', 'fira' ),
                'shortName' => __( 'S', 'fira' ),
                'size'      => 19.5,
                'slug'      => 'small',
            ),
            array(
                'name'      => __( 'Normal', 'fira' ),
                'shortName' => __( 'M', 'fira' ),
                'size'      => 22,
                'slug'      => 'normal',
            ),
            array(
                'name'      => __( 'Large', 'fira' ),
                'shortName' => __( 'L', 'fira' ),
                'size'      => 36.5,
                'slug'      => 'large',
            ),
            array(
                'name'      => __( 'Huge', 'fira' ),
                'shortName' => __( 'XL', 'fira' ),
                'size'      => 49.5,
                'slug'      => 'huge',
            ),
        )
    );

    // Editor color palette.
    add_theme_support(
        'editor-color-palette',
        array(
            array(
                'name'  => 'default' === get_theme_mod( 'primary_color' ) ? __( 'Blue', 'fira' ) : null,
                'slug'  => 'primary',
                'color' => fira_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 33 ),
            ),
            array(
                'name'  => 'default' === get_theme_mod( 'primary_color' ) ? __( 'Dark Blue', 'fira' ) : null,
                'slug'  => 'secondary',
                'color' => fira_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 23 ),
            ),
            array(
                'name'  => __( 'Dark Gray', 'fira' ),
                'slug'  => 'dark-gray',
                'color' => '#111',
            ),
            array(
                'name'  => __( 'Light Gray', 'fira' ),
                'slug'  => 'light-gray',
                'color' => '#767676',
            ),
            array(
                'name'  => __( 'White', 'fira' ),
                'slug'  => 'white',
                'color' => '#FFF',
            ),
        )
    );

    // Add support for responsive embedded content.
    add_theme_support( 'responsive-embeds' );
    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus(array(
        'header' => __('Primary Menu', 'fira'),
        'footer' => __('Footer Menu', 'fira'),
    ));

    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption'
    ));
    // Enable support for Post Formats.
    add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat',));
    if (!isset($content_width)) {
        $content_width = 600;
    }

    // Enable support for Post Formats.
    //add_theme_support( 'post-formats', array('aside','image','video','quote','link','gallery','status','audio','chat',));
}

/**
 * Setup additional media sizes
 */
add_action('init', 'fira_add_image_sizes');
function fira_add_image_sizes()
{

    // Crop TRUE medium image size
    /*
    $medium=get_image_size('medium');
    remove_image_size('medium');
    add_image_size('medium', $medium['width'], $medium['height'], true);
    */

    add_image_size('thumbnail-archive', 162, 91, true);
    add_image_size('thumbnail-catalog', 160, 300, true);
    add_image_size('thumbnail-product', 70, 70, true);
    add_image_size('thumbnail-app', 480, 300, true);
}

/**
 * Setup additional media size names
 */
//add_filter('image_size_names_choose', 'fira_image_sizes_names');
//function fira_custom_image_sizes_names($sizes) {
//	$sizes['thumbnail-archive'] =__( 'Thumbnail archive size','fira');
//	return $sizes;
//}
add_filter('wpcf7_ajax_loader', 'my_wpcf7_ajax_loader');
function my_wpcf7_ajax_loader () {
    return  get_bloginfo('stylesheet_directory') . '/images/ajax-loader.gif';
}
/**
 * Allow upload svg
 */

function fira_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'fira_mime_types');
/**
 * Register sidebar
 */
add_action('widgets_init', 'fira_widgets_init');
function fira_widgets_init()
{
    register_sidebar(array(
        'name' => __('Right blog sidebar', 'fira'),
        'id' => 'right-sidebar-blog',
        'description' => __('There are you can place additional widgets for blog', 'fira'),
        'before_title' => '<h3 class="title text-center">',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name' => __('Right sidebar posts', 'fira'),
        'id' => 'right-sidebar',
        'description' => __('There are you can place additional widgets for single post', 'fira'),
        'before_title' => '<h3 class="title text-center">',
        'after_title' => '</h3>'
    ));
    register_sidebar(
        array(
            'name'          => __( 'Footer 1', 'fira' ),
            'id'            => 'sidebar-1',
            'description'   => __( 'Add widgets here to appear in your footer.', 'fira' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h4 class="mb-4">',
            'after_title'   => '</h4>',
        )
    );
    register_sidebar(
        array(
            'name'          => __( 'Footer 2', 'fira' ),
            'id'            => 'sidebar-2',
            'description'   => __( 'Add widgets here to appear in your footer.', 'fira' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h4 class="mb-4">',
            'after_title'   => '</h4>',
        )
    );
}
// удаляет H2 из шаблона пагинации
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){
    /*
    Вид базового шаблона:
    <nav class="navigation %1$s" role="navigation">
        <h2 class="screen-reader-text">%2$s</h2>
        <div class="nav-links">%3$s</div>
    </nav>
    */

    return '
	<nav class="navigation %1$s" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>    
	';
}

add_filter('acf/settings/google_api_key', function () {
    return get_field('theme_options_google_maps','option');
});
/**
 * Load Scripts
 */
add_action('wp_enqueue_scripts', 'fira_scripts');
function fira_scripts()
{
    /* Bootstrap */
    if(function_exists('acf_add_options_page') && get_field('theme_options_bootstrap','option')){
        if(get_field('theme_options_bootstrap_v','option')==3){
            wp_enqueue_style('bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', false, '');
            wp_enqueue_style('bootstrap-theme-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css', false, '');
            wp_enqueue_script('bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), null, true );
        }else{
            wp_enqueue_style('bootstrap-css', '//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', false, '');
            wp_enqueue_script('jquery-ajax-js', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array('jquery'), null, true );
            wp_enqueue_script('popper-js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array('jquery'), null, true );
            wp_enqueue_script('bootstrap-js', '//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array('jquery'), null, true );
        }
    }else{
        wp_enqueue_style('bootstrap-css', '//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', false, '');
        wp_enqueue_script('jquery-ajax-js', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array('jquery'), null, true );
        wp_enqueue_script('popper-js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array('jquery'), null, true );
        wp_enqueue_script('bootstrap-js', '//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array('jquery'), null, true );
    }

    /* Magnific Popup */
    if(function_exists('acf_add_options_page') && get_field('theme_options_magnific_popup','option')){
        wp_enqueue_script('magnific-popup-js', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js', array('jquery'), null, true );
        wp_enqueue_style('magnific-popup-css', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css', false, '');
    }

    /* Masonry */
    if(function_exists('acf_add_options_page') && get_field('theme_options_masonry','option')){
        wp_enqueue_script( 'masonry', '//cdnjs.cloudflare.com/ajax/libs/masonry/3.1.2/masonry.pkgd.js', array('jquery'), null, true );
        wp_enqueue_script( 'imagesloaded', 'https://unpkg.com/imagesloaded@4.1/imagesloaded.pkgd.min.js', array('jquery'), null, true );
    }

    /* Slick Slider */
    if(function_exists('acf_add_options_page') && get_field('theme_options_slickslider','option')){
        wp_enqueue_style('slick-css', get_template_directory_uri().'/css/slick.css', false, '');
        wp_enqueue_style('slick-theme-css', get_template_directory_uri() . '/css/slick-theme.css', false, '');
        wp_enqueue_script('slick-js', get_template_directory_uri().'/js/slick.min.js', array('jquery'), null, true );
    }

    /* Google Maps API for ACF */
    if(function_exists('acf_add_options_page') && get_field('theme_options_google_maps','option') && is_singular()){
        wp_enqueue_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?key='.get_field('theme_options_google_maps','option').'&v=3.exp', array(), '3', true );
        wp_enqueue_script( 'google-map-init', get_template_directory_uri() . '/js/google-maps-init.js', array('google-map', 'jquery'), '0.1', true );
//        wp_enqueue_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?v=3&sensor=false');
        wp_localize_script( 'google-map-init', 'marker_img',  get_template_directory_uri().'/images/marker.png');
    }

    /* Qwl Slider */
    if(function_exists('acf_add_options_page') && get_field('theme_options_owlcarousel','option')){
        wp_enqueue_style('owl', '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', false, '');
        wp_enqueue_style('owl-theme', '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', false, '');
        wp_enqueue_script('owl-js', '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array('jquery'), null, true);
    }
    if(function_exists('acf_add_options_page') && get_field('theme_options_countdown','option')) {
        wp_enqueue_script('countdown-js', get_template_directory_uri() . '/js/countdown.min.js', array('jquery'), null, true);
    }
    if(function_exists('acf_add_options_page') && get_field('theme_options_animate','option')) {
        wp_enqueue_style('animate', '//cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css', false, '');
    }
    if(function_exists('acf_add_options_page') && get_field('theme_options_wow','option')) {
        wp_enqueue_script('wow-js', get_template_directory_uri() . '/js/wow.min.js', array('jquery'), null, true);
    }
    if(function_exists('acf_add_options_page') && get_field('theme_options_parallax','option')) {
        wp_enqueue_script('parallax', get_template_directory_uri() . '/js/parallax.js', array('jquery'), null, false);
        wp_enqueue_style('parallax-css', get_template_directory_uri() . '/css/parallax.css');
    }
    if(function_exists('acf_add_options_page') && get_field('theme_options_datetimepicker','option')) {
        wp_enqueue_style('datetimepicker-css', get_template_directory_uri() . '/js/jquery.datetimepicker.min.css');
        wp_enqueue_script('datetimepicker-js', get_template_directory_uri() . "/js/jquery.datetimepicker.full.min.js", array('jquery'));
    }
    if(function_exists('acf_add_options_page') && get_field('theme_options_awesome_fonts','option')) {
        wp_enqueue_style('fontawesome', '//use.fontawesome.com/releases/v5.8.2/css/all.css', false, '');
    }
    if(function_exists('acf_add_options_page') && get_field('theme_options_maskedinput','option')) {
        wp_enqueue_script('mask-js', get_template_directory_uri() . '/js/jquery.maskedinput.min.js', array('jquery'), null, false);
    }
//    theme_options_intltelinput
    if(function_exists('acf_add_options_page') && get_field('theme_options_utils','option')) {
        wp_enqueue_script('intltelinput-js', get_template_directory_uri() . '/js/intlTelInput.min.js', array('jquery'), null, false);
        wp_enqueue_script('utils-js', get_template_directory_uri() . '/js/utils.js', array('jquery'), null, false);
    }
    wp_enqueue_style('font-opensans','//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&subset=cyrillic-ext', false, '');
    wp_enqueue_style('font-sans','//fonts.googleapis.com/css?family=Montserrat+Alternates:300,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic-ext', false, '');
    wp_enqueue_style('font-Montserrat','//fonts.googleapis.com/css?family=Montserrat:300,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic-ext', false, '');

    if (is_404()) {
        wp_enqueue_style('not-found', get_template_directory_uri() . '/css/not-found-page.css', false, '');
    }


    /* Theme */
    wp_enqueue_style('fira', get_stylesheet_uri(), false, '');
    wp_enqueue_style('responsive', get_template_directory_uri() . '/css/responsive.css', false, '');

    wp_enqueue_script('fira-js', get_template_directory_uri() . '/js/fira.js', array('jquery'), null, true);

    // Load contact form style
    wp_enqueue_style('contact-form-style', get_template_directory_uri() . '/css/contact-form.css', array(), '20170101');
// Load contact form js
    wp_enqueue_script('contact-form-js', get_template_directory_uri() . '/js/contact-form.js', array(), '20170101', true);
    wp_localize_script( 'fira_reg_script', 'fira_reg_vars', array(
            'fira_ajax_url' => admin_url( 'admin-ajax.php' ),
        )
    );
    if (is_singular() && comments_open()) {
        wp_enqueue_script('comment-reply');
    }
}

if(function_exists('acf_add_options_page') && get_field('theme_options_google_maps','option')){
    add_action('acf/init', 'fira_acf_google_api_key');
    function fira_acf_google_api_key() {
        acf_update_setting('google_api_key', get_field('google_map_api_key','option'));
    }
}

//Breadcrubs


if( !function_exists('fira_breadcrumbs') ){
    function fira_breadcrumbs(){
        global $fira_slugs;
        $link_before      = '<li>';
        $link_after       = '</li>';
        $link_attr        = ' ';
        $link             = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
        $delimiter        = '<span class="separator"></span>';              // Delimiter between crumbs
        $before           = '<li class="current">'; // Tag before the current crumb
        $after            = '</li>';
        $page_on_front = get_option('page_on_front');
        $breadcrumbs = '';
        $wp_the_query   = $GLOBALS['wp_the_query'];
        $queried_object = $wp_the_query->get_queried_object();
        if( ( is_home() && empty( $page_on_front ) ) || is_front_page() ){
            return $breadcrumbs;
        }
        else{
            $breadcrumbs = '<ul class="list-unstyled breadcrumbs-list">';
            $breadcrumbs .= '<li><a href="'.esc_url( home_url('/') ).'">'.__( 'Home', 'fira' ).'</a><span class="separator"></span></li>';
            if( is_home() ){
                $breadcrumbs .= '<li>'.get_the_title( get_option('page_for_posts') ).'</li>';
            }
            else if( is_404() ){
                $breadcrumbs .= '<li>'.esc_html__( 'Not found', 'fira' ).'</li>';
            }
            else if( is_tax() ){
                $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

// Create a list of all the term's parents
                $parent = $term->parent;
                while ($parent):
                    $parents[] = $parent;
                    $new_parent = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
                    $parent = $new_parent->parent;
                endwhile;
                if(!empty($parents)):
                    $parents = array_reverse($parents);

// For each parent, create a breadcrumb item
                    $i=2; foreach ($parents as $parent):
                    $item = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
                    $url = get_bloginfo('url').'/'.$item->taxonomy.'/'.$item->slug;
                    echo '<li><a href="'.$url.'">'.$item->name.'</a> </li>';
                    $i++;  endforeach;
                endif;
// Display the current term in the breadcrumb
                $breadcrumbs .= '<li>'.$term->name.'</li>';
            }
            else if( is_category() ){
                $breadcrumbs .= '<li><a href="'.get_permalink( get_option('page_for_posts') ).'">'.get_the_title( get_option('page_for_posts') ).'</a><span class="separator"></span></li>';
                $breadcrumbs .= '<li>'.single_cat_title(' ',false).'</li>';
            }
            else if( is_tag() ){
                $breadcrumbs .= '<li><a href="'.get_permalink( get_option('page_for_posts') ).'">'.get_the_title( get_option('page_for_posts') ).'</a><span class="separator"></span></li>';
                $breadcrumbs .= '<li>'.get_query_var('tag').'</li>';
            }
            else if( is_search() ){
                $breadcrumbs .= '<li><a href="'.get_permalink( get_option('page_for_posts') ).'"> '.get_the_title( get_option('page_for_posts') ).'</a><span class="separator"></span></li>';
                $breadcrumbs .= '<li>'.esc_html__('Search results: ', 'fira').' '. get_search_query().'</span></li>';
            }
            // Handle single post requests which includes single pages, posts and attatchments
            // Handle archives which includes category-, tag-, taxonomy-, date-, custom post type archives and author archives
            else if( is_archive() ) {
                if (    is_category() || is_tag()  || is_tax()  ) {
                    // Set the variables for this section
                    $term_object        = get_term( $queried_object );
                    $taxonomy           = $term_object->taxonomy;
                    $term_id            = $term_object->term_id;
                    $term_name          = $term_object->name;
                    $term_parent        = $term_object->parent;
                    $taxonomy_object    = get_taxonomy( $taxonomy );
                    $current_term_link  = $before . $taxonomy_object->labels->singular_name . ': ' . $term_name . $after;
                    $parent_term_string = '';

                    if ( 0 !== $term_parent )
                    {
                        // Get all the current term ancestors
                        $parent_term_links = [];
                        while ( $term_parent ) {
                            $term = get_term( $term_parent, $taxonomy );

                            $parent_term_links[] = sprintf( $link, esc_url( get_term_link( $term ) ), $term->name );

                            $term_parent = $term->parent;
                        }

                        $parent_term_links  = array_reverse( $parent_term_links );
                        $parent_term_string = implode( $delimiter, $parent_term_links );
                    }

                    if ( $parent_term_string ) {
                        $breadcrumbs .= $parent_term_string . $delimiter . $current_term_link;
                    } else {
                        $breadcrumbs .= $current_term_link;
                    }

                } elseif ( is_author() ) {

                    $breadcrumbs .=  __( 'Author archive for ') .  $before . $queried_object->data->display_name . $after;

                } elseif ( is_date() ) {
                    // Set default variables
                    $year     = $wp_the_query->query_vars['year'];
                    $monthnum = $wp_the_query->query_vars['month'];
                    $day      = $wp_the_query->query_vars['day'];

                    // Get the month name if $monthnum has a value
                    if ( $monthnum ) {
                        $date_time  = DateTime::createFromFormat( '!m', $monthnum );
                        $month_name = $date_time->format( 'F' );
                    }

                    if ( is_year() ) {

                        $breadcrumbs .= $before . $year . $after;

                    } elseif( is_month() ) {

                        $year_link        = sprintf( $link, esc_url( get_year_link( $year ) ), $year );

                        $breadcrumbs .= $year_link . $delimiter . $before . $month_name . $after;

                    } elseif( is_day() ) {

                        $year_link        = sprintf( $link, esc_url( get_year_link( $year ) ),             $year       );
                        $month_link       = sprintf( $link, esc_url( get_month_link( $year, $monthnum ) ), $month_name );

                        $breadcrumbs .= $year_link . $delimiter . $month_link . $delimiter . $before . $day . $after;
                    }

                } elseif ( is_post_type_archive() ) {

                    $post_type        = $wp_the_query->query_vars['post_type'];
                    $post_type_object = get_post_type_object( $post_type );

                    $breadcrumbs .= $before . $post_type_object->labels->name . $after;

                }
            }
            else if ( is_singular() )
            {
                /**
                 * Set our own $post variable. Do not use the global variable version due to
                 * reliability. We will set $post_object variable to $GLOBALS['wp_the_query']
                 */
                $post_object = sanitize_post( $queried_object );

                // Set variables
                $title          = apply_filters( 'the_title', $post_object->post_title );
                $parent         = $post_object->post_parent;
                $post_type      = $post_object->post_type;
                $post_id        = $post_object->ID;
                $post_link      = $before . $title . $after;
                $parent_string  = '';
                $post_type_link = '';

                if ( 'post' === $post_type )
                {
                    // Get the post categories
                    $categories = get_the_category( $post_id );
                    if ( $categories ) {
                        // Lets grab the first category
                        $category  = $categories[0];

                        $category_links = get_category_parents( $category, true, $delimiter );
                        $category_links = str_replace( '<a',   $link_before . '<a' . $link_attr, $category_links );
                        $category_links = str_replace( '</a>', '</a>' . $link_after,             $category_links );
                    }
                }

                if ( !in_array( $post_type, ['post', 'page', 'attachment'] ) )
                {
                    $post_type_object = get_post_type_object( $post_type );
                    $archive_link     = esc_url( get_post_type_archive_link( $post_type ) );

                    $post_type_link   = sprintf( $link, $archive_link, $post_type_object->labels->name );
                }

                // Get post parents if $parent !== 0
                if ( 0 !== $parent )
                {
                    $parent_links = [];
                    while ( $parent ) {
                        $post_parent = get_post( $parent );

                        $parent_links[] = sprintf( $link, esc_url( get_permalink( $post_parent->ID ) ), get_the_title( $post_parent->ID ) );

                        $parent = $post_parent->post_parent;
                    }

                    $parent_links = array_reverse( $parent_links );

                    $parent_string = implode( $delimiter, $parent_links );
                }
                if ( $category_links )  $breadcrumbs .= $category_links;
                if ( $post_type_link )  $breadcrumbs .= $post_type_link . $delimiter;
                // Lets build the breadcrumb trail
                if ( $parent_string ) {
                    $breadcrumbs .= $parent_string . $delimiter . $post_link;
                } else {
                    $breadcrumbs .= $post_link;
                }


            }

            else{
                $breadcrumbs .= '<li>'.get_the_title().'</li>';
            }

            $breadcrumbs .= '</ul>';
        }

        return $breadcrumbs;
    }
}
/**
 * Add options page
 */
if( function_exists('acf_add_options_page') ) {

    acf_add_options_sub_page(array(
        'page_title' 	=> __('Разработчикам','fira'),
        'menu_title' 	=> __('Разработчикам','fira'),
        'parent_slug' 	=> 'toyota-theme-settings',
    ));
}

/**
 * Edit Main Loop
 */

function add_custom_types_to_tax( $query ) {
    if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
// Get all your post types
        $post_types = get_post_types();

        $query->set( 'post_type', $post_types );
        return $query;
    }
}
add_filter( 'pre_get_posts', 'add_custom_types_to_tax' );

/**
 * Edit Custom Post Type archive title
 */
add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title();
        return $title;
    }
    if (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
        return $title;
    }
    if (is_tax()) {
        $title = single_term_title('', false);
        return $title;
    }
    if (is_tag()) {
        $title = single_tag_title('', false);
        return $title;
    }
});

/**
 * Pagination
 */
if (!function_exists('fira_pagination')) {
    function fira_pagination()
    {
        global $wp_query;
        $big = 9999;
        echo paginate_links(array('base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))), 'format' => '?paged=%#%', 'current' => max(1, get_query_var('paged')), 'prev_next' => true, 'prev_text' => __('&laquo;', 'fira'), 'next_text' => __('&raquo;', 'fira'), 'total' => $wp_query->max_num_pages));
    }
}

/**
 * Remove emoji
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

/*--------------------------------------------------------------
	Some specific additional functions
 --------------------------------------------------------------*/

/**
 * Get size information for all currently-registered image sizes.
 */
function get_image_sizes()
{
    global $_wp_additional_image_sizes;

    $sizes = array();

    foreach (get_intermediate_image_sizes() as $_size) {
        if (in_array($_size, array('thumbnail', 'medium', 'medium_large', 'large'))) {
            $sizes[$_size]['width'] = get_option("{$_size}_size_w");
            $sizes[$_size]['height'] = get_option("{$_size}_size_h");
            $sizes[$_size]['crop'] = (bool)get_option("{$_size}_crop");
        } elseif (isset($_wp_additional_image_sizes[$_size])) {
            $sizes[$_size] = array(
                'width' => $_wp_additional_image_sizes[$_size]['width'],
                'height' => $_wp_additional_image_sizes[$_size]['height'],
                'crop' => $_wp_additional_image_sizes[$_size]['crop'],
            );
        }
    }

    return $sizes;
}
# удалить атрибут type у scripts и styles
add_filter('style_loader_tag', 'sj_remove_type_attr', 10, 2);
add_filter('script_loader_tag', 'sj_remove_type_attr', 10, 2);
add_filter('wp_print_footer_scripts ', 'sj_remove_type_attr', 10, 2);
function sj_remove_type_attr($tag) {
    return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
}
add_filter('style_loader_tag', 'clean_style_tag');
function clean_style_tag($src) {
    return str_replace('type="text/css"', '', $src);
}
add_filter('script_loader_tag', 'clean_script_tag');
function clean_script_tag($src) {
    return str_replace("type='text/javascript'", '', $src);
}
/**
 * Get size information for a specific image size.
 */
function get_image_size($size)
{
    $sizes = get_image_sizes();

    if (isset($sizes[$size])) {
        return $sizes[$size];
    }
    return false;
}
add_filter('autoptimize_filter_imgopt_lazyloaded_img','sizes_experiment');
function sizes_experiment($img_in) {
    $noscript_pos = strpos( $img_in, '</noscript>') + 11;
    $noscript_img = substr ( $img_in , 0 , $noscript_pos );
    $_img = substr ( $img_in , $noscript_pos );
    return $noscript_img . str_replace( 'sizes=', 'data-sizes=', $_img );
}
/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * Customizer gutenberg.
 */
require get_template_directory() . '/inc/gutenberg.php';

function fira_get_post_views($postID){
    $count_key = 'fira_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}
function fira_set_post_views($postID) {
    $count_key = 'fira_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function load_more_scripts() {

    global $wp_query;

    // In most cases it is already included on the page and this line can be removed
    wp_enqueue_script('jquery');

    // register our main script but do not enqueue it yet
    wp_register_script( 'my_loadmore', get_stylesheet_directory_uri() . '/js/myloadmore.js', array('jquery') );

    // now the most interesting part
    // we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
    // you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
    wp_localize_script( 'my_loadmore', 'loadmore_params', array(
        'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
        'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
        'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
        'max_page' => $wp_query->max_num_pages,
//        'post_type' => get_post_type()
    ) );

    wp_enqueue_script( 'my_loadmore' );
}

add_action( 'wp_enqueue_scripts', 'load_more_scripts' );

function loadmore_ajax_handler(){

    // prepare our arguments for the query
    $args = json_decode( stripslashes( $_POST['query'] ), true );
    $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
    $args['post_status'] = 'publish';
//    $args['post_type'] = $_POST['post_type'];
    // it is always better to use WP_Query but not here
    query_posts( $args );
    if( have_posts() ) :?>
        <?php  while ( have_posts() ) :  the_post(); ?>
            <article class="box-shadow">
                <a href="<?php the_permalink();?>" rel="nofollow" ><?php the_post_thumbnail();?></a>
                <h2 class="subtitle"><?php the_title();?></h2>  <span class="entry-meta"><?php fira_edit_link();?></span>
                <p><?php echo wp_trim_words( strip_shortcodes(get_the_excerpt()), 20, '...' );?></p>
                <div class="text-right">
                    <a href="<?php the_permalink();?>" rel="nofollow"  class="btn"><?php _e('Детальніше','fira');?></a>
                </div>
                <div class="clearfix"></div>
            </article>
        <?php endwhile;?>
    <?php endif;
    die; // here we exit the script and even no wp_reset_query() required!
}

add_action('wp_ajax_loadmore', 'loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'loadmore_ajax_handler'); // wp_ajax_nopriv_{action}

function scroll_to_invalid() {
    ?>
    <script type="text/javascript">
        document.addEventListener( 'wpcf7invalid', function( event ) {
            setTimeout( function() {
                if($(window).width() > 575) {
                    $('html').stop().animate({
                        scrollTop: $('.wpcf7-not-valid').offset().top,
                    }, 500, 'swing');
                    $('.wpcf7-not-valid').eq(0).focus();
                }
                else{
                    $('html').stop().animate({
                        scrollTop: $('.wpcf7-not-valid').eq(0).offset().top-50,
                    }, 500, 'swing');
                    $('.wpcf7-not-valid').eq(0).focus();
                }
            }, 100);
        }, false );
    </script>
    <?php
}

add_action( 'wp_footer', 'scroll_to_invalid' );
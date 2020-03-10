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

    wp_enqueue_style('animate-css', get_template_directory_uri().'/css/animate.css', false, '');

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

    wp_enqueue_script( 'countdown-js', get_template_directory_uri() . '/js/countdown.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'wow-js', get_template_directory_uri() . '/js/wow.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'maskedinput-js', get_template_directory_uri() . '/js/jquery.maskedinput.min.js', array('jquery'), null, true );


    wp_enqueue_style('fontawesome', '//use.fontawesome.com/releases/v5.8.2/css/all.css', false, '');
    wp_enqueue_style('animate', '//cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css', false, '');
    wp_enqueue_style('font-opensans','//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&subset=cyrillic-ext', false, '');
    wp_enqueue_style('font-sans','//fonts.googleapis.com/css?family=Montserrat+Alternates:300,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic-ext', false, '');
    wp_enqueue_style('font-Montserrat','//fonts.googleapis.com/css?family=Montserrat:300,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic-ext', false, '');

    wp_enqueue_style('custom-slider', get_template_directory_uri() . '/css/slider.css', false, '');
    if (is_404()) {
        wp_enqueue_style('not-found', get_template_directory_uri() . '/css/not-found-page.css', false, '');
    }

    wp_enqueue_script('wow-js', get_template_directory_uri() . '/js/wow.min.js', array('jquery'), null, true);
    wp_enqueue_script('popup-js', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array('jquery'), null, true);
    wp_enqueue_script('mask-js', get_template_directory_uri() . '/js/jquery.maskedinput.min.js', array('jquery'), null, false);

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
                <p><?php echo wp_trim_words( strip_shortcodes(get_the_content()), 20, '...' );?></p>
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


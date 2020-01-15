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

add_filter('acf/settings/google_api_key', function () {
    return get_field('theme_options_google_maps','option');
});
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
        wp_enqueue_style('normalize-css', get_template_directory_uri().'/css/normalize.css', false, '');
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
        wp_localize_script( 'google-map-init', 'marker_img',  get_template_directory_uri().'/images/icon-map.png');
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
    wp_enqueue_style('font-opensans','//fonts.googleapis.com/css?family=Open+Sans:300,400,700,800', false, '');
     wp_enqueue_style('font-roboto','//fonts.googleapis.com/css?family=Roboto:300,400,700,800', false, '');

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

# удалить атрибут type у scripts и styles
add_filter('style_loader_tag', 'sj_remove_type_attr', 10, 2);
add_filter('script_loader_tag', 'sj_remove_type_attr', 10, 2);
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
 * Add options page
 */
if( function_exists('acf_add_options_page') ) {
//    acf_add_options_page(array(
//        'page_title' 	=> __('Настройки темы','toyota'),
//        'menu_title'	=> __('Настройки темы','toyota'),
//        'menu_slug' 	=> 'toyota-theme-settings',
//        'capability'	=> 'edit_posts',
//        'redirect'		=> false
//    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> __('Разработчикам','fira'),
        'menu_title' 	=> __('Разработчикам','fira'),
        'parent_slug' 	=> 'toyota-theme-settings',
    ));
}

/**
 * Edit Main Loop
 */
add_filter('pre_get_posts', 'fira_posts');
function fira_posts($query)
{
    if (!is_admin() && !is_single()) {
    }
}

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

function fira_customize_register($wp_customize)
{

    $fira_transport = 'postMessage';


    $wp_customize->add_section(
        'fira_advanced_options',
        array(
            'title' => 'Header',
            'priority' => 21
        )
    );


    $wp_customize->add_setting(
        'fira_header_logo',
        array(
            'default' => '',
            'transport' => $fira_transport
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'fira_header_logo',
            array(
                'label' => 'Логотип',
                'settings' => 'fira_header_logo',
                'section' => 'fira_advanced_options'
            )
        )
    );
        $wp_customize->add_setting(
        'fira_header_button_url',
        array(
            'default' => '',
            'transport' => $fira_transport
        )
    );

    $wp_customize->add_control(
            'fira_header_button_url',
            array(
                'label' => 'Ссылка кнопки в шапке',
                'type' => 'text',
                'section' => 'fira_advanced_options'
            
        )
    );
   $wp_customize->add_setting(
        'fira_header_button',
        array(
            'default' => '',
            'transport' => $fira_transport
        )
    );

    $wp_customize->add_control(
            'fira_header_button',
            array(
                'label' => 'Текст кнопки в шапке',
                'type' => 'text',
                'section' => 'fira_advanced_options'
            
        )
    );
    
    $wp_customize->add_setting(
        'fira_footer_logo',
        array(
            'default' => '',
            'transport' => $fira_transport
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'fira_footer_logo',
            array(
                'label' => 'Логотип footer',
                'settings' => 'fira_footer_logo',
                'section' => 'fira_advanced_options'
            )
        )
    );
 
// Добавляем собственную секцию настроек цвета
    $wp_customize->add_section(
        'fira_color_options',
        array(
            'title' => 'Цвета',
            'priority' => 22
        )
    );

// Добавляем выбор главного цвета
    $wp_customize->add_setting(
        'fira_main_color',
        array(
            'default' => '',
            'transport' => $fira_transport
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'fira_main_color', array(
            'label' => 'Главный цвет',
            'settings' => 'fira_main_color',
            'section' => 'fira_color_options',
            'priority' => 1
        )));
    // Добавляем выбор дополнительного цвета
    $wp_customize->add_setting(
        'fira_second_color',
        array(
            'default' => '',
            'transport' => $fira_transport
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'fira_second_color', array(
            'label' => 'Дополнительный цвет',
            'settings' => 'fira_second_color',
            'section' => 'fira_color_options',
            'priority' => 2
        )));

// Добавляем собственную секцию настроек
    $wp_customize->add_section(
        'fira_footer_options',
        array(
            'title' => 'Footer',
            'priority' => 202,
            'description' => 'Customize the view of your footer'
        )
    );
    // Текст копирайта в футере
    $wp_customize->add_setting(
        'fira_footer_copyright_text',
        array(
            'default' => '',
            'transport' => $fira_transport
        )
    );
    $wp_customize->add_control(
        'fira_footer_copyright_text',
        array(
            'section' => 'fira_footer_options',
            'label' => 'Copyright',
            'type' => 'text'
        )
    );
    // Адрес в футере
    $wp_customize->add_setting(
        'fira_footer_address',
        array(
            'default' => '',
            'transport' => $fira_transport
        )
    );
    $wp_customize->add_control(
        'fira_footer_address',
        array(
            'section' => 'fira_footer_options',
            'label' => 'Адрес',
            'type' => 'text'
        )
    );

   
}

add_action('customize_register', 'fira_customize_register');

function true_customizer_css()
{
    echo '<style>';

    //загружаем фон
//	if ( 0 < count( strlen( ( $background_image_url = get_theme_mod( 'fira_background_image' ) ) ) ) ){
//    		echo 'background-image: url( \'' . $background_image_url . '\' );';
//	}
//	echo '}';


    echo '</style>';
   //  if(is_front_page()){
   //  echo '<script>';
   //   echo 'jQuery(document).ready(function ($) {
   //      $("#menu-item-144 a,#menu-item-143 a").addClass("scroll");
   //      $("#menu-item-144 a").attr("href", "#features");
   //      $("#menu-item-143 a").attr("href", "#pricing");
   //  });';
   //  echo '</script>';
   // } 
}

add_action('wp_head', 'true_customizer_css');

//произвольный тип записи для писем лидов

add_action( 'init', 'cpt_mail_calback' );

function cpt_mail_calback()
{

    $labels = array(
        "name" => "Mail",
        "singular_name" => "Mail",
        "menu_name" => "Mail",
        "all_items" => "All mail",
        "add_new" => "Add New",
        "add_new_item" => "Add New",
        "edit" => "Edit",
        "edit_item" => "Edit",
        "new_item" => "New item",
        "view" => "View",
        "view_item" => "View item",
        "search_items" => "Search item",
        "not_found" => "No found",
        "not_found_in_trash" => "No found",
    );

    $args = array(
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "show_ui" => true,
        "has_archive" => false,
        "show_in_menu" => true,
        "exclude_from_search" => true,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => true,
        "rewrite" => false,
        "query_var" => true,
        "menu_position" => 7,
        "menu_icon" => "dashicons-email-alt",
        "supports" => array("title", "editor"),
    );

    register_post_type("mail", $args);
}

//Заменяем имя отправителя
    function fira_mail_name( $email ){
        return get_site_url();
    }
    add_filter( 'wp_mail_from_name', 'fira_mail_name' );

//    Заменяем email отправителя


    function fira_mail_from ($email ){
        return 'info@'.get_site_url();
    }
    add_filter( 'wp_mail_from', 'fira_mail_from' );


//    функция отправки письма
    function send_mail() {

        /* Забираем отправленные данные */
        $client_fio = $_POST['client_fio'];
        $client_tel = $_POST['client_tel'];
        $client_mail = $_POST['client_mail'];
        $client_sum = $_POST['client_sum'];

        /* Отправляем нам письмо */
        $emailTo = 'fira.gcgtrust@gmail.com';
        $subject = 'Test mail рассылки!';
        $headers = "Content-type: text/html; charset=\"utf-8\"";
        $mailBody = "$client_fio <br/><br/> $client_tel <br/><br/> $client_mail <br/><br/> $client_sum";

        wp_mail($emailTo, $subject, $mailBody, $headers);

        /* Создаем новый пост-письмо */
        $post_data = array(
            'post_title'    => $client_fio,
            'post_content'  => $client_tel . '<br/>' .$client_mail . '<br/>' .$client_sum,
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_type' => 'mail',
        );

        wp_insert_post( $post_data );

        /* Завершаем выполнение ajax */
        die();

    }

    add_action("wp_ajax_send_mail", "send_mail");
    add_action("wp_ajax_nopriv_send_mail", "send_mail");

    // Hide page by country
    function getCountry($ip){

        $url = "http://ipinfo.io/{$ip}?token=d6ced0cade3614";
        $ch1 = curl_init($url);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($ch1);
        curl_close($ch1);
        $info = json_decode( $content );
        if(isset($info->country)){
            $country = $info->country;
        }else{
            $country = 'BD';
        }

        $names        = file_get_contents( "http://country.io/names.json" );
        $decrypt     = json_decode( $names );

        $countryname = $decrypt->$country;

        return $countryname;
    }


    add_action( 'template_redirect', function() {
        global $country;
        global $blacklist;
        $country = getCountry($_SERVER['REMOTE_ADDR']);
        $blacklist = [
            'Bulgaria',
            'Finland'
        ];
        if(in_array($country, $blacklist) && is_page('404')){
            global $wp_query;
            $wp_query->set_404();
            status_header(404);
            get_template_part( 404 ); exit();
        }
        else{

        }
    } );

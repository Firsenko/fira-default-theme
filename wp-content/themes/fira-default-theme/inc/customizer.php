<?php
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

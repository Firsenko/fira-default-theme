<?php
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
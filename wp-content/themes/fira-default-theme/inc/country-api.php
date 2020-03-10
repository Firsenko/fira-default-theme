<?php

// Hide page by country
function getCountry($ip){

    $url = "http://ipinfo.io/{$ip}";
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

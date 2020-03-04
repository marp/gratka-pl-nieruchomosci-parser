<?php
set_time_limit(1200); //20minut;
ini_set("default_socket_timeout",9999);
include_once('./../parser/simple_html_dom.php');
include_once('./../connection.php');

$stmt = $conn->query("SELECT url FROM `links`");
$stmt->fetch(PDO::FETCH_BOTH);
$pages = $stmt->fetchAll();

//print_r($pages);

foreach ($pages as $p) {
    $details = file_get_html($p[0]);
    $scripts_array = $details->find('script');
    $scripts = "";
    foreach ($scripts_array as $s) {
        $scripts .= $s->innertext;
    }
    preg_match('/.lokalizacja.szerokosc.geograficzna-y..([\d]+.[\d]+)/', $scripts, $latitude);
    if (isset($latitude[1])){
        $latitude = $latitude[1];
    }else{
        var_dump($latitude);
    }
    preg_match('/.lokalizacja.dlugosc.geograficzna-x..([\d]+.[\d]+)/', $scripts, $longitude);
    if (isset($longitude[1])){
        $longitude = $longitude[1];
    }else{
        echo $p[0];
        var_dump($longitude);
    }

//    if(is_array($longitude)){
//       var_dump($longitude);
//    }
//    if(is_array($latitude)){
//        var_dump($latitude);
//    }
    //echo "Latitude: ".$latitude.

}
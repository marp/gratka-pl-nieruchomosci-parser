<?php
include_once('./../parser/simple_html_dom.php');
include_once('./../functions.php');
include_once('./../connection.php');

$details = file_get_html("https://gratka.pl/nieruchomosci/nowe-mieszkanie-lodz-ul-pogranicze-lodzi-i-konstantynowa/ob/3906911");

//$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_path = "https://gratka.pl/nieruchomosci/nowe-mieszkanie-lodz-ul-pogranicze-lodzi-i-konstantynowa/ob/3906911";
$uri_segments = explode('/', $uri_path);

echo $uri_segments[6];
/*
$description = $details->find("div[class=description__rolled ql-container]")[0]->plaintext;
print_r($description);

$details = $details->find("meta[property=og:image]");

echo "<hr>".count($details);

foreach ($details as $det){
    echo "<img src='".$det->getAttribute('content')."'>";
}
*/

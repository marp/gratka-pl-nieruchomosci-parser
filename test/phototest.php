<?php
include_once('./../parser/simple_html_dom.php');
include_once('./../functions.php');
include_once('./../connection.php');

$details = file_get_html("https://gratka.pl/nieruchomosci/nowe-mieszkanie-lodz-ul-pogranicze-lodzi-i-konstantynowa/ob/3906911");

$description = $details->find("div[class=description__rolled ql-container]")[0]->plaintext;
print_r($description);

$details = $details->find("meta[property=og:image]");

echo "<hr>".count($details);

foreach ($details as $det){
    echo "<img src='".$det->getAttribute('content')."'>";
}


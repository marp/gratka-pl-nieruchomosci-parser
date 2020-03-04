<?php
include_once('./../parser/simple_html_dom.php');

$details = file_get_html("https://gratka.pl/nieruchomosci/mieszkanie-warszawa-bialoleka-ul-swiatowida/oi/2613984");

$photos = "";
$scripts = $details->find("script");
foreach ($scripts as $s){
    $photos .= $s->innertext;
}
echo $photos;

preg_match('/dataJson\s*:\s*([^\]]+)/', $photos, $photos_matches);
if(isset($photos_matches)){
    $photos_matches =  "{\"".$photos_matches[0]."]}";
    $photos_matches = explode("dataJson: [",$photos_matches);
    $decoded = json_decode($photos_matches[1]);
    $photos_json = $decoded->data;
    foreach ($photos_json as $row) {
        echo "<br>".$row->url;
    }
}

$numItems = count($photos_json);
$i = 0;

$sql = "INSERT INTO `photos` (id_offer, url) VALUES";
foreach ($photos_json as $key=>$row) {
    $sql .= "(1,'";
    $sql .= $row->url."')";
    if(!(++$i === $numItems)) {
        $sql .= ",";
    }
}
$sql .= ";";
echo $sql;
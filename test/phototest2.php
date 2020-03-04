<?php
include_once('./../parser/simple_html_dom.php');
//include_once('./../functions.php');
//include_once('./../connection.php');

//$json = '{"data":[{"url":"https:\/\/d-gr.ppstatic.pl\/kadry\/k\/r\/gr-ogl\/24\/80\/2613984_202115698_mieszkanie-warszawa-bialoleka-ul-swiatowida_xlarge.jpg","thumb":"https:\/\/d-gr.ppstatic.pl\/kadry\/k\/r\/gr-ogl\/24\/80\/2613984_202115698_mieszkanie-warszawa-bialoleka-ul-swiatowida_small.jpg"}]}';
//$decoded = json_decode($json);
//$data = $decoded->data;
//foreach ($data as $row){
//    var_dump($row->url);
//}

//return;
$details = file_get_html("https://gratka.pl/nieruchomosci/mieszkanie-warszawa-bialoleka-ul-swiatowida/oi/2613984");

$scripts = $details->find("script");

//echo "<hr>Count:".count($scripts)."<hr>";

$photos = $scripts[32]->innertext;


echo "<hr>".$photos."<hr>";
//echo $photos."<hr>";
preg_match('/(data")\s*:([^\]]+)/', $photos, $photos);
if(isset($photos[2])){
    var_dump($photos[2]);
    echo "<hr>";
    preg_match('/"url":.+?(?=,)/', $photos[2], $p);
    echo "wynikow: ".count($p)."<hr>";
    foreach ($p as $px) {
        echo $px . "<br>";
    }
}
//            if(isset($photos[1])) $this->latitude = $latitude[1];


//foreach($scripts as $key => $s){
//        echo "<hr>nr $key<hr>".$s->innertext;
//}

/*
$description = $details->find("div[class=description__rolled ql-container]")[0]->plaintext;
print_r($description);

$details = $details->find("meta[property=og:image]");

echo "<hr>".count($details);

foreach ($details as $det){
    echo "<img src='".$det->getAttribute('content')."'>";
}
*/

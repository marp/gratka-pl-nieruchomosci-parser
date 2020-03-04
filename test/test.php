<?php
include_once('./parser/simple_html_dom.php');
include_once('./functions.php');
include_once('./connection.php');
//$details = file_get_html("https://gratka.pl/nieruchomosci/nowe-mieszkanie-lodz-ul-pogranicze-lodzi-i-konstantynowa/ob/3906911");

    $pageFrom = getLatestPageNumberFromDB($conn);
    $range = getRange();
    $latestRange = getLatestRange($conn);
    $r = $range[$latestRange];
    echo "Wywołanie: <b>".$latestRange."</b><br>";
    echo "Strona nr: <b>";
    $pageTo = $pageFrom+100;
    echo "<br>PageFrom: <b>".$pageFrom."</b> PageTo:<b>".$pageTo."</b><br>";
    for ($x = $pageFrom; $x < $pageTo; $x++) {
        echo $x . ",";
//        $min = $range[$x][0];
//        $max = $range[$x][1];
        setLastUpdatedPageNumber($conn, $x);
    }
    if($pageFrom >= getLatestPageNumber()){
        echo "Zmiena sie zakres cenowy";
        setLatestRange($conn, $latestRange+1);
        setLastUpdatedPageNumber($conn, 0);
    }
    echo "</b><br>";

    $min = $r[0];
    $max = $r[1];
    echo "Min: <b>" . $min . "</b><br>";
    echo "Max: <b>" . $max . "</b><br>";
    echo "<hr>";





return;
$range = getRange();


foreach ($range as $key => $r ) {
    echo "Wywołanie: <b>".$key."</b><br>";
    echo "Strona nr: <b>";
    for ($x = 0; $x < 312; $x++) {
        echo $x.",";
//        $min = $range[$x][0];
//        $max = $range[$x][1];
    }
    echo "</b><br>";

    $min = $r[0];
    $max = $r[1];
    echo "Min: <b>" . $min . "</b><br>";
    echo "Max: <b>" . $max . "</b><br>";
    echo "<hr>";
}
return;

$x=0;
while($x < 2500000){
    $x++;
    echo "[".$x.",";
    $x--;
    $x+=40000;
    echo $x."],<br>";

}


return;
$string = '%u05E1%u05E2';
$string = "Homest Polska Patrycja W\u0142odarczyk";
$string = preg_replace('/\\\\u([0-9A-F]+)/', '&#x$1;', $string);
echo html_entity_decode($string, ENT_COMPAT, 'UTF-8');

$string = "Homest Polska Patrycja W\u0142odarczyk";
$string = preg_replace('/\\u([0-9A-F]+)/', '&#x$1;', $string);
echo html_entity_decode($string, ENT_COMPAT, 'UTF-8');

return;
$contactForm_person = $details->find("h3");
foreach ($contactForm_person as $contactForm_persona){
 //echo "Array";
 echo $contactForm_persona->plaintext;
}
return;

$contactForm_person = $details->find('.contactForm__person', 0);
if($contactForm_person){
    $contactForm_person = $contactForm_person->plaintext;
    $contactForm_person = $contactForm_person;
    $contactForm_companyName = null;
    echo "<br><br>OSOBA: ".$contactForm_person."<br><br>";
    echo "<br><br>FIRMA: ".$contactForm_companyName."<br><br>";
}else{

    $contactForm_companyName = $details->find('h3.contactForm__companyName', 0);
    $contactForm_companyName = $contactForm_companyName->plaintext;
    var_dump($contactForm_companyName);
    $contactForm_person = null;
    echo "<br><br>OSOBA: ".$contactForm_person."<br><br>";
    echo "<br><br>FIRMA: ".$contactForm_companyName."<br><br>";
}
//foreach($results as $res){
//        var_dump($res->outertext);
//}

//var_dump($results[38]->outertext);

//var_dump($results->outertext);


//preg_match('/.lokalizacja.szerokosc.geograficzna-y..([\d]+.[\d]+)/', $results->outertext, $latitude);
//$latitude = $latitude[1];
//echo "SZEREKOSC: ".$latitude;
//
//echo "<br>";
//
//preg_match('/.lokalizacja.dlugosc.geograficzna-x..([\d]+.[\d]+)/', $results->outertext, $longitude);
//$longitude = $longitude[1];
//echo "DLUGOSC: ".$longitude;



//var_dump($results->outertext);
//
//$results = htmlentities($results->outertext);
//var_dump($results);
//$abc = explode(":", $results);
//var_dump($abc);
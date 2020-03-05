<?php
set_time_limit(1200); //20minut;
ini_set("default_socket_timeout",9999);
include_once('./parser/simple_html_dom.php');
include_once('./offer.php');
include_once('./functions.php');
include_once('./connection.php');

    $stmt = $conn->query("SELECT * FROM `sites` WHERE `domain` = \"https://gratka.pl/nieruchomosci\"");
    $stmt = $stmt->fetch(PDO::FETCH_BOTH);
    $queryLastUpdated = $stmt['last_updated'];
    $queryLastPage = $stmt['last_page'];
    $pagesToUpdate = 10;
    $range = getRange();

    if($queryLastPage==0){

        setLatestPageNumber($conn, getLatestPageNumber($range[getLatestRange($conn)][0],$range[getLatestRange($conn)][1]));
        $stmt = $conn->query("SELECT * FROM `sites` WHERE `domain` = \"https://gratka.pl/nieruchomosci\"");
        $stmt = $stmt->fetch(PDO::FETCH_BOTH);
        $queryLastUpdated = $stmt['last_updated'];
        $queryLastPage = $stmt['last_page'];
    }

    if($queryLastUpdated >= $queryLastPage){
        echo "Last pg:".$queryLastPage."<br>Last update".$queryLastUpdated;
        setLastUpdatedPageNumber($conn, 0);
    }else{
        echo "<br>LastUpdated: " . $queryLastUpdated . "<br>";
        echo "LastPage: " . $queryLastPage . "<br>";
    }


    if(($queryLastPage - $queryLastUpdated) < $pagesToUpdate){
//        print_r($queryLastPage);
//        print_r($queryLastUpdated);
        echo "Zostalo mniej niz 10 stron, wykona sie".($queryLastPage-$queryLastUpdated)."stron";
        $pagesToUpdate = ($queryLastPage-$queryLastUpdated);

        //for debug purposes
    }else{
        echo "Zostalo duzo stron, wiec wykona sie ".$pagesToUpdate." stron.";
    }
    $pageFrom = $queryLastUpdated;
    $pageTo = $pageFrom+$pagesToUpdate;
    $pageSort = 'newest';

    $objects = [];
    $range = getRange();
    $latestRange = getLatestRange($conn);
    $r = $range[$latestRange];

    for($pageNumber=$pageFrom; $pageNumber<=$pageTo; $pageNumber++){
        echo "<p style='color:red'>Strona nr: ".$pageNumber."</p><br><br>";
        $priceMin = $r[0];
        $priceMax = $r[1];
    $page = 'https://gratka.pl/nieruchomosci/sprzedaz?cena-calkowita:min='.$priceMin.'&cena-calkowita:max='.$priceMax.'&page='.$pageNumber.'&sort='.$pageSort;
    echo $page;


    $html = file_get_html($page);

    echo "<br>PageFrom: <b>".$pageFrom."</b> PageTo:<b>".$pageTo."</b><br>";
    foreach($html->find('article.teaser') as $el) {
        //$title = $el->find('a')[0]->getAttribute('href');
        //$title = $el->find('h2.teaser__title')[0]->find('a.teaser__anchor')[0]->plaintext;

        //START
        $deleteChars = [" ", ",", ".", "!"];
        $title_toCheck = str_replace($deleteChars, "", $el->find("a.teaser__anchor", 0)->plaintext); // wyczyszczenie tytułu - PRZY SPRAWDZANIU NIE UWZGLĘDNIAMY ZNAKÓW INTERPUNKCYJNYCH

        $objects[] = new offer($el);
        $last = count($objects);
        $last -= 1;
        $objects[$last]->downloadDetails();


        //if (array_key_exists('latitude', $objects[$last])) //jeśli mamy lat/lng
        if ($objects[$last]->latitude) //jeśli mamy lat/lng
        {
            //sprawdzamy po lat/lng, cenie, tytule. Jeśli jest - nie dodajemy
            $stmt_skip = $conn->prepare("SELECT ID FROM offers WHERE latitude = ? AND longitude = ? AND price = ? AND REPLACE(REPLACE(REPLACE(REPLACE(title, ' ', ''), ',', ''), '.', ''), '!', '') LIKE ?");
            $stmt_skip->execute([$objects[$last]->latitude, $objects[$last]->longitude, $objects[$last]->price, $title_toCheck]);
            if($stmt_skip->rowCount()) {
                //return;
                echo "Duplikat. Pomijanie...";
            }else{
                $objects[$last]->save($conn);
            }
        }
        else
        {
            // jeśli nie ma lat - sprawdzamy po cenie,tytule, adresie
            $arrVal = array($objects[$last]->price, $title_toCheck, $objects[$last]->map_address);
            $sql = "SELECT ID FROM offers WHERE price = ? AND REPLACE(REPLACE(REPLACE(REPLACE(title, ' ', ''), ',', ''), '.', ''), '!', '') LIKE ? AND map_address = ?";

            $stmt_skip = $conn->prepare($sql);
            $stmt_skip->execute($arrVal);
            if($stmt_skip->rowCount()) {
                //return;
                echo "<span style=\"color:gray;\">Duplikat. Pomijanie...</span>";
            }else{
                $objects[$last]->save($conn);
            }
        }
//
//            $sql = "SELECT * FROM `offers` WHERE `title`= :title";
//            //echo "<pre>".$title."</pre>";
//            $stmt = $conn->prepare($sql);
//            $stmt->bindParam(":title",$title);
//            $stmt->execute();
//            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
//            $number_of_rows = count($results);
            echo "<hr>";
    }
    if($pageNumber >= getLatestPageNumberFromDB($conn)){
         echo "Page: $pageNumber >= ".getLatestPageNumberFromDB($conn)."<br>Zmiena sie zakres cenowy";
         setLatestRange($conn, $latestRange+1);
         setLastUpdatedPageNumber($conn, 0);
         setLatestPageNumber($conn, 0);
    }
    $stmt = $conn->prepare('UPDATE `sites` SET `last_updated` = '.$pageNumber.' WHERE `id`=1');
    $stmt = $stmt->execute();
    echo "Skrypt zakonczony.";
    }
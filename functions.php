<?php

function getLatestPageNumber($priceMin, $priceMax){
//    $page = 'https://gratka.pl/nieruchomosci?page=1';
    $page = 'https://gratka.pl/nieruchomosci/sprzedaz?cena-calkowita:min='.$priceMin.'&cena-calkowita:max='.$priceMax.'&page=1&sort=newest';
    $html = file_get_html($page);
    return $html->find('div.pagination', 0)->find('a', 4)->plaintext;
}

function getLatestPageNumberFromDB($conn){
    $stmt = $conn->query("SELECT * FROM `sites` WHERE `domain` = \"https://gratka.pl/nieruchomosci\"");
    $stmt = $stmt->fetch(PDO::FETCH_BOTH);
    return $stmt['last_page'];
}

function setLatestPageNumber($conn, $pageNumber){
    $stmt = $conn->prepare('UPDATE `sites` SET `last_page` = '.$pageNumber.' WHERE `id`=1');
    $stmt = $stmt->execute();
}

function setLastUpdatedPageNumber($conn, $pageNumber){
    $stmt = $conn->prepare('UPDATE `sites` SET `last_updated` = '.$pageNumber.' WHERE `id`=1');
    $stmt = $stmt->execute();
}

function getRange(){
    return [
        [0,40000],
        [40001,80000],
        [80001,120000],
        [120001,160000],
        [160001,200000],
        [200001,240000],
        [240001,280000],
        [280001,320000],
        [320001,360000],
        [360001,400000],
        [400001,440000],
        [440001,480000],
        [480001,520000],
        [520001,560000],
        [560001,600000],
        [600001,640000],
        [640001,680000],
        [680001,720000],
        [720001,760000],
        [760001,800000],
        [800001,840000],
        [840001,880000],
        [880001,920000],
        [920001,960000],
        [960001,1000000],
        [1000001,1040000],
        [1040001,1080000],
        [1080001,1120000],
        [1120001,1160000],
        [1160001,1200000],
        [1200001,1240000],
        [1240001,1280000],
        [1280001,1320000],
        [1320001,1360000],
        [1360001,1400000],
        [1400001,1440000],
        [1440001,1480000],
        [1480001,1520000],
        [1520001,1560000],
        [1560001,1600000],
        [1600001,1640000],
        [1640001,1680000],
        [1680001,1720000],
        [1720001,1760000],
        [1760001,1800000],
        [1800001,1840000],
        [1840001,1880000],
        [1880001,1920000],
        [1920001,1960000],
        [1960001,2000000],
        [2000001,2040000],
        [2040001,2080000],
        [2080001,2120000],
        [2120001,2160000],
        [2160001,2200000],
        [2200001,2240000],
        [2240001,2280000],
        [2280001,2320000],
        [2320001,2360000],
        [2360001,2400000],
        [2400001,2440000],
        [2440001,2480000],
        [2480001,999999999],
        ];
}

function getLatestRange($conn){
    $stmt = $conn->prepare('SELECT `price_range` FROM `sites`');
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results[0]["price_range"];
}

function setLatestRange($conn, $range){
    $stmt = $conn->prepare('UPDATE `sites` SET `price_range` = '.$range.' WHERE `id`=1');
    $stmt = $stmt->execute();
}
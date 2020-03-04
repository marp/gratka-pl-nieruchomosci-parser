<?php
    include_once('./parser/simple_html_dom.php');
    include_once('./connection.php');


    $pageNumber = 1;
    $pageSort = 'newest';
    $page = 'https://gratka.pl/nieruchomosci?page='.$pageNumber.'&sort='.$pageSort;

    $html = file_get_html($page);
    
    echo "<hr>";
    
    foreach($html->find('article.teaser') as $el){
        $url = $el->find('a');
        $url = $url[0]->getAttribute('href');


        $img = $el->find('img');
        $img = $img[0]->getAttribute('data-src');

        $title = $el->find('h2.teaser__title');
        $title = $title[0]->plaintext;
        
        $location = $el->find('h3.teaser__location');
        $location = $location[0]->plaintext;
        str_replace( "\n" , '', $location );
        $geo_level = explode(",", $location);
        $geo_level_1 = $geo_level[0];
        if(isset($geo_level[2])){
            $geo_level_2 = $geo_level[1];
            $geo_level_3 = $geo_level[2];
        }else{
            $geo_level_2 = $geo_level[1];
            $geo_level_3 = null;
        }

        $params = $el->find('ul.teaser__params');
        $params = $params[0]->plaintext;
        
        $price = $el->find('p.teaser__price');
        $price = $price[0]->plaintext;
        $price = explode("zł", $price);
        $price = $price[0];

        $area= $el->find('ul.teaser__params');
        $area = $area[0]->plaintext;
        $areaPattern = '/Powierzchnia w m2\: ([\d\.]+)/';
        preg_match ( $areaPattern , $area, $area);
        if(!isset($area[1])){
            $area = null;
        }
        $area = (int)$area[1];
        
        $stmt = $conn->prepare("INSERT INTO `offers` (`id_domain`, `title`, `geo_level_1`, `geo_level_2`,`geo_level_3`, `price`, `price_currency`)	VALUES(
        1,
        :title,
        :geo_level_1,
        :geo_level_2,
        :geo_level_3,
        :price,
        :price_currency

        );");
        
        $stmt->execute([
            ':title' => $title,
            ':geo_level_1' => $geo_level_1,
            ':geo_level_2' => $geo_level_2,
            ':geo_level_3' => $geo_level_3,
            ':price' => $price,
            ':price_currency' => 'zł'
        ]);
		if($stmt->rowCount() > 0)
		{
			echo 'Dodano: '.$stmt->rowCount().' rekordow';
		}
		else
		{
			echo 'Wystąpił błąd podczas dodawania rekordów!';
		}
        $add = null;


        $id_offer = $conn->lastInsertId();

        $stmt = $conn->prepare("INSERT INTO `links` (`id_domain`, `own_id_offer`, `url`)	VALUES(
        :id_domain,
        :own_id_offer,
        :url
        );");

        $stmt->execute([
            ':id_domain' => 1,
            ':own_id_offer' => $id_offer,
            ':url' => $url,
        ]);
        if($stmt->rowCount() > 0)
        {
            echo 'Dodano: '.$stmt->rowCount().' rekordow';
        }
        else
        {
            echo 'Wystąpił błąd podczas dodawania rekordów!';
        }
        $add = null;

        $stmt = $conn->prepare("INSERT INTO `photos` (`id_offer`, `url`)	VALUES(
        :id_offer,
        :url
        );");

        $stmt->execute([
            ':id_offer' => $id_offer,
            ':url' => $img,
        ]);
        if($stmt->rowCount() > 0)
        {
            echo 'Dodano: '.$stmt->rowCount().' rekordow';
        }
        else
        {
            echo 'Wystąpił błąd podczas dodawania rekordów!';
        }
        $add = null;

    }
<?php
include_once('./parser/simple_html_dom.php');

    class offer{
        public $id;
        public $url = '';
        public $title = '';
        public $img = '';
        public $photos;
        public $description;
        public $location;
        public $params;
        public $area;
        public $price;
        public $phone;
        public $offerOwner;

        //details
        public $terrain_area;
        public $rooms_num;
        public $building_ownership;
        public $build_year;
        public $building_material;
        public $construction_status;
        public $floor_no;
        public $building_floors_num;
        public $windows_type;
        public $building_type;

        public $latitude;
        public $longitude;

        public $map_address;

        public $person;
        public $company_name;

        public function __construct($el){
            $this->url = $el->find('a', 0)->getAttribute('href');

            $this->title = $el->find('h2.teaser__title', 0)->find('a.teaser__anchor', 0)->plaintext;
            echo "<br>Tajtle: ".$this->title;

            $this->location = @$el->find('h3.teaser__location', 0)->plaintext;

            $this->params = $el->find('ul.teaser__params', 0)->plaintext;


            $price = $el->find('p.teaser__price', 0)->plaintext;
            $price = explode("zł", $price);
            $price = $price[0];
            $price = str_replace(" ", "", $price);
            if(is_numeric($price)) {
                $this->price = $price;
            }else{
                $this->price = 0; //jesli cena nie jest podana
            }

            $area= $el->find('ul.teaser__params', 0)->plaintext;
            $areaPattern = '/Powierzchnia w m2\: ([\d\.]+)/';
            preg_match ( $areaPattern , $area, $area);
            if(!isset($area[1])){
                $this->area = 0;
            }else {
                $this->area = (int)$area[1];
            }


        }

        public function downloadDetails(){
            $details = file_get_html($this->url);
            $scripts_array = $details->find('script');
            $scripts = "";
            foreach ($scripts_array as $s){
                echo "Scripts:".count($scripts_array);

                $scripts .= $s->innertext;
            }

            //$photos = $details->find("script",32)->innertext;

            preg_match('/dataJson\s*:\s*([^\]]+)/', $scripts, $photos_matches);
            if(isset($photos_matches[0])){
                $photos_matches =  "{\"".$photos_matches[0]."]}";
                $photos_matches = explode("dataJson: [",$photos_matches);
                $decoded = json_decode($photos_matches[1]);
                $this->photos = $decoded->data;
//                foreach ($photos_json as $row) {
//                    echo "<br>".$row->url;
//                }
            }else{
                $this->photos = null;
                echo "<br><b>Ustawianie zdjec na null</b>";
            }

            $uri_segments = explode('/', $this->url);

            $this->id = $uri_segments[6];

            $this->description = $details->find("div[class=description__rolled ql-container]",0);
            if($this->description) {
                $this->description = strip_tags($this->description->plaintext);
                $this->description = trim($this->description);
            }else{
                $this->description = "";
            }

            //OLD PHONE GETTER
            $this->phone = $details->find('a#pokaz-numer-gora', 0);
            if($this->phone){
                $this->phone = $this->phone->getAttribute('data-full-phone-number');
            }
            $this->phone = str_replace("+48","", $this->phone);
            $this->phone = str_replace(" ","", $this->phone);



            $terrain = $details->find('ul.parameters__rolled', 0);
            $terrainPlainText = $terrain->plaintext;
            $terrainAreaPattern = 'Powierzchnia działki w m2';
            $terrainExists = strpos($terrainPlainText ,$terrainAreaPattern);
            if ($terrainExists == true){
                echo "terrain found at position: " . $terrainExists."<br>";
                $terrainElement = $terrain->find('li',3);
                //echo $terrainElement->plaintext;
                if(strpos($terrainElement->plaintext, "Powierzchnia działki w m2")==true){
                    $terrainElement = $terrainElement->find('b',0)->plaintext;
                    preg_match_all('!\d+!', $terrainElement, $this->terrain_area);
                    $this->terrain_area = $this->terrain_area[0][0];
                }
            }

            $rooms_num = $details->find('ul.parameters__rolled', 0)->plaintext;
            $rooms_num = preg_replace('!\s+!', ' ', $rooms_num );
            $areaPattern = '/Liczba pokoi ([\d]+)/';
            preg_match ( $areaPattern , $rooms_num, $rooms_numMatches);
            if(!isset($rooms_numMatches[1])){
                $this->rooms_num = null;
            }else {
                $this->rooms_num = (int)$rooms_numMatches[1];

            }

            $build_year = $details->find('ul.parameters__rolled', 0)->plaintext;
            $build_year = preg_replace('!\s+!', ' ', $build_year );
            $areaPattern = '/Rok budowy ([\d]+)/';
            preg_match ( $areaPattern , $build_year, $build_yearMatches);
            if(!isset($build_yearMatches[1])){
                $this->build_year = null;
            }else {
                $this->build_year = (int)$build_yearMatches[1];
            }

            $building_material = $details->find('ul.parameters__rolled', 0)->plaintext;
            $building_material = preg_replace('!\s+!', ' ', $building_material );
            $areaPattern = '/Materiał budynku ([A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]+)/';
            preg_match ( $areaPattern , $building_material, $building_materialMatches);
            if(!isset($building_materialMatches[1])){
                $this->building_material = null;
            }else {
                $this->building_material = (string)$building_materialMatches[1];
            }

            $building_ownership = $details->find('ul.parameters__rolled', 0)->plaintext;
            $building_ownership = preg_replace('!\s+!', ' ', $building_ownership );
            $areaPattern = '/Forma własności ([A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]+)/';
            preg_match ( $areaPattern , $building_ownership, $building_ownershipMatches);
            if(!isset($building_ownershipMatches[1])){
                $this->building_ownership = null;
            }else {
                $this->building_ownership = (string)$building_ownershipMatches[1];
            }

            $construction_status = $details->find('ul.parameters__rolled', 0)->plaintext;
            $construction_status = preg_replace('!\s+!', ' ', $construction_status );
            $areaPattern = '/Stan ([A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]+)/';
            preg_match ( $areaPattern , $construction_status, $construction_statusMatches);
            if(!isset($construction_statusMatches[1])){
                $this->construction_status = null;
            }else {
                $this->construction_status = (string)$construction_statusMatches[1];
            }

            $windows_type = $details->find('ul.parameters__rolled', 0)->plaintext;
            $windows_type = preg_replace('!\s+!', ' ', $windows_type );
            $areaPattern = '/Okna ([A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]+)/';
            preg_match ( $areaPattern , $windows_type, $windows_typeMatches);
            if(!isset($windows_typeMatches[1])){
                $this->windows_type = null;
            }else {
                $this->windows_type = (string)$windows_typeMatches[1];
            }

            $floor_no = $details->find('ul.parameters__rolled', 0)->plaintext;
            $floor_no = preg_replace('!\s+!', ' ', $floor_no );
            $areaPattern = '/Piętro ([\d]+)/';
            preg_match ( $areaPattern , $floor_no, $floor_noMatches);
            if(!isset($floor_noMatches[1])){
                $this->floor_no = null;
            }else {
                $this->floor_no = (int)$floor_noMatches[1];
            }

            $building_floors_num = $details->find('ul.parameters__rolled', 0)->plaintext;
            $building_floors_num = preg_replace('!\s+!', ' ', $building_floors_num );
            $areaPattern = '/Liczba pięter w budynku ([\d]+)/';
            preg_match ( $areaPattern , $building_floors_num, $building_floors_numMatches);
            if(!isset($building_floors_numMatches[1])){
                $this->building_floors_num = null;
            }else {
                $this->building_floors_num = (int)$building_floors_numMatches[1];
            }

            $building_type = $details->find('ul.parameters__rolled', 0)->plaintext;
            $building_type = preg_replace('!\s+!', ' ', $building_type );
            $areaPattern = '/Typ zabudowy ([A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]+)/';
            preg_match ( $areaPattern , $building_type, $building_typeMatches);
            if(!isset($building_typeMatches[1])){
                $this->building_type = null;
            }else {
                $this->building_type = (string)$building_typeMatches[1];
            }

            $this->company_name = null;
            $company = $details->find('script', 39);
            preg_match('/"company":"(.*?)"/', $company->innertext, $company);
            if(isset($company[1])){
                $company = preg_replace('/\\\\u([0-9A-F]+)/', '&#x$1;', $company[1]);
                $company= html_entity_decode($company, ENT_COMPAT, 'UTF-8');
//                var_dump($company);
                $this->company_name = $company;
                $this->offerOwner = "Agencja";
            }else{
                $this->company_name = null;
                $this->offerOwner = "Osoba fizyczna";
            }

            $this->person = null;
            $person = $details->find('script', 39);
            preg_match('/"person":"(.*?)"/', $person->innertext, $person);
            if(isset($person[1])){
                $person = preg_replace('/\\\\u([0-9A-F]+)/', '&#x$1;', $person[1]);
                $person = html_entity_decode($person, ENT_COMPAT, 'UTF-8');
                $this->person = $person;
            }else{
                $this->person = null;
            }

            $building_type = preg_replace('!\s+!', ' ', $building_type );
            $areaPattern = '/Typ zabudowy ([A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]+)/';
            preg_match ( $areaPattern , $building_type, $building_typeMatches);
            if(!isset($building_typeMatches[1])){
                $this->building_type = null;
            }else {
                $this->building_type = (string)$building_typeMatches[1];
            }


            preg_match('/.lokalizacja.szerokosc.geograficzna-y..([\d]+.[\d]+)/', $scripts, $latitude);
            if(isset($latitude[1])){
                $this->latitude = $latitude[1];
            }else{
                $this->latitude = null;
            }
            preg_match('/.lokalizacja.dlugosc.geograficzna-x..([\d]+.[\d]+)/', $scripts, $longitude);
            if(isset($longitude[1])){
                $this->longitude = $longitude[1];
            }else{
                $this->longitude = null;
            }
            echo "<br>Latitude: <b>".$this->latitude."</b>";
            echo "<br>Longitude: <b>".$this->longitude."</b>";





        }

        public function save($conn){


            $stmt = $conn->prepare("INSERT INTO `users` (`id_domain`, `name`, `company_name`, `phone` ) VALUES(
                                                                                          :id_domain,
                                                                                          :name,
                                                                                          :company_name, 
                                                                                          :phone
            );");

            $stmt->execute([
                ':id_domain' => 1,
                ':name' => $this->person,
                ':company_name' => $this->company_name,
                ':phone' => $this->phone
            ]);
            if($stmt->rowCount() > 0)
            {
                echo 'Dodano: '.$stmt->rowCount().' rekordow do `users`<br>';
            }
            else
            {
                echo 'Wystąpił błąd podczas dodawania rekordów!';
            }
            $add = null;
            $id_user = $conn->lastInsertId();




            str_replace( "\n" , '', $this->location );
            $geo_level = explode(",", $this->location);
            $geo_level_1 = trim($geo_level[0]);
            if(isset($geo_level[2])){
                $geo_level_2 = trim($geo_level[1]);
                $geo_level_3 = trim($geo_level[2]);
                $this->map_address = $geo_level_1.",".$geo_level_2.",".$geo_level_3;
            }else{
                $geo_level_2 = trim($geo_level[1]);
                $this->map_address = $geo_level_1.",".$geo_level_2;
                $geo_level_3 = null;
            }

            $stmt = $conn->prepare("INSERT INTO offers (id_domain, own_id_offer, title, description, geo_level_1, geo_level_2,geo_level_3, price, price_currency, latitude, longitude, offerOwner, phone, person_id, area)	VALUES(
            1,
            :own_id_offer,                                                                                                                                                           
            :title,
            :description,                                                                                                                              
            :geo_level_1,
            :geo_level_2,
            :geo_level_3,
            :price,
            :price_currency,
            :latitude,                                                                                                                   
            :longitude,
            :offerOwner,      
            :phone,
            :person_id,                                                                                                                                                                                  
            :area                                                                                                                   
            );");

            $stmt->execute([
                ':own_id_offer' => $this->id,
                ':title' => $this->title,
                ':description' => $this->description,
                ':geo_level_1' => $geo_level_1,
                ':geo_level_2' => $geo_level_2,
                ':geo_level_3' => $geo_level_3,
                ':price' => $this->price,
                ':price_currency' => 'zł',
                ':latitude' => $this->latitude,
                ':longitude' => $this->longitude,
                ':offerOwner' => $this->offerOwner,
                ':phone' => $this->phone,
                ':person_id' => $id_user,
                ':area' => $this->area

            ]);
            if($stmt->rowCount() > 0)
            {
                echo 'Dodano: '.$stmt->rowCount().' rekordow do `offers`<br>';
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
                ':url' => $this->url,
            ]);
            if($stmt->rowCount() > 0)
            {
                echo 'Dodano: '.$stmt->rowCount().' rekordow do `links`<br>';
            }
            else
            {
                echo 'Wystąpił błąd podczas dodawania rekordów!';
            }
            $add = null;

            if($this->photos != null) {
                $numItems = count($this->photos);
                $i = 0;

                $sql = "INSERT INTO `photos` (id_offer, url) VALUES";
                foreach ($this->photos as $key => $row) {
                    $sql .= "(".$id_offer.",'";
                    $sql .= $row->url . "')";
                    if (!(++$i === $numItems)) {
                        $sql .= ",";
                    }
                }
                $sql .= ";";

                $stmt = $conn->prepare($sql);

                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    echo 'Dodano: ' . $stmt->rowCount() . ' rekordow do `photos`<br>';
                } else {
                    echo 'Wystąpił błąd podczas dodawania rekordów!';
                }
                $add = null;
            }else{
                echo "<br><b style=\"color:blue;\">NIE ZNALEZIONO ZDJĘĆ!</b>";
            }

            $stmt = $conn->prepare("INSERT INTO `details` (`id_offer`, `id_domain`, `terrain_area`, `rooms_num`, `build_year`, `building_material`, `building_ownership`, `construction_status`, `building_floors_num`, `floor_no`, `windows_type`, `building_type`) VALUES(
            :id_offer,
            :id_domain,
            :terrain_area,
            :rooms_num,
            :build_year,
            :building_material,
            :building_ownership,
            :construction_status,
            :building_floors_num,                                                                                                                                                                               
            :floor_no,
            :windows_type,                                                                                                                                                                                           
            :building_type                                                                                                                                                                                           
                                                                                                                            
            );");

            $stmt->execute([
                ':id_offer' => $id_offer,
                ':id_domain' => 1,
                ':terrain_area' => $this->terrain_area,
                ':rooms_num' => $this->rooms_num,
                ':build_year' => $this->build_year,
                ':building_material' => $this->building_material,
                ':building_ownership' => $this->building_ownership,
                ':construction_status' => $this->construction_status,
                ':building_floors_num' => $this->building_floors_num,
                ':floor_no' => $this->floor_no,
                ':windows_type' => $this->windows_type,
                ':building_type' => $this->building_type
            ]);
            if($stmt->rowCount() > 0)
            {
                echo 'Dodano: '.$stmt->rowCount().' rekordow do `terrain_area`<br>';
            }
            else
            {
                echo 'Wystąpił błąd podczas dodawania rekordów!';
            }
            $add = null;



        }
    }
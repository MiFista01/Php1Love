<?php
    class ModelEstates {
        public static function getThreeEstates() {
            $database = new database();
            $photo = $database -> getAll("SELECT * FROM photo ORDER BY id ASC");
            if($photo == null) return;
            $estates = $database -> getAll("SELECT * FROM object ORDER BY id DESC LIMIT 3");
            if($estates == null) return;
            for ($i = 0; $i < count($estates); $i++) { 
                $cityId = $database -> getOne("SELECT *, city.name as city FROM object 
                    INNER JOIN city on object.cityId = city.id AND object.id = ".$estates[$i]['id']);
                $estates[$i]['city'] = $cityId['name'];

                $fav = $database->getOne("SELECT * FROM fav 
                    WHERE userId = ".$_SESSION['userId']." AND objectId = ".$estates[$i]['id']);
                if($fav == null) { 
                    $estates[$i]['fav'] = 'no'; 
                } else { 
                    $estates[$i]['fav'] = 'yes';
                }
            };
            return [$estates, $photo];
       }
        public static function getThreeOffers() {
            $database = new database();
            $photo = $database -> getAll("SELECT * FROM photo ORDER BY id ASC");
            if($photo == null) return;
            $estates = $database -> getAll("SELECT * FROM object WHERE offer = 1 ORDER BY id DESC LIMIT 3");
            if($estates == null) return;
            for ($i = 0; $i < count($estates); $i++) { 
                $cityId = $database -> getOne("SELECT *, city.name as city FROM object 
                    INNER JOIN city on object.cityId = city.id AND object.id = ".$estates[$i]['id']);
                $estates[$i]['city'] = $cityId['name'];

                $fav = $database->getOne("SELECT * FROM fav 
                    WHERE userId = ".$_SESSION['userId']." AND objectId = ".$estates[$i]['ownerId']);
                if($fav == null) { 
                    $estates[$i]['fav'] = 'no'; 
                } else { 
                    $estates[$i]['fav'] = 'yes';
                }
            };
            return [$estates, $photo];
       }
       public static function getEstates() {
            $database = new database();
            $photo = $database -> getAll("SELECT * FROM photo ORDER BY id ASC");
            if($photo == null) return;
            $estates = $database -> getAll("SELECT * FROM object ORDER BY id ASC");
            if($estates == null) return;
            for ($i = 0; $i < count($estates); $i++) { 
                $cityId = $database -> getOne("SELECT *, city.name as city FROM object 
                INNER JOIN city on object.cityId = city.id AND object.id = ".$estates[$i]['id']);
                $estates[$i]['city'] = $cityId['name'];

                $fav = $database->getOne("SELECT * FROM fav 
                    WHERE userId = ".$_SESSION['userId']." AND objectId = ".$estates[$i]['ownerId']);
                if($fav == null) { 
                    $estates[$i]['fav'] = 'no'; 
                } else { 
                    $estates[$i]['fav'] = 'yes';
                }
            };
            return [$estates, $photo];
       }
       public static function getFavourites() {
            $database = new database();
            $photo = $database -> getAll("SELECT * FROM photo ORDER BY id ASC");
            if($photo == null) return;
            $favourites = $database -> getAll("SELECT * FROM fav WHERE userId = ".$_SESSION['userId']." ORDER BY id ASC");
            if($favourites == null) return;
            $estates = array();
            for ($i = 0; $i < count($favourites); $i++) {
                $estate = $database -> getOne("SELECT * FROM object WHERE id = ".$favourites[$i]['objectId']);
                $city = $database -> getOne("SELECT city.name as city FROM object 
                    INNER JOIN city on object.cityId = city.id AND object.id = ".$estate['id']);
                $estate['cityId'] = $city['name'];
                array_push($estates, $estate);
            };
            return [$estates, $photo];
        }
    }
?>
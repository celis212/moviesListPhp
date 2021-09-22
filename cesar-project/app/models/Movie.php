<?php
    /*
    * searches, gets and registers in the database 
    */
    class Movie {
        private $db_json;

        public function __construct(){
            $this->db_json = new Database('dbmovies');
        }

        // Register movies
        public function register($dataInfo){
            $db_data = $this->db_json->getDatabase();
            $input = array(
                'movie' => $dataInfo['api'],
            );
            $db_data = $input;
            file_put_contents(APPDIRECTION . '/database/dbmovies.json', json_encode($db_data, JSON_PRETTY_PRINT));
        }

        public function searchMovieTitle($movieInfo){
            $db_data = $this->db_json->getDatabase();
            //print_r($db_data);
            $db_data = $db_data['movie'];
            //print_r($db_data);
            
            if($db_data){
                $movies = [];

                //search by title
                echo $movieInfo['titleSearch'];
                if($movieInfo['titleSearch']){
                    foreach($db_data as $movie){
                        if(strpos(strtolower($movie['Title']), strtolower($movieInfo['titleSearch'])) > -1){
                            $movies[] = $movie; 
                        }
                    }

                }else{
                    $movies = $db_data;
                }

                if($movieInfo['dateStart'] < $movieInfo['dateEnd']){
                    $db_data = $movies;
                    $movies = [];
                    foreach($db_data  as $movie){
                        //echo $movie['Year'].'/'.$movieInfo['dateStart'].'/'.$movie['Year'].'/'.$movieInfo['dateEnd'];
                        if($movie['Year'] >= $movieInfo['dateStart'] && $movie['Year'] <= $movieInfo['dateEnd']){
                            $movies[] = $movie; 
                        }
                    }
                }

                
                //print_r($movies);
                if($movieInfo['sortBy'] == 'Title'){
                    if($movieInfo['when'] == 'asc'){
                        usort($movies, function ($a, $b) use($movieInfo) {return strcmp($a['Title'] ,  $b['Title'] );});
                    } else{
                        usort($movies, function ($a, $b) use($movieInfo) {return strcmp($b['Title'] ,  $a['Title'] );});
                    }
                } else{
                    if($movieInfo['when'] == 'asc'){
                        usort($movies, function ($a, $b) use($movieInfo) {return (intval($a['Year'])  - intval($b['Year']) );});
                    } else{
                        usort($movies, function ($a, $b) use($movieInfo) {return (intval($b['Year'])  - intval($a['Year']) );});
                    }
                }
            }
            //print_r($movies);
            return $movies;
        }

        //call the info 
        public function getMovies(){
            return $this->databaseInfo->getDatabase();
        }




        /*// Search movie title
        public function ($movieName){
            $db_data = $this->db_json->getDatabase();
            $moviesName = [];
            if($db_data){
                foreach($db_data['movie'] as $movie){
                    if(strpos(strtolower($movie['Title']), strtolower($movieName)) > -1){
                        $moviesName = $movie; 
                    }
                }
                if(count($moviesName) > 0){
                    return $moviesName;
                }else{
                    return false;
                }
            }
            return false;
        }
    
        // Search movies range date
        public function searchMovieDate($createdDate){
            $db_data = $this->databaseInfo->getDatabase();

            $moviesYear = [];

            if($db_data){
                foreach($db_data['movie'] as $movie){
                    $year = explode('-', $movie['Year']);
                    $year = intval(trim($year[0]));

                    if($year >= intval($createdDate[0]) && $year <= intval($createdDate[1])){
                        $moviesYear[] = $movie; 
                    }
                }

                if(count($moviesYear) > 0){
                    return $moviesYear;
                }else{
                    return false;
                }
            }
        }*/

        
    
}
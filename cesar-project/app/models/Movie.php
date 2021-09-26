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

        //search in the list 
        public function searchMovieTitle($movieInfo){
            $db_data = $this->db_json->getDatabase();
            $movies = [];

            if(!empty($db_data['movie'])){
                $db_data = $db_data['movie'];

                //search by title
                if($movieInfo['titleSearch']){
                    foreach($db_data as $movie){
                        if(strpos(strtolower($movie['Title']), strtolower($movieInfo['titleSearch'])) > -1){
                            $movies[] = $movie; 
                        }
                    }
                }else{
                    $movies = $db_data;
                }

                //search betwwen years 
                if($movieInfo['dateStart'] < $movieInfo['dateEnd']){
                    $db_data = $movies;
                    $movies = [];
                    foreach($db_data  as $movie){
                        if($movie['Year'] >= $movieInfo['dateStart'] && $movie['Year'] <= $movieInfo['dateEnd']){
                            $movies[] = $movie; 
                        }
                    }
                }

                //sort by title ascending or descending  
                if($movieInfo['sortBy'] == 'Title'){
                    if($movieInfo['when'] == 'asc'){
                        usort($movies, function ($a, $b) {
                            return strcmp($a['Title'] ,  $b['Title'] );
                        });
                    } else{
                        usort($movies, function ($a, $b) {
                            return strcmp($b['Title'] ,  $a['Title'] );
                        });
                    }
                } 
                ////sort by year ascending or descending  
                else{
                    if($movieInfo['when'] == 'asc'){
                        usort($movies, function ($a, $b) {
                            return (intval($a['Year']) - intval($b['Year']));
                        });
                    } else{
                        usort($movies, function ($a, $b) {
                            return (intval($b['Year']) - intval($a['Year']));
                        });
                    }
                }
            }
            return $movies;
        }

        //call the info 
        public function getMovies(){
            return $this->databaseInfo->getDatabase();
        }
}
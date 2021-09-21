<?php
    /*
    * searches, gets and registers in the database 
    */
    class Movie {
        private $databaseInfo;

        public function __construct(){
            $this->databaseInfo = new Database('dbmovies');
        }

        // Register movies
        public function register($dataInfo){
            echo 'uno'; 
            $db_json = $this->databaseInfo->getDatabase();
            $input = array(
                'movie' => $dataInfo['api'],
            );
            $db_json = $input;
            file_put_contents(APPDIRECTION . '/database/dbmovies.json', json_encode($db_json, JSON_PRETTY_PRINT));
        }

        // Search movie title
        public function searchMovieTitle($movieName){
            $db_json = $this->databaseInfo->getDatabase();
            $moviesName = [];
            if($db_json){
                foreach($db_json['movie'] as $movie){
                    if(strpos(strtolower($movie), strtolower($movieName)) > -1){
                        $moviesName[] = $movie; 
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
            $db_json = $this->databaseInfo->getDatabase();
            $moviesYear = [];
            if($db_json){
                foreach($db_json['movie'] as $movie){
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
        }
    
        public function getMovies(){
            return $this->databaseInfo->getDatabase();
        }
    }
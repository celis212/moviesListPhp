<?php
    class Movie {
        /*
        * Movie model
        * comunicate with database
        * Execute registrarion and searching on database
        */

        private $db;

        public function __construct(){
            $this->db = new Database('movies');
        }

        // Register movies
        public function register($data){
            //get Database
            $db_data = $this->db->getDatabase();
            $input = array(
                'movie' =>$data['api'],
            );
            //append the input to our array
            $db_data = $input;
            //encode back to json
            file_put_contents(APPROOT . '/database/movies.json', json_encode($db_data, JSON_PRETTY_PRINT));
            
        }

            // Search movie title
        public function searchMovieTitle($nameMovie){
            //Get Database
            $db_data = $this->db->getDatabase();
            // Check in all user
            if($db_data){
                foreach($db_data['movie'] as $movie){
                    if($movie['Title']==$nameMovie){
                        return $movie;
                    }
                }
            }
            return false;

            }

        // Search movies range date
        public function searchMovieDate($date){
            //Get Database
            $db_data = $this->db->getDatabase();
            // Check in all user
            $movies=[];
            if($db_data){
                foreach($db_data['movie'] as $movie){
                    $year = explode('-',$movie['Year']);
                    $year = intval(trim($year[0]));
                    if($year>= intval($date[0]) && $year<= intval($date[1])){
                        $movies[] = $movie; 
                    }
                }
                if(count($movies)>0){
                    return $movies;
                }else{
                    return false;
                }
            }
        }

        public function getMovies(){
            return $this->db->getDatabase();
        }
    }
<?php  
/*
* Movie Controller
* Show, Search, Sort movies
* verify if the user is still log in 
*/
    class Movies extends Controller{

        public function __construct(){
             if(!isLoggedIn()){
                 redirect('/users/signin');
             }
             
            $this->userModel = $this->model('Movie');
        }

        //Show movies on API
        public function index(){
            $data = [
                'movie' => '',
                'movie_err' => ''
            ];

            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form API request
                $movie      = trim($_POST['movie']);
                $movie      = explode(' ', $movie);
                $movie      = implode('_', $movie);
                $url        ='https://www.omdbapi.com/?s='.$movie.'&apiKey=fc59da33';
                $json       = @file_get_contents($url);
                $movies     = json_decode($json, true);
                $movie      = explode('_', $movie);
                $movie      = implode(' ', $movie);

                if(isset($movies['Error'])){
                    $data =[
                        'movie' => $movie,
                        'movie_err' => 'search not found, try again!'
                    ];

                    // Load view
                    $this->view('movies/index', $data);
                }else{
                    $data =[
                        'movie' => $movie,
                        'api' => $movies['Search']
                    ];

                    //register movies on Database
                    $this->userModel->register($data);
                    //Load view
                    $this->view('movies/index', $data);
                }
            } else {
                $this->view('movies/index', $data);
            }
        }

        // search and sort the list of movies
        public function search(){
            $searchInfo = [
                'titleSearch' => !empty($_POST['titleSearch']) ? trim($_POST['titleSearch']) : '',
                'dateStart' => is_numeric($_POST['dateStart']) ? intval($_POST['dateStart']) : 0,
                'dateEnd' => is_numeric($_POST['dateEnd']) ? intval($_POST['dateEnd']) : date('Y'),
                'when' => !empty($_POST['when']) ? trim($_POST['when']) : 'asc',
                'sortBy' => !empty($_POST['sortBy']) ? trim($_POST['sortBy']) : 'Title',
            ];
            $dataInfo = $this->userModel->searchMovieTitle($searchInfo);

            //hold the given data 
            $data = [
                'titleSearch' => !empty($_POST['titleSearch']) ? trim($_POST['titleSearch']) : '',
                'dateStart' => is_numeric($_POST['dateStart']) ? intval($_POST['dateStart']) : 0,
                'dateEnd' => is_numeric($_POST['dateEnd']) ? intval($_POST['dateEnd']) : date('Y'),
                'when' => !empty($_POST['when']) ? trim($_POST['when']) : 'asc',
                'sortBy' => !empty($_POST['sortBy']) ? trim($_POST['sortBy']) : 'Title',
                'movie' => '',
                'api' => $dataInfo
            ];

            $this->view('movies/index', $data);
        }
    }

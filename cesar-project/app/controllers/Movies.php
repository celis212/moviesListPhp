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
                $data = [
                    'movie' => '',
                    'movie_err' => ''
                ];

                $this->view('movies/index', $data);
            }
        }

        public function search(){
            $searchInfo = [
                'titleSearch' => !empty($_POST['titleSearch']) ? trim($_POST['titleSearch']) : '',
                'dateStart' => is_numeric($_POST['dateStart']) ? intval($_POST['dateStart']) : 0,
                'dateEnd' => is_numeric($_POST['dateEnd']) ? intval($_POST['dateEnd']) : date('Y'),
                'when' => !empty($_POST['when']) ? trim($_POST['when']) : 'asc',
                'sortBy' => !empty($_POST['sortBy']) ? trim($_POST['sortBy']) : 'Title',
            ];
            $dataInfo = $this->userModel->searchMovieTitle($searchInfo);
            //print_r($data);

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


        
        //Search movies on Database
        /*public function search1(){
            if(!empty($_POST['titleSearch'])){//Search for title
                $name = trim($_POST['titleSearch']);

                //function for search title
                $dataSearch = $this->userModel->searchMovieTitle($name);
                if($dataSearch === FALSE){
                    $movies = $this->userModel->getMovies();

                    $data =[
                        'movie' => '',
                        'titleSearch_err' => "movie title does not match, try again",
                        'api' => $movies['movie']
                    ];

                    // Load view
                    $this->view('movies/index', $data);
                }else{
                    $movieMap = $dataSearch;
                    $data =[
                        'movie' => '',
                        'api' => $movieMap
                    ];

                    // Load view
                    $this->view('movies/index', $data);
                }
            
            }*/
            /*
            elseif(!empty($_POST['dateStart']) && !empty($_POST['dateEnd'])){//Search for range date
                $date[] = trim($_POST['dateStart']);
                $date[] = trim($_POST['dateEnd']);
                $dataSearch = $this->userModel->searchMovieDate($date);

                if($dataSearch === FALSE){
                    $movies = $this->userModel->getMovies();
                    $data =[
                        'movie' => '',
                        'dateStart_err' => "There isn't movies in date range entered",
                        'api' => $movies['movie']
                    ];
                    // Load view
                    $this->view('movies/index', $data);
                }else{
                    $movieMap[] = $dataSearch;
                    $data =[
                        'movie' => '',
                        'api' => $dataSearch
                    ];
                    // Load view
                    $this->view('movies/index', $data);
                }


            }else{
                $movies = $this->userModel->getMovies();//when values are empty

                $data =[
                    'movie' => '',
                    'titleSearch_err' => "Enter title or range date for search",
                    'api' => $movies['movie']
                ];

                // Load view
                $this->view('movies/index', $data);
            }
        }

        //Sort by title or date
        public function sort(){
            
            if($_POST['sortBy']){
                $sortValue = $_POST['sortBy'];
                $sortOption = $_POST['when'];

                $movies = $this->userModel->getMovies();

                sort($movies['movie']);// title ascend 

                if($sortValue === 1 && $sortOption == "desc"){
                    arsort($movies['movie']);
                } elseif($sortValue === 2 && $sortOption == "asc"){
                    function cmp($a, $b) {//function create for sort Ascending years
                        if (intval($a['Year']) == intval($b['Year'])) {
                            return 0;
                        }

                        return (intval($a['Year']) < intval($b['Year'])) ? -1 : 1;
                    }

                    uasort($movies['movie'], 'cmp');
                } elseif($sortValue === 2 && $sortOption == "desc"){
                    function cmp2($a, $b) {//function create for sort Descendig years
                        if (intval($a['Year']) == intval($b['Year'])) {
                            return 0;
                        }

                        return (intval($a['Year']) < intval($b['Year'])) ? 1 : -1;
                    }

                    usort($movies['movie'], 'cmp2');
                }

                $data =[
                    'movie' => '',
                    'api' => $movies['movie']
                ];

                // Load view
                $this->view('movies/index', $data);
            }
        }*/
    }

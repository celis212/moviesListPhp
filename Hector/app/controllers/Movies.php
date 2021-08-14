<?php
    /*
    * Movie Controller
    * Show, Search, Sort movies
    */
class Movies extends Controller{
    public function __construct(){
            $this->userModel = $this->model('Movie');
        }

    //Show movies on API
    public function index(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form API request
                $movie = trim($_POST['movie']);
                $movie = explode(' ',$movie);
                $movie = implode('_',$movie);
                $url ='https://www.omdbapi.com/?s='.$movie.'&apiKey=fc59da33';
                $json = @file_get_contents($url);
                $movies = json_decode($json,true);
                $movie = explode('_',$movie);
                $movie = implode(' ',$movie);
                if(isset($movies['Error'])){
                    $data =[
                        'movie' => $movie,
                        'movie_err' => 'Movie not found'
                    ];
                    // Load view
                    $this->view('movies/index', $data);
                }else{
                    // Init data
                    $data =[
                        'movie' => $movie,
                        'api' => $movies['Search']
                    ];
                    //register movies on Database
                    $this->userModel->register($data);
                    //Load view
                    $this->view('movies/index', $data);
                }
                
            }
    }   

    //Search movies on Database
    public function search(){
        if(!empty($_POST['titleSearch'])){//Search for title
            $name = trim($_POST['titleSearch']);
            //function for search title
            $dataSearch = $this->userModel->searchMovieTitle($name);
            
            if($dataSearch===FALSE){
                $movies = $this->userModel->getMovies();
                $data =[
                    'movie' => '',
                    'titleSearch_err' => "Movie searched wasn't found",
                    'api' => $movies['movie']
                ];
                // Load view
                $this->view('movies/index', $data);
            }else{
                $movieMap[] = $dataSearch;
                $data =[
                    'movie' => '',
                    'api' => $movieMap
                ];
                // Load view
                $this->view('movies/index', $data);
            }
            
        }elseif(!empty($_POST['dateStart'])&&!empty($_POST['dateEnd'])){//Search for range date
            $date[] = trim($_POST['dateStart']);
            $date[] = trim($_POST['dateEnd']);
            $dataSearch = $this->userModel->searchMovieDate($date);

            if($dataSearch===FALSE){
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
        if($_POST['sortBy']!='Choose..'){
            $sortOption = $_POST['sortBy'];
            $movies = $this->userModel->getMovies();
            //Sort by selected option
            if($sortOption==1){
                sort($movies['movie']);
            }elseif($sortOption==2){
                arsort($movies['movie']);
            }elseif($sortOption==3){
                function cmp($a, $b) {//function create for sort Ascending years
                    if (intval($a['Year']) == intval($b['Year'])) {
                        return 0;
                    }
                    return (intval($a['Year']) < intval($b['Year'])) ? -1 : 1;
                }
                uasort($movies['movie'], 'cmp');
            }elseif($sortOption==4){
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
            
    }
    
}
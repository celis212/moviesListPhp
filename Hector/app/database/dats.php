//controller/movies   
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
            }
        }
        
        //Search movies on Database
        public function search(){
            echo "tres";
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
                    $movieMap[] = $dataSearch;

                    $data =[
                        'movie' => '',
                        'api' => $movieMap
                    ];

                    // Load view
                    $this->view('movies/index', $data);
                }
            
            }elseif(!empty($_POST['dateStart']) && !empty($_POST['dateEnd'])){//Search for range date
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
        /*
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


//helpers/session
    <?php
    session_start();

    // Flash message helper
    // EXAMPLE - flash('register_success', 'You are now registered');
    // DISPLAY IN VIEW - echo flash('register_success');

    function flash($name = '', $message = '', $class = 'alert alert-success'){
        if(!empty($name)){
            if(!empty($message) && empty($_SESSION[$name])){//$_SESSION[$name] storage as a key
                if(!empty($_SESSION[$name])){
                    unset($_SESSION[$name]);
                }

                if(!empty($_SESSION[$name. '_class'])){
                    unset($_SESSION[$name. '_class']);
                }

                $_SESSION[$name] = $message;//$message storage as a value
                $_SESSION[$name. '_class'] = $class;//$class as a sesion variable 
            } elseif(empty($message) && !empty($_SESSION[$name])){
                $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : '';
                echo '<div class="'.$class.'" id="msg-flash">'.$_SESSION[$name].'</div>';//display it here
                unset($_SESSION[$name]);
                unset($_SESSION[$name. '_class']);
            }
        }
    }
          
    function isLoggedIn(){
        if(isset($_SESSION['user_email'])){
            return true;
        } else {
            return false;
        }
    }

//models/movies 
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

        // Search movie title
        public function searchMovieTitle($movieName){
            $db_data = $this->db_json->getDatabase();
            $moviesName = [];
            if($db_data){
                foreach($db_data['movie'] as $movie){
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
        }

        //call the info 
        public function getMovies(){
            return $this->databaseInfo->getDatabase();
        }
    
}
//model/ser
<?php
    class User {
        /*
        * User model
        * comunicate with database
        * Execute registration and check values for username 
        * on database and validate login username and password
        */
        private $db_json;//db

        public function __construct(){
            $this->db_json = new Database('dbusers');
        }

        // signup user
        public function signup($dataInfo){//data
            //get Database
            $db_data = $this->db_json->getDatabase();
            $input = array(
                'username' => $dataInfo['username'],
                'phone' => $dataInfo['phone'],
                'email' => $dataInfo['email'],
                'password' => password_hash($dataInfo['password'], PASSWORD_DEFAULT)
            );

            //append the input to our array
            $db_data[] = $input;
            //encode back to json
            file_put_contents(APPDIRECTION . '/database/dbusers.json', json_encode($db_data, JSON_PRETTY_PRINT));
        }

        // Check if does not exist username
        public function checkUsername($username){
            //Get Database
            $db_data = $this->db_json->getDatabase();
            // Check in all user
            if($db_data){
                foreach($db_data as $user){
                    if($user['username'] == $username){
                        return true;
                    }
                }
            }
            return false;
        }

        // Check if does not exist email
        public function checkemail($email){
            //Get Database
            $db_data = $this->db_json->getDatabase();
            // Check in all user
            if($db_data){
                foreach($db_data as $mail){
                    if($mail['email'] == $email){
                        return true;
                    }
                }
            }
            return false;
        }

        // Check username and password match
        public function checkLogin($dataInfo){
            //Get Database
            $db_data = $this->db_json->getDatabase();
            // Check in all user
            if($db_data){
                foreach($db_data as $user){
                    if($user['username'] == $dataInfo['username'] && password_verify($dataInfo['password'], $user['password'])){
                        $_SESSION['user_email'] = $user['email'];
                        $_SESSION['user_name'] = $user['username'];
                        redirect('/movies');
                        return true;
                    }
                }
            }
            return false;
        }

    }

//inc/navsearc
    <div class="row">
    <div class="col">
        <form action="<?php echo URLDIRECTION; ?>/movies/search" method="post">
            <div class="row">
                <div class="col">
                    <label for="name">Search by title</label>
                    <input type="text" placeholder="title" name="titleSearch" class="form-control form-control-lg 
                        <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="">
                    <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
                </div>
                <div class="col">
                    <label for="name">Date range:</label>
                    <div class="row">
                        <div class="col">
                            <input type="text" placeholder="start date" name="dateStart" class="form-control form-control-lg 
                                <?php echo (!empty($data['start_err'])) ? 'is-invalid' : ''; ?>" value="">
                            <span class="invalid-feedback"><?php echo $data['start_err']; ?></span>
                        </div>
                        <div class="col">
                            <input type="text" placeholder="end date" name="dateEnd" class="form-control form-control-lg 
                                <?php echo (!empty($data['end_err'])) ? 'is-invalid' : ''; ?>" value="">
                            <span class="invalid-feedback"><?php echo $data['end_err']; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row  my-sm-2">
                <div class="col">
                    <input type="submit" value="Search" class="btn btn-primary btn-block">
                </div>
            </div>
        </form>
    </div>

    <div class="col">
        <form action="<?php echo URLDIRECTION; ?>/movies/sort" method="post">
                <div class="col">
                    <label for="name">Sort by:</label>
                    <select class="form-control form-control-lg" name='sortBy' aria-label="Default select example">
                        <option value="1" selected>Title</option>
                        <option value="2">Date</option>
                    </select>
                    <p>
                    <label for="name">Sort by:</label>
                        <input type="radio" name="when" value="asc" checked>Asc
                        <input type="radio" name="when" value="desc">Desc</p>
                </div>
            </div>
        </form>
    </div>

//movies/index
    <?php require APPDIRECTION . '/views/inc/header.php'; ?>

    <h1>Welcome to API Movies</h1>
    <form action="<?php echo URLDIRECTION; ?>/movies/index" method="post">
        <div class="form-group">
            <label for="name">Movie search:</label>
            <input type="text" name="movie" class="form-control form-control-lg <?php echo (!empty($data['movie_err'])) ? 
                'is-invalid' : ''; ?>" value="<?php echo $data['movie']; ?>">
            <span class="invalid-feedback"><?php echo $data['movie_err']; ?></span>
        </div>
        <div class="row my-sm-2">
            <div class="col">
                <input type="submit" value="Update movie list" class="btn btn-success btn-block">
            </div>
        </div>
    </form>


    <?php require APPDIRECTION . '/views/inc/navsearch.php'; ?>

<?php require APPDIRECTION . '/views/inc/footer.php'; ?>

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
            }

            echo "tres";
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
                    $movieMap[] = $dataSearch;

                    $data =[
                        'movie' => '',
                        'api' => $movieMap
                    ];

                    // Load view
                    $this->view('movies/index', $data);
                }
            
            }elseif(!empty($_POST['dateStart']) && !empty($_POST['dateEnd'])){//Search for range date
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


    
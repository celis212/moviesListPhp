paso ocho 
<?php
/**
 * the default controller of the app set in the Core
 * extens the controllers class to load models and the views
 * set the data of the pages that exists the views folders, in this case app/views/
 * 
 * Rules
 *  - in function view don't use .php, set by default in the there
 *  - the way to put models 
 * 
 * ex1: pages/index -> require_once '../app/views/index.php';
 * ex2: $data = ["title" => "Talent's Movies"]; -> $data['title'] = "Talent's Movies"
 */
    class Pages extends Controller{
        public function __constructor(){
            $this->movieModel = $this->model('Movie');
        }    
        
        public function index(){
           $data = [
               "title" => "Talent's Movies",
                'description' => "You can see all the movies you want"
           ];
           $this->view('pages/index', $data);
        }
        
        public function about(){
            $data = [
                'title' => 'About Us',
                'description' => "This page is a requirement to enter Talent's development area and will display 
                a list of movies according to your search pattern."
            ];
            $this->view('pages/about', $data);
        }

    }
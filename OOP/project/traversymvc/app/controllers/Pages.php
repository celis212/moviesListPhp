<?php
// we extends to have all the classes of controller 
    class Pages extends Controller{
        public function __construct(){
            //echo 'Pages loaded';
            
            $this->postModel = $this->model('Post');
        }

        // if we have /traversymvc/
        //because index is our default direction 
        //$url[0] is going to be null and present a warning
        public function index(){
            $data = [
                'title' => 'Welcome'
              ];
        
            $this->view('pages/index', $data);
        }

        public function about(){
            // this is a example how it works, we can put $id to show the params works
            // this is on the URL traversymvc/pages/about/33
            //echo $id;// in about($id) is only a test 
            $data = [
                'title' => 'About Us'
              ];
        
            $this->view('pages/about', $data);
        }
    }
    
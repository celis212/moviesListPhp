<?php
    class Pages extends Controller{
        public function __constructor(){
            //echo 'Pages loaded';
            $this->postModel = $this->model('Post');
        }    
        
        public function index(){
            //example to prove the view module
           // $this->view('Hello');
           $data = [
            'title' => 'Welcome'
           ];
           $this->view('pages/index', $data);
        }

        public function about(){//about($id){
            //echo $id;
            //$this->view('pages/about');
            $data = [
                'title' => 'About Us'
            ];
            $this->view('pages/about', $data);
        }
    }





    
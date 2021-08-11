<?php
    /*
    * Pages Controller
    * for manage main and about pages
    */
    class Pages extends Controller{
        public function __construct(){

        }

        public function index(){
            $data = [
                'title'=> 'Welcome to my test'
            ];
            $this->view('pages/index', $data);
        }

        public function about(){
            $data = [
                'title'=> 'About',
                'description' => 'Backend Talent.com test, implement a register and login users and manage an API movies'
            ];
            $this->view('pages/about', $data);
        }
    }
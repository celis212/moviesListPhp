<?php
/**
 * App core Class
 * creates URL & loads core controller 
 * URL FORMAT - /controller/methods/params
 */

    class Core{
        // if we dont have any other controller taht what we are going to see and go  "Pages"
        protected $currentController = 'Pages';
        //is the same thing 
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct(){
            //print_r($this->getUrl());
            //assign to a variable 
            $url = $this->getUrl();

            //looks in controller for the firts value, if the value exist 
            //remenber that we configurate that all the infor redirects to index.php thats why we start an that position
            //ucwords capitalize the firts word
            // if the file doesnt exits currentController = pages 

            if(isset($url)){
                if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
                    //if exists, set as controller 
                    $this->currentController = ucwords($url[0]);
                    // unset index 0 of the array
                    unset($url[0]);
                }
            }

            //require the controlller 
            require_once '../app/controllers/' . $this->currentController . '.php';

            //instantiate controller class
            $this->currentController = new $this->currentController;

            //we check if we have a second parameter ej=/traversymvc/host/method
            // if we have this is going to be the method 
            if(isset($url[1])){
                //check if the method exists in the currentController 
                if(method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];
                    // unset $URL 1
                    unset($url[1]);
                }
            }

            //prove the the currentMerthod works 
            //echo $this->currentMethod;

            //get the params if the values exists, if not is still a empty array
            // remenber we unset both  in 0 and 1
            $this->params = $url ? array_values($url) : []; 

            //call a callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        //we are going to recover all the info before the /localhost/travesymvc
        public function getUrl(){
            if(isset($_GET['url'])){
                // return a string and eliminated the last item "/" on the array
                $url = rtrim($_GET['url'], '/');
                // filter a variable with a special filter 
                //sanitize filter special characters
                $url = filter_var($url, FILTER_SANITIZE_URL);
                // return an array separate with something
                $url = explode('/', $url);
                return $url;
                //echo $_GET['url'];
            }
        }
    }

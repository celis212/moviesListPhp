<?php
/**
 * main App core class
 * creating and handling of controllers, methods and parameters found in the URL
 * separates and assigns each of the received data in the URL 
 * 
 * Rules
 *  - it will start automatically on request.
 *  - format of the URL = /controller/method/params
 *  - by default the location of this file is /cesar-project/public/index.php
 * 
 * ex1: if the URL /cesar-project/one/two/three ->  search if one exits is going to be the controller, two is the 
 *                                                 method and three the params. if dont, pages is the default option 
 *                                                 by default. 
 * 
 * @param string $_GET['url'] /cesar-project/$controllerInfo/$MethodInfo/$paramsInfo
 *
 * @return array [[$controllerInfo, $MethodInfo], $paramsInfo] values associated with the URL information 
 *                                                             duly cleared
 */
    class Core {
        protected $controllerInfo = 'Pages';
        protected $methodInfo = 'index';
        protected $paramsInfo = [];
     
        //check in the controller's folder and set the controller 
        public function __construct(){
            $url = $this->getUrl();

            //if the controller exists set as a controller
            if($url){
                if(file_exists('../app/controllers/' . ucwords($url[0]). '.php')){
                    $this->controllerInfo = ucwords($url[0]);
                    unset($url[0]);
                }
            }

            //performs the connection and requirement the file
            require_once '../app/controllers/'. $this->controllerInfo . '.php';

            $this->controllerInfo = new $this->controllerInfo;

            //if the second part of the URL exists in controllers will set as a method
            if(isset($url[1])){
                if(method_exists($this->controllerInfo, $url[1])){
                    $this->methodInfo = $url[1];
                    unset($url[1]);
                }
            }

            //if the third part of the URL exists  will set the params in a array
            $this->paramsInfo = $url ? array_values($url) : [];

            //Calling a callback with an array of parameters
            call_user_func_array([$this->controllerInfo, $this->methodInfo], $this->paramsInfo);
        }

        //Separation and filtering of the information in the URL
        public function getUrl(){
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                //var_dump($url);
                return $url;
            }
        }
    }
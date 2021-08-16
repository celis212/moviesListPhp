<?php
    /** 
     * Base controller
     * load the models and the views
     */
    class Controller {
        // Load model
        public function model($model){
          // Require model file
          require_once '../app/models/' . $model . '.php';
    
          // Instatiate model
          return new $model();
        }
    
        // Load view
        //data pass infor between the views 
        public function view($view, $data = []){
          // Check for view file
          if(file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
          } else {
            // View does not exist
            //die stop the application
            die('View does not exist');
          }
        }
    }
    

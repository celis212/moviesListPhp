paso cinco
<?php
/**
 * base controller that load models and views 
 * receives the calls from the model which is in charge of interacting with the database.
 * 
 * Rules
 *  - the existence of the view is confirmed and the view will be returned
 *  - in case of having information, it will be returned as an array. 
 *  - you can pase data to the view 
 *  - you can load models and views as long  you can extend the class from controller.php
 */
class Controller{
    //load the model from models folders
    public function model($model){
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

        //load the view from views folders and pass data 
        public function view($view, $data = []){
            if(file_exists('../app/views/' . $view . '.php')){
                require_once '../app/views/' . $view . '.php';
            } else {
                die("View doesn't exist");
            }
        }
    }
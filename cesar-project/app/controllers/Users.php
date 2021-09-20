 paso cuatro
<?php
/**
 * check is a post request
 * if the form is summited or loaded   
 *     
 * Users Controller
 * Register new users
 * Validate all values before register
 * Login User with validation of username and password
 */
    class Users extends Controller {
        public function __construct(){
                
        }
        
        public function signup(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
               
            } else {
                // Init data
                $data =[
                    'username' => '',
                    'phone' => '',
                    'email' => '',
                    'password' => '',
                    'username_err' => '',
                    'phone_err' => '',
                    'email_err' => '',
                    'password_err' => ''
                ];

                // Load view
                $this->view('users/signup', $data);
            }
        }

        public function signin(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

            } else {
            // Init data
                $data =[    
                    'username' => '',
                    'password' => '',
                    'username_err' => '',
                    'password_err' => '',        
                ];

                // Load view
                $this->view('users/signin', $data);
            }
        } 
    }
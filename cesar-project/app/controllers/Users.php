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
            //chack the models folders 
            $this->userModel = $this->model('User');
        }
        
        public function signup(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                //sanitize the POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'username' => trim($_POST['username']),
                    'email' => trim($_POST['email']),
                    'phone' => trim($_POST['phone']),
                    'password' => trim($_POST['password']),
                    'username_err' => '',
                    'phone_err' => '',
                    'email_err' => '',
                    'password_err' => ''
                ];

                
                // Validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter a valid email';
                } elseif(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',
                    $data['email'])){//Check valid email 
                    $data['email_err'] = 'You enter a invalid email, please correct';
                } 

                // Validate Username
                if(empty($data['username'])){
                    $data['username_err'] = 'Please enter a valid Username';
                } elseif(preg_match("/[^a-zA-Z]/",$data['username'])){// Check if username contains numbers
                    $data['username_err'] = 'Username must only contains letters';
                }

                // Validate Phone
                if(empty($data['phone'])){
                    $data['phone_err'] = 'Please enter a valid Phone number';
                } elseif(strlen($data['phone'])!=10  || !preg_match("/[+][0-9]{9}/", $data['phone'])){// Check valid format
                    $data['phone_err'] = 'only the "+" symbol and nine-digit numbers are accepted.';
                }

                // Validate Password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please enter a valid password';
                } elseif(strlen($data['password']) < 6){
                    $data['password_err'] = 'Password must be at least 6 characters';
                }elseif(preg_match('/[^a-zA-Z0-9*-.]+/', $data['password'])){
                    $data['password_err'] = 'Only special characters allowed *-.';
                }elseif(!preg_match('/^(?=.*[A-Z])(?=.*[*-.])/',$data['password'])){
                    $data['password_err'] = 'Must have one uppercase and must contains at least one these characters "*"
                    ,"-" or "."';
                }

                // Make sure errors are empty
                if(empty($data['username_err']) && empty($data['email_err']) && empty($data['name_err']) && 
                empty($data['password_err']) && empty($data['phone_err'])){
                    if($this->userModel->checkUsername($data['username'])){
                        $data['username_err'] = 'Username already exist, change username';
                        $this->view('users/signup', $data);
                    } elseif($this->userModel->checkemail($data['email'])){
                        $data['email_err'] = 'Email already exist, change email';
                        $this->view('users/signup', $data);
                    } else{
                        $this->userModel->signup($data);
                        // Init data
                        $data =[    
                            'username' => '',
                            'password' => '',
                            'username_err' => '',
                            'password_err' => '',        
                        ];

                        flash('signup_success', 'You have created your user correctly!');
                        redirect('/users/signin');
                        //$this->view('users/signin', $data);
                        //echo '<script>alert("You have created your user correctly!")</script>';
                    }
                
                // Validated
                } else {
                    // Load view with errors
                    $this->view('users/signup', $data);
                }

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

                //sanitize the POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                 // Init data
                $data =[
                    'username' => trim($_POST['username']),
                    'password' => trim($_POST['password']),
                    'username_err' => '',
                    'password_err' => '',      
                ];
        
                // Validate Email
                if(empty($data['username'])){
                    $data['username_err'] = 'Pleae enter a valid username';
                }
        
                // Validate Password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please enter a valid password';
                }
        
                // Make sure errors are empty
                if(empty($data['username_err']) && empty($data['password_err'])){
                    // Validated
                    if($this->userModel->checkLogin($data)){
                        $defaultMovie['movie'] = 'Avengers';
                        //user session
                        //$this->createUserSession($data);
                        $this->view('movies/index', $defaultMovie);
                    }else{
                        $data['username_err'] = 'Username or Password are incorrect, please try again';
                        // Load view with errors
                        $this->view('users/signin', $data);
                    }
            } else {
                // Load view with errors
                $this->view('users/signin', $data);
            }
    

            } else {
            // Init data
                $data =[    
                    'username'      => '',
                    'password'      => '',
                    'username_err'  => '',
                    'password_err'  => '',        
                ];

                // Load view
                $this->view('users/signin', $data);
            }
        } 
      
        public function logout(){
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            session_destroy();
            redirect('/users/signin');
        }

    }
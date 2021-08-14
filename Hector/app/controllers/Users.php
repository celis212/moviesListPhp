<?php
class Users extends Controller {
    /*
    * Users Controller
    * Register new users
    * Validate all values before register
    * Login User with validation of username and password
    */
    public function __construct(){
            $this->userModel = $this->model('User');
        }

    public function register(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form

            // Init data
            $data =[
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
                $data['email_err'] = 'Please enter email';
            } elseif(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',$data['email'])){//Check valid email 
                $data['email_err'] = 'You enter a not valid email, please correct';
            } 

            // Validate Username
            if(empty($data['username'])){
                $data['username_err'] = 'Please enter Username';
            } elseif(preg_match("/[^a-zA-Z]/",$data['username'])){// Check if username contains numbers
                $data['username_err'] = 'Username must only contains letters';
            }

            // Validate Phone
            if(empty($data['phone'])){
                $data['phone_err'] = 'Please enter Phone number';
            } elseif(strlen($data['phone'])!=10  || !preg_match("/[+][0-9]{9}/", $data['phone'])){// Check valid format
                $data['phone_err'] = 'Phone number must begin with "+" followed by 9 numbers, example: +6174499';
            }

            // Validate Password
            if(empty($data['password'])){
                $data['password_err'] = 'Please enter password';
            } elseif(strlen($data['password']) < 6){
                $data['password_err'] = 'Password must be at least 6 characters';
            }elseif(preg_match('/[^a-zA-Z0-9*-.]+/',$data['password'])){
                $data['password_err'] = 'Only special characters allowed *-.';
            }elseif(!preg_match('/^(?=.*[A-Z])(?=.*[*-.])/',$data['password'])){
                $data['password_err'] = 'One letter must be uppercase and must contains at least one these characters *-.';
            }


            // Make sure errors are empty
            if(empty($data['username_err']) && empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['phone_err'])){
                if(!$this->userModel->checkUsername($data['username'])){
                    $this->userModel->register($data);
                    // Init data
                    $data =[    
                        'username' => '',
                        'password' => '',
                        'username_err' => '',
                        'password_err' => '',        
                    ];
                    $this->view('users/login', $data);
                    echo '<script>alert("Successful user created, please login")</script>';
                }
                else{
                    $data['username_err'] = 'Username already exist, change username';
                    $this->view('users/register', $data);
                }
                
                // Validated
            } else {
                // Load view with errors
                $this->view('users/register', $data);
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
            $this->view('users/register', $data);
        }
    }


    public function login(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Process form
            
            // Init data
            $data =[
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'username_err' => '',
                'password_err' => '',      
            ];
    
            // Validate Email
            if(empty($data['username'])){
                $data['username_err'] = 'Pleae enter username';
            }
    
            // Validate Password
            if(empty($data['password'])){
                $data['password_err'] = 'Please enter password';
            }
    
            // Make sure errors are empty
            if(empty($data['username_err']) && empty($data['password_err'])){
                // Validated
                if($this->userModel->checkLogin($data)){
                    $defaultMovie['movie'] = 'Avengers';
                    $this->view('movies/index',$defaultMovie);
                }else{
                    $data['username_err'] = 'Username or Password incorrect, please try again';
                    // Load view with errors
                    $this->view('users/login', $data);
                }
            } else {
                // Load view with errors
                $this->view('users/login', $data);
            }
    
    
            } else {
            // Init data
            $data =[    
                'username' => '',
                'password' => '',
                'username_err' => '',
                'password_err' => '',        
            ];
    
            // Load view
            $this->view('users/login', $data);
            }
        }
    


}
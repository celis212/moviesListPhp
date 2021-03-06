<?php
/**
 * Flash message helper
 * EXAMPLE - flash('register_success', 'You are now registered');
 * DISPLAY IN VIEW - echo flash('register_success');
 */
    session_start();
    function flash($name = '', $message = '', $class = 'alert alert-success'){
        if(!empty($name)){
            if(!empty($message) && empty($_SESSION[$name])){//$_SESSION[$name] storage as a key
                if(!empty($_SESSION[$name])){
                    unset($_SESSION[$name]);
                }

                if(!empty($_SESSION[$name. '_class'])){
                    unset($_SESSION[$name. '_class']);
                }

                $_SESSION[$name] = $message;//$message storage as a value
                $_SESSION[$name. '_class'] = $class;//$class as a sesion variable 
            } elseif(empty($message) && !empty($_SESSION[$name])){
                $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : '';
                echo '<div class="'.$class.'" id="msg-flash">'.$_SESSION[$name].'</div>';//display it here
                unset($_SESSION[$name]);
                unset($_SESSION[$name. '_class']);
            }
        }
    }

    //verify if the session still on     
    function isLoggedIn(){
        if(isset($_SESSION['user_email'])){
            return true;
        } else {
            return false;
        }
    }
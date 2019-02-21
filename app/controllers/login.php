<?php

class Login extends Controller {

    /*
     * http://localhost/login
     */
    function Index () {

        if (!isset($_SESSION['login'])) {

            $this->view('template/header');
            $this->view('login');
            $this->view('template/footer');

        } else {

            header('Location: /php_mvc/');

        }

    }

    /*
     * http://localhost/login/log_in
     */
    function Log_In () {

        // Loads /models/user.php
        $this->model('User');

        if(isset($_POST['login']) AND isset($_POST['password'])){

            if ($this->user->hydrate($_POST['login'], $_POST['password'])){
                
                $_SESSION['login'] = $_POST['login'];
                $_SESSION['password'] = $_POST['password'];
                $_SESSION['firstName'] = $this->user->getFirstName();
                $_SESSION['lastName'] = $this->user->getLastName();
            }
        }

        header("Location: /php_mvc/");

    }

    /*
     * http://localhost/login/logout
     */
    function Logout () {

        $_SESSION = [];
        session_unset();
        header('Location: /php_mvc/');

    }

}

?>
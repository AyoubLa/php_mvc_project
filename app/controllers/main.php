<?php

class Main extends Controller {

    /*
     * http://localhost/
     */
    function Index () {
        
        if (!isset($_SESSION['login'])) {

            header('Location: login');
            //header('Location: app/controllers/main.php');

        } else {

            header('Location: /php_mvc/dashboard');
            
        }
        
    }

    /*
     * http://localhost/anothermainpage
     */
    function anotherMainPage () {
        echo 'Works!';
    }

}

?>
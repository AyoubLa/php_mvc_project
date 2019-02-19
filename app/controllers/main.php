<?php

class Main extends Controller {

    /*
     * http://localhost/
     */
    function Index () {
        
        if (!isset($_SESSION['login'])) {

            echo 'helooo';
            //header('Location: app/controllers/main.php');

        } else {

            header('Location: /dashboard');
            
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
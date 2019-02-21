<?php

class Dashboard extends Controller {

    /*
     * http://localhost/dashboard
     */
    function Index () {
        
        if (!isset($_SESSION['login'])) {

            header('Location: /php_mvc/login');

        } else {

            $this->view('template/header');
            $this->view('dashboard/index');
            $this->view('template/footer');
            
        }
        
    }

    /*
     * http://localhost/dashboard/subpage/[$parameter]
     */
    function subpage ($parameter = '') {

        $viewData = array(
            'parameter' => $parameter
        );

        $this->view('template/header');
        $this->view('dashboard/subpage', $viewData);
        $this->view('template/footer');

    }

}

?>
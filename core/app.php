<?php

/*
 *   Date: 2017-06-01
 * Author: Dawid Yerginyan
 */

class App {

    private $config = [];

    public $db;

    function __construct () {

        define("URI", $_SERVER['REQUEST_URI']);
        define("ROOT", $_SERVER['DOCUMENT_ROOT']);

    }

    function autoload () {

        spl_autoload_register(function ($class) {

            $class = strtolower($class);
            if (file_exists(ROOT . '/php_mvc/core/classes/' . $class . '.php')) {
                
                require_once ROOT . '/php_mvc/core/classes/' . $class . '.php';

            } else if (file_exists(ROOT . '/php_mvc/core/helpers/' . $class . '.php')) {

                require_once ROOT . '/php_mvc/core/helpers/' . $class . '.php';

            }

        });

    }

    function config () {

        $this->requires('/php_mvc/core/config/session.php');
        $this->requires('/php_mvc/core/config/database.php');      

        try {

            $this->db = new PDO('mysql:host=' . $this->config['database']['hostname'] . ';dbname=' . $this->config['database']['dbname'],
                                $this->config['database']['username'], 
                                $this->config['database']['password']);

            $this->db->query('SET NAMES utf8');
            $this->db->query('SET CHARACTER_SET utf8_unicode_ci');
            
            // TODO: Remove for production
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {

            echo 'Connection Error : ' . $e->getMessage();

        }

    }

    function requires($path) {

        require ROOT . $path;

    }

    function start () {

        session_name($this->config['sessionName']);
        session_start();

        $route = explode('/', URI);

        $route[2] = strtolower($route[2]);

        if ((sizeof($route) > 2) && file_exists(ROOT . '/php_mvc/app/controllers/' . $route[2] . '.php')) {
            $this->requires('/php_mvc/app/controllers/' . $route[2] . '.php');
            $controller = new $route[2]();
        } else {
            $this->requires('/php_mvc/app/controllers/main.php');
            $main = new Main();
        }

    }
    
}

?>
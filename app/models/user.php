<?php

/*
 * Every class derriving from Model has access to $this->db
 * $this->db is a PDO object
 * Has a config in /core/config/database.php
 */
class User extends Model {

    private $_id;
	private $_firstName;
	private $_lastName;
	private $_login;
	private $_password;
    
    // function __construct($login, $password) {
        
    //     $this->hydrate($login, $password);
    // }

    public function getId()
    {
    	return $this->_id;
    }

    public function getFirstName()
    {
    	return $this->_firstName;
    }

    public function getLastName()
    {
    	return $this->_lastName;
    }

    public function getLogin()
    {
    	return $this->_login;
    }

    public function getPassword()
    {
    	return $this->_password;
    }
    

    public function setFirstName($firstName)
    { 
        if(strlen($firstName) <= 30) {

            $this->_firstName = $firstName;
            return true;
        }
        
        return false;
    }

    public function setLastName($lastName)
    { 
        if(strlen($lastName) <= 30) {

            $this->_lastName = $lastName;
            return true;
        }
        
        return false;
    }

    public function setLogin($login)
    { 
        if(strlen($password) <= 30) {

            $this->_login = $login;
            return true;
        }
        
        return false;
    }

    public function setPassword($password)
    { 
        if(strlen($password) <= 30) {

            $this->_password = $password;
            return true;
        }
        
        return false;
    }

    public function hydrate($login, $password)
    {
        $req = $this->login($login, $password);
        while ($ligne = $req->fetch(PDO::FETCH_ASSOC)) {

        	$this->_id = $ligne['id'];
            $this->setFirstName($ligne['first_name']);
            $this->setLastName($ligne['last_name']);
            $this->setLogin($ligne['login']);
            $this->setPassword($ligne['password']);
            return $this;
        }

        return false;
    }

    public function login($login, $password)
    {
        $req = $this->db->prepare('SELECT * FROM users WHERE login = ? AND password = ?');
        $req->execute(array($login, $password));
        return $req;
    }
}

?>
<?php

class ConexionTraspaso
{
    /*public  static $dbname = "";
		public  static $username = "";
		public  static $password = "";*/

    /*public  function __construct($db,$u,$p){
			

         /*$this->dbname = $_SESSION['db_name'];
         $this->username =	$_SESSION['user_name'];
         $this->password = $_SESSION['password_db'];*/
    /*$this->dbname = $db;
         $this->username =	$u;
         $this->password = $p;
    	
    	}*/



    public static  function conectar($dbname, $username, $password)
    {
        //$dbname = strtolower($_SESSION['db_name']);
        //$username =strtolower($_SESSION['user_name']);
        //$password = $_SESSION['password_db'];

        //$link = new PDO("mysql:host=localhost;dbname=u203735599_ifxt",
        //	            "u203735599_alber",
        //	            "EjST6ovOU76s");
        $link = new PDO("mysql:host=localhost;dbname=" . strtolower($dbname),
            strtolower($username),
            $password
        );

        $link->exec("set names utf8");

        return $link;
    }
}

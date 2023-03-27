<?php

namespace App\core 
{      
    use PDO;
    
    class DataBase extends PDO
    {
        protected $dsn = "mysql:host=localhost; dbname=qrcodegenerator; charset=utf8;";
        protected $username = "root";
        protected $password = "";
        protected $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

        public function __construct(){
          parent::__construct($this->dsn, $this->username, $this->password, $this->options);
        }
    }
}

?>
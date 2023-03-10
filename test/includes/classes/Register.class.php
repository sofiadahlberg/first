<?php 

Class Register{
    //properties
    private $db;
    private $email;
    private $password;
  
    
    //metod

    //constructor
    function __construct()
    {
        $this->db = new mysqli('localhost', 'news', 'password', 'blog');
        if ($this->db->connect_errno > 0) {
            die("Fel vid anslutning:" . $this->db->connect_error);
        }
    }
   
   
}
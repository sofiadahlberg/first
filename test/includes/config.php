<?php

// Aktivera felrapportering
error_reporting(-1);
ini_set("display_errors", 1); 

//Aktivera kod
   spl_autoload_register(function ($class_name) {
    include 'includes/classes/' . $class_name . '.class.php';
     });

     //aktivera sessioner
     session_start();
     
?>
<?php
include("includes/header.php");
//Anslutning till databasen
$db = new mysqli("localhost", "news", "password", "blog");
if ($db->connect_errno > 0) {
    die('Fel vid anslutning [' . $db->connect_error . ']');
}


// ta bort tabell new om esisterar och skapa tabellen pÃ¥ nytt
$sql = "DROP TABLE IF EXISTS news;";
$sql .= "CREATE TABLE news(
    id INT (255) PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    content VARCHAR(1500) NOT NULL,
    postdate timestamp NOT NULL DEFAULT current_timestamp(),
    login_email VARCHAR(40),
    user_id INT (40)
)";

//Skicka SQLfrågor till server
if ($db->multi_query($sql)) {
    echo "Databas och användare installerad";
} else {
    echo "Fel vid installation av DB";
}
//stäng
$db->close();

//anslut till servern pÃ¥ nytt
$db = new mysqli("localhost", "news", "password", "blog");
if ($db->connect_errno > 0) {
    die('Fel vid anslutning [' . $db->connect_error . ']');
}

$sql = "DROP TABLE IF EXISTS login;";
$sql .= "CREATE TABLE login(
    email VARCHAR(40) NOT NULL,
    password VARCHAR(255) NOT NULL,
    firstname VARCHAR(40) NOT NULL,
    lastname VARCHAR(40) NOT NULL,
    userid INT (40)  PRIMARY KEY AUTO_INCREMENT,
    postdate timestamp NOT NULL DEFAULT current_timestamp()
    );
    ";

//Skicka SQLfrågor till server
if ($db->multi_query($sql)) {
    echo "Databas och användare installerad";
} else {
    echo "Fel vid installation av DB";
}

$db->close();
<?php include("includes/header.php"); ?>
<h1>Logga in</h1>
<div class="container">

    <h2>Ange användaruppgifter: </h2>
    <?php

    //Skapa en ny instans
    $user = new Login();


    //Kolla om form är postat
    if (isset($_POST['email'])) {
        $userid = $_POST['userid'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($user->LoginUser($email, $password)) {

            //Anrop till set username och set password
            if ($user->setmail($email && $user->setaPassword($password))) {
                //Skriv ut
    
                $user->setmail($email && $user->setaPassword($password));
                //Ange SESSION_variabel
               
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                
                
               /* header("Location: admin.php");*/
                header("Location: admin.php?email=$email");
            } else { $_SESSION['wrong'] = "Felaktig E-post/lösenord";}
        }
        else{
            $_SESSION['errormessage'] = "Ange E-post/lösenord";
        }
    }

    ?>
    <form class="login" action="login.php" method="post">
        <label for="email">E-postadress:</label>
        <br>
        <input type="text" name="email" id="email">
        
        <br>
        <label for="password">Lösenord:</label>
        <br>
        <input type="password" name="password" id="password">

        <br>
        <span class="error">
            <?php
            //Skriv ut felmeddelande
            if (isset($_SESSION['errormessage'])) {
                echo $_SESSION['errormessage'];
            }
            unset($_SESSION['errormessage']);
            ?>
        </span> <br>
        <span class="error">
            <?php
            //Skriv ut felmeddelande
            if (isset($_SESSION['wrong'])) {
                echo $_SESSION['wrong'];
            }
            unset($_SESSION['wrong']);
            ?>
        </span> <br>

 <span><a href="register.php">Registrera dig</a></span> 

 <?php 
 
 ?>
<input class="btn" type="submit" name="submit" value="Logga in"></a>
           <?php  ?>
</form>
</div>
    <?php
include("includes/footer.php");?>

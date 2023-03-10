<?php include("includes/header.php");
?>

<h1>Registrera nytt konto</h1>
<div class="container">
    <span class="error">
        <?php
        if (isset($_SESSION['RegError'])) {
            echo $_SESSION['RegError'];

        }
        unset($_SESSION['RegError']); ?>
    </span>
    <?php
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];

        //prepared statements
        
        $inlog = new Login();
       

        if ($inlog->registerUser($email, $password, $firstname, $lastname)) {
            /*$inlog->registerUser($email, $password, $firstname, $lastname);*/
           echo "<p> Användare registrerad</p>";
        } else {
            $_SESSION['RegError'] = "<p> Fel vid reg av konto</p>!";
        }
        
    }
    ?>
    <form class="login" method="POST">
        <br>
        <label for="email">Email-adress:</label>
        <br>
        <input type="email" name="email" id="email">
        <br>
        <label for="password">Lösenord:</label>
        <br>
        <input type="password" name="password" id="password">
        <br>
        <label for="firstname">Förnamn:</label>
        <br>
        <input type="firstname" name="firstname" id="firstname">
        <br>
        <label for="lastname">Efternamn:</label>
        <br>
        <input type="lastname" name="lastname" id="lastname">
        <br>

        <input class="btn" type="submit" name="reg" value="Registrera konto">
    </form>
</div>

<?php include("includes/footer.php"); ?>
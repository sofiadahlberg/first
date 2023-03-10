<?php include("includes/header.php");
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}
$name = new Login();
$users_list = $name->getLogin();
$email = ($_SESSION['email']);
$userid = $name->GetIDByUsername($email);
?>

<h1>Blogginlägg</h1>
<div class="adminbox">

    <p class="inlog">Du är nu inloggad som:
        <?= $_SESSION['email']; ?>
    </p>

    <p>
        <a href="logout.php" class="logoutbtn">Logga ut</a>
    </p>
    <h2>Skapa inlägg:</h2>

    <?php
    $Create = new Blog();


    if (isset($_GET['delbutton'])) {
        $delbutton = intval($_GET['delbutton']);
        if ($Create->deleteblog($delbutton)) {
            $Create->deleteblog($delbutton);
        }
    }
    
    $title = "";
    $content = "";
    if (isset($_POST['title'])) {
        $title = $_POST['title'];

        if (isset($_POST['content'])) {
            $content = $_POST['content'];
            $email = $_SESSION['email'];
            /*$userid = $_POST['userid'];*/
            $success = true;
            /*header("Location: admin.php");*/

            if (!$Create->SetTitle($title)) {
                $success = false;
                /*$Create->SetTitle($title);*/
                $_SESSION['TitleError'] = "Du måste skriva något i titelfältet";
            }
        }

        if (!$Create->SetContent($content)) {
            /*$Create->SetContent($content);*/
            $_SESSION['ContentError'] = "Du måste skriva något i contentfältet";
        }

        /*if ($Create->setTitle($title && $Create->SetContent($content))) {*/
        if ($success) {

            if ($Create->AddNews($title, $content, $userid)) {
                echo "<p>Ditt blogginlägg är nu tillagd av användare $email</p>";
                $title = "";
                $content = "";
            } else {
                echo "<p> Ditt inlägg kunde inte läggas till</p> ";
            }
        } else {
            "<p>Nyheten kunde inte sparas</p>";
        }
    }


    ?>


    <!--Nytt formulär för att skapa nytt blogginlägg-->
    <form method="POST" action="admin.php">
        <?php
        echo "<input type='hidden' name='userid' id='userid' value=$userid>";

        ?>

        <span class="error">
            <?php
            if (isset($_SESSION['TitleError'])) {
                echo $_SESSION['TitleError'];
            }
            unset($_SESSION['TitleError']); ?>
        </span><br>

        <label for="title">Titel:</label><br>
        <input type="text" id="title" name="title" value="<?= $title; ?>">
        <br>

        <span class="error">
            <?php
            if (isset($_SESSION['ContentError'])) {
                echo $_SESSION['ContentError'];

            }
            unset($_SESSION['ContentError']); ?>
        </span><br>
        <label for="content">Innehåll:</label><br>
        <textarea name="content" id="content"><?= $content; ?></textarea>
        <br>

        <input type='submit' id="save" name="save" value="skapa blogginlägg">

    </form>
    <?php
    ?>
    <h2>Befintliga nyheter</h2>
    <?php



    $title_list = $Create->getPostByID($userid);
    $nameid = $name->GetNameById($userid);

    //loopa och skriv ut 
    foreach ($title_list as $header) { ?>
        <article class='admin'>
            <h3>
                <?= $header['title'] ?>
            </h3>
            <p class='blogtext'>
                <?= "Postat: " . $header['postdate'] ?>
            </p>
            <p>
                <?= $header['content'] ?>
            </p>
            <p>

                <?= $nameid; /* $header['user_id'] */?>
            </p>

            <?php /*$name->getLogin();*/
            ?>


            <div class='buttons'>
                <a class='editbutton' href="edit.php?id=<?= $header['id']; ?>">Ändra</a>
                <a class='delbutton' href='admin.php?delbutton=<?= $header['id'] ?>'>Radera</a>

            </div>
        </article>
        <?php
    } ?>


    <?php

    ?>
</div>
<?php
include("includes/footer.php"); ?>
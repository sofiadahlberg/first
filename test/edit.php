<?php include("includes/header.php");
if (!isset($_SESSION['email'])) {
    //är man Inte inloggad skickas man till adminsidan
    header("Location: login.php");

}

?>

<h1>Ändra blogginlägg</h1>
<div class="adminbox">
    <p class="inlog">Du är nu inloggad som:
        <?= $_SESSION['email'] ?>
    </p>
    <p> <a href="logout.php" class="logoutbtn">Logga ut</a></p>
    <h2>Ändra inlägg:</h2>

    <?php
    $Create = new Blog();
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);


        if (isset($_POST['title'])) {
            $title = $_POST['title'];
            $title = "";

            if (isset($_POST['content'])) {
                $content = $_POST['content'];
                $success = true;
                $content = "";
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

            if ($Create->setTitle($title && $Create->SetContent($content)))
                if ($success) {
                    if ($Create->ChangeBlog($id, $title, $content)) {
                        echo "<p>Ditt blogginlägg har nu ändrats</p>";
                        /*$title = "";
                        $content = "";*/
                    } else {
                        echo "<p> Ditt blogginlägg kunde inte ändras</p> ";
                    }
                }
        }

    }
    $info = $Create->GetSpecBlog($id); ?>
    <!--Nytt formulär för att skapa nytt blogginlägg-->
    <form method="POST" action="admin.php">
        <span class="error">
            <?php
            if (isset($_SESSION['TitleError'])) {
                echo $_SESSION['TitleError'];
            }
            unset($_SESSION['TitleError']); ?>
        </span><br>
        <label for="title">Titel:</label><br>
        <input type="text" id="title" name="title" value="<?= $info['title']; ?>" ?>
        <br><br>
        <span class="error">
            <?php
            if (isset($_SESSION['ContentError'])) {
                echo $_SESSION['ContentError'];

            }
            unset($_SESSION['ContentError']); ?>
        </span><br>
        <label for="content">Innehåll:</label><br>
        <textarea name="content" id="content"><?= $info['content']; ?></textarea>
        <br>
        <input type='submit' id="save" name="save" value="Ändra blogginlägg">
    </form>

    <h2>Befintliga nyheter</h2>
    <?php

    //Hämta news
    $title_list = $Create->getNews();
    


    //loopa och skriv ut 
    /* foreach ($title_list as $header) { ?>
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
    <?php $name->getLogin();
    ?>
    <?= $_SESSION['email']
    ?>
    <div class='buttons'>
    <a class='editbutton' href="edit.php?id=<?= $header['id']; ?>">Ändra</a>
    </div>
    </article>*/


    ?>
</div>
<?php
include("includes/footer.php"); ?>
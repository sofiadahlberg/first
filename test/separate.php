<?php include("includes/header.php"); ?>
<h1>Blogginlägg</h1>
<div class="blog">
    <?php
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        //ny instans
        $Create = new Blog();
        $specblog = $Create->GetSpecBlog($id);

        ?>
        <article class='separate'>
            <h3>
                <?= $specblog['title']; ?>
            </h3>
            <p class='blogtext'>
                <?= "Postat:" . $specblog['postdate']; ?>
            <p>
                <?= $specblog['content']; ?>
            <section>
                <ul id="expander">
                    <li>
                        <button class="expanderBtn">Vad är Aria? <i class="fas fa-chevron-down arrow"></i></button>
                        <article class="textExpand">
                            <div class="row">
                                <form class="form-horizontal" action="index.php" method="POST">
                                    <input type="hidden" name="id" value=<?php $commentsId ?>>
                                    <input type="hidden" name="idnews" value=<?php $id ?>>
                                    <input type="hidden" name="iduser" value=<?php $userID ?>>
                                    <div class="form-group">
                                        <label for="commName">Namn:</label><br>
                                        <textarea name="commName" id="commName"><?php $commName; ?></textarea>
                                        <label class="col3 control-label">Skriv Kommentar</label>
                                        <div class="col9">
                                            <textarea class="form-control" rows="5" cols="10" name="comment"
                                                placeholder="comment"></textarea>
                                        </div>
                                    </div>
                                    <input type="submit" name="postcomment" value="comment">
                                </form>
                                <?php
                                if (isset($_POST['commName'])) {
                                    $commName = $_POST['commName'];
                                    $comment = $_POST['comment'];
                                    //Skapa ny instans
                                    $insert = new Blog();
                                    if ($insert->AddComment($commName, $comment, $id, $userID)) { //call function to registrer user
                                        echo "<p class='msg'>Användare skapad!</p>"; //If user was created, show message
                                    } else {
                                        echo "<p class='errormsg'>Fel vid registrering av användare, alla fält behöver vara ifyllda</p>"; // Of user wasnt created, show message
                                    }
                                }

                                ?>
                        </article>
        </article>


        <?php
    }
    ?>
</div>


<?php
include("includes/footer.php"); ?>
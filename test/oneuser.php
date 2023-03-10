<?php include("includes/header.php"); ?>
<?php $name = new Login();/* ?>
<h2> Alla blogginlägg från
<?php
$tables = $name->Name($userid); ?>
<?= $tables['firstname'] . "" . $tables['lastname'] ?>
</h2> */ 


/*$fullname = $name->getLogin();*/
$Create = new Blog();
if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];
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
                <?= $nameid?>
            </p>
        </article>
    <?php }

    //ny instans 
} ?>

<?php
include("includes/footer.php"); ?>
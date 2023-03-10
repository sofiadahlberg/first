<?php include("includes/header.php");

$name = new Login();
$Create = new Blog();

//Läs in avändare
$users_list = $name->getLogin();


?>
<h2>De fem senaste blogginläggen:</h2>
<section>
    <?php
    //Läs in lista
    $todo_list = $Create->getLatestFive();

    //loopa
    foreach($todo_list as $item){ ?>
        <article class="boxes"> <?php
        echo "<a href='oneuser.php?userid=" . $item['userid'] . "'>" . $item['firstname'] . " " . $item['lastname'] . "</a>";
        
        echo"<h2>".$item['title'] . "</h2>" . "<br><p>" . $item['content'] . "</p><p>". $item['postdate'] . "</p>"; ?>
    </article>
    <?php
    }
    ?>
    </section>

    <h2> Våra användare</h2>  <?php
$fullname = $name->getLogin();  

    
 // Loopa igenom
foreach ($fullname as $f) {?>
    <li class='OurUsers'><a class='OurUsers' href="oneuser.php?userid=<?= $f['userid'] ?>"> <?= $f['firstname'
    ] . " " . $f['lastname'] ?> </a></li>

<?php
 } ?>

    


<?php
include("includes/footer.php") ?>
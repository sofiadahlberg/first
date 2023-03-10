<?php include("includes/config.php") ?>
<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content=" width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <script src="https://kit.fontawesome.com/f001f8c4bf.js" crossorigin="anonymous"></script>
 <title>Blogg</title>
</head>
<body>
    <header>
        <!-- Öppna mobilmeny-->
        <button class="menu-btn open" aria-label="Öppna menyn" id="open-menu">
            <span class="menu-bar">
                <span class="bars"></span>
                <span class="bars"></span>
                <span class="bars"></span>
            </span>
            <span class="menu-text">Meny</span>
        </button>
        <!--navigering-->
        <nav id="menu-nav">
            <!--StÃ¤ng navigering-->
            <button class="menu-btn close" aria-label="Stäng menyn" id="close-menu">
                <span class="menu-bar">
                    <span class="bars cross1"></span>
                    <span class="bars cross2"></span>
                </span>
                <span class="menu-text">Stäng</span>
            </button>
            <ul>
                <li><a href="index.php" class="navlink">Startsida</a></li>
                <li><a href="nyheter.php" class="navlink">Nyheter</a></li>
                <li><a href="index-php" class="own">Bloggveckan</a></li>
            </ul>
            
        </nav>
    </header>
    <main>
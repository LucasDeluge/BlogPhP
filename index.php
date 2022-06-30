<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"
            defer></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">       
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="topbar">
        <nav>
            <a href="./index.php">Accueil</a>
            <a href="./addArticle.php" target="_blank">Articles</a>
            <a href="./listArticle.php" target="_blank">Liste</a>
            <a href="./contact.php" target="_blank">Contact</a>
        </nav>
        <div class="log">
            <a href="./login.php"><i class="fa-solid fa-arrow-right-to-bracket"></i></a>
            <!-- <a href="./inscription.php">Inscription</a> -->
            <a href="./logoff.php"><i class="fa-solid fa-power-off"></i></a>
        </div>
    </header>
<div class="banniere">
</div>
<?php 
var_dump($_SESSION);
echo "<br>Connexion réussie, bienvenue {$_SESSION['users']['username']} !"
?>
<div class="body">
<div class="main">
    <div class="container-main">
<article class="article1">
    <a href="#" class="article1-img"><img src="./img/pexels-night.jpeg" alt="night"></a>
    <div class="article1-date">Màj le 29/06/2022</div>
    <h2 class="article1-title">Découverte du Monde</h2>
    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab, adipisci. Consequatur saepe delectus doloribus tempore at ducimus nisi incidunt expedita.</p>
</article>
<article class="article1">
    <a href="#" class="article1-img"><img src="./img/pexels-lake.jpeg" alt="lake"></a>
    <div class="article1-date">Màj le 29/06/2022</div>
    <h2 class="article1-title">LifeStyle</h2>
    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellendus illum aut mollitia impedit numquam cumque rerum animi vero doloribus dolores?</p>
</article>
<article class="article1">
    <a href="#" class="article1-img"><img src="./img/pexels-sand.jpeg" alt="sand"></a>
    <div class="article1-date">Màj le 29/06/2022</div>
    <h2 class="article1-title">Trucs & Astuces</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo voluptas alias doloribus accusamus iste. Dolore laudantium aspernatur quaerat vero consequuntur.</p>
</article>
</div>
</div>
<aside class="sidebar">
    <h4 class="sidebar-title">Envie de voyager ?</h4>
    <ul>
        <li><a href="#" target="_blank">Découverte</a></li>
        <li><a href="#" target="_blank">Informations</a></li>
        <li><a href="#" target="_blank">Idées</a></li>
        <li><a href="#" target="_blank">A propos</a></li>
    </ul>
    <hr>
    <h4 class="sidebar-title">Votre voyage</h4>
    <ul>
        <li><a href="#" target="_blank">Destinations</a></li>
        <li><a href="#" target="_blank">Préparatifs</a></li>
        <li><a href="#" target="_blank">Souvenirs</a></li>
        <li><a href="#" target="_blank">A propos</a></li>
    </ul>
</aside>
</div>
</body>
</html>
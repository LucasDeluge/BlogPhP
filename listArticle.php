<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"
            defer></script>
</head>
<body>
<main class="container">
    <p>
        <a href="addArticle.php">Ajouter</a>
    </p>
<?php
require_once 'connexionDB.php';

foreach ($pdo->query("select * from article")->fetchAll() as $key => $article) {
    $dateCreation = new DateTime($article['dateCreation']);
    echo"
    <div class='card border-primary my-2' style='max-width: 20rem;'>
  <div class='card-header'>{$article['nom']} ({$article['id']})</div>
  <div class='card-body'>
    <h4 class='card-title'>{$article['prix']} &euro;</h4>
    <p class='card-text'>{$article['poids']} kg</p>
    <p>
    <p class='card-text'>{$dateCreation->format('d/m/y h/m/s')}</p>
    <p>
    <form action='updateArticle.php?id={$article['id']}' method='post' class='mr-2'>
        <button type='submit' class='btn btn-warning'>Modifier</button>
    </form>
    <form action='deleteArticle.php?id={$article['id']}' method='post' class='mr-2'>
        <button type='submit' class='btn btn-danger'>Supprimer</button>
    </form>
</p>
  </div>
</div>
    ";
};
?>
</main>
</body>
</html>

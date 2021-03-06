<?php
session_start();
var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des articles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous" defer></script>
</head>

<body>
    <main class="container">
        <p>
            <strong><a href="addArticle.php">Ajouter</a></strong>
        </p>

        <?php
        require_once 'connexionDB.php';
        foreach ($pdo->query("select * from article")->fetchAll() as $key => $article) {
            // $_SESSION['users']['username'] = $user;
            $dateCreation = new DateTime($article['dateCreation']);
            echo "
            <div class='card border-primary my-2' style='max-width: 20rem;'>
                <div class='card-header'>{$article['titre']} ({$article['id']})</div>
                <img src='{$article['image']}' class='card-img-top' alt='image article'>
                <div class='card-body'>
                    <h4 class='card-title'>{$article['description']} </h4>
                    <p class='card-text'>{$article['categorie']} </p>
                    <p class='card-text'>Posté le {$dateCreation->format('d/m/y à H:i:s')} par {$article['users']} </p>
                    ";
                    if ($article['users'] == $_SESSION['users']['username']) {
                        echo"
                            <form action='updateArticle.php' method='post' class='mr-2'>
                                <input type='hidden' name='id' value='{$article['id']}'>
                                <button type='submit' class='btn btn-warning'>Modifier</button>
                            </form>
                            <form action='delArticle.php' method='post' class='mr-2'>
                                <input type='hidden' name='id' value='{$article['id']}'>
                                <button type='submit' class='btn btn-danger'>Supprimer</button>
                            </form>
                        ";
                    }
            echo"
                </div>
            </div>
            ";
        }
        ?>
    </main>
</body>

</html>
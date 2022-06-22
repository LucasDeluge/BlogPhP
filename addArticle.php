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
   <link rel="stylesheet" href="style.css">
</head>
<body id="sea">
<main class="container">
    <h1>Ajouter un article</h1>
    <?php

    //on récuperer les info du formulaire
    $titre = $_POST['titre'] ?? false;
    $titre = htmlspecialchars($titre);
    $categorie = $_POST['categorie'] ?? false;
    $categorie = htmlspecialchars($categorie);
    $message = $_POST['message'] ?? false;
    $message = htmlspecialchars($message);

    //on fait qq verif
    if (strlen($titre) > 0 && $categorie > 0 && $message > 0) {

        require_once 'connexionDB.php';

        //je prépare ma requete
        $req = $pdo->prepare('insert into article values (null, :titre, :categorie, :message, NOW())');
        // je l'execute avec les parametres necessaire
        if($req->execute([
            ':titre' => $titre,
            ':categorie' => $categorie,
            ':message' => $message,
        ])){
            echo '
            <div class="alert alert-dismissible alert-success">
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              <strong>Bravo!</strong> Article créer avec succès 
            <a href="./addArticle.php" class="alert-link"> - Retour </a>.
            </div>
            ';
        } else {
            echo '
            <div class="alert alert-dismissible alert-danger">
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              <strong>Erreur!</strong> <a href="#" class="alert-link">Une erreur est survenue lors de la création de l\'article
            </a> and try submitting again.
            </div>
            ';
        }
    }

    ?>
    <form action="" method="post">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Titre</label>
            <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Catégorie</label>
            <input type="text" class="form-control" id="categorie" name="categorie" placeholder="Catégorie">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Message</label>
            <input type="text" class="form-control" id="message" name="message" placeholder="Message">
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>

</main>
</body>
</html>
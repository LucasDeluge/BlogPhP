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
    <h1>Modifier un article</h1>
    <?php

    try {
        require_once 'connexionDB.php';

        $id = $_POST['id'] ?? false;
        $id = (int)$id;

        if ($id <= 0) {
            throw new Exception('Erreur lors de la récuperation de l\'article (id)');
        }
        //je prépare ma requet1e
        $req = $pdo->prepare('select * from article where id = :id');
        // je l'execute avec les parametres necessaire
        $req->execute([
            ':id' => $id
        ]);

        $article = $req->fetch(PDO::FETCH_ASSOC) ?? null;

    } catch (Exception $exception) {
        echo '
            <div class="alert alert-dismissible alert-danger">
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              <strong>Erreur!</strong> <a href="#" class="alert-link">Une erreur est survenue : ' . $exception->getMessage() . '
            </a> and try submitting again.
            </div>
            ';
    }

    //on récupere les info du formulaire
    $id = $_POST['id'] ?? false;
    $id = (int)$id;
    $titre = $_POST['titre'] ?? false;
    $titre = htmlspecialchars($titre);
    $categorie = $_POST['categorie'] ?? false;
    $categorie = htmlspecialchars($categorie);
    $description = $_POST['description'] ?? false;
    $description = htmlspecialchars($description);

    //on fait qq verif
    if (strlen($titre) > 0 && $categorie > 0 && $description > 0) {

        try {
            require_once 'connexionDB.php';

            //je prépare ma requete
            $req = $pdo->prepare('update article set titre = :titre, categorie = :categorie, description = :description where id = :id');
            // je l'execute avec les parametres necessaire
            $req->execute([
                ':id' => $id,
                ':titre' => $titre,
                ':categorie' => $categorie,
                ':description' => $description
            ]);

            echo '
            <div class="alert alert-dismissible alert-success">
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              <strong>Bravo!</strong> Article modifié avec succès 
              <a href="listArticle.php" class="alert-link"> Voir la liste </a>.
            </div>
            ';

//        } catch (Exception $Exception){
        } catch (PDOException|DomainException $Exception) {
            echo '
            <div class="alert alert-dismissible alert-danger">
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              <strong>Erreur!</strong> <a href="#" class="alert-link">Une erreur est survenue : ' . $Exception->getMessage() . '
            </a> and try submitting again.
            </div>
            ';
        }
    }

    ?>
     <form action="" method="post">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Titre</label>
            <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre"
                   value="<?php echo $article['titre'] ?>">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Categorie</label>
            <input type="text" class="form-control" id="categorie" name="categorie" placeholder="Categorie"
                   value="<?php echo $article['categorie'] ?>">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Description"
                   value="<?php echo $article['description'] ?>">
        </div>
        <input type="hidden" name="id" value="<?php echo $article['id'] ?>">
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>

</main>
</body>
</html>
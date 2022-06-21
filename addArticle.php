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
    <link rel="stylesheet" href="articles.css">
</head>
<body>
<main class="container">
    <h1>Ajouter un article</h1>
    <?php

    //on récuperer les info du formulaire
    $nom = $_POST['nom'] ?? false;
    $nom = htmlspecialchars($nom);
    $poids = $_POST['poids'] ?? false;
    $poids = (float)$poids;
    $prix = $_POST['prix'] ?? false;
    $prix = (float)$prix;

    //on fait qq verif
    if (strlen($nom) > 0 && $poids > 0 && $prix > 0) {

        require_once 'connexionDB.php';

        //je prépare ma requete
        $req = $pdo->prepare('insert into article values (null, :nom, :poids, :prix, NOW())');
        // je l'execute avec les parametres necessaire
        if($req->execute([
            ':nom' => $nom,
            ':poids' => $poids,
            ':prix' => $prix,
        ])){
            echo '
            <div class="alert alert-dismissible alert-success">
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              <strong>Bravo!</strong> Article créer avec succès 
            <a href="./index.php" class="alert-link"> - Retour </a>.
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
            <label for="exampleFormControlInput1" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Le nom du produit">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Poids</label>
            <input type="text" class="form-control" id="poids" name="poids" placeholder="Le poids du produit">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Prix</label>
            <input type="text" class="form-control" id="prix" name="prix" placeholder="Le prix du produit">
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>

</main>
</body>
</html>
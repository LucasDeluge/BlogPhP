<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="style.css">
</head>

<body id="sea">
    <main class="container">
        <h1>Ajouter un article</h1>
        <?php

        //Récuperer les info du formulaire
        $titre = $_POST['titre'] ?? false;
        $titre = htmlspecialchars($titre);
        $categorie = $_POST['categorie'] ?? false;
        $categorie = htmlspecialchars($categorie);
        $description = $_POST['description'] ?? false;
        $description = htmlspecialchars($description);
        $imgUpload = "img".date("dmYHis")."."."jpg" ?? false;

        //Vérifier 
        if (strlen($titre) > 0 && $categorie > 0 && $description > 0) {

            require_once 'connexionDB.php';

            var_dump($_FILES);
            $users = $_SESSION['users']['username'];
            $imgUpload = $_FILES["imgUpload"];
            $target_file = __DIR__ . './uploadimg/' . basename($imgUpload["name"]);
            $imgPath = './uploadimg/' . $imgUpload["name"];
            $uploadOk = true;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["imgUpload"]["tmp_name"]);
                if ($check !== false) {
                    echo "Le fichier a du contenu - " . $check["mime"] . ".";
                } else {
                    echo "Le fichier est vide.";
                    $uploadOk = false;
                }
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Désolé, ce fichier existe déjà.";
                $uploadOk = false;
            }

            // Check file size
            if ($_FILES["imgUpload"]["size"] > 10000000) {
                echo "Désolé, ce fichier est trop volumineux.";
                $uploadOk = false;
            }

            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" && $imageFileType != "svg"
            ) {
                echo "Désolé, seuls les formats JPG, JPEG, PNG, GIF & SVG sont autorisés.";
                $uploadOk = false;
            }

            // Check if $uploadOk is set to 0 by an error
            if (!$uploadOk) {
                echo "Désolé, le fichier ne respecte pas les conditions d'upload.";
                // if everything is ok, try to upload file
            } else {
                // Je déplace mon fichier du dossier temporaire vers son dossier définitif
                if (move_uploaded_file($_FILES["imgUpload"]["tmp_name"], $imgPath)) {
                    echo "Le fichier " . htmlspecialchars(basename($_FILES["imgUpload"]["name"])) . " a été déplacé.";
                } else {
                    echo "Désolé, une erreur est survenue.";
                }
            }

            //Je prépare ma requete
            $req = $pdo->prepare('insert into article values (null, :titre, :categorie, :description, :image, :users, NOW())');
            //Je l'exécute avec les paramètres nécessaires
            if ($req->execute([
                ':titre' => $titre,
                ':categorie' => $categorie,
                ':description' => $description,
                ':image' => $imgPath,
                ':users' => $users
            ])) {
                echo '
            <div class="alert alert-dismissible alert-success">
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              <strong>Bravo!</strong> Votre article a été déposé avec succès 
            <br><a href="./listArticle.php" class="alert-link"> - Voir la liste </a>.
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

        <form enctype="multipart/form-data" action="" method="post">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Titre : </label>
                <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Catégorie : </label>
                <input type="text" class="form-control" id="categorie" name="categorie" placeholder="Catégorie">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Description : </label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Description">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Image : </label>
                <br>
                <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
                <input type="file" name="imgUpload" />
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </main>
</body>

</html>
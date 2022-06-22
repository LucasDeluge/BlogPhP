
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Article</title>
</head>
<body>
<form action="intermediaire.php" method="post">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Titre</label>
            <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Catégorie</label>
            <input type="text" class="form-control" id="categorie" name="categorie" placeholder="Catégorie">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Message">
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</body>
</html>


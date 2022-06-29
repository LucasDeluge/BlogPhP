<?php

    try {
        require_once 'connexionDB.php';

        //je recupere l'id posté
        $id = $_POST['id'] ?? false;
        $id = (int)$id;

        //si il n'est pas valide, je declenche une erreur (met fin a l'execution)
        if ($id <= 0) {
            throw new Exception('Erreur lors de la suppression de l\'article (id)');
        }

        //je récupère mon article
        $article = $pdo->query('select * from article where id = '.$id)->fetch();
  
        //je prépare ma requete
        $req = $pdo->prepare('delete from article where id = :id');
        // je l'execute avec les parametres necessaire
        $req->execute([
            ':id' => $id
        ]);

        //je supprime l'image liée à l'article
        unlink($article['image']);

        echo '
            <div class="alert alert-dismissible alert-success">
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              <strong>Bravo!</strong> Article supprimé avec succès !
              <a href="listArticle.php" class="alert-link"> Voir la liste </a>.
            </div>
            ';

    } catch (Exception $exception) {
        echo '
            <div class="alert alert-dismissible alert-danger">
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              <strong>Erreur!</strong> <a href="#" class="alert-link">Une erreur est survenue : ' . $exception->getMessage() . '
            </a> and try submitting again.
            </div>
            ';
    }
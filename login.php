<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>

<body id="mountain">
    <div id="container">
        <?php
        try {
            $email = $_POST['email'] ?? null;
            $mdp = $_POST['passeword'] ?? null;
            $mdp = htmlspecialchars($mdp);

            //Je vérifie que le mdp n'est pas null et que le mail soit valide
            if (!is_null($mdp) && filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
                require_once 'connexionDB.php';

                $stmt = $pdo->prepare("select * from users where email = :email");

                if ($stmt->execute([
                    ':email' => $email
                ])) {
                    //si je trouve mon utilisateur en bdd
                    if ($stmt->rowCount() === 1) {
                        // je le lie a ma var $user
                        $user = $stmt->fetch();

                        //mdp identique?
                        if (password_verify($mdp, $user['passeword'])) {
                            session_start();
                            $_SESSION['users'] = $user;
                            var_dump($_SESSION);
                        }
                    } else {
                        throw new Exception('erreur : email ou mot de passe incorrect');
                    }
                } else {
                    throw new Exception('erreur : compte non reconnu');
                }
            } 
        } catch (PDOException | Exception $Exception) {
            echo '
                    <div class="alert alert-dismissible alert-danger">
                      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      <strong>Erreur!</strong> <a href="login.php" class="alert-link">Une erreur est survenue : ' . $Exception->getMessage() . '
                    </a>.
                    </div>
                    ';
        }
        ?>
        <form action="" method="POST">
            <h1>Connexion</h1>

            <label><b>Email</b></label>
            <input type="text" placeholder="Entrer l'adresse e-mail" name="email" required>

            <label><b>Mot de passe</b></label>
            <input type="password" placeholder="Entrer le mot de passe" name="passeword" required>

            <input type="submit" id='submit' value='CONNEXION'>

        </form>
<?php

 echo'<strong>Connexion réussie, Bienvenue !</strong>';
 echo'<br><strong><a href="./index.php">Retour</a></strong>';
?>
</div>
</body>

</html>
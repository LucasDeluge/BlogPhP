<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // On vérifie si le champ "recaptcha-response" contient une valeur
    if(empty($_POST['recaptcha-response'])){
        header('Location: index.php');
    } else{
        // On prépare l'URL
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=6LdRh6IgAAAAALsmLLkQMzkUWj5_KRrAzUJq5pVX&response={$_POST['recaptcha-response']}";

        // On vérifie si curl est installé
        if(function_exists('curl_version')){
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($curl);
        } else{
            // On utilisera file_get_contents
            $response = file_get_contents($url);
        }

        // On vérifie qu'on a une réponse
        if(empty($response) || is_null($response)){
            header('Location: index.php');
        } else{
            $data = json_decode($response);
            if($data->success){
                if(
                    isset($_POST['email']) && !empty($_POST['email']) &&
                    isset($_POST['passeword']) && !empty($_POST['passeword'])
                ){
                    // On nettoie le contenu
                    $email = strip_tags($_POST['email']);
                    $passeword = htmlspecialchars($_POST['passeword']);
                }
            } else{
                header('Location: index.php');
            }
        }
    }
}
?>

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
<strong><a href="./index.php">Accueil</a></strong>
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
                            header('Location: index.php');
                            exit();
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

            <a href="./inscription.php">Pas de compte ?</a>

            <input type="hidden" id="recaptchaResponse" name="recaptcha-response">

        </form>
</div>

<script src="https://www.google.com/recaptcha/api.js?render=6LdRh6IgAAAAAGBd6ZuwzVrucPyRV2fLfIx-9jvL"></script>
<script>
grecaptcha.ready(function() {
    grecaptcha.execute('6LdRh6IgAAAAAGBd6ZuwzVrucPyRV2fLfIx-9jvL', {action: 'homepage'}).then(function(token) {
        document.getElementById('recaptchaResponse').value = token
    });
});
</script>

</body>
</html>
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
                    isset($_POST['username']) && !empty($_POST['username']) &&
                    isset($_POST['passeword']) && !empty($_POST['passeword']) &&
                    isset($_POST['email']) && !empty($_POST['email'])
                ){
                    // On nettoie le contenu
                    $username = strip_tags($_POST['username']);
                    $passeword = htmlspecialchars($_POST['passeword']);
                    $email = strip_tags($_POST['email']);

                    // Traitement des données
                    echo "Inscription de {$username} réussie";
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
    <title>S'inscrire</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body id="beach">
<div id="container">
        <form action="" method="POST">
            <h1>Inscription</h1>
                
            <label><b>Nom d'utilisateur</b></label>
            <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

            <label><b>Mot de passe</b></label>
            <input type="password" placeholder="Entrer le mot de passe" name="passeword" required>

            <label><b>Email</b></label>
            <input type="text" placeholder="Entrer l'adresse e-mail" name="email" required>

            <input type="submit" id='submit' value='INSCRIPTION' >

            <input type="hidden" id="recaptchaResponse" name="recaptcha-response">
        </form>
            <?php
    $username = $_POST['username'] ?? null;        
    $email = $_POST['email'] ?? null;
    $mdp = $_POST['passeword'] ?? null;
    $mdp = htmlspecialchars($mdp);

    //je verifie que le mdp n'est pas null et que le mail soit valide
    if (!is_null($mdp) && filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
        require_once 'connexionDB.php';
        $stmt = $pdo->prepare("insert into users values (null, :username, :passeword, :email)");
        $res = $stmt->execute([
            ':username' => $username,
            ':passeword' => password_hash($mdp, PASSWORD_ARGON2I),
            ':email' => $email
        ]);
        echo"Salut " . $username . "!, votre adresse e-mail est ". $email;
        echo'<br><a href="./index.php">Retour</a>';
    }
     ?>

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
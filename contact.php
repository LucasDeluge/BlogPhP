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
                    isset($_POST['email']) && !empty($_POST['email']) &&
                    isset($_POST['message']) && !empty($_POST['message'])
                ){
                    // On nettoie le contenu
                    $username = strip_tags($_POST['username']);
                    $email = strip_tags($_POST['email']);
                    $message = htmlspecialchars($_POST['message']);

                    // Traitement des données
                    echo "Message de {$username} envoyé";
                }
            } else{
                header('Location: index.php');
            }
        }
    }
} 
// else{
//     http_response_code(405);
//     echo 'Méthode non autorisée';
// }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nous contacter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body id="snow">
  <div id="container">
<form action="" method="POST">
            <h1>Contact</h1>
                
            <label><b>Nom d'utilisateur</b></label>
            <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
<br>
            <label><b>Email</b></label>
            <input type="text" placeholder="Entrer l'adresse e-mail" name="email" required>
<br>
            <label><b>Message : </b></label>
            
            <textarea type="text" name="message" style="height:200px; width:394px" placeholder="Entrer votre message ici" required></textarea>
<br>
            <input type="submit" id='submit' value='ENVOYER' >

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

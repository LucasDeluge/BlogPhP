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
  </body>
</html>
<?php
// Permet l'affichage des erreurs
ini_set('display_errors', 'On');
error_reporting(E_ALL);
$dsn = 'mysql:dbname=blog;host=localhost;port=3306;charset=utf8';
$user = 'userblog';
$pwd = 'J3.]_)CDQ4/lpUbx';

// Crée la connexion à la BdD
$pdo = new PDO($dsn, $user, $pwd, [
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Permet d'activer le mode verbeux pour les erreurs
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Lire les enregistrements comme un tableau
]);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body id="beach">
<div id="container">
        <form action="verification.php" method="POST">
            <h1>Inscription</h1>
                
            <label><b>Nom d'utilisateur</b></label>
            <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

            <label><b>Mot de passe</b></label>
            <input type="password" placeholder="Entrer le mot de passe" name="password" required>

            <label><b>Email</b></label>
            <input type="text" placeholder="Entrer l'adresse e-mail" name="email" required>

            <input type="submit" id='submit' value='INSCRIPTION' >
  </body>
</html>
<?php
  // Vérifie qu'il provient d'un formulaire
  $user_password = $_POST["password"]  ?? false;
  $user_name = $_POST["username"]  ?? false;
  $user_mail = $_POST["email"]  ?? false;
  if ($user_name !== false && $user_mail !== false && $user_password !== 0) {

    $sql = "INSERT INTO username values(null, '$user_name', '$user_mail', '$user_password' )";
  }
 $pdo->exec($sql);
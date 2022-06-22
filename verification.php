<?php
  // Vérifier qu'il provient d'un formulaire
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Identifiants mysql
    $host = "localhost";
    $username = "userblog";
    $password = "J3.]_)CDQ4/lpUbx";
    $database = "blog";
    $name = $_POST["username"]; 
    $mdp = $_POST["passeword"]; 
    $email = $_POST["email"];

    if (!isset($name)){
      die("S'il vous plaît entrez votre nom");
    }
    if (!isset($mdp)){
      die("S'il vous plaît entrez votre mot de passe");
    }
    if (!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
      die("S'il vous plaît entrez votre adresse e-mail");
    }  
    //Ouvrir une nouvelle connexion au serveur MySQL
    $mysqli = new mysqli($host, $username, $password, $database);
    
    //Afficher toute erreur de connexion
    if ($mysqli->connect_error) {
      die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    }  
    
    //Préparer la requête d'insertion SQL
    $statement = $mysqli->prepare("INSERT INTO users (username, passeword, email) VALUES(?, ?, ?)"); 
    //Associer les valeurs et exécuter la requête d'insertion
    $statement->bind_param('sss', $name, $mdp, $email); 
    
    if($statement->execute()){
      print "Salut " . $name . "!, votre adresse e-mail est ". $email;
      echo'<br><a href="./index.php">Retour</a>';
    }else{
      print $mysqli->error; 
    }
  }
?>
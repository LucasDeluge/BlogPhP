<?php
//Permet d'afficher les erreurs
ini_set('display_errors', 'On');
error_reporting(E_ALL);

$dsn = 'mysql:dbname=blog;host=localhost;port=3306;charset=utf8';

$user = 'userblog';
$pwd = 'J3.]_)CDQ4/lpUbx';
// $user = 'root';
// $pwd = '';

//Créer la connexion à la bdd
$pdo = new PDO($dsn, $user, $pwd, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // permet d'activer le mode verbeux pour les erreurs
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC    // lire les enregistrement comme un tableau
]);
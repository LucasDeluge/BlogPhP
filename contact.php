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
        </form>
</div>
  <script src="./scripts.js"></script>
</body>
</html>
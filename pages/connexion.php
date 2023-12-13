<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=reseausocial', 'root', 'root');

if(isset($_POST['login'])) {
   $email = htmlspecialchars($_POST['email']);
   $mot_de_passe = $_POST['mot_de_passe'];
   if(!empty($email) AND !empty($mot_de_passe)) {
      $requser = $bdd->prepare("SELECT * FROM membres WHERE email = ?");
      $requser->execute(array($email));
      if($requser->rowCount() == 1) {
         $userinfo = $requser->fetch();
         if (password_verify($mot_de_passe, $userinfo['mot_de_passe'])) {
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['nom']= $userinfo['nom'];
            $_SESSION['prenom']= $userinfo['prenom'];
            $_SESSION['email'] = $userinfo['email'];
            $_SESSION['pseudo'] = $userinfo['pseudo'];
            $_SESSION['photo_profil'] = $userinfo['photo_profil'];
            $_SESSION['admin'] = $userinfo['admin'];
            $_SESSION['description'] = $userinfo['description'];
            $_SESSION['date_creation'] = $userinfo['date_creation'];
            header("Location: accueil.php?id=".$_SESSION['id']);
         } else {
            $erreur = "Email ou mot de passe incorrect !";
         }
      } else {
         $erreur = "Email ou mot de passe incorrect !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="inscription.css">
</head>
<body>
    <div class="container">
        <h1 class="nom">ECE In</h1>
        <h2>Connexion</h2>
        <form action="connexion.php" method="post">
            <label for="email">E-mail :</label>
            <input type="email" name="email" required>

            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" name="mot_de_passe" required>

            <button type="submit" name="login">Se connecter</button>
        </form>
        <?php if(isset($erreur)) { echo '<p style="color:red;">'.$erreur.'</p>'; } ?>
        <p>Pas encore inscrit ? <a href="inscription.php">Inscrivez-vous ici</a>.</p>
    </div>
</body>
</html>

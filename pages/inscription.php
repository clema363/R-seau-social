<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="inscription.css">
</head>
<body>
    <div class="container">
        <h1 class="nom">ECE In</h1>
        <h2>Inscription</h2>
        <form action="inscription.php" method="post">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" required>

            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" required>

            <label for="pseudo">Pseudo :</label>
            <input type="text" name="pseudo" required>

            <label for="email">E-mail :</label>
            <input type="email" name="email" required>

            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" name="mot_de_passe" required>

            <label for="confirmation_mot_de_passe">Confirmer le mot de passe :</label>
            <input type="password" name="confirmation_mot_de_passe" required>

            <button type="submit">S'inscrire</button>
        </form>
        <?php

            $bdd = new PDO('mysql:host=localhost;dbname=reseausocial', 'root', 'root' );

            // Vérification si le formulaire est soumis
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des données du formulaire
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $pseudo = $_POST['pseudo'];
                $email = $_POST['email'];
                $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); // Hachage du mot de passe
                $photo_profil_defaut = 'profil.png';
                if ($_POST['mot_de_passe']===$_POST['confirmation_mot_de_passe']) {
                    if ($_POST['mot_de_passe'] === 'admin') {
                        $requete = $bdd->prepare('INSERT INTO membres (nom, prenom, pseudo, email, mot_de_passe, photo_profil, admin) VALUES (?, ?, ?, ?, ?, ?, ?)');
                        $requete->execute([$nom, $prenom, $pseudo, $email, $mot_de_passe, $photo_profil_defaut, 1]);
                    }
                    else {
                        $requete = $bdd->prepare('INSERT INTO membres (nom, prenom, pseudo, email, mot_de_passe, photo_profil) VALUES (?, ?, ?, ?, ?, ?)');
                        $requete->execute([$nom, $prenom, $pseudo, $email, $mot_de_passe, $photo_profil_defaut]);   
                    }
                    // Redirection vers la page de connexion
                    header('Location: connexion.php');
                    exit();
                }
                else {
                    echo '<p style="color:red;">Il faut que les deux mots de passes soient identiques';
                }
                
            }
        ?>
        <p>Déjà inscrit ? <a href="connexion.php">Connectez-vous ici</a>.</p>
    </div>
</body>
</html>

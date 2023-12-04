<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <form action="connexion.php" method="post">
            <label for="email">E-mail :</label>
            <input type="email" name="email" required>

            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" name="mot_de_passe" required>

            <button type="submit">Se connecter</button>
        </form>
        <p>Pas encore inscrit ? <a href="inscription.php">Inscrivez-vous ici</a>.</p>
    </div>
    <?php
        // Connexion à la base de données (à adapter avec vos propres informations)
        $bdd = new PDO('mysql:host=localhost;dbname=reseausocial', 'root', 'root');

        // Vérification si le formulaire est soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des données du formulaire
            $email = $_POST['email'];
            $mot_de_passe = $_POST['mot_de_passe'];

            // Recherche de l'utilisateur dans la base de données
            $requete = $bdd->prepare('SELECT * FROM membres WHERE email = ?');
            $requete->execute([$email]);
            $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

            // Vérification du mot de passe
            if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
                // Authentification réussie, rediriger vers la page sécurisée
                header('Location: accueil.php');
                exit();
            } else {
                // Authentification échouée, rediriger vers la page de connexion avec un message d'erreur
                header('Location: connexion.php?erreur=1');
                exit();
            }
        }
        ?>

</body>
</html>
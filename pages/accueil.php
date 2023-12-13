<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header('Location: connexion.php');
        exit;
    }
    
    /*$host = 'localhost';
    $dbname = 'reseausocial';  // Remplacez par le nom de votre base de données
    $username = 'root';
    $password = 'root';  // Laissez vide si aucun mot de passe n'est défini

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM membres";  // Assurez-vous que la table s'appelle 'membres'
        $stmt = $conn->query($sql);

        $membres = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accueil</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var navItems = document.querySelectorAll('#nav_plus nav a');

            navItems.forEach(function (item) {
                var icon = item.querySelector('.icone');
                if (icon) {
                    var originalSrc = icon.src;
                    var hoverSrc = icon.getAttribute('data-hover');

                    item.addEventListener('mouseover', function () {
                        icon.src = hoverSrc;
                    });

                    item.addEventListener('mouseout', function () {
                        icon.src = originalSrc;
                    });
                }
            });
        });
    </script>
</head>
<body>
    <div id="nav_plus">
        <nav>
            <img id="logo" src="images/logo.png">
            <ul>
                <li><a href="accueil.php" class="active"><img class="icone" src="images/icones/accueil_noir.png" data-hover="images/icones/accueil_noir.png">  Accueil</a></li>
                <li><a href="reseau.php"><img class="icone" src="images/icones/reseau_bleu.png" data-hover="images/icones/reseau_noir.png">  Mon reseau</a></li>
                <li><a href="profil.php"><img class="icone" src="images/icones/profil_bleu.png" data-hover="images/icones/profil_noir.png">  Vous</a></li>
                <li><a href="notifications.php"><img class="icone" src="images/icones/notifications_bleu.png" data-hover="images/icones/notifications_noir.png">  Notifications</a></li>
                <li><a href="messagerie.php"><img class="icone" src="images/icones/messagerie_bleu.png" data-hover="images/icones/messagerie_noir.png">  Messagerie</a></li>
                <li><a href="emplois.php"><img class="icone" src="images/icones/emplois_bleu.png" data-hover="images/icones/emplois_noir.png">  Emplois</a></li>
            </ul>
        </nav>
    </div>
    <div id="wrapper">
        <div id="section">
            <?php echo "Bonjour, " . $_SESSION['pseudo']; ?>
            <?php echo "<img src='images/photo_de_profil/" . $_SESSION['photo_profil'] . "' width='100px' height='100px' border-radius='100%'>";?>
        </div>
        <footer>
            <p>Je suis le footer</p>
        </footer>
    </div>
</body>
</html>

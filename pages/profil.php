<?php
session_start();
if (!isset($_SESSION['id'])) {
        header('Location: connexion.php');
        exit;
}

$bdd = new PDO('mysql:host=localhost;dbname=reseausocial', 'root', 'root');
$erreur = ''; // Initialisation de la variable d'erreur

if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])) {
    $tailleMax = 2097152;
    $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
    if($_FILES['avatar']['size'] <= $tailleMax) {
        $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
        if(in_array($extensionUpload, $extensionsValides)) {
            $chemin = "images/photo_de_profil/".$_SESSION['id'].".".$extensionUpload;
            $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
            if($resultat) {
                $photo_profil = $_SESSION['id'].".".$extensionUpload;
                $updateavatar = $bdd->prepare('UPDATE membres SET photo_profil = :photo_profil WHERE id = :id');
                $updateavatar->execute(array(
                    'photo_profil' => $photo_profil,
                    'id' => $_SESSION['id']
                ));

                $_SESSION['photo_profil'] = $photo_profil; // Mise à jour de la session
                header('Location: profil.php?id='.$_SESSION['id']);
            } else {
                $erreur = "Erreur durant l'importation de votre photo de profil";
            }
        } else {
            $erreur = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
        }
    } else {
        $erreur = "Votre photo de profil ne doit pas dépasser 2Mo";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vous</title>
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
                <li><a href="accueil.php"><img class="icone" src="images/icones/accueil_bleu.png" data-hover="images/icones/accueil_noir.png">  Accueil</a></li>
                <li><a href="reseau.php"><img class="icone" src="images/icones/reseau_bleu.png" data-hover="images/icones/reseau_noir.png">  Mon reseau</a></li>
                <li><a href="profil.php" class="active"><img class="icone" src="images/icones/profil_noir.png" data-hover="images/icones/profil_noir.png">  Vous</a></li>
                <li><a href="notifications.php"><img class="icone" src="images/icones/notifications_bleu.png" data-hover="images/icones/notifications_noir.png">  Notifications</a></li>
                <li><a href="messagerie.php"><img class="icone" src="images/icones/messagerie_bleu.png" data-hover="images/icones/messagerie_noir.png">  Messagerie</a></li>
                <li><a href="emplois.php"><img class="icone" src="images/icones/emplois_bleu.png" data-hover="images/icones/emplois_noir.png">  Emplois</a></li>
            </ul>
        </nav>
    </div>
    <div id="wrapper">
        <div id="section">
           
            <?php echo $_SESSION['photo_profil']; ?>
            <br>
            <?php echo $_SESSION['pseudo']; ?>
            <br>
            <?php echo "Inscrits depuis le ".$_SESSION['date_creation'];?>
            <br>
            <?php echo "<img id='photo' src='images/photo_de_profil/" . $_SESSION['photo_profil'] . "'>";?>
            <br>
            <button id="toggleButton">Changer la photo de profil</button>
            <div id="menuContent" style="display: none;">
                <form method="POST" enctype="multipart/form-data"> 
                    <input type="file" name="avatar">
                    <input type="submit" value="mettre a jour">
                </form>

                <?php
                    if($erreur != '') {
                        echo '<p style="color:red;">'.$erreur.'</p>';
                    }
                ?>
            </div>
            <script>
                document.getElementById('toggleButton').addEventListener('click', function() {
                    var content = document.getElementById('menuContent');
                    if (content.style.display === 'none' || content.style.display === '') {
                        content.style.display = 'block';
                        this.textContent = 'Annuler';
                    } else {
                        content.style.display = 'none';
                        this.textContent = 'Changer la photo de profil';
                    }
                });
            </script>

            <br>
            <?php echo "Description : ".$_SESSION['description'];?>

        </div>
        <footer>
            <p>Je suis le footer</p>
        </footer>
    </div>
</body>
</html>

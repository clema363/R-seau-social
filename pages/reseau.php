<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header('Location: connexion.php');
        exit;
    }
    $bdd = new PDO('mysql:host=localhost;dbname=reseausocial', 'root', 'root');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reseau</title>
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
                <li><a href="reseau.php" class="active"><img class="icone" src="images/icones/reseau_noir.png" data-hover="images/icones/reseau_noir.png">  Mon reseau</a></li>
                <li><a href="profil.php"><img class="icone" src="images/icones/profil_bleu.png" data-hover="images/icones/profil_noir.png">  Vous</a></li>
                <li><a href="notifications.php"><img class="icone" src="images/icones/notifications_bleu.png" data-hover="images/icones/notifications_noir.png">  Notifications</a></li>
                <li><a href="messagerie.php"><img class="icone" src="images/icones/messagerie_bleu.png" data-hover="images/icones/messagerie_noir.png">  Messagerie</a></li>
                <li><a href="emplois.php"><img class="icone" src="images/icones/emplois_bleu.png" data-hover="images/icones/emplois_noir.png">  Emplois</a></li>
            </ul>
        </nav>
    </div>
    <div id="wrapper">
        
        <div id="section">
                
                <h2>Réseau de <?php echo $_SESSION['prenom']; ?></h2>
                
<!-- ------------------------------    ABONNÉS   --------------------------------------  -->
                <br>
                <h3>Abonnés</h3>
                <br>
                <?php

                // Affichage des abonnés
                // Affichage des abonnés
                $sql_follower = "SELECT m.id, m.nom, m.prenom, m.pseudo, m.email FROM membres m INNER JOIN follow f ON m.id = f.id_follower WHERE f.id_following = ? AND m.id != ?";
                $stmt_follower = $bdd->prepare($sql_follower);
                $stmt_follower->execute([$_SESSION['id'], $_SESSION['id']]);

                if ($stmt_follower->rowCount() > 0) {
                    while ($row_follower = $stmt_follower->fetch(PDO::FETCH_ASSOC)) {
                        
                        // Ici, $id_follower est l'ID de l'abonné
                        $id_follower = $row_follower['id'];

                        // Vérification si l'utilisateur actuel suit cet abonné
                        $checkQuery = "SELECT * FROM follow WHERE id_follower = ? AND id_following = ?";
                        $checkStmt = $bdd->prepare($checkQuery);
                        $checkStmt->execute([$_SESSION['id'], $id_follower]);

                        echo "<div class='petit_profil' >" . $row_follower["nom"] . " " . $row_follower["prenom"] . "<br>" . $row_follower["pseudo"];

                        if ($checkStmt->rowCount() == 0) {
                            // Affiche le bouton "Suivre" si l'utilisateur actuel ne suit pas déjà l'abonné
                            ?>
                                <form action="reseau.php" method="post">
                                    <input type="hidden" name="id_following" value="<?php echo $id_follower; ?>">
                                    <input type="submit" value="Suivre" class="bouton_follow">
                                </form>
                            <?php
                        } else {
                            // Affiche le bouton "Se désabonner" si l'utilisateur actuel suit déjà l'abonné
                            ?>
                                <form action="reseau.php" method="post">
                                    <input type="hidden" name="id_unfollow" value="<?php echo $id_follower; ?>">
                                    <input type="submit" value="Se désabonner" class="bouton_unfollow">
                                </form>
                            <?php
                        }

                        echo "</div>"; // Fermeture de la div

                    }
                } else {
                    echo "Vous n'avez pas d'abonnés :(";
                }



                
                ?>

                <br>
            
                <br>


<!-- ------------------------------    ABONNEMENT   --------------------------------------  -->


                <h3>Abonnements</h3>
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_unfollow'])) {
                    $id_follower = $_SESSION['id'];
                    $id_following = $_POST['id_unfollow'];

                    
                        
                    $query = "DELETE FROM follow WHERE id_follower = ? AND id_following = ?";
                    $requete = $bdd->prepare($query);
                    $requete->execute([$id_follower, $id_following]);
                    
                    ?>
                        <script>location.reload();</script>
                    <?php
                    
                }
                
                    $sql_following = "SELECT m.id, m.nom, m.prenom, m.pseudo, m.email FROM membres m INNER JOIN follow f ON m.id = f.id_following WHERE f.id_follower = ? AND m.id != ?";
                    $stmt_following = $bdd->prepare($sql_following);
                    $stmt_following->execute([$_SESSION['id'], $_SESSION['id']]);
                    


                    
                    
                    

                    if ($stmt_following->rowCount() > 0) {
                        while ($row_following = $stmt_following->fetch(PDO::FETCH_ASSOC)) {
                            echo "<div class='petit_profil' >" . $row_following["nom"] . " " . $row_following["prenom"] . " <br> " . $row_following["pseudo"];
                            ?>

                            <form action="reseau.php" method="post">
                                <input type="hidden" name="id_unfollow" value="<?php echo $row_following['id']; ?>">
                                <input type="submit" value="Se désabonner" class="bouton_unfollow">
                            </form>

                            </div>

                            <?php
                        }

                    } else {
                        echo "Vous n'avez pas d'abonnements.";
                    }
                ?>
                <br>
                



<!-- ------------------------------    À SUIVRE   --------------------------------------  -->


                <h3>À suivre</h3>

                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_following'])) {
                    $id_follower = $_SESSION['id'];
                    $id_following = $_POST['id_following'];

                    

                    // Vérifier si l'utilisateur actuel suit déjà cette personne
                    
                    $checkQuery = "SELECT * FROM follow WHERE id_follower = ? AND id_following = ?";
                    $checkStmt = $bdd->prepare($checkQuery);
                    $checkStmt->execute([$id_follower, $id_following]);

                        if ($checkStmt->rowCount() == 0) {
                            // Insérer la relation de suivi si elle n'existe pas déjà
                            $query = "INSERT INTO follow (id_follower, id_following) VALUES (?, ?)";
                            $requete = $bdd->prepare($query);
                            $requete->execute([$id_follower, $id_following]);
                            ?>
                                <script>location.reload();</script>
                            <?php

                        }
                        
                    }
                

            
                    $sql_non_follow = "SELECT m.id, m.nom, m.prenom, m.pseudo, m.email 
                            FROM membres m 
                            LEFT JOIN follow f ON m.id = f.id_following AND f.id_follower = ?
                            WHERE f.id_following IS NULL AND m.id != ?";
                    $stmt_non_follow = $bdd->prepare($sql_non_follow);
                    $stmt_non_follow->execute([$_SESSION['id'], $_SESSION['id']]);
                    
                    

                    if ($stmt_non_follow->rowCount() > 0) {
                        while ($row_non_follow = $stmt_non_follow->fetch(PDO::FETCH_ASSOC)) {
                            echo "<div class='petit_profil' >" . $row_non_follow["nom"] . " " . $row_non_follow["prenom"] . " <br> " . $row_non_follow["pseudo"];
                            ?>

                            <form action="reseau.php" method="post">
                                <input type="hidden" name="id_following" value="<?php echo $row_non_follow['id']; ?>">
                                <input type="submit" value="Suivre" class="bouton_follow">
                            </form>

                            </div>
                            
                            <?php


                        }

                    } else {
                        echo "il n'y à plus d'utilisateur à suivre.";
                    }
                ?>

        </div>
        <footer>
            <p>Je suis le footer</p>
        </footer>
    </div>
</body>
</html>

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
                <li><a href="accueil.php"><img class="icone" src="images/icones/accueil_bleu.png" data-hover="images/icones/accueil_noir.png">  Accueil</a></li>
                <li><a href="reseau.php"><img class="icone" src="images/icones/reseau_bleu.png" data-hover="images/icones/reseau_noir.png">  Mon reseau</a></li>
                <li><a href="profil.php"><img class="icone" src="images/icones/profil_bleu.png" data-hover="images/icones/profil_noir.png">  Vous</a></li>
                <li><a href="notifications.php"><img class="icone" src="images/icones/notifications_bleu.png" data-hover="images/icones/notifications_noir.png">  Notifications</a></li>
                <li><a href="messagerie.php"><img class="icone" src="images/icones/messagerie_bleu.png" data-hover="images/icones/messagerie_noir.png">  Messagerie</a></li>
                <li><a href="emplois.php" class="active"><img class="icone" src="images/icones/emplois_bleu.png" data-hover="images/icones/emplois_noir.png">  Emplois</a></li>
            </ul>
        </nav>
    </div>
    <div id="wrapper">
        
        <div id="section">
           <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
        <footer>
            <p>Je suis le footer</p>
        </footer>
    </div>
</body>
</html>

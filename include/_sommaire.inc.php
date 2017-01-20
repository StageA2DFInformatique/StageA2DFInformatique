<?php
/**
 * Contient la division pour le sommaire, sujet à des variations suivant la 
 * connexion ou non d'un utilisateur, et dans l'avenir, suivant le type de cet utilisateur 
 * @todo  RAS
 */
$repInclude = './include/';
include ($repInclude . "connexionBDD.php");
//include ($repInclude . "_bdGestionDonnees.lib.php");
?>
<!-- Division pour le sommaire -->
<div id="menuGauche">
    <div id="infosUtil">
        <?php
        if (isset($_SESSION["loginUser"])) {
            $idUser = $_SESSION["idUser"];
            $nom = $_SESSION['nomUser'];
            $prenom = $_SESSION['prenomUser'];
            $login = $_SESSION['loginUser'];
        }
        ?>  
    </div>  
    <?php
    if (isset($_SESSION["loginUser"])) {
        ?>
        <div class="arrondie2">
            <ul id="menuList">
                <li class="smenu">
                    <a href="cAccueil.php" title="Accueil">Accueil</a>
                </li>

                <li class="smenu">
                    <a href="cSaisieEnCours.php" title="En cours">En cours</a>
                    <ul>
                        <li><a href="cSemaine1.php">Semaine n°1</a></li>
                        <li><a href="cSemaine2.php">Semaine n°2</a></li>
                        <li><a href="cSemaine3.php">Semaine n°3</a></li>
                        <li><a href="cSemaine4.php">Semaine n°4</a></li>
                    </ul>
                </li>
                <li class="smenu">
                    <a href="cSaisieTableauBord.php" title="Tableau de bord">Tableau de bord</a>
                </li>          
                <li class="smenu">
                    <a href="cConsulterGraphique.php" title="Graphique">Graphique</a>
                </li> 
                <li class="smenu">
                    <a href="cGestionFournisseurs.php" title="Fournisseurs">Fournisseurs</a>
                </li> 
                <li class="smenu">
                    <a href="cGestionCharges.php" title="Charges">Charges</a>
                </li>  
                <li class="smenu">
                    <a href="cSeDeconnecter.php" title="Se déconnecter">Se déconnecter</a>
                </li>
        </div>
        <?php
    }
    ?>
</div>

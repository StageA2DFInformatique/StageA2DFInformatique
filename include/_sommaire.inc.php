<?php
/**
 * Contient la division pour le sommaire, sujet à des variations suivant la 
 * connexion ou non d'un utilisateur, et dans l'avenir, suivant le type de cet utilisateur 
 * @todo  RAS
 */
$repInclude = './include/';
include ($repInclude . "connexionBDD.php");
?>
<!-- Division pour le sommaire -->
<div id="menuGauche">
    <div id="infosUtil">
        <?php
        if (estVisiteurConnecte()) {
            $idUser = obtenirIdUserConnecte();
            $lgUser = obtenirDetailVisiteur($idConnexion, $idUser);
            $nom = $lgUser['nom'];
            $prenom = $lgUser['prenom'];
            $login = $lgUser['login'];
            ?>
            <h2>
                <?php
                ?>
            </h2>
            <?php
            //different affichage selon la personne connecté (administrateur ou simple visiteur)
            if ($login == 'admin') {
                echo '<center><h3>François Baraud</h3></center>';
            }
        }
        ?>  
    </div>  
    <?php
    if (estVisiteurConnecte()) {
        ?>
        <div class="arrondie2">
            <ul id="menuList">
                <li class="smenu">
                    <a href="cAccueil.php" title="Page d'accueil">Accueil</a>
                </li>

                <li class="smenu">
                    <a href="cSaisieEncours.php" title="En cours">En cours</a>
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

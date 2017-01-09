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
                echo $nom . " " . $prenom;
                ?>
            </h2>
            <?php
            //different affichage selon la personne connecté (administrateur ou simple visiteur)
            if ($login != 'admin') {
                ?>
                <h3>Employé</h3>  
                <?php
            } else {
                echo '<h3>François Baraud</h3>';
            }
            ?>
            <?php
        }
        ?>  
    </div>  
    <?php
    if (estVisiteurConnecte()) {
        ?>
    <div class="corpsForm">
        <ul id="menuList">
            <li class="smenu">
                <a href="cAccueil.php" title="Page d'accueil">Accueil</a>
            </li>
            <li class="smenu">
                <a href="cSeDeconnecter.php" title="Se déconnecter">Se déconnecter</a>
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
                <a href="cModifierFournisseurs.php" title="Fournisseurs">Fournisseurs</a>
            </li> 
            <li class="smenu">
                <a href="cModifierCharges.php" title="Charges">Charges</a>
            </li>  
 <?php
            //accès aux fonctionnalités d'administration du site seulement possible pour l'administrateur du site
            if ($login == 'admin') {
                ?>
                <li class="smenu">
                    <a href="cConsulterBaseDeDonnee.php" title="Consultation de toutes les tables de la base de donnée">Affichage de la BDD</a>
                </li>
                <li class="smenu">
                    <a href="cCrypterMotsDePasseBDD.php" title="Crypter les mots de passe de la base de donnée">Crypter mots de passe BDD</a>
                </li>
                <li class="smenu">
                    <a href="cResetMotsDePasseBDD.php" title="Remettre les mots de passe de base dans la base de donnée">Reset mots de passe BDD</a>
                </li>
                </div>
                <?php
            }
            ?>
        </ul>
        <?php
        // affichage des éventuelles erreurs déjà détectées
        if (nbErreurs($tabErreurs) > 0) {
            echo toStringErreurs($tabErreurs);
        }
    }
    ?>
</div>

<?php

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");

//Division principale
echo '<div id="contenu">';
echo "<h2><center>Suppression d'une vente ou d'un dépannage</center></h2>";

use modele\dao\Semaine4DAO;
use modele\metier\Semaine4;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();


// SUPPRIMER LA VENTE OU LE DEPANNAGE SÉLECTIONNÉ(E)

$id = $_REQUEST['id4'];  // Non obligatoire mais plus propre
$uneVente4 = Semaine4DAO::getOneById($id4);
/* @var $uneVente4 Semaine4  */
$designation4 = $uneVente4->getDesignation4();
$prix4 = $uneVente4->getPrix4();
echo "
<br><center>Voulez-vous vraiment supprimer la vente ou le dépannage '$designation4' d'une valeur de $prix ?
<h3><br>
<a href='cSemaine1.php?action=validerSupprimerVente1&id=$id4'>Oui</a>
&nbsp; &nbsp; &nbsp; &nbsp;
<a href='cSemaine4.php?'>Non</a></h3>
</center>";

require($repInclude . "_fin.inc.php");
echo '</div>';

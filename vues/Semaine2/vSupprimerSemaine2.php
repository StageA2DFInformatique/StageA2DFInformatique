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

use modele\dao\Semaine2DAO;
use modele\metier\Semaine2;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();


// SUPPRIMER LA VENTE OU LE DEPANNAGE SÉLECTIONNÉ(E)

$id = $_REQUEST['id2'];  // Non obligatoire mais plus propre
$uneVente2 = Semaine2DAO::getOneById($id2);
/* @var $uneVente2 Semaine2  */
$designation2 = $uneVente2->getDesignation2();
$prix2 = $uneVente2->getPrix2();
echo "
<br><center>Voulez-vous vraiment supprimer la vente ou le dépannage '$designation2' d'une valeur de $prix ?
<h3><br>
<a href='cSemaine2.php?action=validerSupprimerVente2&id=$id2'>Oui</a>
&nbsp; &nbsp; &nbsp; &nbsp;
<a href='cSemaine2.php?'>Non</a></h3>
</center>";

require($repInclude . "_fin.inc.php");
echo '</div>';

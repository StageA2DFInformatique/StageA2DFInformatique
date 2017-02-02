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

$id = $_REQUEST['id'];  // Non obligatoire mais plus propre
$uneVente = Semaine4DAO::getOneById($id);
/* @var $uneVente Semaine4  */
$designation = $uneVente->getDesignation();
$prix = $uneVente->getPrix();
$type = $uneVente->getType();
echo "
<br><center>Voulez-vous vraiment supprimer le / la $type '$designation' d'une valeur de $prix € ?
<h3><br>
<a href='cSemaine4.php?action=validerSupprimerVente&id=$id'>Oui</a>
&nbsp; &nbsp; &nbsp; &nbsp;
<a href='cSemaine4.php?'>Non</a></h3>
</center>";

require($repInclude . "_fin.inc.php");
echo '</div>';

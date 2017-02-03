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

use modele\dao\EnCoursDAO;
use modele\metier\Operation;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();


// SUPPRIMER LA VENTE OU LE DEPANNAGE SÉLECTIONNÉ(E)

$id = $_REQUEST['id'];  // Non obligatoire mais plus propre
$uneOpe = EnCoursDAO::getOneById($id);
/* @var $uneOpe Operation  */
$designation = $uneOpe->getDesignation();
$prix = $uneOpe->getPrix();
$type = $uneOpe->getType();
$date = $uneOpe->getDate();
echo "
<br><center>Voulez-vous vraiment supprimer le / la $type '$designation' d'une valeur de $prix € datant du  ?
<h3><br>
<a href='cSaisieEnCours.php?action=validerSupprimerVente&id=$id'>Oui</a>
&nbsp; &nbsp; &nbsp; &nbsp;
<a href='cSaisieEnCours.php?'>Non</a></h3>
</center>";

require($repInclude . "_fin.inc.php");
echo '</div>';

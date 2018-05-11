<?php

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");

//Division principale
echo '<div id="contenu">';
echo "<h2><center>Suppression d'une opération</center></h2>";

use modele\dao\EnCoursDAO;
use modele\metier\EnCours;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();


// SUPPRIMER L'OPERATION SÉLECTIONNÉE

$id = $_REQUEST['id'];  // Non obligatoire mais plus propre
$uneOpe = EnCoursDAO::getOneById($id);
/* @var $uneOpe EnCours  */
$designation = $uneOpe->getDesignation();
$prix = $uneOpe->getPrix();
$type = $uneOpe->getType();
$jour = $uneOpe->getjour();
$mois = $uneOpe->getMois();
$annee = $uneOpe->getAnnee();

echo "
<br><center>Voulez-vous vraiment supprimer le $type $designation d'une valeur de $prix et datant du $jour/$mois/$annee ?
<h3><br>
<a href='cSaisieEnCours.php?action=validerSupprimerOpe&id=$id'>Oui</a>
&nbsp; &nbsp; &nbsp; &nbsp;
<a href='cSaisieEnCours.php?'>Non</a></h3>
</center>";

require($repInclude . "_fin.inc.php");
echo '</div>';

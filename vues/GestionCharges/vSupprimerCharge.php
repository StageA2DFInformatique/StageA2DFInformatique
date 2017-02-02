<?php

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");

//Division principale
echo '<div id="contenu">';
echo "<h2><center>Suppression d'une charge</center></h2>";

use modele\dao\ChargesDAO;
use modele\metier\Charges;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();


// SUPPRIMER LA CHARGE SÉLECTIONNÉE

$id = $_REQUEST['id'];  // Non obligatoire mais plus propre
$unChrg = ChargesDAO::getOneById($id);
/* @var $unChrg Charges  */
$nom = $unChrg->getNom();
echo "
<br><center>Voulez-vous vraiment supprimer la charge $nom ?
<h3><br>
<a href='cGestionCharges.php?action=validerSupprimerChrg&id=$id'>Oui</a>
&nbsp; &nbsp; &nbsp; &nbsp;
<a href='cGestionCharges.php?'>Non</a></h3>
</center>";

require($repInclude . "_fin.inc.php");
echo '</div>';

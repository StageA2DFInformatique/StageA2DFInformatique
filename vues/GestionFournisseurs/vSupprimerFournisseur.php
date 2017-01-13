<?php

$repInclude = './include/';
require($repInclude . "_init.inc.php");

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");

//Division principale
echo '<div id="contenu">';
echo "<h2><center>Suppression d'un fournisseur</center></h2>";
use modele\dao\FournisseursDAO;
use modele\metier\Fournisseurs;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();


// SUPPRIMER LE FOURNISSEUR SÉLECTIONNÉ

$id = $_REQUEST['id'];  // Non obligatoire mais plus propre
$unFourni = FournisseursDAO::getOneById($id);
/* @var $unFourni Fournisseurs  */
$nom = $unFourni->getNom();
echo "
<br><center>Voulez-vous vraiment supprimer le fournisseur $nom ?
<h3><br>
<a href='cGestionFournisseurs.php?action=validerSupprimerFourni&id=$id'>Oui</a>
&nbsp; &nbsp; &nbsp; &nbsp;
<a href='cGestionFournisseurs.php?'>Non</a></h3>
</center>";

require($repInclude . "_fin.inc.php");
echo '</div>';
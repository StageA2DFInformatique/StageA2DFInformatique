<?php

use modele\dao\FournisseursDAO;
use modele\metier\Fournisseurs;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();

include("include/_entete.inc.html");
include("include/_sommaire.inc.php");

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

include("include/_fin.inc.php");


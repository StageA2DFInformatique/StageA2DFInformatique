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
echo "<h2>Gestion des Fournisseurs</h2>";

use modele\dao\FournisseursDAO;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();


// AFFICHER L'ENSEMBLE DES FOURNISSEURS
// CETTE PAGE CONTIENT UN TABLEAU CONSTITUÉ D'1 LIGNE D'EN-TÊTE ET D'1 LIGNE PAR
// FOURNISSEUR

echo "
<br>
<table width='55%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>

   <tr class='enTeteTabNonQuad'>
      <td colspan='4'><strong>Fournisseurs</strong></td>
   </tr>";

$lesFournisseurs = FournisseursDAO::getAll();
// BOUCLE SUR LES FOURNISSEURS
foreach ($lesFournisseurs as $unFournisseur) {
    $id = $unFournisseur->getId();
    $nom = $unFournisseur->getNom();
    echo "
		<tr class='ligneTabNonQuad'>
         <td width='52%'>$nom</td>
         
         <td width='16%' align='center'> 
         <a href='cGestionFournisseurs.php?action=detailFournib&id=$id'>
         Voir détail</a></td>
         
         <td width='16%' align='center'> 
         <a href='cGestionFournisseurs.php?action=demanderModifierFourni&id=$id'>
         Modifier</a></td>";
    echo "
      </tr>";
}
echo "
</table>
<br>
<a href='cGestionFournisseurs.php?action=demanderCreerFourni'>
Création d'un fournisseur</a >";

require($repInclude . "_fin.inc.php");
echo '</div>';

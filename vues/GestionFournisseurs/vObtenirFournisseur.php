<?php

use modele\dao\FournisseursDAO;
use modele\dao\Bdd;

require_once __DIR__ . '/../../includes/autoload.php';
Bdd::connecter();

include("includes/_debut.inc.php");

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

include("includes/_fin.inc.php");


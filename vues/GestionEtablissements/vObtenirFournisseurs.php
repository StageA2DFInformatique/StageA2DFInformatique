<?php
use modele\dao\FournisseursDAO;
use modele\dao\Bdd;
require_once __DIR__.'/../../includes/autoload.php';
Bdd::connecter();

include("includes/_entete.inc.html");

// AFFICHER L'ENSEMBLE DES FOURNISSEURS CETTE PAGE CONTIENT UN TABLEAU CONSTITUÉ D'1 LIGNE D'EN-TÊTE ET D'1 LIGNE PAR FOURNISSEUR

echo "
<br>
<table width='55%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>

   <tr class='enTeteTabNonQuad'>
      <td colspan='4'><strong>Fournisseurs</strong></td>
   </tr>";

$lesFournisseurs = FournisseursDAO::getAll();
// BOUCLE SUR LES Fournisseurs
foreach ($lesFournisseurs as $unFournisseur) {
    $id = $unFournisseur->getId();
    $nom = $unFournisseur->getNom();
    echo "
		<tr class='ligneTabNonQuad'>
         <td width='52%'>$nom</td>
         
         <td width='16%' align='center'> 
         <a href='cGestionFournisseurs.php?action=detailFourni&id=$id'>
         <button type=button>Voir détail</button></a></td>
         
         <td width='16%' align='center'> 
         <a href='cGestionFournisseurs.php?action=demanderModifierFourni&id=$id'>
         <button type=button>Modifier</button></a></td>";

    // S'il existe déjà des attributions pour le fournisseur, il faudra
    // d'abord les supprimer avant de pouvoir supprimer le fournisseur
    if (!AttributionDao::existeAttributionsFourni($id)) {
        echo "
            <td width='16%' align='center'> 
            <a href='cGestionFournisseurs.php?action=demanderSupprimerFourni&id=$id'>
            <button type=button>Supprimer</button></a></td>";
    } else {
        echo "
            <td width='16%'>&nbsp; </td>";
    }
    echo "
      </tr>";
}
echo "
</table>
<br>
<a href='cGestionFournisseurs.php?action=demanderCreerFourni'>
<button type=button>Création d'un fournisseur</button></a >";

include("includes/_fin.inc.php");


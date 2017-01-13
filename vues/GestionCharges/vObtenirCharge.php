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
echo "<h2><center>Gestion des Charges</center></h2>";

use modele\dao\ChargesDAO;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();


// AFFICHER L'ENSEMBLE DES CHARGES
// CETTE PAGE CONTIENT UN TABLEAU CONSTITUÉ D'1 LIGNE D'EN-TÊTE ET D'1 LIGNE PAR
// CHARGE

echo "
<br>
<table width='55%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>

   <tr class='enTeteTabNonQuad'>
      <td colspan='4'><strong><center>Charges</center></strong></td>
   </tr>";

$lesCharges = ChargesDAO::getAll();
// BOUCLE SUR LES CHARGES
foreach ($lesCharges as $unCharge) {
    $id = $unCharge->getId();
    $nom = $unCharge->getNom();
    echo "
		<tr class='ligneTabNonQuad'>
         <td width='52%'>$nom</td>
         
         <td width='16%' align='center'> 
        <a href='cGestionCharges.php?action=detailChrg&id=$id'>
                    <img src='./images/detail.png' />
        </a>  
         <td width='16%' align='center'> 
        <a href='cGestionCharges.php?action=demanderModifierChrg&id=$id'>
                    <img src='./images/modifier.png' />
        </a>
         <td width='16%' align='center'> 
        <a href='cGestionCharges.php?action=demanderSupprimerChrg&id=$id'>
                    <img src='./images/supprimer.png' />
        </a>
    </tr>";
}
echo "
    </table>
    <br>
    <a href = 'cGestionCharges.php?action=demanderCreerChrg'>
    Création d'une Charge</a >";
echo '</div>';
require($repInclude . "_fin.inc.php");


<?php

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");

//Division principale
echo '<div id="contenu">';
echo "<h2><center>Détail Charge</center></h2>";

use modele\dao\ChargesDAO;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();


// OBTENIR LE DÉTAIL DE LA CHARGE SÉLECTIONNÉ

$unChrg = ChargesDAO::getOneById($id);
/* @var $unChrg Charge  */
$nom = $unChrg->getNom();
$description = $unChrg->getDescription();
$numContrat = $unChrg->getNumContrat();
$numTel = $unChrg->getNumTel();
echo "
<br>
<table width='60%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>
   
   <tr class='enTeteTabNonQuad'>
      <td colspan='3'><strong><center>$nom</center></strong></td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td  width='20%'>&nbsp Id: </td>
      <td>&nbsp$id</td>
   </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='20%'>&nbsp Description: </td>
      <td>&nbsp$description</td>
   </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='20%'>&nbsp N° Contrat: </td>
      <td>&nbsp$numContrat</td>
   </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='20%'>&nbsp N° Tel: </td>
      <td>&nbsp$numTel</td>
   </tr>
</table>
<br>
<a href='cGestionCharges.php'>Retour</a>";


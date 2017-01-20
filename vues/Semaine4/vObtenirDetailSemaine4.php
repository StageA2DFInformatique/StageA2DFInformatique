<?php

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");

//Division principale
echo '<div id="contenu">';
echo "<h2><center>Détail des ventes et dépannage de la Semaine 4</center></h2>";

use modele\dao\Semaine4DAO;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();


// OBTENIR LE DÉTAIL DE LA VENTE SÉLECTIONNÉE

$uneVente4 = Semaine4DAO::getOneById($id4);
$designation4 = $uneVente4->getDesignation4();
$type4 = $uneVente4->getType4();
$prix4 = $uneVente4->getPrix4();
echo "
<br>
<table width='70%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>
   
   <tr class='enTeteTabNonQuad'>
      <td colspan='4'><strong><center>&nbsp $designation4</center></strong></td>
   </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='50%'></td>
      <td></td>
   </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='40%'>&nbsp Type : </td>
      <td>&nbsp $type4</td>
   </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='40%'>&nbsp Valeur: </td>
      <td>&nbsp $prix4 €</td>
   </tr>
</table>
<br>
<a href='cSemaine4.php'>Retour</a>";


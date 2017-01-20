<?php

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");

//Division principale
echo '<div id="contenu">';
echo "<h2><center>Détail des ventes et dépannage de la Semaine 1</center></h2>";

use modele\dao\Semaine1DAO;
use modele\dao\Bdd;

require_once __DIR__ . '/../../../include/autoload.php';
Bdd::connecter();


// OBTENIR LE DÉTAIL DE LA VENTE SÉLECTIONNÉE

$uneVente1 = Semaine1DAO::getOneById($id);
$designation = $uneVente1->getDesignation();
$type = $uneVente1->getType();
$prix = $uneVente1->getPrix();
echo "
<br>
<table width='70%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>
   
   <tr class='enTeteTabNonQuad'>
      <td colspan='3'><strong><center>&nbsp $designation</center></strong></td>
   </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='50%'></td>
      <td></td>
   </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='30%'>&nbsp Type : </td>
      <td>&nbsp $type</td>
   </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='30%'>&nbsp Valeur: </td>
      <td>&nbsp $prix €</td>
   </tr>
</table>
<br>
<a href='cSemaine1.php'>Retour</a>";


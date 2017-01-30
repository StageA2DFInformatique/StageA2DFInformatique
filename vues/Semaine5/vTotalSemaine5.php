<?php

use modele\metier\TotalSemaine5;

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");

//Division principale
echo '<div id="contenu">';
echo "<h2><center>Rentrées d'argents de la semaine n°5</center></h2>";

use modele\dao\TotalSemaine5DAO;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();


// OBTENIR LE DÉTAIL DE LA VENTE SÉLECTIONNÉE
$id=1;
$unTotal = TotalSemaine5DAO::superSum();
if($unTotal==''){
    $unTotal=0;
}
$tester= new TotalSemaine5 ($id, $unTotal);
TotalSemaine5DAO::update($id,$tester);

echo "
<br>
<table width='70%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>
   
   <tr class='enTeteTabNonQuad'>
      <td colspan='3'><strong><center>Semaine n°5</center></strong></td>
   </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='50%'></td>
      <td></td>
   </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='30%'>&nbsp Total : </td>
      <td>&nbsp $unTotal €</td>
   </tr>
</table>
<br>
<a href='cSemaine5.php'>Retour</a>";


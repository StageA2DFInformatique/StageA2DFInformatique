<?php

use modele\metier\TotalSemaine3;

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");

//Division principale
echo '<div id="contenu">';
echo "<h2><center>Rentrée d'argents de la semaine n°3</center></h2>";

use modele\dao\TotalSemaine3DAO;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();


// OBTENIR LE DÉTAIL DE LA VENTE SÉLECTIONNÉE
$id=1;
$unTotal = TotalSemaine3DAO::superSum();
if($unTotal==''){
    $unTotal=0;
}
$tester= new TotalSemaine3 ($id, $unTotal);
TotalSemaine3DAO::update($id,$tester);

echo "
<br>
<table width='70%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>
   
   <tr class='enTeteTabNonQuad'>
      <td colspan='3'><strong><center>&nbsp Total de la semaine n°3</center></strong></td>
   </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='50%'></td>
      <td></td>
   </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='30%'>&nbsp Type : </td>
      <td>&nbsp $unTotal</td>
   </tr>
</table>
<br>
<a href='cSemaine3.php'>Retour</a>";

<?php

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");

//Division principale
echo '<div id="contenu">';
echo "<h2><center>Tableau de Synthèse globale</center></h2>";

use modele\dao\SyntheseDAO;
use modele\metier\Synthese;
use modele\dao\EnCoursDAO;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();


// Obtenir le tableau des syntheses
$uneSynth = SyntheseDAO::getOneById($id);
$date = $uneSynth->getDate();
$compte = $uneSynth->getCompte();
$cb = $uneSynth->getCb();
$espece = $uneSynth->getEspece();
$cheque = $uneSynth->getCheque();
$totalFinMois = $uneSynth->getTotalFinMois();
$totalMoisPlusUn = $uneSynth->getTotalMoisPlusUn();

$totalFinMois = $compte + $cb + $espece + $cheque + EnCoursDAO::superSum();

$uneSynth = new Synthese($id, $date, $compte, $cb, $espece, $cheque, $totalFinMois, $totalMoisPlusUn);

SyntheseDAO::update($id, $uneSynth);

echo "
<br>
<table width='100%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>
   
   <tr class='enTeteTabNonQuad'>
      <td colspan='3'><strong><center>Synthese global de $date</center></strong></td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td  width='50%'></td>
      <td></td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td  width='50%'>&nbsp  Compte: </td>
      <td>&nbsp $compte €</td>
   </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='50%'>&nbsp  Carte banquaire: </td>
      <td>&nbsp $cb €</td>
   </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='50%'>&nbsp  Espèce: </td>
      <td>&nbsp $espece €</td>
   </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='50%'>&nbsp  Chèque: </td>
      <td>&nbsp $cheque €</td>
   </tr>
      </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='50%'></td>
      <td></td>
   </tr>
      </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='50%'>&nbsp  Chiffre d'affaire du mois  </td>
      <td>&nbsp $totalFinMois €</td>
   </tr>
      </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='50%'>&nbsp  Total sur un mois +1: </td>
      <td>&nbsp $totalMoisPlusUn €</td>
   </tr>
</table>
<br>
<a href='cAccueil.php'>Retour</a>";

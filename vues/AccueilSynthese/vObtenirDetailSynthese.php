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
use modele\dao\TotalSemaine1DAO;
use modele\dao\TotalSemaine2DAO;
use modele\dao\TotalSemaine3DAO;
use modele\dao\TotalSemaine4DAO;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();


// Obtenir le tableau des syntheses
$uneSynth = SyntheseDAO::getOneById($id);
$mois = $uneSynth->getMois();
$compte = $uneSynth->getCompte();
$cb = $uneSynth->getCb();
$espece = $uneSynth->getEspece();
$cheque = $uneSynth->getCheque();
$totalFinMois = $uneSynth->getTotalFinMois();
$totalMoisPlusUn = $uneSynth->getTotalMoisPlusUn();
$caMoisHt = $uneSynth->getCaMoisHt();

$totalFinMois += TotalSemaine1DAO::superSum() + TotalSemaine2DAO::superSum() + TotalSemaine3DAO::superSum() + TotalSemaine4DAO::superSum();
$totalMoisPlusUn += TotalSemaine1DAO::superSum() + TotalSemaine2DAO::superSum() + TotalSemaine3DAO::superSum() + TotalSemaine4DAO::superSum();

SyntheseDAO::update($id, $uneSynth);


echo "
<br>
<table width='100%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>
   
   <tr class='enTeteTabNonQuad'>
      <td colspan='3'><strong><center>Synthese global du mois de $mois</center></strong></td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td  width='50%'></td>
      <td></td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td  width='50%'> Compte: </td>
      <td>&nbsp $compte €</td>
   </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='50%'> Carte banquaire: </td>
      <td>&nbsp $cb €</td>
   </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='50%'> Espèce: </td>
      <td>&nbsp $espece €</td>
   </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='50%'> Chèque: </td>
      <td>&nbsp $cheque €</td>
   </tr>
      </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='50%'></td>
      <td></td>
   </tr>
      </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='50%'> Total en fin de mois: </td>
      <td>&nbsp $totalFinMois €</td>
   </tr>
      </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='50%'> Total sur un mois +1: </td>
      <td>&nbsp $totalMoisPlusUn €</td>
   </tr>
      </tr>
      <tr class='ligneTabNonQuad'>
      <td  width='50%'> Chiffre d'affaire du mois (HT): </td>
      <td>&nbsp $caMoisHt €</td>
   </tr>
   
   
</table>
<br>
<a href='cAccueil.php'>Retour</a>";

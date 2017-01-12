<?php
$repInclude = './include/';
require($repInclude . "_init.inc.php");
use modele\dao\FournisseursDAO;
use modele\metier\Fournisseurs;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();

include("include/_entete.inc.html");
include("include/_sommaire.inc.php");


// OBTENIR LE DÉTAIL Du FOURNISSEUR SÉLECTIONNÉ

$unFourni = FournisseursDAO::getOneById($id);
/* @var $unFourni Fournisseur  */
$nom = $unFourni->getNom();
$adresseRue = $unFourni->getAdresse();
$codePostal = $unFourni->getCdp();
$ville = $unFourni->getVille();
$tel = $unFourni->getTel();
$adresseElectronique = $unFourni->getEmail();
$paiement = $unFourni->getPaiement();


echo "
<br>
<table width='60%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>
   
   <tr class='enTeteTabNonQuad'>
      <td colspan='3'><strong>$nom</strong></td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td  width='20%'> Id: </td>
      <td>$id</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td> Adresse: </td>
      <td>$adresseRue</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td> Code postal: </td>
      <td>$codePostal</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td> Ville: </td>
      <td>$ville</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td> Téléphone: </td>
      <td>$tel</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td> E-mail: </td>
      <td>$adresseElectronique</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td> Paiement sous combien de jours: </td>
      <td>$paiement</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td> Type: </td>";

echo " </table>
<br>
<a href='cGestionFournisseurs.php'>Retour</a>";

include("include/_fin.inc.php");


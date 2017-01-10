<?php

use modele\dao\FournisseursDAO;
use modele\metier\Fournisseurs;
use modele\dao\Bdd;

require_once __DIR__ . '/../../includes/autoload.php';
Bdd::connecter();

include("includes/_debut.inc.php");

// OBTENIR LE DÉTAIL DU FOURNISSEUR SÉLECTIONNÉ

$unFourni = FournisseursDAO::getOneById($id);
/* @var $unFourni Fournisseur  */
$nom = $unFourni->getNom();
$adresseRue = $unFourni->getAdresse();
$codePostal = $unFourni->getCdp();
$ville = $unFourni->getVille();
$tel = $unFourni->getTel();
$adresseElectronique = $unFourni->getEmail();
$paiment = $unFourni->getTempsPaiment();

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
      <td> Temps de Paiement: </td>
      <td>$paiement</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td> Type: </td>";
echo "
   </tr>
   
</table>
<br>
<a href='cGestionFournisseurs.php'><button type=button>Retour</button></a>";

include("includes/_fin.inc.php");


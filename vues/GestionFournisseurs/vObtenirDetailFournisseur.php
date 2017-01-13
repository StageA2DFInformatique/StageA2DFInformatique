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
echo "<h2><center>Détail fournisseur</center></h2>";

use modele\dao\FournisseursDAO;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();


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
      <td colspan='3'><strong>&nbsp&nbsp$nom</strong></td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td  width='20%'>&nbsp Id: </td>
      <td>&nbsp$id</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td>&nbsp Adresse: </td>
      <td>&nbsp$adresseRue</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td>&nbsp Code postal: </td>
      <td>&nbsp$codePostal</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td>&nbsp Ville: </td>
      <td>&nbsp$ville</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td>&nbsp Téléphone: </td>
      <td>&nbsp$tel</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td>&nbsp E-mail: </td>
      <td>&nbsp$adresseElectronique</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td>&nbsp Paiement: </td>
      <td>&nbsp$paiement</td>;
   </tr>;

</table>
<br>
<a href='cGestionFournisseurs.php'>Retour</a>";


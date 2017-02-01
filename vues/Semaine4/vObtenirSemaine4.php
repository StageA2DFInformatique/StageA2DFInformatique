<?php

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");

//Division principale
echo '<div id="contenu">';
echo "<h2><center>Saisie durant la semaine n°4</center></h2>";

use modele\dao\Semaine4DAO;
use modele\dao\TotalSemaine4DAO;
use modele\metier\TotalSemaine4;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();
$id=1;
$unTotal = TotalSemaine4DAO::superSum();
if($unTotal==''){
    $unTotal=0;
}
$tester= new TotalSemaine4 ($id, $unTotal);
TotalSemaine4DAO::update($id,$tester);

// AFFICHER L'ENSEMBLE DES VENTE ET DEPANNAGE DE LA SEMAINE N°4
echo "
<br>
<table width='75%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>

   <tr class='enTeteTabNonQuad'>
      <td colspan='6'><strong><center>Semaine n°4</center></strong></td>
   </tr>";
 echo "
    &nbsp&nbsp<a href = 'cSemaine4.php?action=demanderCreerVente'><img src='./images/add.png'title='Ajouter une vente ou un dépannage' /></a >
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <strong> Total = $unTotal € </strong>";
    

$LesVentes = Semaine4DAO::getAll();
// BOUCLE SUR LES CHARGES
foreach ($LesVentes as $uneVente) {
    $id = $uneVente->getId();
    $designation = $uneVente->getDesignation();
    $type= $uneVente->getType();
    $prix=$uneVente->getPrix();
   
    echo "
    <tr class='ligneTabNonQuad'>
        <td width='5%'>&nbsp<strong>Id: </strong>$id</td> 
        <td width='40%'><strong><center> $designation </center></strong></td>
        <td width='10%'>&nbsp $type </td> 
        <td width='8%'>&nbsp $prix € </td> 
        <td width='1%' align='center'><a href='cSemaine4.php?action=demanderModifierVente&id=$id'><img src='./images/modifier.png'title='Modifier' /></a>
        <td width='1%' align='center'><a href='cSemaine4.php?action=demanderSupprimerVente&id=$id'><img src='./images/supprimer.png' title='Supprimer' /></a>
    </tr>";
}
echo "
    </table>";
require($repInclude . "_fin.inc.php");
echo '</div>';

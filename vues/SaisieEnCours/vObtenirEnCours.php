<?php

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");

//Division principale
echo '<div id="contenu">';
echo "<h2><center>Saisie en cours</center></h2>";

use modele\dao\EnCoursDAO;
use modele\dao\TotalEnCoursDAO;
use modele\metier\TotalEnCours;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();
$id = 1;
$unTotal = TotalEnCoursDAO::superSum();
if ($unTotal == '') {
    $unTotal = 0;
}
$tester = new TotalEnCours($id, $unTotal);
TotalEnCoursDAO::update($id, $tester);

// AFFICHER L'ENSEMBLE DES VENTE ET DEPANNAGE
echo "
<br>
<table width='100%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>

   <tr class='enTeteTabNonQuad'>
      <td colspan='6'><strong><center>Saisie en Cours</center></strong></td>
   </tr>";
echo "
    &nbsp&nbsp<a href = 'cSaisieEnCours.php?action=demanderCreerOpe'><img src='./images/add.png'title='Ajouter une vente ou un dépannage' /></a >
    &nbsp&nbsp<strong> Total = $unTotal € </strong>";


$lesOpes = EnCoursDAO::getAll();
// BOUCLE SUR LES OPERATIONS
foreach ($lesOpes as $uneOpe) {
    $id = $uneOpe->getId();
    $designation = $uneOpe->getDesignation();
    $type = $uneOpe->getType();
    $prix = $uneOpe->getPrix();
    $date= $uneOpe->getDate();

    echo "
    <tr class='ligneTabNonQuad'>
        <td width='10%'>&nbsp<strong>Id: </strong>$id </td> 
        <td width='40%'><strong><center> $designation </center></strong></td>
        <td width='10%'>&nbsp $type </td> 
        <td width='8%'>&nbsp $prix € </td> 
        <td width='8%'>&nbsp $date </td> 
        <td width='1%' align='center'><a href='cSaisieEnCours.php?action=demanderModifierOpe&id=$id'><img src='./images/modifier.png'title='Modifier' /></a>
        <td width='1%' align='center'><a href='cSaisieEnCours.php?action=demanderSupprimerOpe&id=$id'><img src='./images/supprimer.png' title='Supprimer' /></a>
    </tr>";
}
echo "
    </table>";
require($repInclude . "_fin.inc.php");
echo '</div>';

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
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();


// AFFICHER L'ENSEMBLE DES VENTE ET DEPANNAGE DE LA SEMAINE N°4
echo "
<br>
<table width='75%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>

   <tr class='enTeteTabNonQuad'>
      <td colspan='5'><strong><center>Semaine n°4</center></strong></td>
   </tr>";

$LesVentes = Semaine4DAO::getAll();
// BOUCLE SUR LES CHARGES
foreach ($LesVentes as $uneVente) {
    $id = $uneVente->getId();
    $designation = $uneVente->getDesignation();
    $type= $uneVente->getType();
    $prix=$uneVente->getPrix();
    echo "
    <tr class='ligneTabNonQuad'>
        <td width='40%'><strong><center> $designation </center></strong></td>
        <td width='10%'>&nbsp $type &nbsp</td> 
        <td width='5%'>&nbsp $prix € &nbsp</td> 
        <td width='1%' align='center'><a href='cSemaine4.php?action=demanderModifierVente&id=$id'><img src='./images/modifier.png'title='Modifier' /></a>
        <td width='1%' align='center'><a href='cSemaine4.php?action=demanderSupprimerVente&id=$id'><img src='./images/supprimer.png' title='Supprimer' /></a>
    </tr>";
}
echo "
    </table>
    <br>
    <a href = 'cSemaine4.php?action=demanderCreerVente'>
    Ajouter une vente ou un dépannage</a >
    <br>
    <a href = 'cSemaine4.php?action=totalSemaine4'>
    Voir le total de la semaine</a >";
require($repInclude . "_fin.inc.php");
echo '</div>';

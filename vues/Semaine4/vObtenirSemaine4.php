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
<table width='55%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>

   <tr class='enTeteTabNonQuad'>
      <td colspan='4'><strong><center>Semaine n°4</center></strong></td>
   </tr>";

$LesVentes4 = Semaine4DAO::getAll();
// BOUCLE SUR LES CHARGES
foreach ($LesVentes4 as $uneVente4) {
    $id4 = $uneVente4->getId4();
    $designation4 = $uneVente4->getDesignation4();
    echo "
        
		<tr class='ligneTabNonQuad'>
         <td width='54%'>&nbsp $designation4</td>
         
         <td width='16%' align='center'>
         <a href='cSemaine4.php?action=detailVente4&id=$id4'>
                    <img src='./images/detail.png'title='Voir détail' />
        </a></td>  
                 <td width='16%' align='center'> 
        <a href='cSemaine4.php?action=demanderModifierVente4&id=$id4'>
                    <img src='./images/modifier.png'title='Modifier' />
        </a></td>
         <td width='16%' align='center'> 
        <a href='cSemaine4.php?action=demanderSupprimerVente4&id=$id4'>
                    <img src='./images/supprimer.png' title='Supprimer' />
        </a></td>
    </tr>";
}
echo "
    </table>
    <br>
    <a href = 'cSemaine4.php?action=demanderCreerVente4'>
    Ajouter une vente ou un dépannage pour la semaine 4</a >";
require($repInclude . "_fin.inc.php");
echo '</div>';

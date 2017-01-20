<?php

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");

//Division principale
echo '<div id="contenu">';
echo "<h2><center>Saisie durant la semaine n°3</center></h2>";

use modele\dao\Semaine3DAO;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();


// AFFICHER L'ENSEMBLE DES VENTE ET DEPANNAGE DE LA SEMAINE N°3
echo "
<br>
<table width='55%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>

   <tr class='enTeteTabNonQuad'>
      <td colspan='4'><strong><center>Semaine n°3</center></strong></td>
   </tr>";

$LesVentes3 = Semaine3DAO::getAll();
// BOUCLE SUR LES CHARGES
foreach ($LesVentes3 as $uneVente3) {
    $id3 = $uneVente3->getId3();
    $designation3 = $uneVente3->getDesignation3();
    echo "
        
		<tr class='ligneTabNonQuad'>
         <td width='53%'>&nbsp $designation3</td>
         
         <td width='16%' align='center'>
         <a href='cSemaine3.php?action=detailVente3&id=$id3'>
                    <img src='./images/detail.png'title='Voir détail' />
        </a></td>  
                 <td width='16%' align='center'> 
        <a href='cSemaine3.php?action=demanderModifierVente3&id=$id3'>
                    <img src='./images/modifier.png'title='Modifier' />
        </a></td>
         <td width='16%' align='center'> 
        <a href='cSemaine3.php?action=demanderSupprimerVente3&id=$id3'>
                    <img src='./images/supprimer.png' title='Supprimer' />
        </a></td>
    </tr>";
}
echo "
    </table>
    <br>
    <a href = 'cSemaine3.php?action=demanderCreerVente3'>
    Ajouter une vente ou un dépannage pour la semaine 3</a >";
require($repInclude . "_fin.inc.php");
echo '</div>';

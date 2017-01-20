<?php

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");

//Division principale
echo '<div id="contenu">';
echo "<h2><center>Saisie durant la semaine n°2</center></h2>";

use modele\dao\Semaine2DAO;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();


// AFFICHER L'ENSEMBLE DES VENTE ET DEPANNAGE DE LA SEMAINE N°2
echo "
<br>
<table width='55%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>

   <tr class='enTeteTabNonQuad'>
      <td colspan='4'><strong><center>Semaine n°2</center></strong></td>
   </tr>";

$LesVentes2 = Semaine2DAO::getAll();
// BOUCLE SUR LES CHARGES
foreach ($LesVentes2 as $uneVente2) {
    $id2 = $uneVente2->getId2();
    $designation2 = $uneVente2->getDesignation2();
    echo "
        
		<tr class='ligneTabNonQuad'>
         <td width='52%'>&nbsp $designation2</td>
         
         <td width='16%' align='center'>
         <a href='cSemaine2.php?action=detailVente2&id=$id2'>
                    <img src='./images/detail.png'title='Voir détail' />
        </a></td>  
                 <td width='16%' align='center'> 
        <a href='cSemaine2.php?action=demanderModifierVente2&id=$id2'>
                    <img src='./images/modifier.png'title='Modifier' />
        </a></td>
         <td width='16%' align='center'> 
        <a href='cSemaine2.php?action=demanderSupprimerVente2&id=$id2'>
                    <img src='./images/supprimer.png' title='Supprimer' />
        </a></td>
    </tr>";
}
echo "
    </table>
    <br>
    <a href = 'cSemaine2.php?action=demanderCreerVente2'>
    Ajouter une vente ou un dépannage pour la semaine 2</a >";
require($repInclude . "_fin.inc.php");
echo '</div>';

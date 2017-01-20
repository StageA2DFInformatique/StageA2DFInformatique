<?php

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");

//Division principale
echo '<div id="contenu">';
echo "<h2><center>Saisie durant la semaine n°1</center></h2>";

use modele\dao\EnCours\Semaine1DAO;
use modele\dao\Bdd;

require_once __DIR__ . '/../../../include/autoload.php';
Bdd::connecter();


// AFFICHER L'ENSEMBLE DES VENTE ET DEPANNAGE DE LA SEMAINE N°1
echo "
<br>
<table width='55%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>

   <tr class='enTeteTabNonQuad'>
      <td colspan='4'><strong><center>Semaine n°1</center></strong></td>
   </tr>";

$LesVentes1 = Semaine1DAO::getAll();
// BOUCLE SUR LES CHARGES
foreach ($LesVentes1 as $uneVente) {
    $id = $uneVente->getId();
    $designation = $uneVente->getDesignation();
    echo "
        
		<tr class='ligneTabNonQuad'>
         <td width='52%'>&nbsp $designation</td>
         
         <td width='16%' align='center'>
         <a href='cSemaine1.php?action=detailVente&id=$id'>
                    <img src='./images/detail.png'title='Voir détail' />
        </a></td>  
                 <td width='16%' align='center'> 
        <a href='cSemaine1.php?action=demanderModifierVente&id=$id'>
                    <img src='./images/modifier.png'title='Modifier' />
        </a></td>
         <td width='16%' align='center'> 
        <a href='cSemaine1.php?action=demanderSupprimerVente&id=$id'>
                    <img src='./images/supprimer.png' title='Supprimer' />
        </a></td>
    </tr>";
}
echo "
    </table>
    <br>
    <a href = 'cSemaine1.php?action=demanderCreerVente'>
    Ajouter une vente ou un dépannage pour la semaine 1</a >";
require($repInclude . "_fin.inc.php");
echo '</div>';

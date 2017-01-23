<?php

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");

//Division principale
echo '<div id="contenu">';
echo "<h2><center>Accueil</center></h2>";

use modele\dao\SyntheseDAO;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();


// AFFICHER LE TABLEAU DE SYNTHESE

echo "
<br>
<table width='85%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>

   <tr class='enTeteTabNonQuad'>
      <td colspan='4'><strong><center>Synthèses</center></strong></td>
   </tr>";

$lesSynthese = SyntheseDAO::getAll();
// BOUCLE SUR LES SYNTHESES
foreach ($lesSynthese as $laSynthese) {
    $id = $laSynthese->getId();
    $mois = $laSynthese->getMois();
    echo "
		<tr class='ligneTabNonQuad'>
         <td width='50%'>&nbsp Synthèse du mois de $mois</td>
         
         <td width='16%' align='center'> 
         <a href='cAccueil.php?action=detailSynth&id=$id'>
                    <img src='./images/detail.png'title='Voir détail' />
        </a></td>  
                 <td width='16%' align='center'> 
        <a href='cAccueil.php?action=demanderModifierSynth&id=$id'>
                    <img src='./images/modifier.png'title='Modifier' />
        </a></td>
    </tr>";
}
require($repInclude . "_fin.inc.php");
echo '</div>';

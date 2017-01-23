<?php

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");

//Division principale
echo '<div id="contenu">';
echo "<h2><center>[ATTENTION !] CETTE ACTION SUPPRIMERA TOUTE LES VALEURS DE LA SEMAINE 1</center></h2>";

use modele\metier\Semaine1;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();


// SUPPRIMER LA VENTE OU LE DEPANNAGE SÉLECTIONNÉ(E)

/* @var $uneVente Semaine1  */
echo "
<br><center>Voulez-vous vraiment supprimer toute les ventes et dépannages de la semaine n°1 ? <br> Cette action est irréversible.
<h3><br>
<a href='cSemaine1.php?action=validerSupprimerTouteVente'>Oui</a>
&nbsp; &nbsp; &nbsp; &nbsp;
<a href='cSemaine1.php?'>Non</a></h3>
</center>";

require($repInclude . "_fin.inc.php");
echo '</div>';

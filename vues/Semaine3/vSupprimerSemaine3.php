<?php

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");

//Division principale
echo '<div id="contenu">';
echo "<h2><center>Suppression d'une vente ou d'un dépannage</center></h2>";

use modele\dao\Semaine3DAO;
use modele\metier\Semaine3;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();


// SUPPRIMER LA VENTE OU LE DEPANNAGE SÉLECTIONNÉ(E)

$id = $_REQUEST['id3'];  // Non obligatoire mais plus propre
$uneVente3 = Semaine3DAO::getOneById($id3);
/* @var $uneVente3 Semaine3  */
$designation3 = $uneVente3->getDesignation3();
$prix3 = $uneVente3->getPrix3();
echo "
<br><center>Voulez-vous vraiment supprimer la vente ou le dépannage '$designation3' d'une valeur de $prix ?
<h3><br>
<a href='cSemaine1.php?action=validerSupprimerVente1&id=$id3'>Oui</a>
&nbsp; &nbsp; &nbsp; &nbsp;
<a href='cSemaine3.php?'>Non</a></h3>
</center>";

require($repInclude . "_fin.inc.php");
echo '</div>';

<?php

setlocale(LC_TIME, 'fr_FR.utf8', 'fra');

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");

//Division principale
echo '<div id="contenu">';
$mois = array('01' => 'Janvier', '02' => 'Fevrier', '03' => 'Mars',
    '04' => 'Avril', '05' => 'Mai', '06' => 'Juin', '07' => 'Juillet',
    '08' => 'Aout', '09' => 'Septembre', '10' => 'Octobre', '11' => 'Novembre', '12' => 'Decembre');
if (!isset($_GET['mois'])) {
    $indexMois = sprintf("%02d", strftime("%m"));
    $annee = strftime("%Y");
    if ($indexMois - 1 == 0) {
        $precedent = 12;
        $anneePrecedent = $annee - 1;
    } else {
        $precedent = $indexMois - 1;
        $anneePrecedent = $annee;
    }
    if ($indexMois + 1 == 13) {
        $suivant = 1;
        $anneeSuivant = $annee + 1;
    } else {
        $suivant = $indexMois + 1;
        $anneeSuivant = $annee;
    }
    echo '<h2><center><a href="cSaisieEnCours.php?mois=' . sprintf("%02d", ($precedent)) . '&annee=' . $anneePrecedent . '"/>◄</a>Saisie au cours du mois de ' . strftime("%B %Y") . '<a href="cSaisieEnCours.php?mois=' . sprintf("%02d", ($suivant)) . '&annee=' . $anneeSuivant . '"/>►</a></center></h2>';
} else {
    $indexMois = $_GET['mois'];
    $annee = $_GET['annee'];

    if ($indexMois - 1 == 0) {
        $precedent = 12;
        $anneePrecedent = $annee - 1;
    } else {
        $precedent = $indexMois - 1;
        $anneePrecedent = $annee;
    }
    if ($indexMois + 1 == 13) {
        $suivant = 1;
        $anneeSuivant = $annee + 1;
    } else {
        $suivant = $indexMois + 1;
        $anneeSuivant = $annee;
    }

    echo '<h2><center><a href="cSaisieEnCours.php?mois=' . sprintf("%02d", ($precedent)) . '&annee=' . $anneePrecedent . '"/>◄</a>Saisie au cours du mois de ' . $mois[$indexMois] . " " . $_GET['annee'] . '<a href="cSaisieEnCours.php?mois=' . sprintf("%02d", ($suivant)) . '&annee=' . $anneeSuivant . '"/>►</a></center></h2>';
}

use modele\dao\EnCoursDAO;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();
$id = 1;
$unTotal = EnCoursDAO::superSum();
if ($unTotal == '') {
    $unTotal = 0;
}

// AFFICHER L'ENSEMBLE DES VENTES ET DEPANNAGES
echo "
<br>
<table width='100%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>

   <tr class='enTeteTabNonQuad'>";
if (!isset($_GET['mois'])) {
    echo "<td colspan='6'><strong><center>Saisie de " . strftime("%B %Y") . "</center></strong></td>";
} else {
    echo "<td colspan='6'><strong><center>Saisie de " . $mois[$_GET['mois']] . " " . $_GET['annee'] . "</center></strong></td>";
}
echo "</tr>";
echo "
    &nbsp&nbsp<a href = 'cSaisieEnCours.php?action=demanderCreerOpe'><img src='./images/add.png'title='Ajouter une vente ou un dépannage' /></a >
    &nbsp&nbsp<strong> Total du mois = $unTotal € </strong>";

if (!isset($_GET['mois'])) {
    $indexMois = sprintf("%02d", strftime("%m"));
    $annee = strftime("%Y");
    $date = $annee . "-" . $indexMois;
} else {
    $date = $_GET['annee'] . "-" . $_GET['mois'];
}

$lesOpes = EnCoursDAO::getByDateAnnee($indexMois,$annee);
// BOUCLE SUR LES OPERATIONS
foreach ($lesOpes as $uneOpe) {
    $id = $uneOpe->getId();
    $designation = $uneOpe->getDesignation();
    $type = $uneOpe->getType();
    $prix = $uneOpe->getPrix();
    $jour = $uneOpe->getJour();
    $mois = $uneOpe->getMois();
    $annee = $uneOpe->getAnnee();

    echo "
    <tr class='ligneTabNonQuad'>
        <td width='40%'><strong><center> $designation </center></strong></td>
        <td width='10%'>&nbsp $type </td> 
        <td width='8%'>&nbsp $prix € </td> 
        <td width='15%'>&nbsp Effectué le $jour/$mois</td> 
        <td width='1%' align='center'><a href='cSaisieEnCours.php?action=demanderModifierOpe&id=$id'><img src='./images/modifier.png'title='Modifier' /></a>
        <td width='1%' align='center'><a href='cSaisieEnCours.php?action=demanderSupprimerOpe&id=$id'><img src='./images/supprimer.png' title='Supprimer' /></a>
    </tr>";
}
echo "
    </table>";
require($repInclude . "_fin.inc.php");
echo '</div>';

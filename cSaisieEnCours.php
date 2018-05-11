<?php

use modele\dao\EnCoursDAO;
use modele\metier\EnCours;
use modele\dao\Bdd;

require_once __DIR__ . '/include/autoload.php';
Bdd::connecter();
$repInclude = './include/';
require($repInclude . "_init.inc.php");
// 1ère étape: Affichage de la première semaine.
if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'initial';
}

$action = $_REQUEST['action'];

// Aiguillage selon l'étape
switch ($action) {
    case 'initial' :
        include("vues/SaisieEnCours/vObtenirEnCours.php");
        break;

    case 'demanderSupprimerOpe':
        $id = $_REQUEST['id'];
        include("vues/SaisieEnCours/vSupprimerEnCours.php");
        break;

    case 'demanderCreerOpe':
        include("vues/SaisieEnCours/vCreerModifierEnCours.php");
        break;

    case 'demanderModifierOpe':
        $id = $_REQUEST['id'];
        include("vues/SaisieEnCours/vCreerModifierEnCours.php");
        break;

    case 'validerSupprimerOpe':
        $id = $_REQUEST['id'];
        EnCoursDAO::delete($id);
        include("vues/SaisieEnCours/vObtenirEnCours.php");
        break;

    case 'validerCreerOpe':case 'validerModifierOpe':
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        }
        $designation = $_REQUEST['designation'];
        $prix = $_REQUEST['prix'];
        $type = $_REQUEST['type'];
        $jour = $_REQUEST['jour'];
        $mois = $_REQUEST['mois'];
        $annee = $_REQUEST['annee'];


        if ($action == 'validerCreerOpe') {
            verifierDonneesOpeC($designation, $prix, $type, $jour, $mois, $annee);
            if (nbErreurs() == 0) {
                $uneOpe = new EnCours(null, $designation, $prix, $type, $jour, $mois, $annee);
                EnCoursDAO::insert($uneOpe);
                include("vues/SaisieEnCours/vObtenirEnCours.php");
            } else {
                include("vues/SaisieEnCours/vCreerModifierEnCours.php");
            }
        } else {
            verifierDonneesOpeM($id, $designation, $prix, $type, $jour, $mois, $annee);
            if (nbErreurs() == 0) {
                $uneOpe = new EnCours($id, $designation, $prix, $type, $jour, $mois, $annee);
                EnCoursDAO::update($id, $uneOpe);
                include("vues/SaisieEnCours/vObtenirEnCours.php");
            } else {
                include("vues/SaisieEnCours/vCreerModifierEnCours.php");
            }
        }
        break;
}

// Fermeture de la connexion au serveur MySql
Bdd::deconnecter();

function verifierDonneesOpeC($designation, $prix, $type, $jour, $mois, $annee) {
    if ($designation == "" || $prix == "" || $type == "" || $jour == "" || $mois == "" || $annee == "") {
        ajouterErreur('Chaque champ suivi du caractère * est obligatoire');
    }
}

function verifierDonneesOpeM($id, $designation, $prix, $type, $jour, $mois, $annee) {
    if ($id == "" || $designation == "" || $prix == "" || $type == "" || $jour == "" || $mois == "" || $annee == "") {
        ajouterErreur('Chaque champ suivi du caractère * est obligatoire');
    }
}

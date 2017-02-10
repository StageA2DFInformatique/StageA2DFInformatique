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

    case 'validerSupprimerTouteOpe':
        $uneOpe = EnCoursDAO::deleteAll();
        include("vues/SaisieEnCours/vObtenirEnCours.php");
        break;

    case 'validerCreerOpe':case 'validerModifierOpe':
        $id = $_REQUEST['id'];
        $designation = $_REQUEST['designation'];
        $prix = $_REQUEST['prix'];
        $type = $_REQUEST['type'];
        $date = $_REQUEST['date'];


        if ($action == 'validerCreerOpe') {
            verifierDonneesOpeC($id, $designation, $prix, $type, $date);
            if (nbErreurs() == 0) {
                $uneOpe = new EnCours($id, $designation, $prix, $type, $date);
                EnCoursDAO::insert($uneOpe);
                include("vues/SaisieEnCours/vObtenirEnCours.php");
            } else {
                include("vues/SaisieEnCours/vCreerModifierEnCours.php");
            }
        } else {
            verifierDonneesOpeM($id, $designation, $prix, $type, $date);
            if (nbErreurs() == 0) {
                $uneOpe = new EnCours($id, $designation, $prix, $type, $date);
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

function verifierDonneesOpeC($id, $designation, $prix, $type, $date) {
    if ($id == "" || $designation == "" || $prix == "" || $type == "" || $date == "") {
        ajouterErreur('Chaque champ suivi du caractère * est obligatoire');
    }
    if ($id != "") {
        // Si l'id est constitué d'autres caractères que de lettres non accentuées 
        // et de chiffres, une erreur est générée
        if (EnCoursDAO::isAnExistingId($id)) {
            ajouterErreur("La/Le $type $id existe déjà");
        }
    }
}

function verifierDonneesOpeM($id, $designation, $prix, $type, $date) {
    if ($id == "" || $designation == "" || $prix == "" || $type == "" || $date == "") {
        ajouterErreur('Chaque champ suivi du caractère * est obligatoire');
    }
}

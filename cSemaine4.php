<?php

/**
 * Contrôleur : SaisieEncours/Semaine4
 */
use modele\dao\Semaine4DAO;
use modele\metier\Semaine4;
use modele\dao\Bdd;

require_once __DIR__ . '/include/autoload.php';
Bdd::connecter();
$repInclude = './include/';
require($repInclude . "_init.inc.php");
// 1ère étape: Affichage de la premiere semaine.
if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'initial';
}

$action = $_REQUEST['action'];

// Aiguillage selon l'étape
switch ($action) {
    case 'initial' :
        include("vues//Semaine4/vObtenirSemaine4.php");
        break;

    case 'detailVente4':
        $id4 = $_REQUEST['id4'];
        include("vues/Semaine4/vObtenirDetailSemaine4.php");
        break;

    case 'demanderSupprimerVente4':
        $id4 = $_REQUEST['id4'];
        include("vues/Semaine4/vSupprimerSemaine4.php");
        break;

    case 'demanderCreerVente4':
        include("vues/Semaine4/vCreerModifierSemaine4.php");
        break;

    case 'demanderModifierVente4':
        $id4 = $_REQUEST['id4'];
        include("vues/Semaine4/vCreerModifierSemaine4.php");
        break;

    case 'valid4erSupprimerVente4':
        $id4 = $_REQUEST['id4'];
        Semaine4DAO::delete($id4);
        include("vues/Semaine4/vObtenirSemaine4.php");
        break;

    case 'valid4erCreerVente4':case 'valid4erModifierVente4':
        $id4 = $_REQUEST['id4'];
        $designation4 = $_REQUEST['designation4'];
        $type4 = $_REQUEST['type4'];
        $prix4 = $_REQUEST['prix4'];


        if ($action == 'valid4erCreerVente4') {
            verifierDonneesVente4C($id4, $designation4, $type4, $prix4);
            if (nbErreurs() == 0) {
                $uneVente4 = new Semaine4($id4, $designation4, $type4, $prix4);
                Semaine4DAO::insert($uneVente4);
                include("vues/Semaine4/vObtenirSemaine4.php");
            } else {
                include("vues/Semaine4/vCreerModifierSemaine4.php");
            }
        } else {
            verifierDonneesVente4M($id4, $designation4, $type4, $prix4);
            if (nbErreurs() == 0) {
                $uneVente4 = new Semaine4($id4, $designation4, $type4, $prix4);
                Semaine4DAO::update($id4, $uneVente4);
                include("vues/Semaine4/vObtenirSemaine4.php");
            } else {
                include("vues/Semaine4/vCreerModifierSemaine4.php");
            }
        }
        break;
}

// Fermeture de la connexion au serveur MySql
Bdd::deconnecter();

function verifierDonneesVente4C($id4, $designation4, $type4, $prix4) {
    if ($id4 == "" || $designation4 == "" || $type4 == "" || $prix4 == "") {
        ajouterErreur('Chaque champ suivi du caractère * est obligatoire');
    }
    if ($id4 != "") {
        // Si l'id4 est constitué d'autres caractères que de lettres non accentuées 
        // et de chiffres, une erreur est générée
        if (!estChiffresOuEtLettres($id4)) {
            ajouterErreur
                    ("L'id4entifiant doit comporter uniquement des lettres non accentuées et des chiffres");
        } else {
            if (Semaine4DAO::isAnExistingId($id4)) {
                ajouterErreur("La Vente $id4 existe déjà");
            }
        }
    }
}

function verifierDonneesVente4M($id4, $designation4, $type4, $prix4) {
    if ($id4 == "" || $designation4 == "" || $type4 == "" || $prix4 == "") {
        ajouterErreur('Chaque champ suivi du caractère * est obligatoire');
    }
}

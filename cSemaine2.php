<?php

/**
 * Contrôleur : SaisieEncours/Semaine2
 */
use modele\dao\Semaine2DAO;
use modele\metier\Semaine2;
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
        include("vues//Semaine2/vObtenirSemaine2.php");
        break;

    case 'detailVente2':
        $id2 = $_REQUEST['id2'];
        include("vues/Semaine2/vObtenirDetailSemaine2.php");
        break;

    case 'demanderSupprimerVente2':
        $id2 = $_REQUEST['id2'];
        include("vues/Semaine2/vSupprimerSemaine2.php");
        break;

    case 'demanderCreerVente2':
        include("vues/Semaine2/vCreerModifierSemaine2.php");
        break;

    case 'demanderModifierVente2':
        $id2 = $_REQUEST['id2'];
        include("vues/Semaine2/vCreerModifierSemaine2.php");
        break;

    case 'valid2erSupprimerVente2':
        $id2 = $_REQUEST['id2'];
        Semaine2DAO::delete($id2);
        include("vues/Semaine2/vObtenirSemaine2.php");
        break;

    case 'valid2erCreerVente2':case 'valid2erModifierVente2':
        $id2 = $_REQUEST['id2'];
        $designation2 = $_REQUEST['designation2'];
        $type2 = $_REQUEST['type2'];
        $prix2 = $_REQUEST['prix2'];


        if ($action == 'valid2erCreerVente2') {
            verifierDonneesVente2C($id2, $designation2, $type2, $prix2);
            if (nbErreurs() == 0) {
                $uneVente2 = new Semaine2($id2, $designation2, $type2, $prix2);
                Semaine2DAO::insert($uneVente2);
                include("vues/Semaine2/vObtenirSemaine2.php");
            } else {
                include("vues/Semaine2/vCreerModifierSemaine2.php");
            }
        } else {
            verifierDonneesVente2M($id2, $designation2, $type2, $prix2);
            if (nbErreurs() == 0) {
                $uneVente2 = new Semaine2($id2, $designation2, $type2, $prix2);
                Semaine2DAO::update($id2, $uneVente2);
                include("vues/Semaine2/vObtenirSemaine2.php");
            } else {
                include("vues/Semaine2/vCreerModifierSemaine2.php");
            }
        }
        break;
}

// Fermeture de la connexion au serveur MySql
Bdd::deconnecter();

function verifierDonneesVente2C($id2, $designation2, $type2, $prix2) {
    if ($id2 == "" || $designation2 == "" || $type2 == "" || $prix2 == "") {
        ajouterErreur('Chaque champ suivi du caractère * est obligatoire');
    }
    if ($id2 != "") {
        // Si l'id2 est constitué d'autres caractères que de lettres non accentuées 
        // et de chiffres, une erreur est générée
        if (!estChiffresOuEtLettres($id2)) {
            ajouterErreur
                    ("L'id2entifiant doit comporter uniquement des lettres non accentuées et des chiffres");
        } else {
            if (Semaine2DAO::isAnExistingId($id2)) {
                ajouterErreur("La Vente $id2 existe déjà");
            }
        }
    }
}

function verifierDonneesVente2M($id2, $designation2, $type2, $prix2) {
    if ($id2 == "" || $designation2 == "" || $type2 == "" || $prix2 == "") {
        ajouterErreur('Chaque champ suivi du caractère * est obligatoire');
    }
}

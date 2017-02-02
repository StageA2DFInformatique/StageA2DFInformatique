<?php

/**
 * Contrôleur : SaisieEncours/Semaine5
 */
use modele\dao\Semaine5DAO;
use modele\metier\Semaine5;
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
        include("vues/Semaine5/vObtenirSemaine5.php");
        break;

    case 'detailVente':
        $id = $_REQUEST['id'];
        include("vues/Semaine5/vObtenirDetailSemaine5.php");
        break;

    case 'demanderSupprimerVente':
        $id = $_REQUEST['id'];
        include("vues/Semaine5/vSupprimerSemaine5.php");
        break;

    case 'demanderSupprimerTouteVente':
        include("vues/Semaine5/vSupprimerTout.php");
        break;

    case 'demanderCreerVente':
        include("vues/Semaine5/vCreerModifierSemaine5.php");
        break;

    case 'demanderModifierVente':
        $id = $_REQUEST['id'];
        include("vues/Semaine5/vCreerModifierSemaine5.php");
        break;

    case 'validerSupprimerVente':
        $id = $_REQUEST['id'];
        Semaine5DAO::delete($id);
        include("vues/Semaine5/vObtenirSemaine5.php");
        break;

    case 'validerSupprimerTouteVente':
        $uneVente = Semaine5DAO::deleteAll();
        include("vues/Semaine5/vObtenirSemaine5.php");
        break;

    case 'totalSemaine5':
        include("vues/Semaine5/vTotalSemaine5.php");
        break;

    case 'validerCreerVente':case 'validerModifierVente':
        $id = $_REQUEST['id'];
        $designation = $_REQUEST['designation'];
        $type = $_REQUEST['type'];
        $prix = $_REQUEST['prix'];


        if ($action == 'validerCreerVente') {
            verifierDonneesVenteC($id, $designation, $type, $prix);
            if (nbErreurs() == 0) {
                $uneVente = new Semaine5($id, $designation, $type, $prix);
                Semaine5DAO::insert($uneVente);
                include("vues/Semaine5/vObtenirSemaine5.php");
            } else {
                include("vues/Semaine5/vCreerModifierSemaine5.php");
            }
        } else {
            verifierDonneesVenteM($id, $designation, $type, $prix);
            if (nbErreurs() == 0) {
                $uneVente = new Semaine5($id, $designation, $type, $prix);
                Semaine5DAO::update($id, $uneVente);
                include("vues/Semaine5/vObtenirSemaine5.php");
            } else {
                include("vues/Semaine5/vCreerModifierSemaine5.php");
            }
        }
        break;
}

// Fermeture de la connexion au serveur MySql
Bdd::deconnecter();

function verifierDonneesVenteC($id, $designation, $type, $prix) {
    if ($id == "" || $designation == "" || $type == "" || $prix == "") {
        ajouterErreur('Chaque champ suivi du caractère * est obligatoire');
    }
    if ($id != "") {
        // Si l'id est constitué d'autres caractères que de lettres non accentuées 
        // et de chiffres, une erreur est générée
        if (!estChiffresOuEtLettres($id)) {
            ajouterErreur
                    ("L'identifiant doit comporter uniquement des lettres non accentuées et des chiffres");
        } else {
            if (Semaine5DAO::isAnExistingId($id)) {
                ajouterErreur("La vente $id existe déjà");
            }
        }
    }
}

function verifierDonneesVenteM($id, $designation, $type, $prix) {
    if ($id == "" || $designation == "" || $type == "" || $prix == "") {
        ajouterErreur('Chaque champ suivi du caractère * est obligatoire');
    }
}

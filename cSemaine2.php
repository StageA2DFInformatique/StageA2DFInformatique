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
// 1ère étape: Affichage de la première semaine.
if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'initial';
}

$action = $_REQUEST['action'];

// Aiguillage selon l'étape
switch ($action) {
    case 'initial' :
        include("vues/Semaine2/vObtenirSemaine2.php");
        break;

    case 'detailVente':
        $id = $_REQUEST['id'];
        include("vues/Semaine2/vObtenirDetailSemaine2.php");
        break;

    case 'demanderSupprimerVente':
        $id = $_REQUEST['id'];
        include("vues/Semaine2/vSupprimerSemaine2.php");
        break;

    case 'demanderSupprimerTouteVente':
        include("vues/Semaine2/vSupprimerTout.php");
        break;

    case 'demanderCreerVente':
        include("vues/Semaine2/vCreerModifierSemaine2.php");
        break;

    case 'demanderModifierVente':
        $id = $_REQUEST['id'];
        include("vues/Semaine2/vCreerModifierSemaine2.php");
        break;

    case 'validerSupprimerVente':
        $id = $_REQUEST['id'];
        Semaine2DAO::delete($id);
        include("vues/Semaine2/vObtenirSemaine2.php");
        break;

    case 'validerSupprimerTouteVente':
        $uneVente = Semaine2DAO::deleteAll();
        include("vues/Semaine2/vObtenirSemaine2.php");
        break;

    case 'validerCreerVente':case 'validerModifierVente':
        $id = $_REQUEST['id'];
        $designation = $_REQUEST['designation'];
        $type = $_REQUEST['type'];
        $prix = $_REQUEST['prix'];


        if ($action == 'validerCreerVente') {
            verifierDonneesVenteC($id, $designation, $type, $prix);
            if (nbErreurs() == 0) {
                $uneVente = new Semaine2($id, $designation, $type, $prix);
                Semaine2DAO::insert($uneVente);
                include("vues/Semaine2/vObtenirSemaine2.php");
            } else {
                include("vues/Semaine2/vCreerModifierSemaine2.php");
            }
        } else {
            verifierDonneesVenteM($id, $designation, $type, $prix);
            if (nbErreurs() == 0) {
                $uneVente = new Semaine2($id, $designation, $type, $prix);
                Semaine2DAO::update($id, $uneVente);
                include("vues/Semaine2/vObtenirSemaine2.php");
            } else {
                include("vues/Semaine2/vCreerModifierSemaine2.php");
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
            if (Semaine2DAO::isAnExistingId($id)) {
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

<?php

/**
 * Contrôleur : SaisieEncours/Semaine1
 */
use modele\dao\Semaine1DAO;
use modele\dao\TotalSemaine1DAO;
use modele\metier\Semaine1;
use modele\metier\TotalSemaine1;
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
        include("vues/Semaine1/vObtenirSemaine1.php");
        break;

    case 'detailVente':
        $id = $_REQUEST['id'];
        include("vues/Semaine1/vObtenirDetailSemaine1.php");
        break;

    case 'demanderSupprimerVente':
        $id = $_REQUEST['id'];
        include("vues/Semaine1/vSupprimerSemaine1.php");
        break;

    case 'demanderSupprimerTouteVente':
        include("vues/Semaine1/vSupprimerTout.php");
        break;

    case 'demanderCreerVente':
        include("vues/Semaine1/vCreerModifierSemaine1.php");
        break;

    case 'demanderModifierVente':
        $id = $_REQUEST['id'];
        include("vues/Semaine1/vCreerModifierSemaine1.php");
        break;

    case 'validerSupprimerVente':
        $id = $_REQUEST['id'];
        Semaine1DAO::delete($id);
        include("vues/Semaine1/vObtenirSemaine1.php");
        break;

    case 'validerSupprimerTouteVente':
        $uneVente = Semaine1DAO::deleteAll();
        include("vues/Semaine1/vObtenirSemaine1.php");
        break;
    
    case 'demanderVoirTotalSemaine1':
        $unTotal = TotalSemaine1DAO::getAll();
        include("vues/Semaine1/vTotalSemaine1.php");
        break;
    
    case 'validerCreerVente':case 'validerModifierVente':
        $id = $_REQUEST['id'];
        $designation = $_REQUEST['designation'];
        $type = $_REQUEST['type'];
        $prix = $_REQUEST['prix'];


        if ($action == 'validerCreerVente') {
            verifierDonneesVenteC($id, $designation, $type, $prix);
            if (nbErreurs() == 0) {
                $uneVente = new Semaine1($id, $designation, $type, $prix);
                Semaine1DAO::insert($uneVente);
                include("vues/Semaine1/vObtenirSemaine1.php");
            } else {
                include("vues/Semaine1/vCreerModifierSemaine1.php");
            }
        } else {
            verifierDonneesVenteM($id, $designation, $type, $prix);
            if (nbErreurs() == 0) {
                $uneVente = new Semaine1($id, $designation, $type, $prix);
                Semaine1DAO::update($id, $uneVente);
                include("vues/Semaine1/vObtenirSemaine1.php");
            } else {
                include("vues/Semaine1/vCreerModifierSemaine1.php");
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
            if (Semaine1DAO::isAnExistingId($id)) {
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

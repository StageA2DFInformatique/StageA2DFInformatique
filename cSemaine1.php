<?php

/**
 * Contrôleur : SaisieEncours/Semaine1
 */
use modele\dao\Semaine1DAO;
use modele\metier\Semaine1;
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
        include("vues//Semaine1/vObtenirSemaine1.php");
        break;

    case 'detailVente1':
        $id = $_REQUEST['id'];
        include("vues/Semaine1/vObtenirDetailSemaine1.php");
        break;

    case 'demanderSupprimerVente1':
        $id = $_REQUEST['id'];
        include("vues/Semaine1/vSupprimerSemaine1.php");
        break;

    case 'demanderCreerVente1':
        include("vues/Semaine1/vCreerModifierSemaine1.php");
        break;

    case 'demanderModifierVente1':
        $id = $_REQUEST['id'];
        include("vues/Semaine1/vCreerModifierSemaine1.php");
        break;

    case 'validerSupprimerVente1':
        $id = $_REQUEST['id'];
        Semaine1DAO::delete($id);
        include("vues/Semaine1/vObtenirSemaine1.php");
        break;

    case 'validerCreerVente1':case 'validerModifierVente1':
        $id = $_REQUEST['id'];
        $designation = $_REQUEST['designation'];
        $type = $_REQUEST['type'];
        $prix = $_REQUEST['prix'];


        if ($action == 'validerCreerVente1') {
            verifierDonneesVente1C($id, $designation, $type, $prix);
            if (nbErreurs() == 0) {
                $uneVente1 = new Semaine1($id, $designation, $type, $prix);
                Semaine1DAO::insert($uneVente1);
                include("vues/Semaine1/vObtenirSemaine1.php");
            } else {
                include("vues/Semaine1/vCreerModifierSemaine1.php");
            }
        } else {
            verifierDonneesVente1M($id, $designation, $type, $prix);
            if (nbErreurs() == 0) {
                $uneVente1 = new Semaine1($id, $designation, $type, $prix);
                Semaine1DAO::update($id, $uneVente1);
                include("vues/Semaine1/vObtenirSemaine1.php");
            } else {
                include("vues/Semaine1/vCreerModifierSemaine1.php");
            }
        }
        break;
}

// Fermeture de la connexion au serveur MySql
Bdd::deconnecter();

function verifierDonneesVente1C($id, $designation, $type, $prix) {
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

function verifierDonneesVente1M($id, $designation, $type, $prix) {
    if ($id == "" || $designation == "" || $type == "" || $prix == "") {
        ajouterErreur('Chaque champ suivi du caractère * est obligatoire');
    }
}

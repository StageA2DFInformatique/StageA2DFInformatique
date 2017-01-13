<?php

/**
 * Contrôleur : gestion des Charges
 */
use modele\dao\ChargesDAO;
use modele\metier\Charges;
use modele\dao\Bdd;

require_once __DIR__ . '/include/autoload.php';
Bdd::connecter();
$repInclude = './include/';
require($repInclude . "_init.inc.php");
// 1ère étape (donc pas d'action choisie) : affichage du tableau des 
// charges 
if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'initial';
}

$action = $_REQUEST['action'];

// Aiguillage selon l'étape
switch ($action) {
    case 'initial' :
        include("vues/GestionCharges/vObtenirCharge.php");
        break;

    case 'detailChrg':
        $id = $_REQUEST['id'];
        include("vues/GestionCharges/vObtenirDetailCharge.php");
        break;

    case 'demanderSupprimerChrg':
        $id = $_REQUEST['id'];
        include("vues/GestionCharges/vSupprimerCharge.php");
        break;

    case 'demanderCreerChrg':
        include("vues/GestionCharges/vCreerModifierCharge.php");
        break;

    case 'demanderModifierChrg':
        $id = $_REQUEST['id'];
        include("vues/GestionCharges/vCreerModifierCharge.php");
        break;

    case 'validerSupprimerChrg':
        $id = $_REQUEST['id'];
        ChargesDAO::delete($id);
        include("vues/GestionCharges/vObtenirCharge.php");
        break;

    case 'validerCreerChrg':case 'validerModifierChrg':
        $id = $_REQUEST['id'];
        $nom = $_REQUEST['nom'];

        if ($action == 'validerCreerChrg') {
            verifierDonneesChrgC($id, $nom);
            if (nbErreurs() == 0) {
                $unChrg = new Charges($id, $nom);
                ChargesDAO::insert($unChrg);
                include("vues/GestionCharges/vObtenirCharge.php");
            } else {
                include("vues/GestionCharges/vCreerModifierCharge.php");
            }
        } else {
            verifierDonneesChrgM($id, $nom);
            if (nbErreurs() == 0) {
                $unChrg = new Charges($id, $nom);
                ChargesDAO::update($id, $unChrg);
                include("vues/GestionCharges/vObtenirCharge.php");
            } else {
                include("vues/GestionCharges/vCreerModifierCharge.php");
            }
        }
        break;
}

// Fermeture de la connexion au serveur MySql
Bdd::deconnecter();

function verifierDonneesChrgC($id, $nom) {
    if ($id == "" || $nom == "") {
        ajouterErreur('Chaque champ suivi du caractère * est obligatoire');
    }
    if ($id != "") {
        // Si l'id est constitué d'autres caractères que de lettres non accentuées 
        // et de chiffres, une erreur est générée
        if (!estChiffresOuEtLettres($id)) {
            ajouterErreur
                    ("L'identifiant doit comporter uniquement des lettres non accentuées et des chiffres");
        } else {
            if (ChargesDAO::isAnExistingId($id)) {
                ajouterErreur("La charge $id existe déjà");
            }
        }
    }
    if ($nom != "" && ChargesDAO::isAnExistingName(true, $id, $nom)) {
        ajouterErreur("La charge $nom existe déjà");
    }
}

function verifierDonneesChrgM($id, $nom) {
    if ($id == "" || $nom == "") {
        ajouterErreur('Chaque champ suivi du caractère * est obligatoire');
    }
    if ($nom != "" && ChargesDAO::isAnExistingName(false, $id, $nom)) {
        ajouterErreur("La charge $nom existe déjà");
    }
}
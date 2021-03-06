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
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        }
        $nom = $_REQUEST['nom'];
        $description = $_REQUEST['description'];
        $numContrat = $_REQUEST['numContrat'];
        $numTel = $_REQUEST['numTel'];
        $date = $_REQUEST['date'];

        if ($action == 'validerCreerChrg') {
            verifierDonneesChrgC($nom, $description, $numContrat, $numTel, $date);
            if (nbErreurs() == 0) {
                $unChrg = new Charges(null, $nom, $description, $numContrat, $numTel, $date);
                ChargesDAO::insert($unChrg);
                include("vues/GestionCharges/vObtenirCharge.php");
            } else {
                include("vues/GestionCharges/vCreerModifierCharge.php");
            }
        } else {
            verifierDonneesChrgM($id, $nom, $description, $numContrat, $numTel, $date);
            if (nbErreurs() == 0) {
                $unChrg = new Charges($id, $nom, $description, $numContrat, $numTel, $date);
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

function verifierDonneesChrgC($nom, $description, $numContrat, $numTel, $date) {
    if ($nom == "" || $description == "" || $numContrat == "" ||
            $numTel == "" || $date == "") {
        ajouterErreur('Chaque champ suivi du caractère * est obligatoire');
    }
}

function verifierDonneesChrgM($id, $nom, $description, $numContrat, $numTel, $date) {
    if ($id == "" || $nom == "" || $description == "" || $numContrat == "" ||
            $numTel == "" || $date == "") {
        ajouterErreur('Chaque champ suivi du caractère * est obligatoire');
    }
}

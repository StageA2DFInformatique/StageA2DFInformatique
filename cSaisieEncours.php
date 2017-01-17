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
// 1ère étape (donc pas d'action choisie) : affichage du tableau de saisie en cours 

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
        $description = $_REQUEST['description'];
        $numContrat = $_REQUEST['numContrat'];
        $numTel = $_REQUEST['numTel'];


        if ($action == 'validerCreerChrg') {
            verifierDonneesChrgC($id, $nom, $description, $numContrat, $numTel);
            if (nbErreurs() == 0) {
                $unChrg = new Charges($id, $nom, $description, $numContrat, $numTel);
                ChargesDAO::insert($unChrg);
                include("vues/GestionCharges/vObtenirCharge.php");
            } else {
                include("vues/GestionCharges/vCreerModifierCharge.php");
            }
        } else {
            verifierDonneesChrgM($id, $nom, $description, $numContrat, $numTel);
            if (nbErreurs() == 0) {
                $unChrg = new Charges($id, $nom, $description, $numContrat, $numTel);
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


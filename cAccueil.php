<?php

/**
 * Contrôleur : gestion des Syntheses de chaque mois de l'année
 */
use modele\dao\SyntheseDAO;
use modele\metier\Synthese;
use modele\dao\Bdd;

require_once __DIR__ . '/include/autoload.php';
Bdd::connecter();
$repInclude = './include/';
require($repInclude . "_init.inc.php");
// 1ère étape (donc pas d'action choisie) : affichage du tableau des syntheses 
if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'initial';
}

$action = $_REQUEST['action'];

// Aiguillage selon l'étape
switch ($action) {
    case 'initial' :
        include("vues/AccueilSynthese/vObtenirSynthese.php");
        break;

    case 'detailSynth':
        $id = $_REQUEST['id'];
        include("vues/AccueilSynthese/vObtenirDetailSynthese.php");
        break;
    case 'demanderModifierSynth':
        $id = $_REQUEST['id'];
        include("vues/AccueilSynthese/vCreerModifierSynthese.php");
        break;

    case 'validerSupprimerSynth':
        $id = $_REQUEST['id'];
        FournisseursDAO::delete($id);
        include("vues/AccueilSynthese/vObtenirSynthese.php");
        break;

    case 'validerModifierSynth':
        $id = $_REQUEST['id'];
        $compte = $_REQUEST['compte'];
        $cb = $_REQUEST['cb'];
        $espece = $_REQUEST['espece'];
        $cheque = $_REQUEST['cheque'];

        if ($action == 'validerModifierSynth') {
            verifierDonneesSynthM($id, $compte, $cb, $espece, $cheque);
            if (nbErreurs() == 0) {
                $uneSynth = new Synthese($id, $compte, $cb, $espece, $cheque);
                SyntheseDAO::update($id, $uneSynth);
                include("vues/AccueilSynthese/vObtenirSynthese.php");
            } else {
                include("vues/AccueilSynthese/vCreerModifierSynthese.php");
            }
        }
        break;
}

// Fermeture de la connexion au serveur MySql
Bdd::deconnecter();

function verifierDonneesSynthM($id, $compte, $cb, $espece, $cheque) {
    if ($id == "" || $compte == "" || $cb == "" || $espece == "" || $cheque == "") {
        ajouterErreur('Chaque champ est obligatoire');
    }
}

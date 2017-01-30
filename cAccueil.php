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
        include("vues/AccueilSynthese/vModifierSynthese.php");
        break;

    case 'validerModifierSynth':
        $id = $_REQUEST['id'];
        $compte = $_REQUEST['compte'];
        $cb = $_REQUEST['cb'];
        $espece = $_REQUEST['espece'];
        $cheque = $_REQUEST['cheque'];
        $mois = $_REQUEST['mois'];


        verifierDonneesSynthM($id, $mois, $compte, $cb, $espece, $cheque);
        if (nbErreurs() == 0) {
            $uneSynth = new Synthese($id, $mois, $compte, $cb, $espece, $cheque, $mois + $compte + $cb + $espece + $cheque, $mois + $compte + $cb + $espece + $cheque+1);
            SyntheseDAO::update($id, $uneSynth);
            include("vues/AccueilSynthese/vObtenirSynthese.php");
        } else {
            include("vues/AccueilSynthese/vModifierSynthese.php");
        }

        break;
        verifierDonneesTotalM($id, $total);
        if (nbErreurs() == 0) {
            $unTotal = new TotalSemaine1($id, $prix);
            TotalSemaine1DAO::update($id, $total);
            include("vues/Semaine1/vObtenirSemaine1.php");
        } else {
            include("vues/Semaine1/vTotalSemaine1.php");
        }
        break;
}

// Fermeture de la connexion au serveur MySql
Bdd::deconnecter();

function verifierDonneesSynthM($id, $compte, $cb, $espece, $cheque) {
    if ($id == "" || $compte == "" || $cb == "" || $espece == "" || $cheque == "") {
        ajouterErreur('Chaque champ est obligatoire');
    }
    //FAIT FONCTIONNER CA
    /* else
      if(!estEntier($compte) || !estEntier($cb) || !estEntier($espece) || !estEntier($cheque) || $compte < 0 || $cb < 0 || $espece < 0 || $cheque < 0){
      ajouterErreur('Tous les champs doivent être des réels positifs.');
      } */
}

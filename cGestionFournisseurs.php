<?php

/**
 * Contrôleur : gestion des fournisseurs
 */
use modele\dao\FournisseursDAO;
use modele\metier\Fournisseurs;
use modele\dao\Bdd;

require_once __DIR__ . '/include/autoload.php';
Bdd::connecter();
$repInclude = './include/';
require($repInclude . "_init.inc.php");
// 1ère étape (donc pas d'action choisie) : affichage du tableau des 
// fournisseurs 
if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'initial';
}

$action = $_REQUEST['action'];

// Aiguillage selon l'étape
switch ($action) {
    case 'initial' :
        include("vues/GestionFournisseurs/vObtenirFournisseur.php");
        break;

    case 'detailFourni':
        $id = $_REQUEST['id'];
        include("vues/GestionFournisseurs/vObtenirDetailFournisseur.php");
        break;

    case 'demanderSupprimerFourni':
        $id = $_REQUEST['id'];
        include("vues/GestionFournisseurs/vSupprimerFournisseur.php");
        break;

    case 'demanderCreerFourni':
        include("vues/GestionFournisseurs/vCreerModifierFournisseur.php");
        break;

    case 'demanderModifierFourni':
        $id = $_REQUEST['id'];
        include("vues/GestionFournisseurs/vCreerModifierFournisseur.php");
        break;

    case 'validerSupprimerFourni':
        $id = $_REQUEST['id'];
        FournisseursDAO::delete($id);
        include("vues/GestionFournisseurs/vObtenirFournisseur.php");
        break;

    case 'validerCreerFourni':case 'validerModifierFourni':
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        }
        $nom = $_REQUEST['nom'];
        $adresseRue = $_REQUEST['adresseRue'];
        $codePostal = $_REQUEST['codePostal'];
        $ville = $_REQUEST['ville'];
        $tel = $_REQUEST['tel'];
        $adresseElectronique = $_REQUEST['adresseElectronique'];
        $paiement = $_REQUEST['paiement'];

        if ($action == 'validerCreerFourni') {
            verifierDonneesFourniC($nom, $adresseRue, $codePostal, $ville, $tel, $adresseElectronique, $paiement);
            if (nbErreurs() == 0) {
                $unFourni = new Fournisseurs(null, $nom, $adresseRue, $codePostal, $ville, $tel, $adresseElectronique, $paiement);
                FournisseursDAO::insert($unFourni);
                include("vues/GestionFournisseurs/vObtenirFournisseur.php");
            } else {
                include("vues/GestionFournisseurs/vCreerModifierFournisseur.php");
            }
        } else {
            verifierDonneesFourniM($id, $nom, $adresseRue, $codePostal, $ville, $tel, $adresseElectronique, $paiement);
            if (nbErreurs() == 0) {
                $unFourni = new Fournisseurs($id, $nom, $adresseRue, $codePostal, $ville, $tel, $adresseElectronique, $paiement);
                FournisseursDAO::update($id, $unFourni);
                include("vues/GestionFournisseurs/vObtenirFournisseur.php");
            } else {
                include("vues/GestionFournisseurs/vCreerModifierFournisseur.php");
            }
        }
        break;
}

// Fermeture de la connexion au serveur MySql
Bdd::deconnecter();

function verifierDonneesFourniC($nom, $adresseRue, $codePostal, $ville, $tel, $adresseElectronique, $paiement) {
    if ($nom == "" || $adresseRue == "" || $codePostal == "" ||
            $ville == "" || $tel == "" || $adresseElectronique == "" || $paiement == "") {
        ajouterErreur('Chaque champ suivi du caractère * est obligatoire');
    }
}

function verifierDonneesFourniM($id, $nom, $adresseRue, $codePostal, $ville, $tel, $adresseElectronique, $paiement) {
    if ($id == "" || $nom == "" || $adresseRue == "" || $codePostal == "" ||
            $ville == "" || $tel == "" || $adresseElectronique == "" || $paiement == "") {
        ajouterErreur('Chaque champ suivi du caractère * est obligatoire');
    }
}

<?php

/**
 * Contrôleur : SaisieEncours/Semaine3
 */
use modele\dao\Semaine3DAO;
use modele\metier\Semaine3;
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
        include("vues//Semaine3/vObtenirSemaine3.php");
        break;

    case 'detailVente3':
        $id3 = $_REQUEST['id3'];
        include("vues/Semaine3/vObtenirDetailSemaine3.php");
        break;

    case 'demanderSupprimerVente3':
        $id3 = $_REQUEST['id3'];
        include("vues/Semaine3/vSupprimerSemaine3.php");
        break;

    case 'demanderCreerVente3':
        include("vues/Semaine3/vCreerModifierSemaine3.php");
        break;

    case 'demanderModifierVente3':
        $id3 = $_REQUEST['id3'];
        include("vues/Semaine3/vCreerModifierSemaine3.php");
        break;

    case 'valid3erSupprimerVente3':
        $id3 = $_REQUEST['id3'];
        Semaine3DAO::delete($id3);
        include("vues/Semaine3/vObtenirSemaine3.php");
        break;

    case 'valid3erCreerVente3':case 'valid3erModifierVente3':
        $id3 = $_REQUEST['id3'];
        $designation3 = $_REQUEST['designation3'];
        $type3 = $_REQUEST['type3'];
        $prix3 = $_REQUEST['prix3'];


        if ($action == 'valid3erCreerVente3') {
            verifierDonneesVente3C($id3, $designation3, $type3, $prix3);
            if (nbErreurs() == 0) {
                $uneVente3 = new Semaine3($id3, $designation3, $type3, $prix3);
                Semaine3DAO::insert($uneVente3);
                include("vues/Semaine3/vObtenirSemaine3.php");
            } else {
                include("vues/Semaine3/vCreerModifierSemaine3.php");
            }
        } else {
            verifierDonneesVente3M($id3, $designation3, $type3, $prix3);
            if (nbErreurs() == 0) {
                $uneVente3 = new Semaine3($id3, $designation3, $type3, $prix3);
                Semaine3DAO::update($id3, $uneVente3);
                include("vues/Semaine3/vObtenirSemaine3.php");
            } else {
                include("vues/Semaine3/vCreerModifierSemaine3.php");
            }
        }
        break;
}

// Fermeture de la connexion au serveur MySql
Bdd::deconnecter();

function verifierDonneesVente3C($id3, $designation3, $type3, $prix3) {
    if ($id3 == "" || $designation3 == "" || $type3 == "" || $prix3 == "") {
        ajouterErreur('Chaque champ suivi du caractère * est obligatoire');
    }
    if ($id3 != "") {
        // Si l'id3 est constitué d'autres caractères que de lettres non accentuées 
        // et de chiffres, une erreur est générée
        if (!estChiffresOuEtLettres($id3)) {
            ajouterErreur
                    ("L'id3entifiant doit comporter uniquement des lettres non accentuées et des chiffres");
        } else {
            if (Semaine3DAO::isAnExistingId($id3)) {
                ajouterErreur("La Vente $id3 existe déjà");
            }
        }
    }
}

function verifierDonneesVente3M($id3, $designation3, $type3, $prix3) {
    if ($id3 == "" || $designation3 == "" || $type3 == "" || $prix3 == "") {
        ajouterErreur('Chaque champ suivi du caractère * est obligatoire');
    }
}

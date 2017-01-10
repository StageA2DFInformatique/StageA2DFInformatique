<?php
$repInclude = './include/';
require($repInclude . "_init.inc.php");

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");
?>
<!-- Division pour le contenu principal -->
<div id="contenu">
    <h2>Fournisseurs</h2>
    <?php

    /**
     * Contrôleur : gestion des Fournisseurs
     */
    use modele\dao\FournisseursDAO;
    use modele\metier\Fournisseurs;
    use modele\dao\Bdd;

require_once __DIR__ . '/includes/autoload.php';
    Bdd::connecter();

    include("includes/_gestionErreurs.inc.php");

// 1ère étape (donc pas d'action choisie) : affichage du tableau des Fournisseurs 
    if (!isset($_REQUEST['action'])) {
        $_REQUEST['action'] = 'initial';
    }

    $action = $_REQUEST['action'];

// Aiguillage selon l'étape
    switch ($action) {
        case 'initial' :
            include("vues/GestionFournisseurs/vObtenirFournisseurs.php");
            break;

        case 'detailFourni':
            $id = $_REQUEST['id'];
            include("vues/GestionFournisseurs/vObtenirDetailFournisseurs.php");
            break;

        case 'demanderSupprimerFourni':
            $id = $_REQUEST['id'];
            include("vues/GestionFournisseurs/vSupprimerFournisseurs.php");
            break;

        case 'demanderCreerFourni':
            include("vues/GestionFournisseurs/vCreerModifierFournisseurs.php");
            break;

        case 'demanderModifierFourni':
            $id = $_REQUEST['id'];
            include("vues/GestionFournisseurs/vCreerModifierFournisseurs.php");
            break;

        case 'validerSupprimerFourni':
            $id = $_REQUEST['id'];
            FournisseursDAO::delete($id);
            include("vues/GestionFournisseurs/vObtenirFournisseurs.php");
            break;

        case 'validerCreerFourni':case 'validerModifierFourni':
            $id = $_REQUEST['id'];
            $nom = $_REQUEST['nom'];
            $adresseRue = $_REQUEST['adresseRue'];
            $codePostal = $_REQUEST['codePostal'];
            $ville = $_REQUEST['ville'];
            $tel = $_REQUEST['tel'];
            $adresseElectronique = $_REQUEST['adresseElectronique'];
            $paiement = $_REQUEST['paiement'];
            if ($action == 'validerCreerFourni') {
                verifierDonneesFourniC($id, $nom, $adresseRue, $codePostal, $ville, $tel, $adresseElectronique, $paiement);
                if (nbErreurs() == 0) {
                    $unFourni = new Fournisseurs($id, $nom, $adresseRue, $codePostal, $ville, $tel, $adresseElectronique, $paiment);
                    FournisseursDAO::insert($unFourni);
                    include("vues/GestionFournisseurs/vObtenirFournisseurs.php");
                } else {
                    include("vues/GestionFournisseurs/vCreerModifierFournisseurs.php");
                }
            } else {
                verifierDonneesFourniM($id, $nom, $adresseRue, $codePostal, $ville, $tel, $adresseElectronique, $paiement);
                if (nbErreurs() == 0) {
                    $unFourni = new Fournisseurs($id, $nom, $adresseRue, $codePostal, $ville, $tel, $adresseElectronique, $paiment);
                    FournisseursDAO::update($id, $unFourni);
                    include("vues/GestionFournisseurs/vObtenirFournisseurs.php");
                } else {
                    include("vues/GestionFournisseurs/vCreerModifierFournisseurs.php");
                }
            }
            break;
    }

// Fermeture de la connexion au serveur MySql
    Bdd::deconnecter();

    function verifierDonneesFourniC($id, $nom, $adresseRue, $codePostal, $ville, $tel, $adresseElectronique, $paiement) {
        if ($id == "" || $nom == "" || $adresseRue == "" || $codePostal == "" ||
                $ville == "" || $tel == "" || $paiement == "") {
            ajouterErreur('Chaque champ suivi du caractère * est obligatoire');
        }
        if ($id != "") {
            // Si l'id est constitué d'autres caractères que de lettres non accentuées 
            // et de chiffres, une erreur est générée
            if (!estChiffresOuEtLettres($id)) {
                ajouterErreur
                        ("L'identifiant doit comporter uniquement des lettres non accentuées et des chiffres");
            } else {
                if (FournisseursDAO::isAnExistingId($id)) {
                    ajouterErreur("Le Fournisseur $id existe déjà");
                }
            }
        }
        if ($nom != "" && FournisseursDAO::isAnExistingName(true, $id, $nom)) {
            ajouterErreur("Le Fournisseur $nom existe déjà");
        }
        if (!estChiffresLettresEspacesOuEtTirets($nom)) {
            ajouterErreur("Le nom doit comporter uniquement des lettres, des chiffres, des espaces et des tirets");
        }
        if ($codePostal != "" && !estUnCp($codePostal)) {
            ajouterErreur('Le code postal doit comporter 5 chiffres');
        }
        if ($tel != "" && !estUntel($tel)) {
            ajouterErreur('Le numero de telephone doit comporter 10 chiffres et commencer par 0');
        }
        if ($adresseElectronique != "" && !adresseEmailValide($adresseElectronique)) {
            ajouterErreur("L'adresse E-mail doit être de type exemple@exemple.fr");
        }
    }

    function verifierDonneesFourniM($id, $nom, $adresseRue, $codePostal, $ville, $tel, $adresseElectronique, $paiement) {
        if ($id == "" || $nom == "" || $adresseRue == "" || $codePostal == "" ||
                $ville == "" || $tel == "" || $paiement == "") {
            ajouterErreur('Chaque champ suivi du caractère * est obligatoire');
        }
        if ($nom != "" && FournisseursDAO::isAnExistingName(false, $id, $nom)) {
            ajouterErreur("Le Fournisseur $nom existe déjà");
        }
        if (!estChiffresLettresEspacesOuEtTirets($nom)) {
            ajouterErreur("Le nom doit comporter uniquement des lettres, des chiffres, des espaces et des tirets");
        }
        if ($codePostal != "" && !estUnCp($codePostal)) {
            ajouterErreur('Le code postal doit comporter 5 chiffres');
        }
        if ($tel != "" && !estUntel($tel)) {
            ajouterErreur('Le numero de telephone doit comporter 10 chiffres et commencer par 0');
        }
        if ($adresseElectronique != "" && !adresseEmailValide($adresseElectronique)) {
            ajouterErreur("L'adresse E-mail doit être de type exemple@exemple.fr");
        }
    }

    function estUnCp($codePostal) {
        // Le code postal doit comporter 5 chiffres
        return strlen($codePostal) == 5 && estEntier($codePostal);
    }

    function estUntel($tel) {
        // Le code postal doit comporter 5 chiffres
        return strlen($tel) == 10 && estEntier($tel) && Start0($tel) == 0;
    }

    require($repInclude . "_fin.inc.php");
    ?>

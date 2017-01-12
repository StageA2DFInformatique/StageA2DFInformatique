<?php

$repInclude = './include/';
require($repInclude . "_init.inc.php");

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");

//Division principale
echo '<div id="contenu">';
echo "<h2>Création d'un Fournisseur</h2>";

use modele\dao\FournisseursDAO;
use modele\metier\Fournisseurs;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();


// CRÉER OU MODIFIER UN FOURNISSEUR
// S'il s'agit d'une création et qu'on ne "vient" pas de ce formulaire (on 
// "vient" de ce formulaire uniquement s'il y avait une erreur), il faut définir 
// les champs à vide sinon on affichera les valeurs précédemment saisies
if ($action == 'demanderCreerFourni') {
    $id = '';
    $nom = '';
    $adresseRue = '';
    $ville = '';
    $codePostal = '';
    $tel = '';
    $adresseElectronique = '';
    $paiement = '';
}

// S'il s'agit d'une modification et qu'on ne "vient" pas de ce formulaire, il
// faut récupérer les données sinon on affichera les valeurs précédemment 
// saisies
if ($action == 'demanderModifierFourni') {
    $unFourni = FournisseursDAO::getOneById($id);
    /* @var $unFourni Fournisseurs */
    $nom = $unFourni->getNom();
    $adresseRue = $unFourni->getAdresse();
    $codePostal = $unFourni->getCdp();
    $ville = $unFourni->getVille();
    $tel = $unFourni->getTel();
    $adresseElectronique = $unFourni->getEmail();
    $paiement = $unFourni->getPaiement();
}

// Initialisations en fonction du mode (création ou modification) 
if ($action == 'demanderCreerFourni' || $action == 'validerCreerFournib') {
    $creation = true;
    $message = "Nouveau fournisseur";  // Alimentation du message de l'en-tête
    $action = "validerCreerFourni";
} else {
    $creation = false;
    $message = "$nom ($id)";            // Alimentation du message de l'en-tête
    $action = "validerModifierFourni";
}
echo '<div id="contenu-formulaire">';

// En cas de création, l'id est accessible sinon l'id est dans un champ
// caché               
if ($creation) {
    // On utilise les guillemets comme délimiteur de champ dans l'echo afin
    // de ne pas perdre les éventuelles quotes saisies (même si les quotes
    // ne sont pas acceptées dans l'id, on a le souci de ré-afficher l'id
    // tel qu'il a été saisi) 
    echo '
         <tr class="ligneTabNonQuad">
            <td> Id*: </td>
            <td><input type="text" value="' . $id . '" name="id" size ="30" 
            maxlength="8"></td>
         </tr>
         <br>';
} else {
    echo "
         <tr>
            <td><input type='hidden' value='$id' name='id'></td><td></td>
         </tr>
            <br>";
}
echo '
      <tr class="ligneTabNonQuad">
         <td> Nom*: </td>
         <td><input type="text" value="' . $nom . '" name="nom" size="30" 
         maxlength="45"></td>
      </tr>
      <br>
            <tr class="ligneTabNonQuad">
         <td> Adresse*: </td>
         <td><input type="text" value="' . $adresseRue . '" name="adresseRue" 
         size="30" maxlength="45"></td>
      </tr>
      <br>
      <tr class="ligneTabNonQuad">
         <td> Code postal*: </td>
         <td><input type="text" value="' . $codePostal . '" name="codePostal" 
         size="30" maxlength="5"></td>
      </tr>
      <br>
      <tr class="ligneTabNonQuad">
         <td> Ville*:</td>
         <td><input type="text" value="' . $ville . '" name="ville" size="30" 
         maxlength="35"></td>
      </tr>
      <br>
      <tr class="ligneTabNonQuad">
         <td> Téléphone*: </td>
         <td><input type="text" value="' . $tel . '" name="tel" size ="30"
         maxlength="10"></td>
      </tr>
      <br>
      <tr class="ligneTabNonQuad">
         <td> E-mail*:</td>
         <td><input type="text" value="' . $adresseElectronique . '" name=
         "adresseElectronique" size ="30" maxlength="70"></td>
      </tr>
      <br>
      <tr class="ligneTabNonQuad">
         <td> Paiement sous combien de jours*: </td>
         <td><input type="text" value="' . $paiement . '" name="paiement" size ="30"
         maxlength="5"></td>
      </tr>
      <br>';
echo '</div>';

echo "<br>
   <table align='right' cellspacing='15' cellpadding='0'>
      <tr>
         <td align='right'><input type='submit' value='Valider' name='valider'>
         </td>
         <td align='left'><input type='reset' value='Annuler' name='annuler'>
         </td>
      </tr>
   </table>
   <a href='cGestionFournisseurs.php'><button type=button>Retour</button></a>
</form>";

include("include/_fin.inc.php");


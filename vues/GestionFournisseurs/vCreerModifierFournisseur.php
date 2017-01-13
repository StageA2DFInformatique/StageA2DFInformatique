<?php

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");

//Division principale
echo '<div id="contenu">';
echo "<h2><center>Création  ou modification d'un Fournisseur</center></h2>";

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
if ($action == 'demanderCreerFourni' || $action == 'validerCreerFourni') {
    $creation = true;
    $message = "Création d'un nouveau Fournisseur";  // Alimentation du message de l'en-tête
    $action = "validerCreerFourni";
} else {
    $creation = false;
    $message = "$nom ($id)";            // Alimentation du message de l'en-tête
    $action = "validerModifierFourni";
}
echo "
    <form method='POST' action='cGestionCharges.php?'>
   <input type='hidden' value='$action' name='action'>
   <br>
   <table width='65%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>
   
      <tr class='enTeteTabNonQuad'>
         <td colspan='3'><strong><center>$message</center></strong></td>
      </tr>";

// En cas de création, l'id est accessible sinon l'id est dans un champ
// caché               
if ($creation) {
    // On utilise les guillemets comme délimiteur de champ dans l'echo afin
    // de ne pas perdre les éventuelles quotes saisies (même si les quotes
    // ne sont pas acceptées dans l'id, on a le souci de ré-afficher l'id
    // tel qu'il a été saisi) 
    echo '
         <tr class="ligneTabNonQuad">
            <td>&nbsp Id*: </td>
            <td><input type="text" value="' . $id . '" name="id" size ="30" 
            maxlength="8"></td>
         </tr>';
} else {
    echo "
         <tr>
            <td><input type='hidden' value='$id' name='id'></td><td></td>
         </tr>";
}
echo '
      <tr class="ligneTabNonQuad">
         <td>&nbsp Nom*: </td>
         <td><input type="text" value="' . $nom . '" name="nom" size="30" 
         maxlength="45"></td>
      </tr>
            <tr class="ligneTabNonQuad">
         <td>&nbsp Adresse*: </td>
         <td><input type="text" value="' . $adresseRue . '" name="adresseRue" 
         size="30" maxlength="45"></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td>&nbsp Code postal*: </td>
         <td><input type="text" value="' . $codePostal . '" name="codePostal" 
         size="30" maxlength="5"></td>
      </tr>
      <br>
      <tr class="ligneTabNonQuad">
         <td>&nbsp Ville*:</td>
         <td><input type="text" value="' . $ville . '" name="ville" size="30" 
         maxlength="35"></td>
      </tr>
      <br>
      <tr class="ligneTabNonQuad">
         <td>&nbsp Téléphone*: </td>
         <td><input type="text" value="' . $tel . '" name="tel" size ="30"
         maxlength="10"></td>
      </tr>
      <br>
      <tr class="ligneTabNonQuad">
         <td>&nbsp E-mail*:</td>
         <td><input type="text" value="' . $adresseElectronique . '" name=
         "adresseElectronique" size ="30" maxlength="70"></td>
      </tr>
      <br>
     <tr class="ligneTabNonQuad">
         <td>&nbsp Paiement (sous cb de jours)*: </td>
         <td><input type="text" value="' . $paiement . '" name="paiement" size ="30"
         maxlength="5"></td>
      </tr>
      <br>';
echo '</div>';
echo "<br>
   <table align='right' cellspacing='15' cellpadding='0'>
   <br>
      <a href='cGestionFournisseurs.php'><button type=button>Retour</button></a>

      <tr>
         <td align='right'><input type='submit' value='Valider' name='valider'>
      </tr>
   </table>
</form>";
include("include/_fin.inc.php");

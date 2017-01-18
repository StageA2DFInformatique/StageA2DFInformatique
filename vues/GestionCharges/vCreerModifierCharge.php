<?php

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");

//Division principale
echo '<div id="contenu">';
echo "<h2><center>Création  ou modification d'une Charge</center></h2>";

use modele\dao\ChargesDAO;
use modele\metier\Charges;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();


// CRÉER OU MODIFIER UNE CHARGE
// S'il s'agit d'une création et qu'on ne "vient" pas de ce formulaire (on 
// "vient" de ce formulaire uniquement s'il y avait une erreur), il faut définir 
// les champs à vide sinon on affichera les valeurs précédemment saisies
if ($action == 'demanderCreerChrg') {
    $id = '';
    $nom = '';
    $description = '';
    $numContrat = '';
    $numTel = '';
}

// S'il s'agit d'une modification et qu'on ne "vient" pas de ce formulaire, il
// faut récupérer les données sinon on affichera les valeurs précédemment 
// saisies
if ($action == 'demanderModifierChrg') {
    $unChrg = ChargesDAO::getOneById($id);
    /* @var $unChrg Charges */
    $nom = $unChrg->getNom();
    $description = $unChrg->getDescription();
    $numContrat = $unChrg->getNumContrat();
    $numTel = $unChrg->getNumTel();
}

// Initialisations en fonction du mode (création ou modification) 
if ($action == 'demanderCreerChrg' || $action == 'validerCreerChrg') {
    $creation = true;
    $messageChrg = "Nouvelle Charge";  // Alimentation du message de l'en-tête
    $action = "validerCreerChrg";
} else {
    $creation = false;
    $messageChrg = "$nom ($id)";            // Alimentation du message de l'en-tête
    $action = "validerModifierChrg";
}
echo "<form method='POST' action='cGestionCharges.php?'>
   <input type='hidden' value='$action' name='action'>
      <table width='65%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>
         <tr class='enTeteTabNonQuad'>
         <td colspan='3'><strong><center>$messageChrg</center></strong></td>
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
         <td> Description*: </td>
         <td><input type="text" value="' . $description . '" name="description" size="30" 
         maxlength="45"></td>
      </tr>
      <br>
            <tr class="ligneTabNonQuad">
         <td> N° Contrat*: </td>
         <td><input type="text" value="' . $numContrat . '" name="numContrat" size="30" 
         maxlength="16"></td>
      </tr>
      <br>
            <tr class="ligneTabNonQuad">
         <td> N° Tel*: </td>
         <td><input type="text" value="' . $numTel . '" name="numTel" size="30" 
         maxlength="10"></td>
      </tr>
      <br>';
echo '</div>';
echo "<br>
   <table align='right' cellspacing='15' cellpadding='0'>
   <br>
      <a href='cGestionCharges.php'><button type=button>Retour</button></a>

      <tr>
         <td align='right'><input type='submit' value='Valider' name='valider'>
      </tr>
   </table>
</form>";
include("include/_fin.inc.php");
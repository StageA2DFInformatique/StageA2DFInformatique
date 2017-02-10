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
    $date = 1;
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
    $date = $unChrg->getDate();
}

// Initialisations en fonction du mode (création ou modification) 
if ($action == 'demanderCreerChrg' || $action == 'validerCreerChrg') {
    $creation = true;
    $messageChrg = "Nouvelle Charge";  // Alimentation du message de l'en-tête
    $action = "validerCreerChrg";
} else {
    $creation = false;
    $messageChrg = "$nom";            // Alimentation du message de l'en-tête
    $action = "validerModifierChrg";
}
echo "<form method='POST' action='cGestionCharges.php?'>
   <input type='hidden' value='$action' name='action'>
      <table width='65%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>
         <tr class='enTeteTabNonQuad'>
         <td colspan='3'><strong><center>$messageChrg</center></strong></td>
      </tr>";

echo '
      <tr class="ligneTabNonQuad">
         <td>&nbsp Nom: </td>
         <td><input type="text" value="' . $nom . '" name="nom" size="30" 
         maxlength="45"></td>
      </tr>
      <br>
            <tr class="ligneTabNonQuad">
         <td>&nbsp Description: </td>
         <td><input type="text" value="' . $description . '" name="description" size="30" 
         maxlength="45"></td>
      </tr>
      
      <tr class="ligneTabNonQuad">
         <td>&nbsp N° Contrat: </td>
         <td><input type="text" value="' . $numContrat . '" name="numContrat" size="30" 
         maxlength="16"></td>
      </tr>
            <tr class="ligneTabNonQuad">
         <td>&nbsp Num Tel: </td>
         <td><input type="text" value="' . $numTel . '" name="numTel" size="30" 
         maxlength="10"></td>
      </tr>
      
      <tr class="ligneTabNonQuad">
         <td>&nbsp A payer: </td>
         <td>';
if ($date == 1) {
    echo " 
               <input type='radio' name='date' value='avant le 12' checked>  
               Avant le 12
               <input type='radio' name='date' value='après le 12'>  Après le 12";
} else {
    echo " 
                <input type='radio' name='date' value='avant le 12'> 
                Avant le 12
                <input type='radio' name='date' value='après le 12' checked> Après le 12";
}

echo '</tr>';
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

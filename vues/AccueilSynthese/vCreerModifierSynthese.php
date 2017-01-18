<?php

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");
use modele\dao\SyntheseDAO;
use modele\metier\Synthese;
use modele\dao\Bdd;
require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();
//Division principale
echo '<div id="contenu">';
echo "<h2><center>Création  ou modification d'une Synthèse</center></h2>";

// CRÉER OU MODIFIER UN FOURNISSEUR
// S'il s'agit d'une création et qu'on ne "vient" pas de ce formulaire (on 
// "vient" de ce formulaire uniquement s'il y avait une erreur), il faut définir 
// les champs à vide sinon on affichera les valeurs précédemment saisies
if ($action == 'demanderCreerSynth') {
    $id = '';
    $mois = '';
    $compte = '';
    $cb = '';
    $espece = '';
    $cheque = '';
}

// S'il s'agit d'une modification et qu'on ne "vient" pas de ce formulaire, il
// faut récupérer les données sinon on affichera les valeurs précédemment 
// saisies
if ($action == 'demanderModifierSynth') {
    $uneSynth = SyntheseDAO::getOneById($id);
    $mois = $uneSynth->getMois();
    $compte = $uneSynth->getCompte();
    $cb = $uneSynth->getCb();
    $espece = $uneSynth->getEspece();
    $cheque = $uneSynth->getCheque();
}

// Initialisations en fonction du mode (création ou modification) 
if ($action == 'demanderCreerSynth' || $action == 'validerCreerSynth') {
    $creation = true;
    $messageSynth = "Création d'une nouvelle Synthese";  // Alimentation du message de l'en-tête
    $action = "validerCreerSynth";
} else {
    $creation = false;
    $messageSynth = "$mois ($id)";            // Alimentation du message de l'en-tête
    $action = "validerModifierSynth";
}
echo "<form method='POST' action='cAccueil.php?'>
   <input type='hidden' value='$action' name='action'>
   <br>
   <table width='100%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>
   
      <tr class='enTeteTabNonQuad'>
         <td colspan='3'><strong><center>$messageSynth</center></strong></td>
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
            <td><input type='hidden' value='$mois' name='mois'></td><td></td>
         </tr>";
}
echo '
      <tr class="ligneTabNonQuad">
         <td>&nbsp Compte: </td>
         <td><input type="text" value="' . $compte . '" name="compte" size="30" 
         maxlength="8"></td>
      </tr>
            <tr class="ligneTabNonQuad">
         <td>&nbsp Carte Banquaire: </td>
         <td><input type="text" value="' . $cb . '" name="cb" 
         size="30" maxlength="8"></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td>&nbsp Espece: </td>
         <td><input type="text" value="' . $espece . '" name="espece" 
         size="30" maxlength="8"></td>
      </tr>
      <br>
      <tr class="ligneTabNonQuad">
         <td>&nbsp Cheque:</td>
         <td><input type="text" value="' . $cheque . '" name="cheque" size="30" 
         maxlength="8"></td>
      </tr>
      <br>';
echo '</div>';
echo "<br>
   <table align='right' cellspacing='15' cellpadding='0'>
   <br>
      <a href='cAccueil.php'><button type=button>Retour</button></a>

      <tr>
         <td align='right'><input type='submit' value='Valider' name='valider'>
      </tr>
   </table>
</form>";
include("include/_fin.inc.php");
<?php

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");

//Division principale
echo '<div id="contenu">';
echo "<h2><center>Ajouter un(e) vente / dépannage</center></h2>";

use modele\dao\EnCoursDAO;
use modele\metier\EnCours;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();

// CRÉER OU MODIFIER UNE VENTE OU UN DEPANNAGE
// S'il s'agit d'une création et qu'on ne "vient" pas de ce formulaire (on 
// "vient" de ce formulaire uniquement s'il y avait une erreur), il faut définir 
// les champs à vide sinon on affichera les valeurs précédemment saisies
if ($action == 'demanderCreerOpe') {
    $id = '';
    $designation = '';
    $type = 1;
    $prix = '';
    $jour = '';
    $mois = '';
    $annee = '';
}

// S'il s'agit d'une modification et qu'on ne "vient" pas de ce formulaire, il
// faut récupérer les données sinon on affichera les valeurs précédemment 
// saisies
if ($action == 'demanderModifierOpe') {
    $uneOpe = EnCoursDAO::getOneById($id);
    /* @var $uneOpe EnCours */
    $jour = $uneOpe->getJour();
    $mois = $uneOpe->getMois();
    $annee = $uneOpe->getAnnee();
    $designation = $uneOpe->getDesignation();
    $type = $uneOpe->getType();
    $prix = $uneOpe->getPrix();
}

// Initialisations en fonction du mode (création ou modification) 
if ($action == 'demanderCreerOpe' || $action == 'validerCreerOpe') {
    $creation = true;
    $messageOpe = "Nouvelle vente ou nouveau dépannage";  // Alimentation du message de l'en-tête
    $action = "validerCreerOpe";
} else {
    $creation = false;
    $messageOpe = "$designation";            // Alimentation du message de l'en-tête
    $action = "validerModifierOpe";
}

// Déclaration du tableau des types

echo "
    <form method='POST' action='cSaisieEnCours.php?'>
   <input type='hidden' value='$action' name='action'>
       <br>
      <table width='85%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>
         
      <tr class='enTeteTabNonQuad'>
         <td colspan='3'><strong><center>$messageOpe</center></strong></td>
      </tr>";

echo ' <input type="hidden" value="' . $id . '" name="id">';


echo '
      <tr class="ligneTabNonQuad">
         <td>&nbsp Designation: </td>
         <td><input type="text" value="' . $designation . '" name="designation" size="30" 
         maxlength="32"></td>
      </tr>
         
      <tr class="ligneTabNonQuad">
         <td>&nbsp Type: </td>
         <td>';
if ($type == 1) {
    echo " 
               <input type='radio' name='type' value='Dépannage' checked>  
               Dépannage
               <input type='radio' name='type' value='Vente'>  Vente";
} else {
    echo " 
                <input type='radio' name='type' value='Dépannage'> 
                Dépannage
                <input type='radio' name='type' value='Vente' checked> Vente";
}

echo '
      <tr class="ligneTabNonQuad">
         <td>&nbsp Valeur: </td>
         <td><input type="text" value="' . $prix . '"name="prix" size="30" 
         maxlength="8">€ </td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td>&nbsp Jour: </td>
         <td><input type="text" value="' . $jour . '"name="jour" size="30" 
         maxlength="2"> </td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td>&nbsp Mois (Janvier = 01, Février = 02 etc...): </td>
         <td><input type="text" value="' . $mois . '"name="mois" size="30" 
         maxlength="2"> </td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td>&nbsp Année: </td>
         <td><input type="text" value="' . $annee . '"name="annee" size="30" 
         maxlength="4"> </td>
      </tr>';

echo '</div>';
echo "<br>
   <table align='right' cellspacing='15' cellpadding='0'>
   <br>
      <a href='cSaisieEnCours.php'><button type=button>Retour</button></a>

      <tr>
         <td align='right'><input type='submit' value='Valider' name='valider'>
      </tr>
   </table>
</form>";
include("include/_fin.inc.php");

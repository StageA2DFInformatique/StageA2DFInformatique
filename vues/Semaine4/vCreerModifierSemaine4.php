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

use modele\dao\Semaine4DAO;
use modele\metier\Semaine4;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();


// CRÉER OU MODIFIER UNE VENTE OU UN DEPANNAGE
// S'il s'agit d'une création et qu'on ne "vient" pas de ce formulaire (on 
// "vient" de ce formulaire uniquement s'il y avait une erreur), il faut définir 
// les champs à vide sinon on affichera les valeurs précédemment saisies
if ($action == 'demanderCreerVente4') {
    $id = '';
    $designation = '';
    $type = 1;
    $prix = '';
    $total = '';
}

// S'il s'agit d'une modification et qu'on ne "vient" pas de ce formulaire, il
// faut récupérer les données sinon on affichera les valeurs précédemment 
// saisies
if ($action == 'demanderModifierVente4') {
    $uneVente4 = Semaine4DAO::getOneById($id4);
    /* @var $uneVente1 Semaine1 */
    $designation4 = $uneVente4->getDesignation();
    $type4 = $uneVente4->getType();
    $prix4 = $uneVente4->getPrix();
}

// Initialisations en fonction du mode (création ou modification) 
if ($action == 'demanderCreerVente4' || $action == 'validerCreerVente4') {
    $creation = true;
    $messageVente4 = "Nouvelle vente ou nouveau dépannage";  // Alimentation du message de l'en-tête
    $action = "validerCreerVente4";
} else {
    $creation = false;
    $messageVente4 = "$designation4 ($id4)";            // Alimentation du message de l'en-tête
    $action = "validerModifierVente4";
}

// Déclaration du tableau des types

echo "
    <form method='POST' action='cSemaine1.php?'>
   <input type='hidden' value='$action' name='action'>
       <br>
      <table width='65%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>
         
      <tr class='enTeteTabNonQuad'>
         <td colspan='4'><strong><center>$messageVente4</center></strong></td>
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
            <td>&nbsp Id: </td>
            <td><input type="text" value="' . $id4 . '" name="id" size ="40" 
            maxlength="8"></td>
         </tr>';
} else {
    echo "
         <tr>
            <td><input type='hidden' value='$id4' name='id'></td><td></td>
         </tr>
            <br>";
}
echo '
      <tr class="ligneTabNonQuad">
         <td>&nbsp Designation: </td>
         <td><input type="text" value="' . $designation4 . '" name="designation" size="40" 
         maxlength="45"></td>
      </tr>
     
      <tr class="ligneTabNonQuad">
         <td>&nbsp Type*: </td>
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
         <td><input type="text" value="' . $prix4 . '" name="prix" size="40" 
         maxlength="45"></td>
      </tr>';
      
echo '</div>';
echo "<br>
   <table align='right' cellspacing='15' cellpadding='0'>
   <br>
      <a href='cSemaine1.php'><button type=button>Retour</button></a>

      <tr>
         <td align='right'><input type='submit' value='Valider' name='valider'>
      </tr>
   </table>
</form>";
include("include/_fin.inc.php");

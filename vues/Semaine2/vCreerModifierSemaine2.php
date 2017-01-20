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

use modele\dao\Semaine2DAO;
use modele\metier\Semaine2;
use modele\dao\Bdd;

require_once __DIR__ . '/../../include/autoload.php';
Bdd::connecter();


// CRÉER OU MODIFIER UNE VENTE OU UN DEPANNAGE
// S'il s'agit d'une création et qu'on ne "vient" pas de ce formulaire (on 
// "vient" de ce formulaire uniquement s'il y avait une erreur), il faut définir 
// les champs à vide sinon on affichera les valeurs précédemment saisies
if ($action == 'demanderCreerVente2') {
    $id2 = '';
    $designation2 = '';
    $type2 = 1;
    $prix2 = '';
}

// S'il s'agit d'une modification et qu'on ne "vient" pas de ce formulaire, il
// faut récupérer les données sinon on affichera les valeurs précédemment 
// saisies
if ($action == 'demanderModifierVente2') {
    $uneVente2 = Semaine2DAO::getOneById($id2);
    /* @var $uneVente2 Semaine2 */
    $designation2 = $uneVente2->getDesignation2();
    $type2 = $uneVente2->getType2();
    $prix2 = $uneVente2->getPrix2();
}

// Initialisations en fonction du mode (création ou modification) 
if ($action == 'demanderCreerVente2' || $action == 'validerCreerVente2') {
    $creation = true;
    $messageVente2 = "Nouvelle vente ou nouveau dépannage";  // Alimentation du message de l'en-tête
    $action = "validerCreerVente2";
} else {
    $creation = false;
    $messageVente2 = "$designation2 ($id2)";            // Alimentation du message de l'en-tête
    $action = "validerModifierVente2";
}

// Déclaration du tableau des types

echo "
    <form method='POST' action='cSemaine2.php?'>
   <input type='hidden' value='$action' name='action'>
       <br>
      <table width='65%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>
         
      <tr class='enTeteTabNonQuad'>
         <td colspan='3'><strong><center>$messageVente2</center></strong></td>
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
            <td><input type="text" value="' . $id2 . '" name="id" size ="30" 
            maxlength="8"></td>
         </tr>';
} else {
    echo "
         <tr>
            <td><input type='hidden' value='$id2' name='id'></td><td></td>
         </tr>
            <br>";
}
echo '
      <tr class="ligneTabNonQuad">
         <td>&nbsp Designation: </td>
         <td><input type="text" value="' . $designation2 . '" name="designation" size="30" 
         maxlength="45"></td>
      </tr>
     
      <tr class="ligneTabNonQuad">
         <td>&nbsp Type*: </td>
         <td>';
if ($type2 == 1) {
    echo " 
               <input type='radio' name='type2' value='Dépannage' checked>  
               Dépannage
               <input type='radio' name='type2' value='Vente'>  Vente";
} else {
    echo " 
                <input type='radio' name='type' value='Dépannage'> 
                Dépannage
                <input type='radio' name='type' value='Vente' checked> Vente";
}

echo '
           <tr class="ligneTabNonQuad">
         <td>&nbsp Valeur: </td>
         <td><input type="text" value="' . $prix2 . '" name="prix" size="30" 
         maxlength="45"></td>
      </tr>';
      
echo '</div>';
echo "<br>
   <table align='right' cellspacing='15' cellpadding='0'>
   <br>
      <a href='cSemaine2.php'><button type=button>Retour</button></a>

      <tr>
         <td align='right'><input type='submit' value='Valider' name='valider'>
      </tr>
   </table>
</form>";
include("include/_fin.inc.php");

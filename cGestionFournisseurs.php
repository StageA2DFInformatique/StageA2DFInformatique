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
<div id="contenu">
    <h2>Gestion des Fournisseurs</h2>
    <br>
    <table width='55%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>

        <tr class='enTeteTabNonQuad'>
            <td colspan='4'><strong>Fournisseurs</strong></td>
        </tr>
        <tr class='ligneTabNonQuad'>
            <td width='52%'>FournisseurTest</td>

            <td width='20%' align='center'> 
                <a href='cGestionFournisseurs.php?action=detailFourni&id=11111111'>
                    <button type=button class="bouton-details">Voir détail</button></a></td>

            <td width='16%' align='center'> 
                <a href='cGestionFournisseurs.php?action=demanderModifierFourni&id=11111111'>
                    <button type=button class="bouton-modifier">Modifier</button></a></td>
            <td width='16%' align='center'> 
                <a href='cGestionFournisseurs.php?action=demanderSupprimerFourni&id=11111111'>
                    <button type=button class="bouton-supprimer">Supprimer</button></a></td>
        </tr>
    </table>
    <br>
    <div class="bouton">
        <p>
            <a href='cGestionFournisseurs.php?action=demanderCreerEtab'>
                <button type=button>Ajout d'un fournisseur</button></a > 
        </p> 
    </div>
    <br>
</div>
<?php
require($repInclude . "_fin.inc.php");
?>

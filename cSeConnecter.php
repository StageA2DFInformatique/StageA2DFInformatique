<?php
/**
 * Script de contrôle et d'affichage du cas d'utilisation "Se connecter"
 * @package default
 * @todo  RAS
 */
$repInclude = './include/';
require($repInclude . "_init.inc.php");
// Si l'utilisateur veut aller sur la page précédente il est renvoyé sur la page d'accueil pour ne pas retomber sur la page d'authentification
if (estVisiteurConnecte()) {
    header('Location: ' . $_SERVER['HTTP_REFERER']); // $_SERVER (historique ) ['HTTP_REFERER'] (page précédente)
}
// est-on au 1er appel du programme ou non ?
$etape = (count($_POST) != 0) ? 'validerConnexion' : 'demanderConnexion';

if ($etape == 'validerConnexion') { // un client demande à s'authentifier
    // acquisition des données envoyées, ici login et mot de passe
    $login = lireDonneePost("txtLogin");
    $mdp = lireDonneePost("txtMdp");
    //ajout de la fontion sha1 qui prend en parametre le mot de passe non crypté saisit par l'utilisateur pour le crypter et le comparer à celui crypté dans la base de données
    $lgUser = verifierInfosConnexion($idConnexion, $login, sha1($mdp));

    // si l'id utilisateur a été trouvé, donc informations fournies sous forme de tableau
    $nbErreur = 0;
    if (is_array($lgUser)) {
        $lgUser = obtenirDetailVisiteur($idConnexion, $lgUser["id"]);
        affecterInfosConnecte($lgUser["id"], $lgUser["login"]);
    } else {
        ajouterErreur($tabErreurs, "Pseudo et/ou mot de passe incorrects, veuillez réessayer s'il vous plait");
    }
}
if ($etape == "validerConnexion" && nbErreurs($tabErreurs) == 0) {
    header("Location:cAccueil.php");
}

require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");
?>
<!-- Division pour le contenu principal -->
<div id="contenu">
    <h2><center><strong>Identifiez - vous</strong></center></h2>
    <?php
    if ($etape == "validerConnexion") {
        if (nbErreurs($tabErreurs) > 0) {
            echo toStringErreurs($tabErreurs);
        }
    }
    ?>               
    <form id="frmConnexion" action="" method="post">
        <div class="corpsForm">
            <div class="linkAccueil">
                <input type="hidden" name="etape" id="etape" value="validerConnexion" />
                <p>
                    <label for="txtLogin" accesskey="n">Login : </label>
                    <input type="text" id="txtLogin" name="txtLogin" maxlength="40" size="40" value="" title="Entrez votre login" />
                </p>
                <p>
                    <label for="txtMdp" accesskey="m">Mot de passe : </label>
                    <input type="password" id="txtMdp" name="txtMdp" maxlength="40" size="40" value=""  title="Entrez votre mot de passe"/>
                </p>
            </div>
        </div>
        <div class="bouton">
            <p>
                <input type="submit" id="ok" value="Valider" />
            </p> 
        </div>
    </form>
</div>
<?php
require($repInclude . "_fin.inc.php");
?>
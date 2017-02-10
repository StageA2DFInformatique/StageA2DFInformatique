<?php

/**
 * Fournit la valeur d'une donnée transmise par la méthode get (url).                    
 * 
 * Retourne la valeur de la donnée portant le nom $nomDonnee reçue dans l'url, 
 * $valDefaut si aucune donnée de nom $nomDonnee dans l'url 
 * @param string nom de la donnée
 * @param string valeur par défaut 
 * @return string valeur de la donnée
 */
function lireDonneeUrl($nomDonnee, $valDefaut = "") {
    if (isset($_GET[$nomDonnee])) {
        $val = $_GET[$nomDonnee];
    } else {
        $val = $valDefaut;
    }
    return $val;
}

/**
 * Fournit la valeur d'une donnée transmise par la méthode post 
 *  (corps de la requête HTTP).                    
 * 
 * Retourne la valeur de la donnée portant le nom $nomDonnee reçue dans le corps de la requête http, 
 * $valDefaut si aucune donnée de nom $nomDonnee dans le corps de requête
 * @param string nom de la donnée
 * @param string valeur par défaut 
 * @return string valeur de la donnée
 */
function lireDonneePost($nomDonnee, $valDefaut = "") {
    if (isset($_POST[$nomDonnee])) {
        $val = $_POST[$nomDonnee];
    } else {
        $val = $valDefaut;
    }
    return $val;
}

/**
 * Fournit la valeur d'une donnée transmise par la méthode get (url) ou post 
 *  (corps de la requête HTTP).                    
 * 
 * Retourne la valeur de la donnée portant le nom $nomDonnee
 * reçue dans l'url ou corps de requête, 
 * $valDefaut si aucune donnée de nom $nomDonnee ni dans l'url, ni dans corps.
 * Si le même nom a été transmis à la fois dans l'url et le corps de la requête,
 * c'est la valeur transmise par l'url qui est retournée.  
 * @param string nom de la donnée
 * @param string valeur par défaut 
 * @return string valeur de la donnée
 */
function lireDonnee($nomDonnee, $valDefaut = "") {
    if (isset($_GET[$nomDonnee])) {
        $val = $_GET[$nomDonnee];
    } elseif (isset($_POST[$nomDonnee])) {
        $val = $_POST[$nomDonnee];
    } else {
        $val = $valDefaut;
    }
    return $val;
}

/**
 * Fournit les messages d'erreurs sous forme d'une liste à puces HTML.                    
 * 
 * Retourne le source HTML, division contenant une liste à puces, d'après les
 * messages d'erreurs contenus dans le tableau des messages d'erreurs $tabErr. 
 * @param array $tabErr tableau des messages d'erreurs  
 * @return string source html
 */
function toStringErreurs($tabErr) {
    $str = '<div class="erreur">';
    $str .= '<ul>';
    foreach ($tabErr as $erreur) {
        $str .= '<li>' . $erreur . '</li>';
    }
    $str .= '</ul>';
    $str .= '</div>';
    return $str;
}

/**
 * Echappe les caractères considérés spéciaux en HTML par les entités HTML correspondantes.
 *  
 * Renvoie une copie de la chaîne $str à laquelle les caractères considérés spéciaux
 * en HTML (tq la quote simple, le guillemet double, les chevrons), auront été
 * remplacés par les entités HTML correspondantes. 
 * @param string $str chaîne à échapper
 * @return string chaîne échappée 
 */
function filtrerChainePourNavig($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function razErreurs() {
    unset($_REQUEST['erreurs']);
}

function ajouterErreur($msg) {
    if (!isset($_REQUEST['erreurs'])) {
        $_REQUEST['erreurs'] = array();
    }
    $_REQUEST['erreurs'] = htmlentities($msg, ENT_QUOTES, 'UTF-8');
}

function getErreurs() {
    if (!isset($_REQUEST['erreurs'])) {
        $_REQUEST['erreurs'] = array();
    }
    return $_REQUEST['erreurs'];
}

function nbErreurs() {
    return count(getErreurs());
}

function printErreurs() {
    if (nbErreurs() != 0) {
        echo '<div id="erreur" class="msgErreur">';
        echo '<ul>';
        foreach (getErreurs() as $erreur) {
            echo "<li>$erreur</li>";
        }
        echo '</ul>';
        echo '</div>';
    }
}

?>
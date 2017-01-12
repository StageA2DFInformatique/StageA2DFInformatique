<?php
/** 
 * Vérifie si une chaîne fournie est bien numérique entière positive.                     
 * 
 * Retrourne true si la valeur transmise $valeur ne contient pas d'autres 
 * caractères que des chiffres, false sinon.
 * @param string chaîne à vérifier
 * @return boolean succès ou échec
 */ 
function estEntierPositif($valeur) {
    return preg_match("/[^0-9]/", $valeur) == 0;
}

/** 
 * Fournit la valeur d'une donnée transmise par la méthode get (url).                    
 * 
 * Retourne la valeur de la donnée portant le nom $nomDonnee reçue dans l'url, 
 * $valDefaut si aucune donnée de nom $nomDonnee dans l'url 
 * @param string nom de la donnée
 * @param string valeur par défaut 
 * @return string valeur de la donnée
 */ 
function lireDonneeUrl($nomDonnee, $valDefaut="") {
    if ( isset($_GET[$nomDonnee]) ) {
        $val = $_GET[$nomDonnee];
    }
    else {
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
function lireDonneePost($nomDonnee, $valDefaut="") {
    if ( isset($_POST[$nomDonnee]) ) {
        $val = $_POST[$nomDonnee];
    }
    else {
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
function lireDonnee($nomDonnee, $valDefaut="") {
    if ( isset($_GET[$nomDonnee]) ) {
        $val = $_GET[$nomDonnee];
    }
    elseif ( isset($_POST[$nomDonnee]) ) {
        $val = $_POST[$nomDonnee];
    }
    else {
        $val = $valDefaut;
    }
    return $val;
}

/** 
 * Ajoute un message dans le tableau des messages d'erreurs.                    
 * 
 * Ajoute le message $msg en fin de tableau $tabErr. Ce tableau est passé par 
 * référence afin que les modifications sur ce tableau soient visibles de l'appelant.  
 * @param array $tabErr  
 * @param string message
 * @return void
 */ 
function ajouterErreur(&$tabErr,$msg) {
    $tabErr[count($tabErr)]=$msg;
}

/** 
 * Retourne le nombre de messages d'erreurs enregistrés.                    
 * 
 * Retourne le nombre de messages d'erreurs enregistrés dans le tableau $tabErr. 
 * @param array $tabErr tableau des messages d'erreurs  
 * @return int nombre de messages d'erreurs
 */ 
function nbErreurs($tabErr) {
    return count($tabErr);
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
    foreach($tabErr as $erreur){
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
?>
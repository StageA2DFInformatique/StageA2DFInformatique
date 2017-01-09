 Programme d'actualisation des lignes des tables,  
 cette mise à jour peut prendre plusieurs minutes...
<?php
include("include/fct.inc.php");

/* Modification des paramètres de connexion */

$serveur='mysql:host=localhost';
$bdd='dbname=a2df_informatique';   		
$user='fbaraud' ;    		
$mdp='admin' ;	

/* fin paramètres*/
/*tentative de connexion a la base de donnée*/
try{
    $pdo = new PDO($serveur.';'.$bdd, $user, $mdp);
    $pdo->query("SET CHARACTER SET utf8");
}
/*message d'erreur en cas d'échec a la connexion a la base de donnée*/
catch (PDOException $e) {
    echo "Erreur ! : " . $e->getMessage() . "<br />";
    $pdo = null;
}

set_time_limit(0);
creationTableauBord($pdo);
creationEnCours($pdo);
creationFournisseurs($pdo);
creationCharges($pdo);
?>
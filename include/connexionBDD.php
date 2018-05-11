<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* Modification des paramètres de connexion */

$serveur = 'mysql:host=localhost';
$nomBDD = 'cfleurance_stage';
$bdd = 'dbname=' . $nomBDD;
$user = 'cfleurance_stage';
$mdp = 'secret';

/* fin paramètres */
/* tentative de connexion a la base de donnée */
try {
    $pdo = new PDO($serveur . ';' . $bdd, $user, $mdp);
    $pdo->query("SET CHARACTER SET utf8");
}
/* message d'erreur en cas d'échec a la connexion a la base de donnée */ catch (PDOException $e) {
    echo "Erreur ! : " . $e->getMessage() . "<br />";
    $pdo = null;
}
?>

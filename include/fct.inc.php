<?php

function getLesVisiteurs($pdo) {
    $req = "select * from visiteur";
    $res = $pdo->query($req);
    $lesLignes = $res->fetchAll();
    return $lesLignes;
}

function updateMdpVisiteur($pdo) {
    $req = "select * from visiteur";
    $res = $pdo->query($req);
    $lesLignes = $res->fetchAll();
    $lettres = "azertyuiopqsdfghjkmwxcvbn123456789";
    foreach ($lesLignes as $unVisiteur) {
        $mdp = "";
        $id = $unVisiteur['id'];
        for ($i = 1; $i <= 5; $i++) {
            $uneLettrehasard = substr($lettres, rand(33, 1), 1);
            $mdp = $mdp . $uneLettrehasard;
        }

        $req = "update visiteur set mdp ='$mdp' where visiteur.id ='$id' ";
        $pdo->exec($req);
    }
}
?>





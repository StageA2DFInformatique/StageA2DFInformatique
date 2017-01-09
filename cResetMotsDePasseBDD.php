<?php
    /** 
     * Script d'affichage du cas d'utilisation "Crypter les mots de passe de la base de donnée"
     * @package default
     * @todo  RAS
     */
    $repInclude = './include/';
    require($repInclude . "_init.inc.php");

    // page inaccessible si visiteur non connecté
    if (!estVisiteurConnecte()) {
        header("Location: cSeConnecter.php");
    }
    require($repInclude . "_entete.inc.html");
    require($repInclude . "_sommaire.inc.php");
?>
<html>
    <head>
        <title>Cryptage mots de passe BDD</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link href="./styles/styles.css" rel="stylesheet" media="all" type="text/css"/>
        <body>
    </head>
    <div id="contenu">
        <?php
            include ($repInclude . "connexionBDD.php");
            echo "<h2>Remise des mots de passe de base des utilisateurs de la $laTable de la base de donnée $nomBDD :</h2>";
            $laTable = "Visiteur";
            echo 'Mise a jour des mots de passes des utilisateurs de la ' . $laTable . ' de la base de donnée '.$nomBDD.' en mot de passes de base: <br/>';
            //liste des mots de passe de base
            $mdpDeBase = array('joliverie', 'jux7g', 'oppg5', 'gmhxd', 'ktp3s', 'doyw1', 'hrjfs', '4vbnd', 's1y1r', 'uf7r3', '6u8dc', 'u817o', 'bw1us', '2hoh9', '7oqpv', 'gk9kx', 'od5rt', 'nvwqq', 'sghkb', 'f1fob', '4k2o5', '44im8', 'qf77j', 'y2qdu', 'i7sn3', 'mpb3t', 'xs5tq', 'dywvt');              
            //on selectionne tout dans la base que lon stock le resultat de la requete SQL dans la variable $contenuTable
            $contenuTable = $pdo->query("SELECT * from $laTable");
            //on recupere le contenu des lignes de la table
            $lignes = $contenuTable->fetchAll(PDO::FETCH_ASSOC);
            //variable i initialisée à 0 qui permettera de parcourir la liste des mots de passe de base
            $i = 0;
            //pour chaque ligne
            foreach ($lignes as $ligne) {
                //message si les mots de passe sont déjà standards
                if($ligne['mdp'] == 'joliverie' || $ligne['mdp'] == 'jux7g' || $ligne['mdp'] == 'oppg5' || $ligne['mdp'] == 'gmhxd' || $ligne['mdp'] == 'ktp3s' || $ligne['mdp'] == 'doyw1' || $ligne['mdp'] == 'hrjfs' || $ligne['mdp'] == '4vbnd' || $ligne['mdp'] == 's1y1r' || $ligne['mdp'] == 'uf7r3' || $ligne['mdp'] == '6u8dc' || $ligne['mdp'] == 'u817o' || $ligne['mdp'] == 'bw1us' || $ligne['mdp'] == '2hoh9' || $ligne['mdp'] == '7oqpv' || $ligne['mdp'] == 'gk9kx' || $ligne['mdp'] == 'od5rt' || $ligne['mdp'] == 'nvwqq' || $ligne['mdp'] == 'sghkb' || $ligne['mdp'] == 'f1fob' || $ligne['mdp'] == '4k2o5' || $ligne['mdp'] == '44im8' || $ligne['mdp'] == 'qf77j' || $ligne['mdp'] == 'y2qdu' || $ligne['mdp'] == 'i7sn3' || $ligne['mdp'] == 'mpb3t' || $ligne['mdp'] == 'xs5tq' || $ligne['mdp'] == 'dywvt'){
                    echo '<h2>Le mot de passe de <mark>'.$ligne['login'].'</mark> ('.$ligne['prenom']." ".$ligne['nom'].') est déjà le mot de passe de base : <mark>'.$ligne['mdp'].'</mark>.</h2></br>';    
                }else{
                    //sinon on execute la remise a jour des mots de passe de base
                    $pdo->exec("UPDATE Visiteur SET mdp = '$mdpDeBase[$i]' WHERE login = '".$ligne['login']."'");
                    //message de confirmation
                    echo '<h2>Le mot de passe de <mark>'.$ligne['login'].'</mark> ('.$ligne['prenom']." ".$ligne['nom'].') était crypté : <mark>'.$ligne['mdp'].'</mark>, son nouveau mot de passe est maintenant remis à zéro : <mark>'.$mdpDeBase[$i].'</mark>.</h2></br>';
                }
                $i ++;
            }
        ?>
        <!-- proposition de retour a la page d'accueil en bas de l'affichage des tables car cette page est grande -->
        <a href="cAccueil.php">Retour à la page d'accueil</a>
    </body>
</html>
<?php        
  require($repInclude . "_pied.inc.html");
  require($repInclude . "_fin.inc.php");
?> 



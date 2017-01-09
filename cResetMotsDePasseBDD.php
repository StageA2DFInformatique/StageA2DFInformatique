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
            $mdpDeBase = array('admin', 'employe1', 'employe2');              
            //on selectionne tout dans la base que lon stock le resultat de la requete SQL dans la variable $contenuTable
            $contenuTable = $pdo->query("SELECT * from $laTable");
            //on recupere le contenu des lignes de la table
            $lignes = $contenuTable->fetchAll(PDO::FETCH_ASSOC);
            //variable i initialisée à 0 qui permettera de parcourir la liste des mots de passe de base
            $i = 0;
            //pour chaque ligne
            foreach ($lignes as $ligne) {
                //message si les mots de passe sont déjà standards
                if($ligne['mdp'] == 'admin' || $ligne['mdp'] == 'employe1' || $ligne['mdp'] == 'employe2'){
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
  require($repInclude . "_fin.inc.php");
?> 



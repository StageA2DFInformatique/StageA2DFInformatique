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
            echo "<h2>Cryptage des mots de passe des utilisateurs de la $laTable de la base de donnée $nomBDD :</h2>";
            $laTable = "Visiteur";
            echo 'Mise a jour des mots de passes des utilisateurs de la ' . $laTable . ' de la base de donnée '.$nomBDD. ' en mot de passes cryptés: <br/>';                
            //on selectionne tout dans la base que lon stock le resultat de la requete SQL dans la variable $contenuTable
            $contenuTable = $pdo->query("SELECT * from $laTable");
            //on recupere le contenu des lignes de la table
            $lignes = $contenuTable->fetchAll(PDO::FETCH_ASSOC);
            //pour chaque ligne
            foreach ($lignes as $ligne) {
                //si les mots de passe sont des mots de passe de base on execute la mise a jour
                if($ligne['mdp'] == 'admin' || $ligne['mdp'] == 'employe1' || $ligne['mdp'] == 'employe2'){
                    //affichage preliminaire avant changement
                    echo '<h2>Le mot de passe de <mark>'.$ligne['login'].'</mark> ('.$ligne['prenom']." ".$ligne['nom'].') était non crypté : <mark>'.$ligne['mdp'].'</mark>.</br>';
                    $mdpCrypte = md5($ligne['mdp']);//traduction du mot de page en cryptage md5 grace a la fonction php md5
                    //execution de la mise a jour du cryptage du mot de passe
                    $pdo->exec("UPDATE Visiteur SET mdp = '$mdpCrypte' WHERE login = '".$ligne['login']."'");
                    //message de confirmation
                    echo 'Son mot de passe est maintenant crypté : <mark>'.$mdpCrypte.'</mark>.</h2></br></br>';
                }else{
                    //sinon l'on indique que le mot de passe est déjà crypté, il ne faut pas le recrypter une autre fois sinon le mot de passe connu de l'utilisateur n'est plus valable !
                    echo "<h2>Le mot de passe de <mark>".$ligne['login']."</mark> (".$ligne['prenom']." ".$ligne['nom'].") est déjà crypté : <mark>".$ligne['mdp']."</mark>.</h2>";
                }
            } 
        ?>
        <!-- proposition de retour a la page d'accueil en bas de l'affichage des tables car cette page est grande -->
        <a href="cAccueil.php">Retour à la page d'accueil</a>
    </body>
</html>
<?php        
  require($repInclude . "_fin.inc.php");
?> 



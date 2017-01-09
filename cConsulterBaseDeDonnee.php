<?php
/**
 * Script d'affichage du cas d'utilisation "Consulter les tables de la base de donnée"
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
        <title>Affichage BDD</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="./styles/styles.css" rel="stylesheet" media="all" type="text/css"/>
    <body>
    </head>
    <div id="contenu">
        <?php
        include ($repInclude . "connexionBDD.php");
        echo "<h2>Affichage des BDD</h2>";
        $lesTables = $pdo->query("SHOW TABLES", PDO::FETCH_NUM);

        //parcourir chaque table de la base $nomBDD ici gsb_frais
        while ($laTable = $lesTables->fetch()) {
            //afficher le nom de la base en qustion
            echo 'Table ' . $laTable[0] . ': <br/>';

            //on selectionne tout dans la base que lon stock le resultat de la requete SQL dans la variable $contenuTable
            $contenuTable = $pdo->query("SELECT * from $laTable[0]");
            //on compte ke nombre de colonnes présentes dans la table
            $nbColonnes = $contenuTable->columnCount();

            // affichage du nom des colonnes
            //ouverture du tableau et d'une ligne
            echo '<table><tr>';
            //pour chaque colonnes
            for ($i = 0; $i < $nbColonnes; $i++) {
                //on obtient le nom de la colonne en question
                $nomColonne = $contenuTable->getColumnMeta($i)["name"];
                //on affiche le nom de la colonne
                echo '<th>' . $nomColonne . '</th>';
            }
            //fermeture d'une lgine
            echo '</tr>';

            // affichage du contenu des lignes
            //pour chaque ligne
            while ($laLigne = $contenuTable->fetch(PDO::FETCH_ASSOC)) {
                //ouverture ligne
                echo '<tr>';
                //pour chaque colonne
                for ($i = 0; $i < $nbColonnes; $i++) {
                    //acquisition du contenu de la ligne pour chaque colonne
                    $nomColonne = $contenuTable->getColumnMeta($i)["name"];
                    //affichage de la case ligne colonne
                    echo '<td>' . $laLigne[$nomColonne] . '</td>';
                }
                //fermeture ligne
                echo '</tr>';
            }
            //fermeture du tableau
            echo '</table>';
            //saut a la ligne entre chaque tableau
            echo '</br>';
        }
        ?>
    </table>
    </br>
   </body>
</html>
<?php
require($repInclude . "_fin.inc.php");
?> 



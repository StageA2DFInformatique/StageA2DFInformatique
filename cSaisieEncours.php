<?php

$repInclude = './include/';
require($repInclude . "_init.inc.php");

// page inaccessible si visiteur non connecté
if (!estVisiteurConnecte()) {
    header("Location: cSeConnecter.php");
}
require($repInclude . "_entete.inc.html");
require($repInclude . "_sommaire.inc.php");
?>
<?php

//Division principale
echo '<div id="contenu">';
echo "<h2><center>En Cours</center></h2>";
echo '</div>';
require($repInclude . "_fin.inc.php");
?>

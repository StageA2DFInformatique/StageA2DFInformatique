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
echo '<h2><center>Statistiques</center></h2>';
echo '<h1>Page en Construction</h1>';
echo '</div>';
?>
<?php

require($repInclude . "_fin.inc.php");
?>

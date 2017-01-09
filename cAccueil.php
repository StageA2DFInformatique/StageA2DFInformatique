<?php
/** 
 * Page d'accueil de l'application web AppliFrais
 * @package default
 * @todo  RAS
 */
  $repInclude = './include/';
  require($repInclude . "_init.inc.php");

  // page inaccessible si visiteur non connecté
  if ( ! estVisiteurConnecte() ) 
  {
        header("Location: cSeConnecter.php");  
  }
  require($repInclude . "_entete.inc.html");
  require($repInclude . "_sommaire.inc.php");
?>
<?php      
          $idUser = obtenirIdUserConnecte() ;
          $lgUser = obtenirDetailVisiteur($idConnexion, $idUser);
          $nom = $lgUser['nom'];
          $prenom = $lgUser['prenom'];
          //Division principale
          echo '<div id="contenu">';
          echo "<h2>Bienvenue sur l'accueil</h2>";
          echo '</div>';
?>
<?php        
  require($repInclude . "_fin.inc.php");
?>

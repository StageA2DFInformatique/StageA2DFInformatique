<?php
/** 
 * Initialise les ressources nécessaires au fonctionnement de l'application
 */
  require("_bdGestionDonnees.lib.php");
  require("_gestionSession.lib.php");
  require("_utilitairesEtGestionErreurs.lib.php");
  // démarrage ou reprise de la session
  initSession();
  // initialement, aucune erreur ...
  $tabErreurs = array();
    
  // Demande-t-on une déconnexion ?
  $demandeDeconnexion = lireDonneeUrl("cmdDeconnecter");
  if ( $demandeDeconnexion == "on") {
      deconnecterVisiteur();
      header("Location: cAccueil.php");
  }
    
  // établissement d'une connexion avec le serveur de données 
  // puis sélection de la BD qui contient les données des visiteurs et de leurs frais
  $idConnexion=connecterServeurBD();
  if (!$idConnexion) {
      ajouterErreur($tabErreurs, "Echec de la connexion au serveur MySql");
  }
  elseif (!activerBD($idConnexion)) {
      ajouterErreur($tabErreurs, "La base de données a2df_informatique est inexistante ou non accessible");
  }
  
?>
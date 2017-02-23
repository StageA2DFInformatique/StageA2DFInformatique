<?php

namespace modele\dao;

use modele\metier\EnCours;
use PDO;

/**
 * Description of SyntheseDAO
 * Classe métier : Synthese
 * @author Charly
 */
class EnCoursDAO implements IDAO {

    protected static function enregVersMetier($enreg) {
        $id = $enreg['ID'];
        $designation = $enreg[strtoupper('designation')];
        $prix = $enreg[strtoupper('prix')];
        $type = $enreg[strtoupper('type')];
        $date = $enreg[strtoupper('date')];

        $uneOpe = new EnCours($id, $designation, $prix, $type, $date);

        return $uneOpe;
    }

    /* Valorise les paramètre d'une requête préparée avec l'état d'un objet Synthese */

    protected static function metierVersEnreg($objetMetier, $stmt) {
        // On utilise bindValue plutôt que bindParam pour éviter des variables intermédiaires
        if ($objetMetier->getId() != null) {
            $stmt->bindValue(':id', $objetMetier->getId());
        }
        $stmt->bindValue(':designation', $objetMetier->getDesignation());
        $stmt->bindValue(':prix', $objetMetier->getPrix());
        $stmt->bindValue(':type', $objetMetier->getType());
        $stmt->bindValue(':date', $objetMetier->getDate());
    }

    /* Insérer un nouvel enregistrement dans la table à partir de l'état d'un objet métier */

    public static function insert($objet) {
        $requete = "INSERT INTO Operations (`designation`, `prix`, `type`, `date`) VALUES (:designation, :prix, :type, :date)";
        $stmt = Bdd::getPdo()->prepare($requete);
        self::metierVersEnreg($objet, $stmt);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }

    /**
     * Mettre à jour enregistrement dans la table à partir de l'état d'un objet métier */
    public static function update($id, $objet) {
        $ok = false;
        $requete = "UPDATE  Operations SET DESIGNATION=:designation, PRIX=:prix, 
                TYPE=:type, DATE=:date WHERE ID=:id";
        $stmt = Bdd::getPdo()->prepare($requete);
        self::metierVersEnreg($objet, $stmt);
        $stmt->bindParam(':id', $id);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }

    public static function delete($id) {
        $ok = false;
        $requete = "DELETE FROM Operations WHERE ID = :id";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $id);
        $ok = $stmt->execute();
        $ok = $ok && ($stmt->rowCount() > 0);
        return $ok;
    }

    public static function getAll() {
        $lesObjets = array();
        $requete = "SELECT * FROM Operations ORDER by date DESC";
        $stmt = Bdd::getPdo()->prepare($requete);
        $ok = $stmt->execute();
        if ($ok) {
            while ($enreg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lesObjets[] = self::enregVersMetier($enreg);
            }
        }
        return $lesObjets;
    }
    
        public static function getAllByDate($date) {
        $lesObjets = array();
        $requete = "SELECT * FROM Operations WHERE date LIKE ':date%' ORDER by date DESC";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':date', $date);
        $ok = $stmt->execute();
        if ($ok) {
            while ($enreg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lesObjets[] = self::enregVersMetier($enreg);
            }
        }
        return $lesObjets;
    }

    public static function getOneById($id) {
        $objetConstruit = null;
        $requete = "SELECT * FROM Operations WHERE ID = :id";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $id);
        $ok = $stmt->execute();
        // attention, $ok = true pour un select ne retournant aucune ligne
        if ($ok && $stmt->rowCount() > 0) {
            $objetConstruit = self::enregVersMetier($stmt->fetch(PDO::FETCH_ASSOC));
        }
        return $objetConstruit;
    }

    /**
     * Permet de vérifier s'il existe ou non une Synthese ayant déjà le même identifiant dans la BD
     * @param string id identifiant de la Synthese à tester
     * @return boolean =true si l'id existe déjà, =false sinon
     */
    public static function isAnExistingId($id) {
        $requete = "SELECT COUNT(*) FROM Operations WHERE ID=:id";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }

    public static function superSum() {
        $requete = "SELECT SUM(prix) FROM `Operations`";
        $stmt = Bdd::getPdo()->prepare($requete);
        $ok = $stmt->execute();
        return $stmt->fetchColumn(0);
    }

}

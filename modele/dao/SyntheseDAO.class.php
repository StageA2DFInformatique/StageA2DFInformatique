<?php

namespace modele\dao;

use modele\metier\Synthese;
use PDO;

/**
 * Description of SyntheseDAO
 * Classe métier : Synthese
 * @author Charly
 */
class SyntheseDAO implements IDAO {

    protected static function enregVersMetier($enreg) {
        $id = $enreg['ID'];
        $date = $enreg[strtoupper('date')];
        $compte = $enreg[strtoupper('compte')];
        $cb = $enreg[strtoupper('cb')];
        $espece = $enreg[strtoupper('espece')];
        $cheque = $enreg[strtoupper('cheque')];
        $totalFinMois = $enreg[strtoupper('totalFinMois')];
        $totalMoisPlusUn = $enreg[strtoupper('totalMoisPlusUn')];

        $uneSynth = new Synthese($id, $date, $compte, $cb, $espece, $cheque, $totalFinMois, $totalMoisPlusUn);

        return $uneSynth;
    }

    /* Valorise les paramètre d'une requête préparée avec l'état d'un objet Synthese */

    protected static function metierVersEnreg($objetMetier, $stmt) {
        // On utilise bindValue plutôt que bindParam pour éviter des variables intermédiaires
        $stmt->bindValue(':id', $objetMetier->getId());
        $stmt->bindValue(':date', $objetMetier->getDate());
        $stmt->bindValue(':compte', $objetMetier->getCompte());
        $stmt->bindValue(':cb', $objetMetier->getCb());
        $stmt->bindValue(':espece', $objetMetier->getEspece());
        $stmt->bindValue(':cheque', $objetMetier->getCheque());
        $stmt->bindValue(':totalFinMois', $objetMetier->getTotalfinMois());
        $stmt->bindValue(':totalMoisPlusUn', $objetMetier->getTotalMoisPlusUn());
    }

    /* Insérer un nouvel enregistrement dans la table à partir de l'état d'un objet métier */

    public static function insert($objet) {
        $requete = "INSERT INTO Synthese VALUES (:id, :date, :compte, :cb, :espece, :cheque, :totalFinMois, :totalMoisPlusUn)";
        $stmt = Bdd::getPdo()->prepare($requete);
        self::metierVersEnreg($objet, $stmt);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }

    /**
     * Mettre à jour enregistrement dans la table à partir de l'état d'un objet métier */
    public static function update($id, $objet) {
        $ok = false;
        $requete = "UPDATE  Synthese SET DATE=:date, COMPTE=:compte, CB=:cb,
           ESPECE=:espece, CHEQUE=:cheque, TOTALFINMOIS=:totalFinMois,
           TOTALMOISPLUSUN=:totalMoisPlusUn WHERE ID=:id";
        $stmt = Bdd::getPdo()->prepare($requete);
        self::metierVersEnreg($objet, $stmt);
        $stmt->bindParam(':id', $id);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }

    public static function delete($id) {
        $ok = false;
        $requete = "DELETE FROM Synthese WHERE ID = :id";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $id);
        $ok = $stmt->execute();
        $ok = $ok && ($stmt->rowCount() > 0);
        return $ok;
    }

    public static function getAll() {
        $lesObjets = array();
        $requete = "SELECT * FROM Synthese";
        $stmt = Bdd::getPdo()->prepare($requete);
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
        $requete = "SELECT * FROM Synthese WHERE ID = :id";
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
        $requete = "SELECT COUNT(*) FROM Synthese WHERE ID=:id";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }

}

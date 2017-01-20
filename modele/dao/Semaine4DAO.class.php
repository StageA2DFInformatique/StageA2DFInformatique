<?php

namespace modele\dao;

use modele\metier\Semaine4;
use PDO;

/**
 * Description of Semaine1DAO
 * Classe métier : Semaine1
 * @author btssio
 */
class Semaine4DAO implements IDAO {

    protected static function enregVersMetier($enreg) {
        $id4 = $enreg['ID4'];
        $designation4 = $enreg[strtoupper('designation4')];
        $type4 = $enreg[strtoupper('type4')];
        $prix4 = $enreg[strtoupper('prix4')];

        $uneVente4 = new Semaine4($id4, $designation4, $type4, $prix4);

        return $uneVente4;
    }

    /**
     * Valorise les paramètre d'une requête préparée avec l'état d'un objet Semaine
     */
    protected static function metierVersEnreg($objetMetier, $stmt) {
        // On utilise bindValue plutôt que bindParam pour éviter des variables intermédiaires
        $stmt->bindValue(':id4', $objetMetier->getId4());
        $stmt->bindValue(':designation4', $objetMetier->getDesignation4());
        $stmt->bindValue(':type4', $objetMetier->getType4());
        $stmt->bindValue(':prix4', $objetMetier->getPrix4());
    }

    /**
     * Insérer un nouvel enregistrement dans la table à partir de l'état d'un objet métier
     * @param Semaine $objet objet métier à insérer
     * @return boolean =FALSE si l'opération échoue
     */
    public static function insert($objet) {
        $requete = "INSERT INTO Semaine4 VALUES (:id4, :designation4, :type4, :prix4)";
        $stmt = Bdd::getPdo()->prepare($requete);
        self::metierVersEnreg($objet, $stmt);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }

    /**
     * Mettre à jour enregistrement dans la table à partir de l'état d'un objet métier
     * @param string identifiant de l'enregistrement à mettre à jour
     * @param Semaine $objet objet métier à mettre à jour
     * @return boolean =FALSE si l'opération échoue
     */
    public static function update($id4, $objet) {
        $ok = false;
        $requete = "UPDATE  Semaine4 SET DESIGNATION4=:designation4, TYPE4=:type4, PRIX4=:prix4 WHERE ID4=:id4";
        $stmt = Bdd::getPdo()->prepare($requete);
        self::metierVersEnreg($objet, $stmt);
        $stmt->bindParam(':id4', $id);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }

    public static function delete($id4) {
        $ok = false;
        $requete = "DELETE FROM Semaine1 WHERE ID4 = :id4";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id4', $id4);
        $ok = $stmt->execute();
        $ok = $ok && ($stmt->rowCount() > 0);
        return $ok;
    }

    public static function getAll() {
        $lesObjets = array();
        $requete = "SELECT * FROM Semaine4";
        $stmt = Bdd::getPdo()->prepare($requete);
        $ok = $stmt->execute();
        if ($ok) {
            while ($enreg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lesObjets[] = self::enregVersMetier($enreg);
            }
        }
        return $lesObjets;
    }

    public static function getOneById($id4) {
        $objetConstruit = null;
        $requete = "SELECT * FROM Semaine4 WHERE ID4 = :id4";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id4', $id4);
        $ok = $stmt->execute();
        // attention, $ok = true pour un select ne retournant aucune ligne
        if ($ok && $stmt->rowCount() > 0) {
            $objetConstruit = self::enregVersMetier($stmt->fetch(PDO::FETCH_ASSOC));
        }
        return $objetConstruit;
    }

    /**
     * Permet de vérifier s'il existe ou non une Synthese ayant déjà le même identifiant dans la BD
     * @param string $id identifiant de la Synthese à tester
     * @return boolean =true si l'id existe déjà, =false sinon
     */
    public static function isAnExistingId($id4) {
        $requete = "SELECT COUNT(*) FROM Semaine4 WHERE ID4=:id4";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id4', $id4);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }

}

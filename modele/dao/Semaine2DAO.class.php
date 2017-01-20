<?php

namespace modele\dao;

use modele\metier\Semaine2;
use PDO;

/**
 * Description of Semaine1DAO
 * Classe métier : Semaine1
 * @author btssio
 */
class Semaine2DAO implements IDAO {

    protected static function enregVersMetier($enreg) {
        $id2 = $enreg['ID2'];
        $designation2 = $enreg[strtoupper('designation2')];
        $type2 = $enreg[strtoupper('type2')];
        $prix2 = $enreg[strtoupper('prix2')];

        $uneVente2 = new Semaine2($id2, $designation2, $type2, $prix2);

        return $uneVente2;
    }

    /**
     * Valorise les paramètre d'une requête préparée avec l'état d'un objet Semaine
     */
    protected static function metierVersEnreg($objetMetier, $stmt) {
        // On utilise bindValue plutôt que bindParam pour éviter des variables intermédiaires
        $stmt->bindValue(':id2', $objetMetier->getId2());
        $stmt->bindValue(':designation2', $objetMetier->getDesignation2());
        $stmt->bindValue(':type2', $objetMetier->getType2());
        $stmt->bindValue(':prix2', $objetMetier->getPrix2());
    }

    /**
     * Insérer un nouvel enregistrement dans la table à partir de l'état d'un objet métier
     * @param Semaine $objet objet métier à insérer
     * @return boolean =FALSE si l'opération échoue
     */
    public static function insert($objet) {
        $requete = "INSERT INTO Semaine2 VALUES (:id2, :designation2, :type2, :prix2)";
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
    public static function update($id2, $objet) {
        $ok = false;
        $requete = "UPDATE  Semaine2 SET DESIGNATION2=:designation2, TYPE2=:type2, PRIX2=:prix2 WHERE ID2=:id2";
        $stmt = Bdd::getPdo()->prepare($requete);
        self::metierVersEnreg($objet, $stmt);
        $stmt->bindParam(':id2', $id);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }

    public static function delete($id2) {
        $ok = false;
        $requete = "DELETE FROM Semaine1 WHERE ID2 = :id2";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id2', $id2);
        $ok = $stmt->execute();
        $ok = $ok && ($stmt->rowCount() > 0);
        return $ok;
    }

    public static function getAll() {
        $lesObjets = array();
        $requete = "SELECT * FROM Semaine2";
        $stmt = Bdd::getPdo()->prepare($requete);
        $ok = $stmt->execute();
        if ($ok) {
            while ($enreg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lesObjets[] = self::enregVersMetier($enreg);
            }
        }
        return $lesObjets;
    }

    public static function getOneById($id2) {
        $objetConstruit = null;
        $requete = "SELECT * FROM Semaine2 WHERE ID2 = :id2";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id2', $id2);
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
    public static function isAnExistingId($id2) {
        $requete = "SELECT COUNT(*) FROM Semaine2 WHERE ID2=:id2";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id2', $id2);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }

}

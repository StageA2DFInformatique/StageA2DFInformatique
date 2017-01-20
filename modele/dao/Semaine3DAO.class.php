<?php

namespace modele\dao;

use modele\metier\Semaine3;
use PDO;

/**
 * Description of Semaine1DAO
 * Classe métier : Semaine1
 * @author btssio
 */
class Semaine3DAO implements IDAO {

    protected static function enregVersMetier($enreg) {
        $id3 = $enreg['ID3'];
        $designation3 = $enreg[strtoupper('designation3')];
        $type3 = $enreg[strtoupper('type3')];
        $prix3 = $enreg[strtoupper('prix3')];

        $uneVente3 = new Semaine3($id3, $designation3, $type3, $prix3);

        return $uneVente3;
    }

    /**
     * Valorise les paramètre d'une requête préparée avec l'état d'un objet Semaine
     */
    protected static function metierVersEnreg($objetMetier, $stmt) {
        // On utilise bindValue plutôt que bindParam pour éviter des variables intermédiaires
        $stmt->bindValue(':id3', $objetMetier->getId3());
        $stmt->bindValue(':designation3', $objetMetier->getDesignation3());
        $stmt->bindValue(':type3', $objetMetier->getType3());
        $stmt->bindValue(':prix3', $objetMetier->getPrix3());
    }

    /**
     * Insérer un nouvel enregistrement dans la table à partir de l'état d'un objet métier
     * @param Semaine $objet objet métier à insérer
     * @return boolean =FALSE si l'opération échoue
     */
    public static function insert($objet) {
        $requete = "INSERT INTO Semaine3 VALUES (:id3, :designation3, :type3, :prix3)";
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
    public static function update($id3, $objet) {
        $ok = false;
        $requete = "UPDATE  Semaine3 SET DESIGNATION3=:designation3, TYPE3=:type3, PRIX3=:prix3 WHERE ID3=:id3";
        $stmt = Bdd::getPdo()->prepare($requete);
        self::metierVersEnreg($objet, $stmt);
        $stmt->bindParam(':id3', $id);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }

    public static function delete($id3) {
        $ok = false;
        $requete = "DELETE FROM Semaine1 WHERE ID3 = :id3";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id3', $id3);
        $ok = $stmt->execute();
        $ok = $ok && ($stmt->rowCount() > 0);
        return $ok;
    }

    public static function getAll() {
        $lesObjets = array();
        $requete = "SELECT * FROM Semaine3";
        $stmt = Bdd::getPdo()->prepare($requete);
        $ok = $stmt->execute();
        if ($ok) {
            while ($enreg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lesObjets[] = self::enregVersMetier($enreg);
            }
        }
        return $lesObjets;
    }

    public static function getOneById($id3) {
        $objetConstruit = null;
        $requete = "SELECT * FROM Semaine3 WHERE ID3 = :id3";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id3', $id3);
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
    public static function isAnExistingId($id3) {
        $requete = "SELECT COUNT(*) FROM Semaine3 WHERE ID3=:id3";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id3', $id3);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }

}

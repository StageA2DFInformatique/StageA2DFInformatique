<?php

namespace modele\dao;

use modele\metier\Operation;
use PDO;

/**
 * Description of ChargesDAO
 * Classe métier : Charges
 * @author btssio
 */
class OperationDAO implements IDAO {

    protected static function enregVersMetier($enreg) {
        $id = $enreg['ID'];
        $idType = $enreg['idType'];
        $designation = $enreg[strtoupper('designation')];
        $date = $enreg[strtoupper('date')];
        $prix = $enreg[strtoupper('prix')];

        $uneOpe = new Operation($id, $idType, $designation, $date, $prix);

        return $uneOpe;
    }

    /**
     * Valorise les paramètre d'une requête préparée avec l'état d'un objet Operation
     * @param type $objetMetier un Operation
     * @param type $stmt requête préparée
     */
    protected static function metierVersEnreg($objetMetier, $stmt) {
        // On utilise bindValue plutôt que bindParam pour éviter des variables intermédiaires
        $stmt->bindValue(':id', $objetMetier->getId());
        $stmt->bindValue(':$idType', $objetMetier->getIdType());
        $stmt->bindValue(':$designation', $objetMetier->getDesignation());
        $stmt->bindValue(':$date', $objetMetier->getDate());
        $stmt->bindValue(':$prix', $objetMetier->getPrix());
    }

    /**
     * Insérer un nouvel enregistrement dans la table à partir de l'état d'un objet métier
     * @param Operation $objet objet métier à insérer
     * @return boolean =FALSE si l'opérationn échoue
     */
    public static function insert($objet) {
        $requete = "INSERT INTO Operation VALUES (:id, :idType, :designation, :date, :prix)";
        $stmt = Bdd::getPdo()->prepare($requete);
        self::metierVersEnreg($objet, $stmt);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }

    /**
     * Mettre à jour enregistrement dans la table à partir de l'état d'un objet métier
     * @param string identifiant de l'enregistrement à mettre à jour
     * @param Operation $objet objet métier à mettre à jour
     * @return boolean =FALSE si l'opération échoue
     */
    public static function update($id, $objet) {
        $ok = false;
        $requete = "UPDATE  Operation SET IDTYPE=:idType, DESIGNATION=:designation, 
                DATE=:date, PRIX=:prix WHERE ID=:id";
        $stmt = Bdd::getPdo()->prepare($requete);
        self::metierVersEnreg($objet, $stmt);
        $stmt->bindParam(':id', $id);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }

    public static function delete($id) {
        $ok = false;
        $requete = "DELETE FROM Operation WHERE ID = :id";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $id);
        $ok = $stmt->execute();
        $ok = $ok && ($stmt->rowCount() > 0);
        return $ok;
    }

    public static function getAll() {
        $lesObjets = array();
        $requete = "SELECT * FROM Operation";
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
        $requete = "SELECT * FROM Operation WHERE ID = :id";
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
     * Permet de vérifier s'il existe ou non une Operation ayant déjà le même identifiant dans la BD
     * @param string $id identifiant de la Operation à tester
     * @return boolean =true si l'id existe déjà, =false sinon
     */
    public static function isAnExistingId($id) {
        $requete = "SELECT COUNT(*) FROM Operation WHERE ID=:id";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }

}

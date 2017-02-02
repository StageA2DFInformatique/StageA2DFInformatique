<?php

namespace modele\dao;

use modele\metier\Type;
use PDO;

/**
 * Description of ChargesDAO
 * Classe métier : Charges
 * @author btssio
 */
class TypeDAO implements IDAO {

    protected static function enregVersMetier($enreg) {
        $idType = $enreg['IDTYPE'];
        $type = $enreg[strtoupper('type')];

        $unType = new Type($idType, $type);

        return $unType;
    }

    /**
     * Valorise les paramètre d'une requête préparée avec l'état d'un objet Type
     * @param type $objetMetier un Type
     * @param type $stmt requête préparée
     */
    protected static function metierVersEnreg($objetMetier, $stmt) {
        // On utilise bindValue plutôt que bindParam pour éviter des variables intermédiaires
        $stmt->bindValue(':$idType', $objetMetier->getIdType());
        $stmt->bindValue(':$type', $objetMetier->getType());
    }

    /**
     * Insérer un nouvel enregistrement dans la table à partir de l'état d'un objet métier
     * @param Type $objet objet métier à insérer
     * @return boolean =FALSE si l'opérationn échoue
     */
    public static function insert($objet) {
        $requete = "INSERT INTO Type VALUES (:idType, :Type)";
        $stmt = Bdd::getPdo()->prepare($requete);
        self::metierVersEnreg($objet, $stmt);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }

    /**
     * Mettre à jour enregistrement dans la table à partir de l'état d'un objet métier
     * @param string identifiant de l'enregistrement à mettre à jour
     * @param Type $objet objet métier à mettre à jour
     * @return boolean =FALSE si l'opération échoue
     */
    public static function update($idType, $objet) {
        $ok = false;
        $requete = "UPDATE  Type SET TYPE=:Type,  WHERE IDTYPE=:idType";
        $stmt = Bdd::getPdo()->prepare($requete);
        self::metierVersEnreg($objet, $stmt);
        $stmt->bindParam(':idType', $idType);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }

    public static function delete($idType) {
        $ok = false;
        $requete = "DELETE FROM Type WHERE ID = :idType";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':idType', $idType);
        $ok = $stmt->execute();
        $ok = $ok && ($stmt->rowCount() > 0);
        return $ok;
    }

    public static function getAll() {
        $lesObjets = array();
        $requete = "SELECT * FROM Type";
        $stmt = Bdd::getPdo()->prepare($requete);
        $ok = $stmt->execute();
        if ($ok) {
            while ($enreg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lesObjets[] = self::enregVersMetier($enreg);
            }
        }
        return $lesObjets;
    }

    public static function getOneById($idType) {
        $objetConstruit = null;
        $requete = "SELECT * FROM Type WHERE ID = :idType";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':idType', $idType);
        $ok = $stmt->execute();
        // attention, $ok = true pour un select ne retournant aucune ligne
        if ($ok && $stmt->rowCount() > 0) {
            $objetConstruit = self::enregVersMetier($stmt->fetch(PDO::FETCH_ASSOC));
        }
        return $objetConstruit;
    }

    /**
     * Permet de vérifier s'il existe ou non une Type ayant déjà le même identifiant dans la BD
     * @param string $idType identifiant de la Type à tester
     * @return boolean =true si l'id existe déjà, =false sinon
     */
    public static function isAnExistingId($idType) {
        $requete = "SELECT COUNT(*) FROM Type WHERE ID=:idType";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':idType', $idType);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }

}

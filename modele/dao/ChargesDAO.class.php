<?php

namespace modele\dao;

use modele\metier\Charges;
use PDO;

/**
 * Description of ChargesDAO
 * Classe métier : Charges
 * @author btssio
 */
class ChargesDAO implements IDAO {

    protected static function enregVersMetier($enreg) {
        $id = $enreg['ID'];
        $nom = $enreg['NOM'];
        $description = $enreg[strtoupper('description')];
        $numContrat = $enreg[strtoupper('numContrat')];
        $numTel = $enreg[strtoupper('numTel')];
        $date = $enreg[strtoupper('date')];


        $unChrg = new Charges($id, $nom, $description, $numContrat, $numTel, $date);

        return $unChrg;
    }

    /**
     * Valorise les paramètre d'une requête préparée avec l'état d'un objet Charges
     * @param type $objetMetier un Charges
     * @param type $stmt requête préparée
     */
    protected static function metierVersEnreg($objetMetier, $stmt) {
        // On utilise bindValue plutôt que bindParam pour éviter des variables intermédiaires
        if ($objetMetier->getId() != null) {
            $stmt->bindValue(':id', $objetMetier->getId());
        }
        $stmt->bindValue(':nom', $objetMetier->getNom());
        $stmt->bindValue(':description', $objetMetier->getDescription());
        $stmt->bindValue(':numContrat', $objetMetier->getNumContrat());
        $stmt->bindValue(':numTel', $objetMetier->getNumTel());
        $stmt->bindValue(':date', $objetMetier->getDate());
    }

    /**
     * Insérer un nouvel enregistrement dans la table à partir de l'état d'un objet métier
     * @param Charges $objet objet métier à insérer
     * @return boolean =FALSE si l'opérationn échoue
     */
    public static function insert($objet) {
        $requete = "INSERT INTO `Charges`(`nom`, `description`, `numContrat`, `numTel`, `date`) VALUES (:nom, :description, :numContrat, :numTel, :date)";
        $stmt = Bdd::getPdo()->prepare($requete);
        self::metierVersEnreg($objet, $stmt);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }

    /**
     * Mettre à jour enregistrement dans la table à partir de l'état d'un objet métier
     * @param string identifiant de l'enregistrement à mettre à jour
     * @param Charges $objet objet métier à mettre à jour
     * @return boolean =FALSE si l'opération échoue
     */
    public static function update($id, $objet) {
        $ok = false;
        $requete = "UPDATE  Charges SET NOM=:nom, DESCRIPTION=:description, 
                NUMCONTRAT=:numContrat, NUMTEL=:numTel, DATE=:date WHERE ID=:id";
        $stmt = Bdd::getPdo()->prepare($requete);
        self::metierVersEnreg($objet, $stmt);
        $stmt->bindParam(':id', $id);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }

    public static function delete($id) {
        $ok = false;
        $requete = "DELETE FROM Charges WHERE ID = :id";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $id);
        $ok = $stmt->execute();
        $ok = $ok && ($stmt->rowCount() > 0);
        return $ok;
    }

    public static function getAll() {
        $lesObjets = array();
        $requete = "SELECT * FROM Charges";
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
        $requete = "SELECT * FROM Charges WHERE ID = :id";
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
     * Permet de vérifier s'il existe ou non une Charge ayant déjà le même identifiant dans la BD
     * @param string $id identifiant de la charge à tester
     * @return boolean =true si l'id existe déjà, =false sinon
     */
    public static function isAnExistingId($id) {
        $requete = "SELECT COUNT(*) FROM Charges WHERE ID=:id";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }

}

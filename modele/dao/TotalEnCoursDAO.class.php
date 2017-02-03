<?php

namespace modele\dao;

use modele\metier\TotalEnCours;
use PDO;

/**
 * Description of TotalEnCoursDAO
 * Classe métier : TotalEnCours
 * @author btssio
 */
class TotalEnCoursDAO implements IDAO {

    protected static function enregVersMetier($enreg) {
        $id = $enreg['ID'];
        $total = $enreg[strtoupper('total')];

        $unTotal = new TotalEnCours($id, $total);

        return $unTotal;
    }

    /**
     * Valorise les paramètre d'une requête préparée avec l'état d'un objet TotalEnCours
     * @param type $objetMetier un TotalEnCours
     * @param type $stmt requête préparée
     */
    protected static function metierVersEnreg($objetMetier, $stmt) {
        // On utilise bindValue plutôt que bindParam pour éviter des variables intermédiaires
        $stmt->bindValue(':id', $objetMetier->getId());
        $stmt->bindValue(':total', $objetMetier->getTotal());
    }

    /**
     * Insérer un nouvel enregistrement dans la table à partir de l'état d'un objet métier
     * @param TotalEnCours $objet objet métier à insérer
     * @return boolean =FALSE si l'opérationn échoue
     */
    public static function insert($objet) {
        $requete = "INSERT INTO TotalEnCours VALUES (:id, :total)";
        $stmt = Bdd::getPdo()->prepare($requete);
        self::metierVersEnreg($objet, $stmt);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }

    /**
     * Mettre à jour enregistrement dans la table à partir de l'état d'un objet métier
     * @param string identifiant de l'enregistrement à mettre à jour
     * @param TotalEnCours $objet objet métier à mettre à jour
     * @return boolean =FALSE si l'opération échoue
     */
    public static function update($id, $objet) {
        $ok = false;
        $requete = "UPDATE  TotalEnCours SET TOTAL=:total WHERE ID=:id";
        $stmt = Bdd::getPdo()->prepare($requete);
        self::metierVersEnreg($objet, $stmt);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }

    public static function superSum() {
        $requete = "SELECT SUM(prix) FROM `Operations` ";
        $stmt = Bdd::getPdo()->prepare($requete);
        $ok = $stmt->execute();
        return $stmt->fetchColumn(0);
    }

    public static function delete($id) {
        $ok = false;
        $requete = "DELETE FROM TotalEnCours WHERE ID = :id";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $id);
        $ok = $stmt->execute();
        $ok = $ok && ($stmt->rowCount() > 0);
        return $ok;
    }

    public static function getAll() {
        $lesObjets = array();
        $requete = "SELECT * FROM TotalEnCours";
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
        $requete = "SELECT * FROM TotalEnCours WHERE ID = :id";
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
        $requete = "SELECT COUNT(*) FROM TotalEnCours WHERE ID=:id";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }

}

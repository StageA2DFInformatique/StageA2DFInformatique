<?php

namespace modele\dao;

use modele\metier\TotalSemaine1;
use PDO;

/**
 * Description of TotalSemaine1DAO
 * Classe métier : TotalSemaine1
 * @author btssio
 */
class TotalSemaine1DAO {

    protected static function enregVersMetier($enreg) {
        $id = $enreg['ID'];
        $total = $enreg[strtoupper('total')];
        $unTotal = new TotalSemaine1($id, $total);

        return $unTotal;
    }

    /**
     * Valorise les paramètre d'une requête préparée avec l'état d'un objet TotalSemaine1
     * @param type $objetMetier un TotalSemaine1
     * @param type $stmt requête préparée
     */
    protected static function metierVersEnreg($objetMetier, $stmt) {
        // On utilise bindValue plutôt que bindParam pour éviter des variables intermédiaires
        $stmt->bindValue(':id', $objetMetier->getId());
        $stmt->bindValue(':total', $objetMetier->getTotal());
    }

    public static function getAll() {
        $lesObjets = array();
        $requete = "INSERT INTO TotalSemaine1 (total) SELECT SUM(prix) FROM Semaine1";
        $stmt = Bdd::getPdo()->prepare($requete);
        $ok = $stmt->execute();
        if ($ok) {
            while ($enreg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lesObjets[] = self::enregVersMetier($enreg);
            }
        }
        return $lesObjets;
    }

}

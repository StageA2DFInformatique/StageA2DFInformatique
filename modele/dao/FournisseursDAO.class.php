<?php

namespace modele\dao;

use modele\metier\Fournisseurs;
use PDO;

/**
 * Description of FournisseursDAO
 * Classe métier : Fournisseurs
 * @author btssio
 */
class FournisseursDAO implements IDAO {

    protected static function enregVersMetier($enreg) {
        $id = $enreg['ID'];
        $nom = $enreg['NOM'];
        $adresse = $enreg[strtoupper('adresseRue')];
        $cdp = $enreg[strtoupper('codePostal')];
        $ville = $enreg[strtoupper('ville')];
        $tel = $enreg[strtoupper('tel')];
        $email = $enreg[strtoupper('adresseElectronique')];
        $type = $enreg[strtoupper('type')];
        $civResp = $enreg[strtoupper('civiliteResponsable')];
        $nomResp = $enreg[strtoupper('nomResponsable')];
        $prenomResp = $enreg[strtoupper('prenomResponsable')];

        $unFourni = new Fournisseur($id, $nom, $adresse, $cdp, $ville, $tel, $email, $type, $civResp, $nomResp, $prenomResp);

        return $unFourni;
    }

    /**
     * Valorise les paramètre d'une requête préparée avec l'état d'un objet Fournisseurs
     * @param type $objetMetier un Fournisseurs
     * @param type $stmt requête préparée
     */
    protected static function metierVersEnreg($objetMetier, $stmt) {
        // On utilise bindValue plutôt que bindParam pour éviter des variables intermédiaires
        $stmt->bindValue(':id', $objetMetier->getId());
        $stmt->bindValue(':nom', $objetMetier->getNom());
        $stmt->bindValue(':rue', $objetMetier->getAdresse());
        $stmt->bindValue(':cdp', $objetMetier->getCdp());
        $stmt->bindValue(':ville', $objetMetier->getVille());
        $stmt->bindValue(':tel', $objetMetier->getTel());
        $stmt->bindValue(':email', $objetMetier->getEmail());
        $stmt->bindValue(':type', $objetMetier->getTypeEtab());
        $stmt->bindValue(':civ', $objetMetier->getCiviliteResp());
        $stmt->bindValue(':nomResp', $objetMetier->getNomResp());
        $stmt->bindValue(':prenomResp', $objetMetier->getPrenomResp());
    }

    /**
     * Insérer un nouvel enregistrement dans la table à partir de l'état d'un objet métier
     * @param Fournisseur $objet objet métier à insérer
     * @return boolean =FALSE si l'opérationn échoue
     */
    public static function insert($objet) {
        $requete = "INSERT INTO Fournisseurs VALUES (:id, :nom, :rue, :cdp, :ville, :tel, :email, :type, :civ, :nomResp, :prenomResp)";
        $stmt = Bdd::getPdo()->prepare($requete);
        self::metierVersEnreg($objet, $stmt);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }

    /**
     * Mettre à jour enregistrement dans la table à partir de l'état d'un objet métier
     * @param string identifiant de l'enregistrement à mettre à jour
     * @param Fournisseurs $objet objet métier à mettre à jour
     * @return boolean =FALSE si l'opérationn échoue
     */
    public static function update($id, $objet) {
        $ok = false;
        $requete = "UPDATE  Fournisseurs SET NOM=:nom, ADRESSERUE=:rue,
           CODEPOSTAL=:cdp, VILLE=:ville, TEL=:tel,
           ADRESSEELECTRONIQUE=:email, TYPE=:type,
           CIVILITERESPONSABLE=:civ, NOMRESPONSABLE=:nomResp, PRENOMRESPONSABLE=:prenomResp 
           WHERE ID=:id";
        $stmt = Bdd::getPdo()->prepare($requete);
        self::metierVersEnreg($objet, $stmt);
        $stmt->bindParam(':id', $id);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }

    public static function delete($id) {
        $ok = false;
        $requete = "DELETE FROM Fournisseurs WHERE ID = :id";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $id);
        $ok = $stmt->execute();
        $ok = $ok && ($stmt->rowCount() > 0);
        return $ok;
    }

    public static function getAll() {
        $lesObjets = array();
        $requete = "SELECT * FROM Fournisseurs";
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
        $requete = "SELECT * FROM Fournisseurs WHERE ID = :id";
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
     * Retourne la liste des fournisseurs qui ont enregistré des offres
     * @return array tableau des fournisseurs
     */
    public static function getAllOfferingRooms() {
        $lesObjets = array();
        $requete = "SELECT * FROM Fournisseurs 
                WHERE ID IN 
                   (SELECT DISTINCT ID
                    FROM Offre o
                    INNER JOIN Fournisseurs e ON e.ID = o.IDETAB
                    ORDER BY ID)";
        $stmt = Bdd::getPdo()->prepare($requete);
        $ok = $stmt->execute();
        if ($ok) {
            while ($enreg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lesObjets[] = self::enregVersMetier($enreg);
            }
        }
        return $lesObjets;
    }

    /**
     * Permet de vérifier s'il existe ou non un fournisseur ayant déjà le même identifiant dans la BD
     * @param string $id identifiant du fournisseur à tester
     * @return boolean =true si l'id existe déjà, =false sinon
     */
    public static function isAnExistingId($id) {
        $requete = "SELECT COUNT(*) FROM Fournisseurs WHERE ID=:id";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }

    /**
     * Permet de vérifier s'il existe ou non un fournisseur portant déjà le même nom dans la BD
     * En mode modification, l'enregistrement en cours de modification est bien entendu exclu du test
     * @param boolean $estModeCreation =true si le test est fait en mode création, =false en mode modification
     * @param string $id identifiant du fournisseur à tester
     * @param string $nom nom du fournisseur à tester
     * @return boolean =true si le nom existe déjà, =false sinon
     */
    public static function isAnExistingName($estModeCreation, $id, $nom) {
        $nom = str_replace("'", "''", $nom);
        // S'il s'agit d'une création, on vérifie juste la non existence du nom sinon
        // on vérifie la non existence d'un autre fournisseur (id!='$id') portant 
        // le même nom
        if ($estModeCreation) {
            $requete = "SELECT COUNT(*) FROM Fournisseurs WHERE NOM=:nom";
            $stmt = Bdd::getPdo()->prepare($requete);
            $stmt->bindParam(':nom', $nom);
            $stmt->execute();
        } else {
            $requete = "SELECT COUNT(*) FROM Fournisseurs WHERE NOM=:nom AND ID<>:id";
            $stmt = Bdd::getPdo()->prepare($requete);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nom', $nom);
            $stmt->execute();
        }
        return $stmt->fetchColumn(0);
    }

}

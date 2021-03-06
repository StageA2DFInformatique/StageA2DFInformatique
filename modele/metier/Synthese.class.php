<?php

namespace modele\metier;

/**
 * Description of Fournisseurs
 * @author Charly
 */
class Synthese {

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $date;

    /**
     * @var string
     */
    private $compte;

    /**
     * @var string
     */
    private $cb;

    /**
     * @var string
     */
    private $espece;

    /**
     * @var string
     */
    private $cheque;

    /**
     * @var string
     */
    private $totalFinMois;

    /**
     * @var string
     */
    private $totalMoisPlusUn;

    function __construct($id, $date, $compte, $cb, $espece, $cheque, $totalFinMois, $totalMoisPlusUn) {
        $this->id = $id;
        $this->date = $date;
        $this->compte = $compte;
        $this->cb = $cb;
        $this->espece = $espece;
        $this->cheque = $cheque;
        $this->totalFinMois = $totalFinMois;
        $this->totalMoisPlusUn = $totalMoisPlusUn;
    }

    function getId() {
        return $this->id;
    }

    function getDate() {
        return $this->date;
    }

    function getCompte() {
        return $this->compte;
    }

    function getCb() {
        return $this->cb;
    }

    function getEspece() {
        return $this->espece;
    }

    function getCheque() {
        return $this->cheque;
    }

    function getTotalFinMois() {
        return $this->totalFinMois;
    }

    function getTotalMoisPlusUn() {
        return $this->totalMoisPlusUn;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setCompte($compte) {
        $this->compte = $compte;
    }

    function setCb($cb) {
        $this->cb = $cb;
    }

    function setEspece($espece) {
        $this->espece = $espece;
    }

    function setCheque($cheque) {
        $this->cheque = $cheque;
    }

    function setTotalFinMois($totalFinMois) {
        $this->totalFinMois = $totalFinMois;
    }

    function setTotalMoisPlusUn($totalMoisPlusUn) {
        $this->totalMoisPlusUn = $totalMoisPlusUn;
    }

}

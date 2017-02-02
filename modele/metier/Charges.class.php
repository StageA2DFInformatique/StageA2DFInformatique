<?php

namespace modele\metier;

/**
 * Description of Charges
 * @author btssio
 */
class Charges {

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $numContrat;

    /**
     * @var string
     */
    private $numTel;

    /**
     * @var string
     */
    private $date;

    function __construct($id, $nom, $description, $numContrat, $numTel, $date) {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->numContrat = $numContrat;
        $this->numTel = $numTel;
        $this->date = $date;
    }

    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getDescription() {
        return $this->description;
    }

    function getNumContrat() {
        return $this->numContrat;
    }

    function getNumTel() {
        return $this->numTel;
    }

    function getDate() {
        return $this->date;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setNumContrat($numContrat) {
        $this->numContrat = $numContrat;
    }

    function setNumTel($numTel) {
        $this->numTel = $numTel;
    }

    function setDate($date) {
        $this->date = $date;
    }

}

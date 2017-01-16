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

    function __construct($id, $nom, $description, $numContrat, $numTel) {
        $this->id = $id;
        $this->nom = $nom;
        $this->nom = $description;
        $this->nom = $numContrat;
        $this->nom = $numTel;
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



}

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

    function __construct($id, $nom) {
        $this->id = $id;
        $this->nom = $nom;
    }

    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

}

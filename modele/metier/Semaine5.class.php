<?php

namespace modele\metier;

/**
 * Description of Semaine1
 * @author btssio
 */
class Semaine5 {

    private $id;
    private $designation;
    private $type;
    private $prix;

    function __construct($id, $designation, $type, $prix) {
        $this->id = $id;
        $this->designation = $designation;
        $this->type = $type;
        $this->prix = $prix;
    }

    function getId() {
        return $this->id;
    }

    function getDesignation() {
        return $this->designation;
    }

    function getType() {
        return $this->type;
    }

    function getPrix() {
        return $this->prix;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDesignation($designation) {
        $this->designation = $designation;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setPrix($prix) {
        $this->prix = $prix;
    }

}

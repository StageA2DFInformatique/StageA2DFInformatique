<?php

namespace modele\metier;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EnCours
 *
 * @author btssio
 */
class EnCours {

    private $id;
    private $designation;
    private $prix;
    private $type;
    private $date;

    function __construct($id, $designation, $prix, $type, $date) {
        $this->id = $id;
        $this->designation = $designation;
        $this->prix = $prix;
        $this->type = $type;
        $this->date = $date;
    }

    function getId() {
        return $this->id;
    }

    function getDesignation() {
        return $this->designation;
    }

    function getPrix() {
        return $this->prix;
    }

    function getType() {
        return $this->type;
    }

    function getDate() {
        return $this->date;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDesignation($designation) {
        $this->designation = $designation;
    }

    function setPrix($prix) {
        $this->prix = $prix;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setDate($date) {
        $this->date = $date;
    }

}

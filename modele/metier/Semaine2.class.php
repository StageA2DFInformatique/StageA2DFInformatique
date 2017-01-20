<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace modele\metier;

/**
 * Description of Semaine2
 *
 * @author Charly
 */
class Semaine2 {

    private $id2;
    private $designation2;
    private $type2;
    private $prix2;
    function __construct($id2, $designation2, $type2, $prix2) {
        $this->id2 = $id2;
        $this->designation2 = $designation2;
        $this->type2 = $type2;
        $this->prix2 = $prix2;
    }
    function getId2() {
        return $this->id2;
    }

    function getDesignation2() {
        return $this->designation2;
    }

    function getType2() {
        return $this->type2;
    }

    function getPrix2() {
        return $this->prix2;
    }

    function setId2($id2) {
        $this->id2 = $id2;
    }

    function setDesignation2($designation2) {
        $this->designation2 = $designation2;
    }

    function setType2($type2) {
        $this->type2 = $type2;
    }

    function setPrix2($prix2) {
        $this->prix2 = $prix2;
    }


}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace modele\metier;

/**
 * Description of Semaine4
 *
 * @author Charly
 */
class Semaine4 {

    private $id4;
    private $designation4;
    private $type4;
    private $prix4;
    function __construct($id4, $designation4, $type4, $prix4) {
        $this->id4 = $id4;
        $this->designation4 = $designation4;
        $this->type4 = $type4;
        $this->prix4 = $prix4;
    }
    function getId4() {
        return $this->id4;
    }

    function getDesignation4() {
        return $this->designation4;
    }

    function getType4() {
        return $this->type4;
    }

    function getPrix4() {
        return $this->prix4;
    }

    function setId4($id4) {
        $this->id4 = $id4;
    }

    function setDesignation4($designation4) {
        $this->designation4 = $designation4;
    }

    function setType4($type4) {
        $this->type4 = $type4;
    }

    function setPrix4($prix4) {
        $this->prix4 = $prix4;
    }


}

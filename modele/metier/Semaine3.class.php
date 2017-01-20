<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace modele\metier;

/**
 * Description of Semaine3
 *
 * @author Charly
 */
class Semaine3 {

    private $id3;
    private $designation3;
    private $type3;
    private $prix3;
    function __construct($id3, $designation3, $type3, $prix3) {
        $this->id3 = $id3;
        $this->designation3 = $designation3;
        $this->type3 = $type3;
        $this->prix3 = $prix3;
    }
    function getId3() {
        return $this->id3;
    }

    function getDesignation3() {
        return $this->designation3;
    }

    function getType3() {
        return $this->type3;
    }

    function getPrix3() {
        return $this->prix3;
    }

    function setId3($id3) {
        $this->id3 = $id3;
    }

    function setDesignation3($designation3) {
        $this->designation3 = $designation3;
    }

    function setType3($type3) {
        $this->type3 = $type3;
    }

    function setPrix3($prix3) {
        $this->prix3 = $prix3;
    }


}

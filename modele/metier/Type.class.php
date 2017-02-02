<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Type
 *
 * @author btssio
 */
class Type {

    private $idType;
    private $type;

    function __construct($idType, $type) {
        $this->idType = $idType;
        $this->type = $type;
    }

    function getIdType() {
        return $this->idType;
    }

    function getType() {
        return $this->type;
    }

    function setIdType($idType) {
        $this->idType = $idType;
    }

    function setType($type) {
        $this->type = $type;
    }

}

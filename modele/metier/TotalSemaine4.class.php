<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace modele\metier;

/**
 * Description of TotalSemaine
 *
 * @author Charly
 */
class TotalSemaine4 {

    private $id;
    private $total;

    function __construct($id, $total) {
        $this->id = $id;
        $this->total = $total;
    }

    function getId() {
        return $this->id;
    }

    function getTotal() {
        return $this->total;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTotal($total) {
        $this->total = $total;
    }

}

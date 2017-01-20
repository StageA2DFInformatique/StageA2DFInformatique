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
class TotalSemaine {
private $id;
private $semaine;
private $total;
function __construct($id, $semaine, $total) {
    $this->id = $id;
    $this->semaine = $semaine;
    $this->total = $total;
}
function getId() {
    return $this->id;
}

function getSemaine() {
    return $this->semaine;
}

function getTotal() {
    return $this->total;
}

function setId($id) {
    $this->id = $id;
}

function setSemaine($semaine) {
    $this->semaine = $semaine;
}

function setTotal($total) {
    $this->total = $total;
}


}

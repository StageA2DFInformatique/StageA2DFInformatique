<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Operation
 *
 * @author btssio
 */
class Operation {
private $id;
private $idType;
private $designation;
private $date;
private $prix;
function __construct($id, $idType, $designation, $date, $prix) {
    $this->id = $id;
    $this->idType = $idType;
    $this->designation = $designation;
    $this->date = $date;
    $this->prix = $prix;
}
function getId() {
    return $this->id;
}

function getIdType() {
    return $this->idType;
}

function getDesignation() {
    return $this->designation;
}

function getDate() {
    return $this->date;
}

function getPrix() {
    return $this->prix;
}

function setId($id) {
    $this->id = $id;
}

function setIdType($idType) {
    $this->idType = $idType;
}

function setDesignation($designation) {
    $this->designation = $designation;
}

function setDate($date) {
    $this->date = $date;
}

function setPrix($prix) {
    $this->prix = $prix;
}


}

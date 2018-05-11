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
    private $jour;
    private $mois;
    private $annee;

    function __construct($id, $designation, $prix, $type, $jour, $mois, $annee) {
        $this->id = $id;
        $this->designation = $designation;
        $this->prix = $prix;
        $this->type = $type;
        $this->jour = $jour;
        $this->mois = $mois;
        $this->annee = $annee;
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

    function getJour() {
        return $this->jour;
    }

    function getMois() {
        return $this->mois;
    }

    function getAnnee() {
        return $this->annee;
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

    function setJour($jour) {
        $this->jour = $jour;
    }

    function setMois($mois) {
        $this->mois = $mois;
    }

    function setAnnee($annee) {
        $this->annee = $annee;
    }

}

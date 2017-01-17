<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EnCours
 *
 * @author Charly
 */
class EnCours {

    private $compte;
    private $cb;
    private $espece;
    private $cheque;

    function __construct($compte, $cb, $espece, $cheque) {
        $this->compte = $compte;
        $this->cb = $cb;
        $this->espece = $espece;
        $this->cheque = $cheque;
    }

    function getCompte() {
        return $this->compte;
    }

    function getCb() {
        return $this->cb;
    }

    function getEspece() {
        return $this->espece;
    }

    function getCheque() {
        return $this->cheque;
    }

    function setCompte($compte) {
        $this->compte = $compte;
    }

    function setCb($cb) {
        $this->cb = $cb;
    }

    function setEspece($espece) {
        $this->espece = $espece;
    }

    function setCheque($cheque) {
        $this->cheque = $cheque;
    }

}

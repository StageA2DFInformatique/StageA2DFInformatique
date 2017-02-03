<?php

namespace modele\metier;

/**
 * Description of TotalEnCours
 *
 * @author Charly
 */
class TotalEnCours {

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

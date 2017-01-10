<?php
namespace modele\metier;

class Fournisseurs {
    /**
     * code  de 8 caractères alphanum.
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $nom;
    /**
     * n° de rue et rue
     * @var string
     */
    private $adresse;
    /**
     * code postal
     * @var string 
     */
    private $cdp;
    /**
     * @var string
     */
    private $ville;
    /**
     * @var string
     */
    private $tel;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string 
     */
    private $paiement; 
    /**
     * @var string 
     */
    function __construct($id, $nom, $adresse, $cdp, $ville, $tel, $email, $paiement) {
        $this->id = $id;
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->cdp = $cdp;
        $this->ville = $ville;
        $this->tel = $tel;
        $this->email = $email;
        $this->tempsPaiement = $paiement;
    }

    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getAdresse() {
        return $this->adresse;
    }

    function getCdp() {
        return $this->cdp;
    }

    function getVille() {
        return $this->ville;
    }

    function getTel() {
        return $this->tel;
    }

    function getEmail() {
        return $this->email;
    }

    function getTempsPaiement() {
        return $this->tempsPaiement;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    function setCdp($cdp) {
        $this->cdp = $cdp;
    }

    function setVille($ville) {
        $this->ville = $ville;
    }

    function setTel($tel) {
        $this->tel = $tel;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTempsPaiement($paiement) {
        $this->typeEtab = $paiement;
    }
}

<?php

namespace entity;

class Hopital
{
private $id_hopital;
private $nom;
private $adresse;
private $commune;

    /**
     * @param $id_hopital
     * @param $nom
     * @param $adresse
     * @param $commune
     */
    public function __construct($id_hopital, $nom, $adresse, $commune)
    {
        $this->id_hopital = $id_hopital;
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->commune = $commune;
    }

    /**
     * @return mixed
     */
    public function getIdHopital()
    {
        return $this->id_hopital;
    }

    /**
     * @param mixed $id_hopital
     */
    public function setIdHopital($id_hopital)
    {
        $this->id_hopital = $id_hopital;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return mixed
     */
    public function getCommune()
    {
        return $this->commune;
    }

    /**
     * @param mixed $commune
     */
    public function setCommune($commune)
    {
        $this->commune = $commune;
    }

}
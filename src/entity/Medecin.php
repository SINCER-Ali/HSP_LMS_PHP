<?php

namespace entity;

class Medecin extends Utilisateur
{
private $id_medecin;
private $specialite;
private $ref_hopital;
private $ref_utilisateur;

    /**
     * @param $id_medecin
     * @param $specialite
     * @param $ref_hopital
     * @param $ref_utilisateur
     */
    public function __construct($id_medecin, $specialite, $ref_hopital, $ref_utilisateur)
    {
        $this->id_medecin = $id_medecin;
        $this->specialite = $specialite;
        $this->ref_hopital = $ref_hopital;
        $this->ref_utilisateur = $ref_utilisateur;
    }

    /**
     * @return mixed
     */
    public function getIdMedecin()
    {
        return $this->id_medecin;
    }

    /**
     * @param mixed $id_medecin
     */
    public function setIdMedecin($id_medecin)
    {
        $this->id_medecin = $id_medecin;
    }

    /**
     * @return mixed
     */
    public function getSpecialite()
    {
        return $this->specialite;
    }

    /**
     * @param mixed $specialite
     */
    public function setSpecialite($specialite)
    {
        $this->specialite = $specialite;
    }

    /**
     * @return mixed
     */
    public function getRefHopital()
    {
        return $this->ref_hopital;
    }

    /**
     * @param mixed $ref_hopital
     */
    public function setRefHopital($ref_hopital)
    {
        $this->ref_hopital = $ref_hopital;
    }

    /**
     * @return mixed
     */
    public function getRefUtilisateur()
    {
        return $this->ref_utilisateur;
    }

    /**
     * @param mixed $ref_utilisateur
     */
    public function setRefUtilisateur($ref_utilisateur)
    {
        $this->ref_utilisateur = $ref_utilisateur;
    }

}
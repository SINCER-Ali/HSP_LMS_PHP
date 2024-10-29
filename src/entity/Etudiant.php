<?php

namespace entity;

class Etudiant extends Utilisateur
{
private $id_utilisateur;
private $cv;
private $formation;
private $ref_utilisateur;

    /**
     * @param $id_utilisateur
     * @param $cv
     * @param $formation
     * @param $ref_utilisateur
     */
    public function __construct($id_utilisateur, $cv, $formation, $ref_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;
        $this->cv = $cv;
        $this->formation = $formation;
        $this->ref_utilisateur = $ref_utilisateur;
    }

    /**
     * @return mixed
     */
    public function getIdUtilisateur()
    {
        return $this->id_utilisateur;
    }

    /**
     * @param mixed $id_utilisateur
     */
    public function setIdUtilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;
    }

    /**
     * @return mixed
     */
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * @param mixed $cv
     */
    public function setCv($cv)
    {
        $this->cv = $cv;
    }

    /**
     * @return mixed
     */
    public function getFormation()
    {
        return $this->formation;
    }

    /**
     * @param mixed $formation
     */
    public function setFormation($formation)
    {
        $this->formation = $formation;
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
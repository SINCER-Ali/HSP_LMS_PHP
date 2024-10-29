<?php

namespace entity;

class Participe
{
private $ref_utilisateur;
private $ref_evenement;

    /**
     * @param $ref_utilisateur
     */
    public function __construct($ref_utilisateur)
    {
        $this->ref_utilisateur = $ref_utilisateur;
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

    /**
     * @return mixed
     */
    public function getRefEvenement()
    {
        return $this->ref_evenement;
    }

    /**
     * @param mixed $ref_evenement
     */
    public function setRefEvenement($ref_evenement)
    {
        $this->ref_evenement = $ref_evenement;
    }

}
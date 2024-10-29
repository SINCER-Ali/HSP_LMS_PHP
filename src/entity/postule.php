<?php

namespace entity;

class postule
{
private $ref_utilisateur;
private $ref_offre;

    /**
     * @param $ref_utilisateur
     * @param $ref_offre
     */
    public function __construct($ref_utilisateur, $ref_offre)
    {
        $this->ref_utilisateur = $ref_utilisateur;
        $this->ref_offre = $ref_offre;
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
    public function getRefOffre()
    {
        return $this->ref_offre;
    }

    /**
     * @param mixed $ref_offre
     */
    public function setRefOffre($ref_offre)
    {
        $this->ref_offre = $ref_offre;
    }

}
<?php

namespace entity;

class Partenaire
{
private $id_partenaire;
private $poste;
private $ref_entreprise;
private $ref_utilisateur;

    /**
     * @param $id_partenaire
     * @param $poste
     * @param $ref_entreprise
     * @param $ref_utilisateur
     */
    public function __construct($id_partenaire, $poste, $ref_entreprise, $ref_utilisateur)
    {
        $this->id_partenaire = $id_partenaire;
        $this->poste = $poste;
        $this->ref_entreprise = $ref_entreprise;
        $this->ref_utilisateur = $ref_utilisateur;
    }

    /**
     * @return mixed
     */
    public function getIdPartenaire()
    {
        return $this->id_partenaire;
    }

    /**
     * @param mixed $id_partenaire
     */
    public function setIdPartenaire($id_partenaire)
    {
        $this->id_partenaire = $id_partenaire;
    }

    /**
     * @return mixed
     */
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * @param mixed $poste
     */
    public function setPoste($poste)
    {
        $this->poste = $poste;
    }

    /**
     * @return mixed
     */
    public function getRefEntreprise()
    {
        return $this->ref_entreprise;
    }

    /**
     * @param mixed $ref_entreprise
     */
    public function setRefEntreprise($ref_entreprise)
    {
        $this->ref_entreprise = $ref_entreprise;
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
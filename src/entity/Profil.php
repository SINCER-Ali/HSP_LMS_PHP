<?php

namespace entity;

class Profil
{
private $id_profil;
private $nom_role;

    /**
     * @param $id_profil
     * @param $nom_role
     */
    public function __construct($id_profil, $nom_role)
    {
        $this->id_profil = $id_profil;
        $this->nom_role = $nom_role;
    }

    /**
     * @return mixed
     */
    public function getIdProfil()
    {
        return $this->id_profil;
    }

    /**
     * @param mixed $id_profil
     */
    public function setIdProfil($id_profil)
    {
        $this->id_profil = $id_profil;
    }

    /**
     * @return mixed
     */
    public function getNomRole()
    {
        return $this->nom_role;
    }

    /**
     * @param mixed $nom_role
     */
    public function setNomRole($nom_role)
    {
        $this->nom_role = $nom_role;
    }






}
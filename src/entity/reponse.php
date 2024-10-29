<?php

namespace entity;

class reponse
{
private $id_reponse;
private $contenu;
private $date_reponse;
private $heure_reponse;
private $ref_post;

    /**
     * @param $id_reponse
     * @param $contenu
     * @param $date_reponse
     * @param $heure_reponse
     * @param $ref_post
     */
    public function __construct($id_reponse, $contenu, $date_reponse, $heure_reponse, $ref_post)
    {
        $this->id_reponse = $id_reponse;
        $this->contenu = $contenu;
        $this->date_reponse = $date_reponse;
        $this->heure_reponse = $heure_reponse;
        $this->ref_post = $ref_post;
    }

    /**
     * @return mixed
     */
    public function getIdReponse()
    {
        return $this->id_reponse;
    }

    /**
     * @param mixed $id_reponse
     */
    public function setIdReponse($id_reponse)
    {
        $this->id_reponse = $id_reponse;
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param mixed $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * @return mixed
     */
    public function getDateReponse()
    {
        return $this->date_reponse;
    }

    /**
     * @param mixed $date_reponse
     */
    public function setDateReponse($date_reponse)
    {
        $this->date_reponse = $date_reponse;
    }

    /**
     * @return mixed
     */
    public function getHeureReponse()
    {
        return $this->heure_reponse;
    }

    /**
     * @param mixed $heure_reponse
     */
    public function setHeureReponse($heure_reponse)
    {
        $this->heure_reponse = $heure_reponse;
    }

    /**
     * @return mixed
     */
    public function getRefPost()
    {
        return $this->ref_post;
    }

    /**
     * @param mixed $ref_post
     */
    public function setRefPost($ref_post)
    {
        $this->ref_post = $ref_post;
    }

}
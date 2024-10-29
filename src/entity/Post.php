<?php

namespace entity;

class Post
{
private $id_post;
private $canal;
private $titre;
private $contenu;
private $date_publication;
private $heure_publication;
private $ref_user;/**
 * @param $id_post
 * @param $canal
 * @param $titre
 * @param $contenu
 * @param $date_publicatio
 * @param $heure_publication
 * @param $ref_user
 */public function __construct($id_post, $canal, $titre, $contenu, $date_publicatio, $heure_publication, $ref_user)
{
    $this->id_post = $id_post;
    $this->canal = $canal;
    $this->titre = $titre;
    $this->contenu = $contenu;
    $this->date_publication = $date_publicatio;
    $this->heure_publication = $heure_publication;
    $this->ref_user = $ref_user;
}/**
 * @return mixed
 */
public function getIdPost()
{
    return $this->id_post;
}/**
 * @param mixed $id_post
 */
public function setIdPost($id_post)
{
    $this->id_post = $id_post;
}/**
 * @return mixed
 */
public function getCanal()
{
    return $this->canal;
}/**
 * @param mixed $canal
 */
public function setCanal($canal)
{
    $this->canal = $canal;
}/**
 * @return mixed
 */
public function getTitre()
{
    return $this->titre;
}/**
 * @param mixed $titre
 */
public function setTitre($titre)
{
    $this->titre = $titre;
}/**
 * @return mixed
 */
public function getContenu()
{
    return $this->contenu;
}/**
 * @param mixed $contenu
 */
public function setContenu($contenu)
{
    $this->contenu = $contenu;
}/**
 * @return mixed
 */
public function getDatePublication()
{
    return $this->date_publication;
}/**
 * @param mixed $date_publication
 */
public function setDatePublication($date_publication)
{
    $this->date_publication = $date_publication;
}/**
 * @return mixed
 */
public function getHeurePublication()
{
    return $this->heure_publication;
}/**
 * @param mixed $heure_publication
 */
public function setHeurePublication($heure_publication)
{
    $this->heure_publication = $heure_publication;
}/**
 * @return mixed
 */
public function getRefUser()
{
    return $this->ref_user;
}/**
 * @param mixed $ref_user
 */
public function setRefUser($ref_user)
{
    $this->ref_user = $ref_user;
}

}
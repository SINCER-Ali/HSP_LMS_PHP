<?php

namespace entity;

require_once __DIR__ . '/../bdd/Bdd.php';
use bdd\Bdd;
class Profil
{
private $id_profil;
private $nom_role;

    /**
     * @param $id_profil
     * @param $nom_role
     */
    public function __construct($id_profil = null, $nom_role= null)
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
    public function getRoleById($id_utilisateur)
    {
        $bdd = new Bdd();
        $req = $bdd->getBdd()->prepare('SELECT profil FROM utilisateur WHERE id_utilisateur = :id');
        $req->execute(['id' => $id_utilisateur]);
        return $req->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateRole($id_utilisateur, $nouveau_role)
    {
        $bdd = new Bdd();
        $req = $bdd->getBdd()->prepare('UPDATE utilisateur SET profil = :role WHERE id_utilisateur = :id');
        return $req->execute([
            'role' => $nouveau_role,
            'id' => $id_utilisateur
        ]);
    }






}
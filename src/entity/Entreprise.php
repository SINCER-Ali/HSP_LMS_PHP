<?php

namespace entity;

use bdd\Bdd;

class Entreprise
{
    private $idEntreprise;
    private $nom;
    private $rue;
    private $cp;
    private $ville;
    public function __construct(array $donnee)
    {
        $this->hydrate($donnee);
    }

    public function hydrate(array $donnee)
    {
        foreach ($donnee as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
    public function __toString()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getIdEntreprise()
    {
        return $this->idEntreprise;
    }

    /**
     * @param mixed $idEntreprise
     */
    public function setIdEntreprise($idEntreprise)
    {
        $this->idEntreprise = $idEntreprise;
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
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * @param mixed $rue
     */
    public function setRue($rue)
    {
        $this->rue = $rue;
    }

    /**
     * @return mixed
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * @param mixed $cp
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    public function ajouter(){
        $bdd = new Bdd();
        $req = $bdd->getBdd()->prepare('INSERT INTO entreprise (nom, rue, cp, ville) VALUES (:nom, :rue, :cp, :ville)');

        $res = $req->execute(array(
            "nom" => $this->getNom(),
            "rue" => $this->getRue(),
            "cp" => $this->getCp(),
            "ville" => $this->getVille(),
        ));

        if ($res) {
            header("Location: ../../vue/accueil.php?success");
        } else {
            header("Location: ../../vue/ajout.php?erreur");
        }
    }
    public function editer(){
        $bdd = new Bdd();
        $req = $bdd->getBdd()->prepare('UPDATE entreprise SET nom=:nom,rue=:rue,cp=:cp,ville=:ville WHERE id_entreprise=:id_entreprise');
        $res = $req->execute(array(
            "nom" => $this->getNom(),
            "rue" => $this->getRue(),
            "cp" => $this->getCp(),
            "ville" => $this->getVille(),
            "id_entreprise" => $this->getIdEntreprise(),
        ));

        if ($res) {
            header("Location: ../../vue/accueil.php?success");
        } else {
            header("Location: ../../vue/edition.php?id_user=" . $this->getIdUtilisateur() . "&erreur");
        }
    }

    public function supprimer(){
        $bdd = new Bdd();
        $req = $bdd->getBdd()->prepare('DELETE FROM entreprise WHERE id_entreprise=:id_entreprise');
        $res = $req->execute(array(
            "id_entreprise" => $this->getIdEntreprise(),
        ));

        if ($res) {
            header("Location: ../../vue/accueil.php?success");
        } else {
            header("Location: ../../vue/connexion.php?erreur");
        }
    }
}
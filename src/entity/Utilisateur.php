<?php

namespace entity;
use Bdd;

class Utilisateur
{

    private $id_utilisateur;
    private $nom;
    private $prenom;
    private $email;
    private $mot_de_passe;
    private $profil;
    private $ref_etablissement;
    private $ref_hopital;
    private $ref_entreprise;
    private $ref_partenaire;

    public function __construct(array $donnee)
    {
        $this->hydrate($donnee);
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
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getMotDePasse()
    {
        return $this->mot_de_passe;
    }

    /**
     * @param mixed $mot_de_passe
     */
    public function setMotDePasse($mot_de_passe)
    {
        $this->mot_de_passe = $mot_de_passe;
    }

    /**
     * @return mixed
     */
    public function getProfil()
    {
        return $this->profil;
    }

    /**
     * @param mixed $profil
     */
    public function setProfil($profil)
    {
        $this->profil = $profil;
    }

    /**
     * @return mixed
     */
    public function getRefEtablissement()
    {
        return $this->ref_etablissement;
    }

    /**
     * @param mixed $ref_etablissement
     */
    public function setRefEtablissement($ref_etablissement)
    {
        $this->ref_etablissement = $ref_etablissement;
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
    public function getRefPartenaire()
    {
        return $this->ref_partenaire;
    }

    /**
     * @param mixed $ref_partenaire
     */
    public function setRefPartenaire($ref_partenaire)
    {
        $this->ref_partenaire = $ref_partenaire;
    }

    /**
     * @return mixed
     */


    public function hydrate(array $donnee)
    {
        foreach ($donnee as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }



    public function inscription()
    {
        $bdd = new Bdd();
        $req = $bdd->getBdd()->prepare('SELECT email FROM `user` WHERE email=:email');
        $req->execute(array(
            "email" => $this->getEmail()
        ));
        $res = $req->fetch();
        if (is_array($res)) {
            header("Location: ../../vue/inscription.php?erreur=0");
        } else {
            $req = $bdd->getBdd()->prepare('INSERT INTO `user`( `nom`, `prenom`, `email`, `mdp`,  `age`) VALUES ( :nom, :prenom, :email, :mdp, :age) ');
            $req->execute(array(
                'nom' => $this->getNom(),
                'prenom' => $this->getPrenom(),
                'age' => $this->getDate(),
                'email' => $this->getEmail(),
                'mdp' => $this->getMdp(),
            ));
            header("Location: ../../vue/inscription.php");
        }
    }

    public function connexion()
    {
        $bdd = new Bdd();
        $req = $bdd->getBdd()->prepare('SELECT * FROM `user` WHERE email=:email and mdp=:mdp');
        $req->execute(array(
            "email" => $this->getEmail(),
            "mdp" => $this->getMdp(),
        ));
        $res = $req->fetch();
        if (is_array($res)) {
            $this->setNom($res["nom"]);
            $this->setPrenom($res["prenom"]);
            $this->setDate($res["age"]);
            session_start();

            $_SESSION["user"] = $this;
            header("Location: ../../vue/accueil.php");
        } else {
            header("Location: ../../vue/connexion.php");
        }
    }

    public function editer()
    {
        $bdd = new Bdd();
        $req = $bdd->getBdd()->prepare('UPDATE User SET nom=:nom,prenom=:prenom,age=:age,email=:email WHERE id_user=:id_user');
        $res = $req->execute(array(
            "email" => $this->getEmail(),
            "age" => $this->getDate(),
            "prenom" => $this->getPrenom(),
            "nom" => $this->getNom(),
            "id_user" => $this->getIdUser(),
        ));

        if ($res) {
            header("Location: ../../vue/accueil.php?success");
        } else {
            header("Location: ../../vue/edition.php?id_user=" . $this->getIdUser() . "&erreur");
        }
    }

    public function supprimer()
    {
        $bdd = new Bdd();
        $req = $bdd->getBdd()->prepare('DELETE FROM User WHERE id_user=:id_user');
        $res = $req->execute(array(
            "id_user" => $this->getIdUser(),
        ));

        if ($res) {
            header("Location: ../../vue/accueil.php?success");
        } else {
            header("Location: ../../vue/connexion.php?erreur");
        }
    }
}
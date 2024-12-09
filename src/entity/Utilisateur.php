<?php

namespace entity;
require_once __DIR__ . '/../bdd/Bdd.php';
use bdd\Bdd;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include '../../vendor/autoload.php';
class Utilisateur
{

    private $id_utilisateur;
    private $nom;
    private $prenom;
    private $email;
    private $mdp;
    private $profil;
    private $ref_etablissement;
    private $ref_hopital;
    private $ref_entreprise;
    private $ref_partenaire;


    const ROLE_MEDECIN = 3;
    const ROLE_ETUDIANT = 1;
    const ROLE_PARTENAIRE = 2;
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
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * @param mixed $mdp
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
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
        if (in_array($profil, [self::ROLE_MEDECIN, self::ROLE_ETUDIANT, self::ROLE_PARTENAIRE])) {
            $this->profil = $profil;
        } else {
            throw new \InvalidArgumentException("Invalid profile: $profil");
        }
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
        $req = $bdd->getBdd()->prepare('SELECT email FROM `utilisateur` WHERE email=:email');
        $req->execute(array(
            "email" => $this->getEmail()
        ));
        $res = $req->fetch();
        if (is_array($res)) {
            header("Location:../../Hsp/Medilab/inscription.php ");
        } else {
            $hashedMdp = password_hash($this->getMdp(), PASSWORD_DEFAULT);

            $req = $bdd->getBdd()->prepare('INSERT INTO `utilisateur`( `nom`, `prenom`, `email`, `mot_de_passe`, `profil`  ) VALUES ( :nom, :prenom, :email, :mdp, :profil ) ');
            var_dump($this->getMdp());
            $req->execute(array(
                'nom' => $this->getNom(),
                'prenom' => $this->getPrenom(),
                'email' => $this->getEmail(),
                'mdp' => $hashedMdp,
                'profil' => $this->getProfil(),
            ));
            header("Location:../../Hsp/Medilab/connexion.php ");
        }

    }

    public function connexion()
    {
        $bdd = new Bdd();
        $req = $bdd->getBdd()->prepare('SELECT * FROM `utilisateur` WHERE email = :email');
        $req->execute(array("email" => $this->getEmail()));
        $res = $req->fetch();

        if ($res && password_verify($this->getMdp(), $res['mot_de_passe']))  {
            session_start();
            $_SESSION['id_utilisateur'] = $res['id_utilisateur'];
            $_SESSION['email'] = $res['email'];
            $_SESSION['nom'] = $res['nom'];
            $_SESSION['prenom'] = $res['prenom'];
            $_SESSION['profil'] = $res['profil'];
            return true;
        } else {
            return false;
        }
    }

    public function editer()
    {
        $bdd = new Bdd();
        $req = $bdd->getBdd()->prepare('UPDATE utilisateur SET nom=:nom,prenom=:prenom,email=:email WHERE id_utilisateur=:id_utilisateur');
        $res = $req->execute(array(
            "email" => $this->getEmail(),
            "prenom" => $this->getPrenom(),
            "nom" => $this->getNom(),
            "id_utilisateur" => $this->getIdUtilisateur(),
        ));

        if ($res) {
            header("Location: ../../vue/accueil.php?success");
        } else {
            header("Location: ../../vue/edition.php?id_user=" . $this->getIdUtilisateur() . "&erreur");
        }
    }

    public function supprimer()
    {
        $bdd = new Bdd();
        $req = $bdd->getBdd()->prepare('DELETE FROM utilisateur WHERE id_utilisateur=:id_utilisateur');
        $res = $req->execute(array(
            "id_utilisateur" => $this->getIdUtilisateur(),
        ));

        if ($res) {
            header("Location: ../../vue/accueil.php?success");
        } else {
            header("Location: ../../vue/connexion.php?erreur");
        }
    }
    public function oublierMdp($newPassword = null, $token = null)
    {
        $bdd = new Bdd();

        if ($newPassword && $token) {
            // Étape 3 : Réinitialisation du mot de passe
            $req = $bdd->getBdd()->prepare('SELECT * FROM utilisateur WHERE reset_token = :token AND reset_expire > NOW()');
            $req->execute(array("token" => $token));
            $res = $req->fetch();

            if ($res) {
                // Mettre à jour le mot de passe
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $updateReq = $bdd->getBdd()->prepare('UPDATE utilisateur SET mot_de_passe = :mdp, reset_token = NULL, reset_expire = NULL WHERE reset_token = :token');
                $updateReq->execute(array(
                    "mdp" => $hashedPassword,
                    "token" => $token,
                ));
                echo "Votre mot de passe a été réinitialisé avec succès.";
            } else {
                echo "Le lien de réinitialisation est invalide ou expiré.";
            }

        } else {
            // Étape 1 : Vérification de l'utilisateur et envoi d'e-mail
            $req = $bdd->getBdd()->prepare('SELECT * FROM utilisateur WHERE email = :email');
            $req->execute(array("email" => $this->getEmail()));
            $res = $req->fetch();

            if ($res) {
                // Générer un token unique
                $token = bin2hex(random_bytes(16));
                $expireTime = date('Y-m-d H:i:s', strtotime('+1 hour')); // Valable 1 heure

                // Stocker le token et l'expiration
                $updateReq = $bdd->getBdd()->prepare('UPDATE utilisateur SET reset_token = :token, reset_expire = :expire WHERE email = :email');
                $updateReq->execute(array(
                    "token" => $token,
                    "expire" => $expireTime,
                    "email" => $this->getEmail(),
                ));

                // Appeler la méthode d'envoi d'email
                $this->envoyerEmail($token);

            } else {
                echo "Aucun utilisateur trouvé avec cette adresse e-mail.";
            }
        }
    }



    public function envoyerEmail($token)
    {
        // Créer le lien de réinitialisation avec le token
        $resetLink = "http://localhost/Hsp/Medilab/mot_de_passe_oublie.php?token=" . $token;

        // Paramètres du mail
        $subject = "Réinitialisation de votre mot de passe";
        $message = "Bonjour,\n\nCliquez sur le lien ci-dessous pour réinitialiser votre mot de passe :\n" . $resetLink . "\n\nCe lien est valable pendant 1 heure.\n\nSi vous n'avez pas demandé cette réinitialisation, veuillez ignorer cet e-mail.";

        // Créer une instance de PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configuration du serveur SMTP
            $mail->isSMTP();                                      // Utiliser SMTP
            $mail->Host = 'smtp.gmail.com';                        // Serveur SMTP de Gmail
            $mail->SMTPAuth = true;                                // Authentification SMTP
            $mail->Username = 'phpmail092@gmail.com';             // Votre adresse e-mail
            $mail->Password = '2401066878cC!';                    // Votre mot de passe d'application
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;    // Sécuriser la connexion
            $mail->Port = 587;                                    // Port pour STARTTLS

            // Activation du débogage pour voir ce qui se passe
            $mail->SMTPDebug = 2;  // Affiche les messages de débogage
            $mail->Debugoutput = 'html';  // Affiche les messages en HTML

            // Destinataire
            $mail->setFrom('phpmail092@gmail.com', 'Nom de votre site');
            $mail->addAddress($this->getEmail());  // Ajouter l'adresse e-mail de l'utilisateur à qui envoyer le message

            // Contenu de l'e-mail
            $mail->isHTML(false);                                  // Envoyer l'e-mail en texte brut
            $mail->Subject = $subject;
            $mail->Body    = $message;

            // Envoi de l'e-mail
            if ($mail->send()) {
                echo "Un e-mail de réinitialisation a été envoyé à votre adresse.";
            } else {
                echo "L'envoi du mail a échoué.";
            }

        } catch (Exception $e) {
            echo "Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}";
        }
    }






}
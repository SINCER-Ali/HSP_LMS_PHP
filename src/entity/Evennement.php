<?php
namespace entity;

require_once __DIR__ . '/../bdd/Bdd.php';
use bdd\Bdd;

class Evennement
{
    private $id_evenement;
    private $titre;
    private $description;
    private $lieu;
    private $nb_places;
    private $date;

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

    // Getters
    public function getIdEvenement() { return $this->id_evenement; }
    public function getTitre() { return $this->titre; }
    public function getDescription() { return $this->description; }
    public function getLieu() { return $this->lieu; }
    public function getNbPlaces() { return $this->nb_places; }
    public function getDate() { return $this->date; }

    // Setters
    public function setIdEvenement($id_evenement) { $this->id_evenement = $id_evenement; }
    public function setTitre($titre) { $this->titre = $titre; }
    public function setDescription($description) { $this->description = $description; }
    public function setLieu($lieu) { $this->lieu = $lieu; }
    public function setNbPlaces($nb_places) { $this->nb_places = $nb_places; }
    public function setDate($date) { $this->date = $date; }

    public function ajouter()
    {
        try {
            $bdd = new Bdd();
            $req = $bdd->getBdd()->prepare('INSERT INTO evenement (titre, description, lieu, nb_places, date) VALUES (:titre, :description, :lieu, :nb_places, :date)');

            $success = $req->execute([
                'titre' => $this->titre,
                'description' => $this->description,
                'lieu' => $this->lieu,
                'nb_places' => $this->nb_places,
                'date' => $this->date
            ]);

            if (!$success) {
                throw new \Exception("Erreur lors de l'ajout de l'événement");
            }
            return true;
        } catch (\Exception $e) {
            throw new \Exception("Erreur lors de l'ajout de l'événement : " . $e->getMessage());
        }
    }

    public function getAllEvenements()
    {
        try {
            $bdd = new Bdd();
            $req = $bdd->getBdd()->query('SELECT * FROM evenement ORDER BY date DESC');
            return $req->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new \Exception("Erreur lors de la récupération des événements : " . $e->getMessage());
        }
    }
}
?>
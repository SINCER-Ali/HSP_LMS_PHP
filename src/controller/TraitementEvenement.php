<?php
session_start();
require_once __DIR__ . '/../entity/Evennement.php';
use entity\Evennement;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log("Données POST reçues : " . print_r($_POST, true));

    try {
        // Validation explicite de nb_places
        $nb_places = filter_var($_POST['nb_places'], FILTER_VALIDATE_INT);
        if ($nb_places === false) {
            throw new \InvalidArgumentException("Le nombre de places doit être un nombre entier valide");
        }

        $evenement = new Evennement([
            'titre' => $_POST['titre'],
            'description' => $_POST['description'],
            'lieu' => $_POST['lieu'],
            'nb_places' => $nb_places,
            'date' => $_POST['date']
        ]);

        if ($evenement->ajouter()) {
            $_SESSION['success_message'] = "L'événement a été créé avec succès.";
            header('Location: ../../Hsp/Medilab/starter-page.php#events');
            exit();
        }
    } catch (\Exception $e) {
        error_log("Erreur lors du traitement : " . $e->getMessage());
        $_SESSION['error_message'] = "Erreur lors de la création de l'événement : " . $e->getMessage();
        header('Location: ../../Hsp/Medilab/creer_evenement.php');
        exit();
    }
}
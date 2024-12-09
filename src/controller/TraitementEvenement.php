<?php
session_start();
require_once __DIR__ . '/../../src/entity/Evennement.php';
use entity\Evennement;

if (!isset($_SESSION['profil']) || $_SESSION['profil'] != 3) {
    header('Location: connexion.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $evenement = new Evennement([
            'titre' => $_POST['titre'],
            'description' => $_POST['description'],
            'lieu' => $_POST['lieu'],
            'nb_places' => $_POST['nb_places'],
            'date' => $_POST['date']
        ]);

        // Ajouter l'événement à la base de données
        if ($evenement->ajouter()) {
            $_SESSION['success_message'] = "L'événement a été créé avec succès.";
            header('Location: ../../Hsp/Medilab/starter-page.php#events');
            exit();
        }
    } catch (\Exception $e) {
        $_SESSION['error_message'] = $e->getMessage();
        header('Location: creer_evenement.php');
        exit();
    }
} else {
    // Si accès direct au fichier sans POST
    header('Location: creer_evenement.php');
    exit();
}
?>
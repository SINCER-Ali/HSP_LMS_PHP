<?php
session_start();
require_once __DIR__ . '/../../src/entity/Evennement.php';
use entity\Evennement;

if (!isset($_SESSION['profil']) || $_SESSION['profil'] != 3) {
    header('Location: ../../Hsp/Medilab/connexion.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $evenement = new Evennement([
        'titre' => $_POST['titre'],
        'description' => $_POST['description'],
        'lieu' => $_POST['lieu'],
        'nb_places' => $_POST['nb_places'],
        'date' => $_POST['date']
    ]);

    $evenement->ajouter();
    $_SESSION['success_message'] = "L'événement a été créé avec succès.";
    header('Location: ../../Hsp/Medilab/starter-page.php');
    exit();
} else {
    header('Location: ../../Hsp/Medilab/creer_evenement.php');
    exit();
}
?>
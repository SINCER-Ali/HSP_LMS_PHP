<?php
session_start();
require_once __DIR__ . '/../../src/entity/Evennement.php';
use entity\Evennement;

if (!isset($_SESSION['id_utilisateur'])) {
    $_SESSION['error_message'] = "Vous devez être connecté pour vous inscrire à un événement.";
    header('Location: connexion.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_evenement'])) {
    try {
        $evenement = new Evennement(['id_evenement' => $_POST['id_evenement']]);
        $evenement->chargerDetails(); // Chargement des détails de l'événement
        $evenement->inscrire($_SESSION['id_utilisateur']);
        $_SESSION['success_message'] = "Vous êtes inscrit à l'événement avec succès.";
    } catch (\Exception $e) {
        $_SESSION['error_message'] = $e->getMessage();
    }
    header('Location: starter-page.php#events');
    exit();
} else {
    $_SESSION['error_message'] = "Requête invalide.";
    header('Location: starter-page.php#events');
    exit();
}
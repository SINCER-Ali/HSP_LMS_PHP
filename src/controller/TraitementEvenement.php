<?php
require_once 'entity/Evennement.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $lieu = $_POST['lieu'];
    $nb_places = $_POST['nb_places'];

    $evenement = new Evennement(null, $titre, $description, $lieu, $nb_places);
    $evenement->ajouter();
}
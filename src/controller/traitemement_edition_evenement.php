<?php
require_once 'entity/Evennement.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_evenement = $_POST['id_evenement'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $lieu = $_POST['lieu'];
    $nb_places = $_POST['nb_places'];

    $evenement = new Evennement($id_evenement, $titre, $description, $lieu, $nb_places);
    $evenement->editer();
}
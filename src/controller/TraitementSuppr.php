21<?php

include '../bdd/Bdd.php';
include '../model/Utilisateur.php';

$user = new Utilisateur([
    "idUser" =>$_POST['id_utilisateur'],
]);
$user->supprimer();





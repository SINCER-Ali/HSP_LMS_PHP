<?php

include '../bdd/Bdd.php';
include '../model/Utilisateur.php';

$user = new Utilisateur([
    "idUser" =>$_POST['id_utilisateur'],
    "nom" =>$_POST['nom'],
    "prenom" =>$_POST['prenom'],
    "email" =>$_POST['email'],
]);
$user->editer();





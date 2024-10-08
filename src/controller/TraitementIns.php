<?php

use entity\Utilisateur;

include 'src/bdd/Bdd.php';
include '../entity/Utilisateur.php';

$user = new Utilisateur([
    "nom" =>$_POST['nom'],
    "prenom" =>$_POST['prenom'],
    "date" =>$_POST['age'],
    "email" =>$_POST['email'],
    "mdp" =>$_POST['mdp'],
]);

$user->inscription();
header("location: connection.html");






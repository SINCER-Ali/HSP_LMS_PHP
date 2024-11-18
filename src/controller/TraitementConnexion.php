<?php
use entity\Utilisateur;
include '../bdd/Bdd.php';
include '../entity/Utilisateur.php';

$user = new Utilisateur([
    "email" =>$_POST['email'],
    "mdp" =>$_POST['mdp'],
]);
$user->connexion();
header("Location: ../../Hsp/Medilab/starter-page.php ");


<?php
use entity\Utilisateur;
include '../bdd/Bdd.php';
include '../entity/Utilisateur.php';

if(array_key_exists(  "connexion", $_POST)){

    $user =new Utilisateur([
        'email'=>$_POST['email'],
        'mdp'=>$_POST['mdp']
 ]);
    $user->connexion();
    header('accueil.php');


}if(array_key_exists( "inscription", $_POST)){
    var_dump($_POST);
        $user = new  Utilisateur([
            'nom' =>$_POST['nom'],
            'prenom' =>$_POST['prenom'],
            'email' =>$_POST['email'],
            'mdp' =>$_POST['mdp'],
        ]);
        var_dump($user);
        $user->inscription();
}elseif (array_key_exists( 'edit', $_POST)){
         $user = new Utilisateur([
             "idUser" =>$_POST['id_user'],
             "nom" =>$_POST['nom'],
             "prenom" =>$_POST['prenom'],
             "email" =>$_POST['email'],
    ]);
            $user->editer();
}elseif (array_key_exists( "Confirmer",$_POST)){
         $user = new Utilisateur([
             "idUser" =>$_POST['id_utilisateur'],
    ]);
            $user->supprimer();
}elseif (array_key_exists("deconnexion",$_POST)){

};


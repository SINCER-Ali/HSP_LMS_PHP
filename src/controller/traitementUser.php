<?php
include '../bdd/Bdd.php';
include '../model/Utilisateur.php';

if(array_key_exists(  "connexion", $_POST)){

    $user =new Utilisateur([
        'email'=>$_POST['email'],
        'mdp'=>$_POST['mot_de_passe']
 ]);
    $user->connexion();
    header('accueil.php');


}elseif(array_key_exists( "ins", $_POST)){
        $user = new  Utilisateur([
            'nom' =>$_POST['nom'],
            'prenom' =>$_POST['prenom'],
            'email' =>$_POST['email'],
            'mdp' =>$_POST['mot_de_passe']
        ]);
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
}elseif (array_key_exists("deconnexion")){

};


<?php
$auteur = $_POST['auteur'];
$message = $_POST['sujet'];

try {
    include '../../src/bdd/Bdd.php';
    $bdd = new \bdd\Bdd();
    $pdo = $bdd->getBdd();

    $date_reponse = date("Y-m-d H:i:s");
    $stmt = $pdo->prepare(
        'INSERT INTO forum_reponse (auteur, message, date_reponse, ref_sujet) 
                    VALUES (:auteur, :message, :date_reponse, :ref_sujet)'
    );
    $stmt->execute([
        ':auteur' => $auteur,
        ':message' => $message,
        ':date_reponse' => $date_reponse,
        ':ref_sujet' => $_POST['sujet'],
    ]);

    $stmt_update = $pdo->prepare(
        'UPDATE forum_sujet SET date_derniere_reponse = :date_reponse WHERE id_sujet = :ref_sujet'
    );
    $stmt_update->execute([
        ':date_reponse' => $date_reponse,
        ':ref_sujet' => $_POST['sujet'],
    ]);


    header('Location: lire_sujet.php?id_sujet_a_lire=' . $_POST['sujet']);
    exit;

} catch (PDOException $e) {
    // Gestion des erreurs PDO
    $erreur = 'Erreur de base de données : ' . $e->getMessage();
}





?>

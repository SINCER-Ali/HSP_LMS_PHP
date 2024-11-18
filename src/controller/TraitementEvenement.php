<?php
session_start();
// Vérifier si l'utilisateur est connecté et est un médecin
if(!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'medecin') {
    header("Location: index.php");
    exit();
}

// Inclure le fichier de configuration de la base de données
include_once 'chemin/vers/votre/config.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $titre = $_POST['titre'];
    $lieu = $_POST['lieu'];
    $description = $_POST['description'];
    $nb_places = $_POST['nb_places'];
    $ref_medecin = $_SESSION['id_medecin']; // Utiliser l'ID du médecin connecté

    // Préparer la requête SQL
    $sql = "INSERT INTO evenements (titre, description, lieu, nb_places, ref_medecin) VALUES (?, ?, ?, ?, ?)";

    // Préparer et exécuter la requête
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssii", $titre, $description, $lieu, $nb_places, $ref_medecin);

        if ($stmt->execute()) {
            // Rediriger vers la page des événements avec un message de succès
            header("Location: index.php#events?success=1");
            exit();
        } else {
            echo "Erreur lors de la création de l'événement : " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erreur de préparation de la requête : " . $conn->error;
    }

    $conn->close();
} else {
    // Si quelqu'un accède directement à ce fichier sans soumettre le formulaire
    header("Location: index.php");
    exit();
}
?>
<?php
session_start();
require_once '../../src/bdd/Bdd.php';

// Vérifier si l'utilisateur est connecté et est un partenaire
if (!isset($_SESSION['id_utilisateur']) || $_SESSION['profil'] != 2) {
    header('Location: offres.php');
    exit();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $missions = $_POST['missions'];
    $salaire = $_POST['salaire'];
    $type = $_POST['type'];
    $etat = 'ouvert'; // Par défaut, l'offre est ouverte

    $bdd = new \bdd\Bdd();
    $req = $bdd->getBdd()->prepare('INSERT INTO offre (titre, description, missions, salaire, type, etat ) VALUES (:titre, :description, :missions, :salaire, :type, :etat)');

    $result = $req->execute([
        'titre' => $titre,
        'description' => $description,
        'missions' => $missions,
        'salaire' => $salaire,
        'type' => $type,
        'etat' => $etat

    ]);

    if ($result) {
        $message = "L'offre a été créée avec succès.";
    } else {
        $message = "Une erreur est survenue lors de la création de l'offre.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une offre - Medilab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Créer une nouvelle offre</h1>
    <?php if ($message): ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
    <?php endif; ?>
    <form method="POST" class="mt-4">
        <div class="mb-3">
            <label for="titre" class="form-label">Titre de l'offre</label>
            <input type="text" class="form-control" id="titre" name="titre" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="missions" class="form-label">Missions</label>
            <textarea class="form-control" id="missions" name="missions" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="salaire" class="form-label">Salaire</label>
            <input type="number" class="form-control" id="salaire" name="salaire" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Type de contrat</label>
            <select class="form-control" id="type" name="type" required>
                <option value="stage">Stage</option>
                <option value="alternance">Alternance</option>
                <option value="CDD">CDD</option>
                <option value="CDI">CDI</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Créer l'offre</button>
        <a href="offres.php" class="btn btn-secondary">Retour aux offres</a>
    </form>
</div>
</body>
</html>
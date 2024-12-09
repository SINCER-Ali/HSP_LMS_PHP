<?php
require_once '../../vendor/autoload.php';
require_once '../../src/bdd/Bdd.php';
require_once '../../src/entity/Utilisateur.php';

use bdd\Bdd;
use entity\Utilisateur;

// Connexion à la base de données
$bdd = new Bdd();


// Récupération des médecins
$req = $bdd->getBdd()->prepare("SELECT email, nom, prenom FROM utilisateur WHERE profil = :role_medecin");
$req->execute(['role_medecin' => Utilisateur::ROLE_MEDECIN]);
$medecins = $req->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Médecins</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Liste des Médecins</h2>
    <table id="medecinsTable" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Email</th>
            <th>Nom</th>
            <th>Prénom</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($medecins as $medecin): ?>
            <tr>
                <td><?= htmlspecialchars($medecin['email']) ?></td>
                <td><?= htmlspecialchars($medecin['nom']) ?></td>
                <td><?= htmlspecialchars($medecin['prenom']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#medecinsTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json"
            }
        });
    });
</script>
</body>
</html>
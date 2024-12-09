<?php
session_start();
require_once '../../src/bdd/Bdd.php';

// Récupération de la liste des médecins
$bdd = new \bdd\Bdd();
$req = $bdd->getBdd()->prepare('SELECT u.id_utilisateur, u.nom, u.prenom, u.email FROM utilisateur u WHERE u.profil = 3');
$req->execute();
$medecins = $req->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Liste des Médecins - Medilab</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Liste des Médecins</h2>

    <table id="medecinsTable" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($medecins as $medecin): ?>
            <tr>
                <td><?php echo htmlspecialchars($medecin['nom']); ?></td>
                <td><?php echo htmlspecialchars($medecin['prenom']); ?></td>
                <td><?php echo htmlspecialchars($medecin['email']); ?></td>
                <td>
                    <a href="../prendre_rendez_vous.php?medecin_id=<?php echo $medecin['id_utilisateur']; ?>"
                       class="btn btn-primary btn-sm">Prendre rendez-vous</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <a href="starter-page.php" class="btn btn-secondary mt-3">Retour au menu</a>
</div>

<script>
    $(document).ready(function() {
        $('#medecinsTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json'
            }
        });
    });
</script>

</body>
</html>

<?php
session_start();
require_once  '../../src/entity/Offre.php';
require_once  '../../src/entity/Utilisateur.php';


use entity\Offre;
use entity\Utilisateur;
use bdd\Bdd;

$bdd = new Bdd();

// Function to check if the user can apply (student or doctor)
function canApply($profil) {
    return $profil == Utilisateur::ROLE_ETUDIANT || $profil == Utilisateur::ROLE_MEDECIN;
}

// Function to check if the user is a partner
function isPartner($profil) {
    return $profil == Utilisateur::ROLE_PARTENAIRE;
}

// Handle job application
if (isset($_POST['apply']) && isset($_SESSION['id_utilisateur'])) {
    $offerId = $_POST['offer_id'];
    $userId = $_SESSION['id_utilisateur'];

    if (canApply($_SESSION['profil'])) {
        $stmt = $bdd->getBdd()->prepare("INSERT INTO postule (ref_utilisateur, ref_offre) VALUES (:userId, :offerId)");
        $stmt->execute([':userId' => $userId, ':offerId' => $offerId]);
        $message = "Candidature soumise avec succès!";
    } else {
        $message = "Vous n'êtes pas autorisé à postuler pour cette offre.";
    }
}

// Fetch all offers
$stmt = $bdd->getBdd()->query("SELECT * FROM offre WHERE etat = 'ouvert'");
$offers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Offres d'emploi - Medilab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
</head>
<body>

<main class="main">
    <div class="container" style="margin-top: 120px;">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title text-center">Offres d'emploi</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($message)): ?>
                            <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
                        <?php endif; ?>

                        <div class="table-responsive">
                            <table id="offersTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Description</th>
                                    <th>Missions</th>
                                    <th>Salaire</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($offers as $offer): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($offer['titre']); ?></td>
                                        <td><?php echo htmlspecialchars($offer['description']); ?></td>
                                        <td><?php echo htmlspecialchars($offer['missions']); ?></td>
                                        <td><?php echo htmlspecialchars($offer['salaire']); ?></td>
                                        <td><?php echo htmlspecialchars($offer['type']); ?></td>
                                        <td>
                                            <?php if (isset($_SESSION['id_utilisateur']) && canApply($_SESSION['profil'])): ?>
                                                <form method="post">
                                                    <input type="hidden" name="offer_id" value="<?php echo $offer['id_offre']; ?>">
                                                    <button type="submit" name="apply" class="btn btn-primary btn-sm">Postuler</button>
                                                </form>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            <a href="accueil.php" class="btn btn-secondary">Retour à l'accueil</a>
                            <?php if (isset($_SESSION['id_utilisateur']) && isPartner($_SESSION['profil'])): ?>
                                <a href="creer_offre.php" class="btn btn-success">Créer une offre</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('#offersTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json'
            }
        });
    });
</script>

</body>
</html>
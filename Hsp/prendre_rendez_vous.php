<?php
session_start();
require_once '../src/bdd/Bdd.php';

if (!isset($_GET['medecin_id'])) {
    header('Location: medecins.php');
    exit();
}

$medecin_id = $_GET['medecin_id'];

// Récupérer les informations du médecin
$bdd = new \bdd\Bdd();
$req = $bdd->getBdd()->prepare('SELECT nom, prenom FROM utilisateur WHERE id_utilisateur = :id');
$req->execute(['id' => $medecin_id]);
$medecin = $req->fetch(PDO::FETCH_ASSOC);

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $motif = $_POST['motif'];

    $req = $bdd->getBdd()->prepare('INSERT INTO rendez_vous (id_patient, id_medecin, date_rdv, heure_rdv, motif) VALUES (:patient, :medecin, :date, :heure, :motif)');
    $result = $req->execute([
        'patient' => $_SESSION['id_utilisateur'],
        'medecin' => $medecin_id,
        'date' => $date,
        'heure' => $heure,
        'motif' => $motif
    ]);

    if ($result) {
        header('Location: mes_rendez_vous.php?success=1');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Prendre Rendez-vous - Medilab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Prendre rendez-vous avec Dr. <?php echo htmlspecialchars($medecin['nom'] . ' ' . $medecin['prenom']); ?></h2>

    <form method="POST" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" required
                   min="<?php echo date('Y-m-d'); ?>">
        </div>

        <div class="mb-3">
            <label for="heure" class="form-label">Heure</label>
            <select class="form-control" id="heure" name="heure" required>
                <?php
                for ($h = 9; $h <= 17; $h++) {
                    printf('<option value="%02d:00">%02d:00</option>', $h, $h);
                    printf('<option value="%02d:30">%02d:30</option>', $h, $h);
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="motif" class="form-label">Motif de la consultation</label>
            <textarea class="form-control" id="motif" name="motif" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Confirmer le rendez-vous</button>
        <a href="medecins.php" class="btn btn-secondary">Retour à la liste</a>
    </form>
</div>

</body>
</html>

<?php
require_once 'entity/Evennement.php';

$id_evenement = $_GET['id'] ?? null;
if (!$id_evenement) {
    header('Location: liste_evenements.php');
    exit;
}

$evenement = new Evennement($id_evenement, null, null, null, null);
$event = $evenement->getEvenementById($id_evenement);

if (!$event) {
    header('Location: liste_evenements.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éditer un événement - Medilab</title>
    <!-- Incluez ici vos fichiers CSS -->
</head>
<body>
<div class="container">
    <h1>Éditer un événement</h1>
    <form action="traitement_edition_evenement.php" method="POST">
        <input type="hidden" name="id_evenement" value="<?php echo $event['id_evenement']; ?>">
        <div class="form-group">
            <label for="titre">Titre :</label>
            <input type="text" id="titre" name="titre" required class="form-control" value="<?php echo htmlspecialchars($event['titre']); ?>">
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea id="description" name="description" required class="form-control"><?php echo htmlspecialchars($event['description']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="lieu">Lieu :</label>
            <input type="text" id="lieu" name="lieu" required class="form-control" value="<?php echo htmlspecialchars($event['lieu']); ?>">
        </div>
        <div class="form-group">
            <label for="nb_places">Nombre de places :</label>
            <input type="number" id="nb_places" name="nb_places" required class="form-control" value="<?php echo htmlspecialchars($event['nb_places']); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour l'événement</button>
    </form>
</div>
<!-- Incluez ici vos fichiers JavaScript -->
</body>
</html>
<?php
require_once '../../src/bdd/Bdd.php';

$bdd = new Bdd();
$pdo = $bdd->getPDO();

$query = $pdo->query("SELECT * FROM evenement ORDER BY ordre ASC");
$evenements = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Événements</title>
</head>
<body>
<h1>Événements</h1>
<?php foreach ($evenements as $evenement): ?>
    <div>
        <h2><?= htmlspecialchars($evenement['titre']) ?></h2>
        <p><?= htmlspecialchars($evenement['description']) ?></p>
        <p>Lieu : <?= htmlspecialchars($evenement['lieu']) ?></p>
        <p>Date : <?= htmlspecialchars($evenement['date']) ?></p>
        <p>Places restantes : <?= $evenement['nb_places'] ?></p>
        <form action="../../src/controller/TraitementEvenement.php" method="post">
            <input type="hidden" name="id_evenement" value="<?= $evenement['id_evenement'] ?>">
            <?php if ($evenement['nb_places'] > 0): ?>
                <button type="submit" name="action" value="inscrire">S'inscrire</button>
            <?php else: ?>
                <p>Complet</p>
            <?php endif; ?>
            <button type="submit" name="action" value="desinscrire">Se désinscrire</button>
        </form>
    </div>
    <hr>
<?php endforeach; ?>
</body>
</html>

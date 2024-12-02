<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un événement - Medilab</title>
    <!-- Incluez ici vos fichiers CSS -->
</head>
<body>
<div class="container">
    <h1>Créer un nouvel événement</h1>
    <form action="traitement_evenement.php" method="POST">
        <div class="form-group">
            <label for="titre">Titre :</label>
            <input type="text" id="titre" name="titre" required class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea id="description" name="description" required class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="lieu">Lieu :</label>
            <input type="text" id="lieu" name="lieu" required class="form-control">
        </div>
        <div class="form-group">
            <label for="nb_places">Nombre de places :</label>
            <input type="number" id="nb_places" name="nb_places" required class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Créer l'événement</button>
    </form>
</div>
<!-- Incluez ici vos fichiers JavaScript -->
</body>
</html>
<?php
session_start();

if (!isset($_SESSION['profil']) || $_SESSION['profil'] != 3) {
    header('Location: connexion.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un événement - Medilab</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .header {
            background-color: #1977cc;
            padding: 15px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: white;
            margin: 0;
        }
        .header a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="datetime-local"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
        }
        .btn {
            background-color: #1977cc;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-secondary {
            background-color: #6c757d;
        }
        .breadcrumb {
            margin-bottom: 20px;
        }
        .breadcrumb a {
            color: #1977cc;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>Medilab</h1>
    <nav>
        <a href="starter-page.php">Accueil</a>
        <a href="starter-page.php#events">Événements</a>
    </nav>
</div>

<div class="container">
    <div class="breadcrumb">
        <a href="starter-page.php">Accueil</a> > Créer un événement
    </div>

    <h2>Créer un nouvel événement</h2>

    <?php
    if (isset($_SESSION['error_message'])) {
        echo '<div style="color: red; margin-bottom: 15px;">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
        unset($_SESSION['error_message']);
    }
    ?>

    <form action="../../src/controller/TraitementEvenement.php" method="POST">
        <div class="form-group">
            <label for="titre">Titre de l'événement</label>
            <input type="text" id="titre" name="titre" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" required></textarea>
        </div>

        <div class="form-group">
            <label for="lieu">Lieu</label>
            <input type="text" id="lieu" name="lieu" required>
        </div>

        <div class="form-group">
            <label for="date">Date de l'événement</label>
            <input type="datetime-local" id="date" name="date" required>
        </div>

        <div class="form-group">
            <label for="nb_places">Nombre de places disponibles</label>
            <input type="number" id="nb_places" name="nb_places" min="1" required>
        </div>

        <div style="text-align: center;">
            <button type="submit" class="btn">Créer l'événement</button>
            <a href="starter-page.php" class="btn btn-secondary" style="text-decoration: none;">Annuler</a>
        </div>
    </form>
</div>

<footer style="text-align: center; margin-top: 20px; padding: 20px;">
    <p>&copy; <?php echo date('Y'); ?> Medilab - Tous droits réservés</p>
</footer>
</body>
</html>
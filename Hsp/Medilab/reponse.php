<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une réponse</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
        }
        h1 {
            text-align: center;
            color: #007bff;
        }
        label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
            color: #333;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 50px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Ajouter une réponse</h1>

    <!-- Formulaire d'insertion d'une réponse -->
    <form action="afficher.php" method="post">
        <label for="auteur">Auteur :</label>
        <input type="text" name="auteur" maxlength="25" value="<?php echo isset($_POST['auteur']) ? htmlentities(trim($_POST['auteur']), ENT_QUOTES) : ''; ?>" required>

        <!-- Le sujet est transmis via POST pour garder la référence du sujet auquel on répond -->
        <input type="hidden" name="sujet" value="<?= $_POST['newreponse'] ?>">

        <label for="message">Message :</label>
        <textarea name="message" cols="50" rows="10" required><?php echo isset($_POST['message']) ? htmlentities(trim($_POST['message']), ENT_QUOTES) : ''; ?></textarea>

        <input type="submit" value="Poster">
    </form>

    <!-- Affichage des erreurs s'il y en a -->
    <?php if (isset($erreur)) : ?>
        <p class="error"><?php echo htmlspecialchars($erreur, ENT_QUOTES); ?></p>
    <?php endif; ?>
</div>

</body>
</html>

<?php
if (isset($_POST['go']) && $_POST['go'] == 'Poster') {
    if (!isset($_POST['auteur'], $_POST['titre'], $_POST['message'])) {
        $erreur = 'Les variables nécessaires au script ne sont pas définies.';
    } else {
        if (empty($_POST['auteur']) || empty($_POST['titre']) || empty($_POST['message'])) {
            $erreur = 'Au moins un des champs est vide.';
        } else {
            try {
                // Inclure et initialiser la connexion
                include '../../src/bdd/Bdd.php';
                $bdd = new \bdd\Bdd();
                $pdo = $bdd->getBdd(); // Récupération de l'instance PDO

                // Préparer et exécuter la requête pour insérer un sujet
                $date = date("Y-m-d H:i:s");
                $stmt = $pdo->prepare(
                    'INSERT INTO forum_sujets (auteur, titre, message, date_derniere_reponse) VALUES (:auteur, :titre, :message, :date)'
                );
                $stmt->execute([
                    ':auteur' => $_POST['auteur'],
                    ':titre' => $_POST['titre'],
                    ':message' => $_POST['message'],
                    ':date' => $date,
                ]);

                header('Location: forum.php');

            } catch (PDOException $e) {
                $erreur = 'Erreur de base de données : ' . $e->getMessage();
            }
        }
    }
}
?>

<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertion d'un nouveau sujet</title>
    <link href="assets/css/main.css" rel="stylesheet"> <!-- Assurez-vous que ce fichier existe et est bien relié -->
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
    <h1>Insérer un sujet</h1>

    <form action="insert_sujet.php" method="post">
        <label for="auteur">Auteur :</label>
        <input type="text" name="auteur" maxlength="30" value="<?php echo isset($_POST['auteur']) ? htmlentities(trim($_POST['auteur']), ENT_QUOTES) : ''; ?>">

        <label for="titre">Titre :</label>
        <input type="text" name="titre" maxlength="50" value="<?php echo isset($_POST['titre']) ? htmlentities(trim($_POST['titre']), ENT_QUOTES) : ''; ?>">

        <label for="message">Message :</label>
        <textarea name="message" rows="10"><?php echo isset($_POST['message']) ? htmlentities(trim($_POST['message']), ENT_QUOTES) : ''; ?></textarea>

        <input type="submit" name="go" value="Poster">
    </form>

    <?php
    if (isset($erreur)) {
        echo '<div class="error">' . htmlentities($erreur, ENT_QUOTES) . '</div>';
    }
    ?>
</div>

</body>
</html>

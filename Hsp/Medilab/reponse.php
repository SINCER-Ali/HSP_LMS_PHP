<?php
include '../../src/bdd/Bdd.php';

try {
    $bdd = new \bdd\Bdd();
    $pdo = $bdd->getBdd();

    // Vérifier si l'ID du sujet est passé en GET
    if (isset($_GET['id_sujet'])) {
        $id_sujet = $_GET['id_sujet'];
    } else {
        die("Le sujet est introuvable.");
    }

    // Récupérer les informations du sujet
    $stmt_sujet = $pdo->prepare('SELECT * FROM forum_sujets WHERE id_sujet = :id_sujet');
    $stmt_sujet->execute([':id_sujet' => $id_sujet]);
    $sujet = $stmt_sujet->fetch();

    if (!$sujet) {
        die("Le sujet demandé n'existe pas.");
    }

    // Traiter la soumission de la réponse
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $auteur = isset($_POST['auteur']) ? trim($_POST['auteur']) : '';
        $message = isset($_POST['message']) ? trim($_POST['message']) : '';

        if (empty($auteur) || empty($message)) {
            $erreur = "L'auteur et le message sont obligatoires.";
        } else {
            // Insérer la réponse dans la base de données
            $stmt_reponse = $pdo->prepare('
                INSERT INTO forum_reponse (ref_sujet, auteur, message, date_reponse)
                VALUES (:ref_sujet, :auteur, :message, NOW())
            ');
            $stmt_reponse->execute([
                ':ref_sujet' => $id_sujet,
                ':auteur' => $auteur,
                ':message' => $message,
            ]);

            // Rediriger vers la page du sujet après avoir ajouté la réponse
            header("Location: afficher.php?id_sujet=" . $id_sujet);
            exit;
        }
    }

    // Récupérer les réponses au sujet
    $stmt_reponses = $pdo->prepare('SELECT * FROM forum_reponse WHERE ref_sujet = :id_sujet ORDER BY date_reponse ASC');
    $stmt_reponses->execute([':id_sujet' => $id_sujet]);
    $reponses = $stmt_reponses->fetchAll();

} catch (PDOException $e) {
    $erreur = 'Erreur de base de données : ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Répondre au sujet - <?php echo htmlentities($sujet['titre']); ?></title>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center; /* Centre horizontalement */
            align-items: center;    /* Centre verticalement */
            height: 100vh;          /* Prend toute la hauteur de la fenêtre */
        }
        .container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 900px;
        }
        h1 {
            color: #007bff;
        }
        .message {
            background-color: #f1f1f1;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
            border-left: 4px solid #007bff;
        }
        .reponse {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
            border-left: 4px solid #17a2b8;
        }
        .reponse .auteur {
            font-weight: bold;
            color: #333;
        }
        .reponse .date {
            font-size: 0.85em;
            color: #777;
        }
        .reponse .message {
            font-size: 1em;
            color: #333;
        }
        .form-container {
            margin-top: 20px;
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

<div class="container">
    <h1><?php echo htmlentities($sujet['titre']); ?></h1>
    <p><strong>Auteur :</strong> <?php echo htmlentities($sujet['auteur']); ?> | <strong>Date de publication :</strong> <?php echo htmlentities($sujet['date_derniere_reponse']); ?></p>
    <div class="message">
        <p><strong>Message initial :</strong></p>
        <p><?php echo nl2br(htmlentities($sujet['message'])); ?></p>
    </div>

    <h2>Répondre au sujet</h2>

    <!-- Formulaire pour répondre au sujet -->
    <div class="form-container">
        <?php if (isset($erreur)): ?>
            <p class="error"><?php echo htmlentities($erreur); ?></p>
        <?php endif; ?>

        <form action="reponse.php?id_sujet=<?php echo $id_sujet; ?>" method="POST">
            <label for="auteur">Auteur :</label>
            <input type="text" name="auteur" maxlength="25" required>

            <label for="message">Message :</label>
            <textarea name="message" rows="6" required></textarea>

            <input type="submit" value="Envoyer la réponse">
        </form>
    </div>

    <h2>Réponses</h2>
    <?php if (empty($reponses)): ?>
        <p>Aucune réponse pour ce sujet.</p>
    <?php else: ?>
        <?php foreach ($reponses as $reponse): ?>
            <div class="reponse">
                <p class="auteur"><?php echo htmlentities($reponse['auteur']); ?> <span class="date">(le <?php echo htmlentities($reponse['date_reponse']); ?>)</span></p>
                <p class="message"><?php echo nl2br(htmlentities($reponse['message'])); ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

</body>
</html>
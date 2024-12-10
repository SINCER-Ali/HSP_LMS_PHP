<?php
include '../../src/bdd/Bdd.php';
try {
    $bdd = new \bdd\Bdd();
    $pdo = $bdd->getBdd();

    if (isset($_GET['id_sujet'])) {
        $id_sujet = $_GET['id_sujet'];
    } else {
        die("Le sujet est introuvable.");
    }

    $stmt_sujet = $pdo->prepare('SELECT * FROM forum_sujets WHERE id_sujet = :id_sujet');
    $stmt_sujet->execute([':id_sujet' => $id_sujet]);
    $sujet = $stmt_sujet->fetch();

    if (!$sujet) {
        die("Le sujet demandé n'existe pas.");
    }

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
    <title><?php echo htmlentities($sujet['titre']); ?> - Forum</title>
    <link href="assets/css/main.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .form-container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
            margin: 50px auto;
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
        .error {
            color: red;
            text-align: center;
            font-weight: bold;
        }
        .btn {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<!-- Barre de navigation -->
<header id="header" class="header sticky-top">
    <div class="container d-flex justify-content-between">
        <div class="logo">
            <h1><a href="../index.php" class="logo d-flex align-items-center me-auto">
                    <h1 class="sitename">Medilab</h1>
                </a></h1>
        </div>
        <nav class="navmenu">
            <ul>
                <li><a href="starter-page.php">Accueil</a></li>
                <li><a href="forum.php">Forum</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="container">
    <h1><?php echo htmlentities($sujet['titre']); ?></h1>

    <p><strong>Auteur :</strong> <?php echo htmlentities($sujet['auteur']); ?> <strong>Date de publication :</strong> <?php echo date('d-m-Y H:i', strtotime($sujet['date_derniere_reponse'])); ?></p>
    <div class="message">
        <p><strong>Message initial :</strong></p>
        <p><?php echo nl2br(htmlentities($sujet['message'])); ?></p>
    </div>

    <div class="action-buttons">
        <a href="reponse.php?id_sujet=<?php echo $id_sujet; ?>" class="btn">Répondre</a>
        <a href="forum.php" class="btn">Retour au forum</a>
    </div>
    <br>

    <h2>Réponses</h2>
    <?php if (empty($reponses)): ?>
        <p>Aucune réponse pour ce sujet.</p>
    <?php else: ?>
        <?php foreach ($reponses as $reponse): ?>
            <div class="reponse">
                <p class="auteur"><?php echo htmlentities($reponse['auteur']); ?> <span class="date">(le <?php echo date('d-m-Y H:i', strtotime($reponse['date_reponse'])); ?>)</span></p>
                <p class="message"><?php echo nl2br(htmlentities($reponse['message'])); ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

</body>
</html>

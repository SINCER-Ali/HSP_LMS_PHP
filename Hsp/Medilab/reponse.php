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

<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertion d'un nouveau sujet</title>
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
        input[type="submit"], .btn-back {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 50px;
            cursor: pointer;
            width: 100%;
            text-align: center;
            display: block;
            margin-top: 10px;
        }
        input[type="submit"]:hover, .btn-back:hover {
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

    <a href="forum.php" class="btn-back">Retour au forum</a>

    <?php
    if (isset($erreur)) {
        echo '<div class="error">' . htmlentities($erreur, ENT_QUOTES) . '</div>';
    }
    ?>
</div>

</body>
</html>


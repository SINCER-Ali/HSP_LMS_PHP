<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: connexion.php');
    exit;
}

if (isset($_POST['go']) && $_POST['go'] == 'Poster') {
    if (!isset($_POST['titre'], $_POST['message'])) {
        $erreur = 'Les variables nécessaires au script ne sont pas définies.';
    } else {
        if (empty($_POST['titre']) || empty($_POST['message'])) {
            $erreur = 'Au moins un des champs est vide.';
        } else {
            try {
                include '../../src/bdd/Bdd.php';
                $bdd = new \bdd\Bdd();
                $pdo = $bdd->getBdd();

                // Récupérer l'ID utilisateur depuis la session
                $id_utilisateur = $_SESSION['id_utilisateur'];

                // Préparer la requête pour récupérer le nom et le prénom de l'utilisateur
                $stmt = $pdo->prepare('SELECT nom, prenom FROM utilisateur WHERE id_utilisateur = :id_utilisateur');
                $stmt->execute([':id_utilisateur' => $id_utilisateur]);
                $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($utilisateur) {
                    // Combiner le nom et le prénom pour l'auteur
                    $auteur = $utilisateur['nom'] . ' ' . $utilisateur['prenom'];
                } else {
                    $erreur = 'Utilisateur introuvable.';
                }

                // Préparer et exécuter la requête pour insérer un sujet
                $date = date("Y-m-d H:i:s");
                $stmt = $pdo->prepare(
                    'INSERT INTO forum_sujets (auteur, titre, message, date_derniere_reponse) VALUES (:auteur, :titre, :message, :date)'
                );
                $stmt->execute([
                    ':auteur' => $auteur,
                    ':titre' => $_POST['titre'],
                    ':message' => $_POST['message'],
                    ':date' => $date,
                ]);

                // Redirection après l'insertion
                header('Location: forum.php');
                exit;

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
    <h1>Nouveau post</h1>

    <form action="insert_sujet.php" method="post">
        <!-- Le champ auteur a été supprimé -->
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

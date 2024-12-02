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

<html>
<head>
    <title>Insertion d'un nouveau sujet</title>
</head>
<body>
<form action="insert_sujet.php" method="post">
    <table>
        <tr>
            <td><strong>Auteur :</strong></td>
            <td>
                <input type="text" name="auteur" maxlength="30" size="50"
                       value="<?php echo isset($_POST['auteur']) ? htmlentities(trim($_POST['auteur']), ENT_QUOTES) : ''; ?>">
            </td>
        </tr>
        <tr>
            <td><strong>Titre :</strong></td>
            <td>
                <input type="text" name="titre" maxlength="50" size="50"
                       value="<?php echo isset($_POST['titre']) ? htmlentities(trim($_POST['titre']), ENT_QUOTES) : ''; ?>">
            </td>
        </tr>
        <tr>
            <td><strong>Message :</strong></td>
            <td>
                <textarea name="message" cols="50" rows="10"><?php echo isset($_POST['message']) ? htmlentities(trim($_POST['message']), ENT_QUOTES) : ''; ?></textarea>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="right">
                <input type="submit" name="go" value="Poster">
            </td>
        </tr>
    </table>
</form>

<?php
if (isset($erreur)) {
    echo '<br><br>' . htmlentities($erreur, ENT_QUOTES);
}
?>

</body>
</html>
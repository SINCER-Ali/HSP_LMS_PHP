<?php
$numero_du_sujet = isset($_GET['numero_du_sujet']) ? intval($_GET['numero_du_sujet']) : 0;

if ($numero_du_sujet <= 0) {
    $erreur = 'Le paramètre "Sujet" est manquant ou invalide.';
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['go']) && $_POST['go'] === 'Poster') {
        $auteur = isset($_POST['auteur']) ? htmlspecialchars(trim($_POST['auteur']), ENT_QUOTES) : null;
        $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message']), ENT_QUOTES) : null;

        if (empty($auteur)) {
            $erreur = 'Le champ "Auteur" est obligatoire.';
        } elseif (empty($message)) {
            $erreur = 'Le champ "Message" est obligatoire.';
        } else {
            try {
                // Inclusion de la classe de connexion à la base de données
                include '../../src/bdd/Bdd.php';
                $bdd = new \bdd\Bdd();
                $pdo = $bdd->getBdd();

                // Ajout de la réponse dans la table `forum_reponse`
                $date_reponse = date("Y-m-d H:i:s");
                $stmt = $pdo->prepare(
                    'INSERT INTO forum_reponse (auteur, message, date_reponse, correspondance_sujet) 
                     VALUES (:auteur, :message, :date_reponse, :correspondance_sujet)'
                );
                $stmt->execute([
                    ':auteur' => $auteur,
                    ':message' => $message,
                    ':date_reponse' => $date_reponse,
                    ':correspondance_sujet' => $numero_du_sujet,
                ]);

                // Mise à jour de la date de dernière réponse dans la table `forum_sujets`
                $stmt_update = $pdo->prepare(
                    'UPDATE forum_sujets SET date_derniere_reponse = :date_reponse WHERE id_sujet = :correspondance_sujet'
                );
                $stmt_update->execute([
                    ':date_reponse' => $date_reponse,
                    ':correspondance_sujet' => $numero_du_sujet,
                ]);

                // Redirection après succès
                header('Location: lire_sujet.php?id_sujet_a_lire=' . $numero_du_sujet);
                exit;

            } catch (PDOException $e) {
                // Gestion des erreurs de la base de données
                $erreur = 'Erreur de base de données : ' . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une réponse</title>
</head>
<body>
<form action="insert_reponse.php?numero_du_sujet=<?php echo htmlspecialchars($_GET['numero_du_sujet'] ?? '', ENT_QUOTES); ?>" method="post">
    <table>
        <tr>
            <td><strong>Auteur :</strong></td>
            <td>
                <input type="text" name="auteur" maxlength="25" size="50"
                       value="<?php echo htmlspecialchars($_POST['auteur'] ?? '', ENT_QUOTES); ?>">
            </td>
        </tr>
        <tr>
            <td><strong>Message :</strong></td>
            <td>
                <textarea name="message" cols="50" rows="10"><?php echo htmlspecialchars($_POST['message'] ?? '', ENT_QUOTES); ?></textarea>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="right">
                <input type="submit" name="go" value="Poster">
            </td>
        </tr>
    </table>
</form>

<?php if (isset($erreur)) : ?>
    <p style="color: red;"><?php echo htmlspecialchars($erreur, ENT_QUOTES); ?></p>
<?php endif; ?>
</body>
</html>

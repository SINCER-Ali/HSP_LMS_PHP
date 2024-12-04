

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une réponse</title>
</head>
<body>
<!-- Formulaire d'insertion d'une réponse -->
<form action="insert_reponse.php" method="post">
    <table>
        <tr>
            <td><strong>Auteur :</strong></td>
            <td>
                <input type="text" name="auteur" maxlength="25" size="50" required>
                <input type="text" name="sujet" hidden="hidden" value="<?= $_POST['newreponse'] ?>">
            </td>
        </tr>
        <tr>
            <td><strong>Message :</strong></td>
            <td>
                <textarea name="message" cols="50" rows="10" required></textarea>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="right">
                <input type="submit" value="Poster">

            </td>
        </tr>
    </table>
</form>

<!-- Affichage des erreurs s'il y en a -->
<?php if (isset($erreur)) : ?>
<p style="color: red;"><?php echo htmlspecialchars($erreur, ENT_QUOTES); ?></p>
<?php endif; ?>
</body>
</html>
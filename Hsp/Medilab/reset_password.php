<?php
if (isset($_GET["email"]) && filter_var($_GET["email"], FILTER_VALIDATE_EMAIL)) {
    $email = $_GET["email"];

    // Si le formulaire est soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $new_password = $_POST["new_password"];
        $confirm_password = $_POST["confirm_password"];

        // Vérifie si les mots de passe correspondent
        if ($new_password == $confirm_password) {
            echo "Votre mot de passe a été réinitialisé.";
            // Vous devez ajouter ici le code pour mettre à jour le mot de passe dans votre base de données
        } else {
            echo "Les mots de passe ne correspondent pas.";
        }
    }
} else {
    echo "L'email est invalide.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Réinitialisation du mot de passe</title>
</head>
<body>
<h2>Réinitialiser le mot de passe</h2>
<form method="POST" action="reset_password.php?email=<?php echo urlencode($email); ?>">
    <label for="new_password">Nouveau mot de passe :</label>
    <input type="password" name="new_password" required><br>

    <label for="confirm_password">Confirmer le mot de passe :</label>
    <input type="password" name="confirm_password" required><br>

    <button type="submit">Réinitialiser le mot de passe</button>
</form>
</body>
</html>

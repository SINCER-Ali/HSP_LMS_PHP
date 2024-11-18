<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Vérifie si l'email est valide
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // URL de réinitialisation
        $reset_link = "http://localhost/HSP_LMS_PHP/Hsp/Medilab/reset_password.php?email=" . urlencode($email);

        // Message de l'email
        $message = "Cliquez sur ce lien pour réinitialiser votre mot de passe : " . $reset_link;
        $subject = "Réinitialisation du mot de passe";

        // Envoi de l'email
        mail($email, $subject, $message);

        echo "Un email a été envoyé pour réinitialiser votre mot de passe.";
    } else {
        echo "L'email que vous avez entré n'est pas valide.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Réinitialisation du mot de passe</title>
</head>
<body>
<h2>Demander la réinitialisation du mot de passe</h2>
<form method="POST" action="reset_password_request.php">
    <label for="email">Entrez votre e-mail :</label>
    <input type="email" name="email" id="email" required>
    <button type="submit">Envoyer le lien</button>
</form>
</body>
</html>

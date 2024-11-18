<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
</head>
<body>
<h2>Réinitialiser votre mot de passe</h2>

<?php
// Inclure les fichiers nécessaires
include '../../src/entity/Utilisateur.php';
include '../../src/bdd/Bdd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    // Récupérer l'email du formulaire
    $email = $_POST['email'];

    // Créer un objet Utilisateur avec l'email
    $utilisateur = new \entity\Utilisateur(array(
        "email" => $email,
    ));

    // Appeler la méthode oublierMdp pour envoyer l'email avec le token
    $utilisateur->oublierMdp();
}

if (isset($_GET['token'])) {
    // Si un token est passé dans l'URL, l'utilisateur souhaite réinitialiser son mot de passe
    $token = $_GET['token'];

    ?>

    <h3>Réinitialiser votre mot de passe</h3>
    <form method="POST" action="mot_de_passe_oublie.php?token=<?php echo $token; ?>">
        <label for="new_password">Nouveau mot de passe :</label>
        <input type="password" id="new_password" name="new_password" placeholder="Entrez votre nouveau mot de passe" required>
        <button type="submit">Réinitialiser le mot de passe</button>
    </form>

    <?php
} else {
    // Si pas de token, afficher le formulaire pour demander l'email
    ?>

    <p>Entrez votre adresse e-mail, nous vous enverrons un lien pour réinitialiser votre mot de passe.</p>
    <form method="POST" action="mot_de_passe_oublie.php">
        <label for="email">Adresse e-mail :</label>
        <input type="email" id="email" name="email" placeholder="Entrez votre e-mail" required>
        <button type="submit">Envoyer le lien de réinitialisation</button>
    </form>

    <?php
}
?>

</body>
</html>

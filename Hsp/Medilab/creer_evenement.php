<?php
session_start();
// Vérifier si l'utilisateur est connecté et est un médecin
if(!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'medecin') {
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un événement - Medilab</title>
    <!-- Inclure les mêmes fichiers CSS que votre page principale -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
</head>
<body>
<main id="main">
    <section class="section">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Créer un nouvel événement</h2>
                <p>Remplissez le formulaire ci-dessous pour ajouter un nouvel événement</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8 mt-5 mt-lg-0">
                    <form action="traitement_evenement.php" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="titre" class="form-control" id="titre" placeholder="Titre de l'événement" required>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="text" class="form-control" name="lieu" id="lieu" placeholder="Lieu de l'événement" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="description" rows="5" placeholder="Description de l'événement" required></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <input type="number" class="form-control" name="nb_places" id="nb_places" placeholder="Nombre de places disponibles" required>
                        </div>
                        <input type="hidden" name="ref_medecin" value="<?php echo $_SESSION['id_medecin']; ?>">
                        <div class="my-3">
                            <div class="loading">Chargement</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Votre événement a été créé avec succès!</div>
                        </div>
                        <div class="text-center"><button type="submit">Créer l'événement</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Inclure les mêmes fichiers JS que votre page principale -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
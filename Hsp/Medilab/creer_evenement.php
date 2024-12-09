<?php
session_start();

// Vérifier si l'utilisateur est connecté et est un médecin
if (!isset($_SESSION['profil']) || $_SESSION['profil'] != 3) {
    header('Location: connexion.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Créer un événement - Medilab</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center me-auto me-lg-0">
            <h1>Medilab</h1>
        </a>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a href="starter-page.php">Accueil</a></li>
                <li><a href="starter-page.php#events">Événements</a></li>
            </ul>
        </nav>
    </div>
</header>

<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Créer un événement</h2>
                <ol>
                    <li><a href="starter-page.php">Accueil</a></li>
                    <li>Créer un événement</li>
                </ol>
            </div>
        </div>
    </div>

    <!-- ======= Create Event Section ======= -->
    <section class="create-event section">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body p-4">
                            <h3 class="card-title text-center mb-4">Créer un nouvel événement</h3>

                            <form action="traitement_evenement.php" method="POST" class="needs-validation" novalidate>
                                <div class="mb-3">
                                    <label for="titre" class="form-label">Titre de l'événement</label>
                                    <input type="text" class="form-control" id="titre" name="titre" required>
                                    <div class="invalid-feedback">
                                        Veuillez entrer un titre pour l'événement.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                                    <div class="invalid-feedback">
                                        Veuillez entrer une description pour l'événement.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="lieu" class="form-label">Lieu</label>
                                    <input type="text" class="form-control" id="lieu" name="lieu" required>
                                    <div class="invalid-feedback">
                                        Veuillez entrer le lieu de l'événement.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="date" class="form-label">Date de l'événement</label>
                                    <input type="datetime-local" class="form-control" id="date" name="date" required>
                                    <div class="invalid-feedback">
                                        Veuillez sélectionner la date et l'heure de l'événement.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="nb_places" class="form-label">Nombre de places disponibles</label>
                                    <input type="number" class="form-control" id="nb_places" name="nb_places" min="1" required>
                                    <div class="invalid-feedback">
                                        Veuillez entrer le nombre de places disponibles.
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Créer l'événement</button>
                                    <a href="starter-page.php" class="btn btn-secondary ms-2">Annuler</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>

<!-- Form Validation Script -->
<script>
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
</body>
</html>
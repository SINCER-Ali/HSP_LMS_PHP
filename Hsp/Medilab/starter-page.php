<?php
session_start();
require_once __DIR__ . '/../../src/entity/Evennement.php';
require_once __DIR__ . '/../../src/entity/Profil.php';
use entity\Evennement;
use entity\Profil;

if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: connexion.php');
    exit();
}
// Récupération du rôle actuel
$profil = new Profil();
$user_role = $profil->getRoleById($_SESSION['id_utilisateur']);
$_SESSION['role'] = $user_role['profil'];

// Récupération des événements
$evenement = new Evennement([]);
$evenements = $evenement->getAllEvenements();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Accueil - Medilab</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="starter-page-page">

<header id="header" class="header sticky-top">
    <div class="topbar d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i>
                <i class="bi bi-phone d-flex align-items-cenater ms-4"><span>+1 5589 55488 55</span></i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </div>

    <div class="branding d-flex align-items-center">
        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="starter-page.php" class="logo d-flex align-items-center me-auto">
                <h1 class="sitename">Medilab</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero">Accueil<br></a></li>
                    <li><a href="forum.php">Forum</a></li>
                    <li><a href="#about">À propos</a></li>
                    <li><a href="offres.php">Offres</a></li>
                    <li><a href="#departments">Départements</a></li>
                    <li><a href="medecins.php">Médecins</a></li>
                    <li class="dropdown"><a href="#"><span>Profil</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="profil.php">Profil</a></li>
                            <li><a href="#">Option 2</a></li>
                            <li><a href="#">Option 3</a></li>
                            <?php if (isset($_SESSION['id_utilisateur']) && $_SESSION['id_utilisateur'] != null) { ?>
                                <li><a href="logout.php">Déconnexion</a></li>
                            <?php } else { ?>
                                <li><a href="connexion.php">Se connecter</a></li>
                            <?php } ?>

                            <li class="dropdown"><a href="#"><span>Sous-menu</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                                <ul>
                                    <li><a href="#">Sous-option 1</a></li>
                                    <li><a href="#">Sous-option 2</a></li>
                                    <li><a href="#">Sous-option 3</a></li>
                                    <li><a href="#">Sous-option 4</a></li>
                                    <li><a href="#">Sous-option 5</a></li>
                                </ul>
                            </li>

                        </ul>
                    </li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="cta-btn d-none d-sm-block" href="medecins.php">Prendre un rendez-vous</a>
            <div class="dropdown">

                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>
        </div>
</header>

<main class="main">
    <!-- Section Événements -->
    <section id="events" class="events section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Événements à venir</h2>
            <p>Découvrez nos prochains événements et inscrivez-vous dès maintenant</p>
        </div>

        <div class="container">
            <div class="row gy-4">
                <?php if (!empty($evenements)): ?>
                    <?php foreach ($evenements as $event): ?>
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="bi bi-calendar"></i> <?php echo htmlspecialchars($event['titre'] ?? ''); ?>
                                    </h5>
                                    <p class="card-text"><?php echo htmlspecialchars($event['description'] ?? ''); ?></p>
                                    <p><i class="bi bi-geo-alt"></i> <?php echo htmlspecialchars($event['lieu'] ?? ''); ?></p>
                                    <p><i class="bi bi-people"></i> <?php echo htmlspecialchars($event['nb_places'] ?? ''); ?> places disponibles</p>
                                    <p><i class="bi bi-clock"></i> <?php echo htmlspecialchars($event['date'] ?? ''); ?></p>
                                    <a href="inscription_evenement.php?id=<?php echo $event['id_evenement'] ?? ''; ?>" class="btn btn-primary">S'inscrire</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <p>Aucun événement n'est prévu pour le moment.</p>
                    </div>
                <?php endif; ?>
            </div>

            <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 3): ?>
                <div class="text-center mt-4">
                    <a href="creer_evenement.php" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Créer un événement
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <!-- Fin Section Événements -->

    <section id="starter-section" class="starter-section section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Section de démarrage</h2>
            <p>Utilisez cette page comme point de départ pour vos propres pages personnalisées.</p>
        </div>

        <div class="container" data-aos="fade-up">
            <p>Contenu de votre section de démarrage ici.</p>
        </div>
    </section>
</main>

<footer id="footer" class="footer light-background">
    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="starter-page.php" class="logo d-flex align-items-center">
                    <span class="sitename">Medilab</span>
                </a>
                <div class="footer-contact pt-3">
                    <p>123 Rue Exemple</p>
                    <p>Paris, 75000</p>
                    <p class="mt-3"><strong>Téléphone:</strong> <span>+33 1 23 45 67 89</span></p>
                    <p><strong>Email:</strong> <span>contact@medilab.fr</span></p>
                </div>
                <div class="social-links d-flex mt-4">
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Liens utiles</h4>
                <ul>
                    <li><a href="#">Accueil</a></li>
                    <li><a href="forum.php">Forum</a></li>
                    <li><a href="#">À propos</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Conditions d'utilisation</a></li>
                    <li><a href="#">Politique de confidentialité</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Nos services</h4>
                <ul>
                    <li><a href="#">Consultations</a></li>
                    <li><a href="#">Examens médicaux</a></li>
                    <li><a href="#">Chirurgie</a></li>
                    <li><a href="#">Suivi médical</a></li>
                    <li><a href="#">Téléconsultation</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Informations</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Carrières</a></li>
                    <li><a href="#">Partenaires</a></li>
                    <li><a href="#">Actualités</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Ressources</h4>
                <ul>
                    <li><a href="#">Blog santé</a></li>
                    <li><a href="#">Guides pratiques</a></li>
                    <li><a href="#">Vidéos éducatives</a></li>
                    <li><a href="#">Newsletter</a></li>
                    <li><a href="#">Témoignages</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">Medilab</strong> <span>Tous droits réservés</span></p>
        <div class="credits">
            Conçu par <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>
</footer>

<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var profileDropdown = document.getElementById('profileDropdown');
        var dropdownToggle = profileDropdown.querySelector('.dropdown-toggle');
        var dropdownMenu = profileDropdown.querySelector('.dropdown-menu');

        dropdownToggle.addEventListener('click', function(event) {
            event.preventDefault();
            event.stopPropagation();

            // Toggle the 'show' class on the dropdown menu
            dropdownMenu.classList.toggle('show');
        });

        // Close the dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!profileDropdown.contains(event.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var profileDropdownBtn = document.getElementById('profileDropdownBtn');
        var profileDropdownMenu = document.getElementById('profileDropdownMenu');

        profileDropdownBtn.addEventListener('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
            profileDropdownMenu.classList.toggle('show');
        });

        document.addEventListener('click', function(event) {
            if (!event.target.matches('#profileDropdownBtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-menu");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        });
    });
</script>


</body>

</html>
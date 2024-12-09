<!DOCTYPE html>
<html lang="en">

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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

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

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fc;
        }

        header {
            background-color: #007bff;
            padding: 10px 0;
            color: white;
        }

        header .logo h1 {
            font-size: 28px;
            color: white;
        }

        .main {
            padding: 40px 20px;
        }

        /* Table styling */
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .table-container {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-color: white;
            overflow: hidden;
            margin-top: 20px;
        }

        /* Button styling */
        .btn {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .new-post-button {
            display: block;
            margin: 20px auto;
            width: fit-content;
            text-decoration: none;
        }

        /* Footer styling */
        footer {
            background-color: #222222;
            color: white;
            padding: 40px 0;
            margin-top: 40px;
        }

        footer a {
            color: white;
            text-decoration: none;
        }

        footer .social-links i {
            margin: 0 10px;
            font-size: 20px;
        }

        footer .credits {
            font-size: 14px;
            margin-top: 20px;
        }
    </style>
</head>

<body>

<header id="header" class="header sticky-top">
    <div class="container d-flex justify-content-between">
        <div class="logo">
            <h1>Medilab</h1>
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

<main class="main">

    <h2 class="text-center mb-4">Forum Medilab</h2>

    <div class="table-container">
        <table id="myTable" class="display">
            <thead>
            <tr>
                <th>Auteur</th>
                <th>Titre</th>
                <th>Message</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            include '../../src/bdd/Bdd.php';
            $bdd = new \bdd\Bdd();
            $sql = 'SELECT id_sujet, auteur, titre, message, date_derniere_reponse FROM forum_sujets ORDER BY date_derniere_reponse DESC';
            $req = $bdd->getBdd()->prepare($sql);
            $req->execute();
            $result = $req->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $item) {
                ?>
                <tr>
                    <td><?php echo $item['auteur']; ?></td>
                    <td><?php echo $item['titre']; ?></td>
                    <td><?php echo $item['message']; ?></td>
                    <td><?php echo date("d-m-Y H:i", strtotime($item['date_derniere_reponse'])); ?></td>
                    <td>
                        <form action="afficher.php" method="post" style="display:inline-block;">
                            <input type="text" name="newreponse" value="<?= $item['id_sujet']; ?>" hidden>
                            <input type="submit" value="Afficher le sujet" class="btn">
                        </form>
                        <form action="reponse.php" method="post" style="display:inline-block;">
                            <input type="text" name="newreponse" value="<?= $item['id_sujet']; ?>" hidden>
                            <input type="submit" value="Répondre" class="btn">
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>

    <a href="./insert_sujet.php" class="new-post-button">
        <button class="btn">Nouveau post</button>
    </a>

</main>

<footer id="footer" class="footer">
    <div class="container">
        <div class="row gy-4">
            <div class="col-md-6">
                <p>&copy; 2024 Medilab. Tous droits réservés.</p>
            </div>
            <div class="col-md-6 text-end">
                <div class="social-links">
                    <a href="#"><i class="bi bi-twitter"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>

<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>

</body>

</html>

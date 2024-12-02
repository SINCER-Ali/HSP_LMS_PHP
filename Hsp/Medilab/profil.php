

<?php
include '../../src/entity/Utilisateur.php';
require_once  '../../vendor/autoload.php';

session_start(); // Assure-toi que la session est démarrée



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Profil - Medilab</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">


</head>
<body>

<!-- Barre de navigation ou header -->
<main class="main">
    <div class="container" style="margin-top: 120px;">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title text-center">Mon Profil</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="profileTable" class="table table-bordered table-striped">
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                </tr>
                                <tr>
                                    <th><?= $_SESSION['user']->getIdUtilisateur() ?></th>
                                    <th><?= $_SESSION['user']->getNom() ?></th>
                                    <th><?= $_SESSION['user']->getPrenom() ?></th>
                                    <th><?= $_SESSION['user']->getEmail() ?></th>
                                    <th><?= $_SESSION['user']->getProfil() ?></th>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Bootstrap JS -->

</body>
</html>

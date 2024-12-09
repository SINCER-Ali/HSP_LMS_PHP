<?php
include '../../src/entity/Utilisateur.php';
require_once  '../../vendor/autoload.php';

session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Profil - Medilab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>

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
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td><?= $_SESSION['id_utilisateur'] ?></td>
                                    <td><?= $_SESSION['nom'] ?></td>
                                    <td><?= $_SESSION['prenom'] ?></td>
                                    <td><?= $_SESSION['email']?></td>
                                    <td><?= $_SESSION['profil'] ?></td>
                                    <td>
                                        <a href="modifier_profil.php" class="btn btn-primary btn-sm">Modifier</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>


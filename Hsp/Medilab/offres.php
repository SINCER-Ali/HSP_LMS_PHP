<?php
session_start();
require_once  '../../src/entity/Offre.php';
require_once  '../../src/entity/Utilisateur.php';


use entity\Offre;
use entity\Utilisateur;
use bdd\Bdd;

$bdd = new Bdd();

// Function to check if the user can apply (student or doctor)
function canApply($profil) {
    return $profil == Utilisateur::ROLE_ETUDIANT || $profil == Utilisateur::ROLE_MEDECIN;
}

// Function to check if the user is a partner
function isPartner($profil) {
    return $profil == Utilisateur::ROLE_PARTENAIRE;
}

// Handle job application
if (isset($_POST['apply']) && isset($_SESSION['id_utilisateur'])) {
    $offerId = $_POST['offer_id'];
    $userId = $_SESSION['id_utilisateur'];

    if (canApply($_SESSION['profil'])) {
        $stmt = $bdd->getBdd()->prepare("INSERT INTO postule (ref_utilisateur, ref_offre) VALUES (:userId, :offerId)");
        $stmt->execute([':userId' => $userId, ':offerId' => $offerId]);
        $message = "Candidature soumise avec succès!";
    } else {
        $message = "Vous n'êtes pas autorisé à postuler pour cette offre.";
    }
}

// Handle offer creation
if (isset($_POST['create_offer']) && isset($_SESSION['id_utilisateur'])) {
    if (isPartner($_SESSION['profil'])) {
        $newOffer = new Offre(
            null,
            $_POST['titre'],
            $_POST['description'],
            $_POST['missions'],
            $_POST['salaire'],
            $_POST['type'],
            'ouvert',
            $_POST['ref_entreprise']
        );

        $stmt = $bdd->getBdd()->prepare("INSERT INTO offre (titre, description, missions, salaire, type, etat, ref_entreprise) VALUES (:titre, :description, :missions, :salaire, :type, :etat, :ref_entreprise)");
        $stmt->execute([
            ':titre' => $newOffer->getTitre(),
            ':description' => $newOffer->getDescription(),
            ':missions' => $newOffer->getMissions(),
            ':salaire' => $newOffer->getSalaire(),
            ':type' => $newOffer->getType(),
            ':etat' => $newOffer->getEtat(),
            ':ref_entreprise' => $newOffer->getRefEntreprise()
        ]);
        $message = "Offre créée avec succès!";
    } else {
        $message = "Vous n'êtes pas autorisé à créer des offres.";
    }
}

// Fetch all offers
$stmt = $bdd->getBdd()->query("SELECT * FROM offre WHERE etat = 'ouvert'");
$offers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offres d'emploi</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
</head>
<body>
<h1>Offres d'emploi</h1>

<?php if (isset($message)): ?>
    <p><?php echo htmlspecialchars($message); ?></p>
<?php endif; ?>

<table id="offersTable">
    <thead>
    <tr>
        <th>Titre</th>
        <th>Description</th>
        <th>Missions</th>
        <th>Salaire</th>
        <th>Type</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($offers as $offer): ?>
        <tr>
            <td><?php echo htmlspecialchars($offer['titre']); ?></td>
            <td><?php echo htmlspecialchars($offer['description']); ?></td>
            <td><?php echo htmlspecialchars($offer['missions']); ?></td>
            <td><?php echo htmlspecialchars($offer['salaire']); ?></td>
            <td><?php echo htmlspecialchars($offer['type']); ?></td>
            <td>
                <?php if (isset($_SESSION['id_utilisateur']) && canApply($_SESSION['profil'])): ?>
                    <form method="post">
                        <input type="hidden" name="offer_id" value="<?php echo $offer['id_offre']; ?>">
                        <button type="submit" name="apply">Postuler</button>
                    </form>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php if (isset($_SESSION['id_utilisateur']) && isPartner($_SESSION['profil'])): ?>
    <h2>Créer une nouvelle offre</h2>
    <form method="post">
        <label for="titre">Titre:</label>
        <input type="text" id="titre" name="titre" required><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>

        <label for="missions">Missions:</label>
        <textarea id="missions" name="missions" required></textarea><br>

        <label for="salaire">Salaire:</label>
        <input type="number" id="salaire" name="salaire" step="0.01" required><br>

        <label for="type">Type:</label>
        <select id="type" name="type" required>
            <option value="stage">Stage</option>
            <option value="alternance">Alternance</option>
            <option value="CDD">CDD</option>
            <option value="CDI">CDI</option>
        </select><br>

        <label for="ref_entreprise">Entreprise:</label>
        <select id="ref_entreprise" name="ref_entreprise" required>
            <?php
            $stmt = $bdd->getBdd()->query("SELECT id_entreprise, nom FROM entreprise");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row['id_entreprise'] . "'>" . htmlspecialchars($row['nom']) . "</option>";
            }
            ?>
        </select><br>

        <button type="submit" name="create_offer">Créer l'offre</button>
    </form>
<?php endif; ?>

<script>
    $(document).ready(function() {
        $('#offersTable').DataTable();
    });
</script>
</body>
</html>
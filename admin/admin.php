<?php
session_start();

// Vérifier si l'utilisateur est connecté et a le rôle d'administrateur
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo '<script>alert("Vous devez être connecté pour accéder à cette page.");</script>';
    echo '<script>window.location.href = "index.php";</script>';
    exit;
}


// Inclure le fichier de configuration
require_once '../config.php';






try {
    // Requête pour récupérer le nombre de commentaires approuvés par note
    $sqlApproved = "SELECT note, COUNT(*) as total FROM avis_clients WHERE approved = 1 GROUP BY note";
    $stmtApproved = $db->query($sqlApproved);
    $resultsApproved = $stmtApproved->fetchAll(PDO::FETCH_ASSOC);

    // Requête pour récupérer le nombre de commentaires non approuvés par note
    $sqlPending = "SELECT note, COUNT(*) as total FROM avis_clients WHERE approved = 0 GROUP BY note";
    $stmtPending = $db->query($sqlPending);
    $resultsPending = $stmtPending->fetchAll(PDO::FETCH_ASSOC);

    // Préparation des données pour le camembert des commentaires approuvés
    $labelsApproved = [];
    $dataApproved = [];
    $colorsApproved = [];

    foreach ($resultsApproved as $row) {
        $labelsApproved[] = $row['note'] . ' ★';
        $dataApproved[] = (int)$row['total'];

        // Attribution des couleurs Bootstrap en fonction du nombre d'étoiles
        switch ($row['note']) {
            case 1:
                $colorsApproved[] = 'red';
                break;
            case 2:
                $colorsApproved[] = 'yellow';
                break;
            case 3:
                $colorsApproved[] = 'dodgerblue';
                break;
            case 4:
                $colorsApproved[] = 'blue';
                break;
            case 5:
                $colorsApproved[] = 'green';
                break;
            default:
                $colorsApproved[] = 'grey';
                break;
        }
    }

    // Préparation des données pour le camembert des commentaires non approuvés
    $labelsPending = [];
    $dataPending = [];
    $colorsPending = [];

    foreach ($resultsPending as $row) {
        $labelsPending[] = $row['note'] . ' ★';
        $dataPending[] = (int)$row['total'];

        // Attribution des couleurs Bootstrap en fonction du nombre d'étoiles
        switch ($row['note']) {
            case 1:
                $colorsPending[] = 'red';
                break;
            case 2:
                $colorsPending[] = 'yellow';
                break;
            case 3:
                $colorsPending[] = 'dodgerblue';
                break;
            case 4:
                $colorsPending[] = 'blue';
                break;
            case 5:
                $colorsPending[] = 'green';
                break;
            default:
                $colorsPending[] = 'grey';
                break;
        }
    }
} catch (PDOException $e) {
    echo "Erreur lors de l'exécution de la requête: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration du Garage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Administration</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
                
                <li class="nav-item">
                    <a class="nav-link" href="../apps/cars/">Gérer le parc occasion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../apps/testimonial/commentsToApprove.php">Approuver des commentaires</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../apps/users.php">Gérer le personnel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Déconnexion</a>
                </li>
                
            </ul>
            
        </div>
    </div>
</nav>

<div class="container alert alert-primary mt-4">
    <?php
    try {
        // Requête pour récupérer le nombre total de commentaires
        $sqlTotal = "SELECT COUNT(*) as total, SUM(approved) as approved FROM avis_clients";
        $stmtTotal = $db->query($sqlTotal);
        $resultTotal = $stmtTotal->fetch(PDO::FETCH_ASSOC);
        $totalComments = $resultTotal['total'];
        $approvedComments = $resultTotal['approved'];
        $pendingComments = $totalComments - $approvedComments;

        // Afficher le nombre total de commentaires
        echo "<p>Il y a {$totalComments} commentaires clients sur votre site, dont {$pendingComments} en attente d'approbation.</p>";
    } catch (PDOException $e) {
        echo "Erreur lors de l'exécution de la requête: " . $e->getMessage();
    }
    ?>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Répartition des commentaires approuvés par nombre d'étoiles</h5>
                <canvas id="approvedCommentChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Répartition des commentaires non approuvés par nombre d'étoiles</h5>
                <canvas id="pendingCommentChart"></canvas>
            </div>
        </div>
    </div>
</div>
<br><hr>
<div class="container alert alert-primary mt-4">
    <?php
    try {
        // Requête pour récupérer le nombre total de voitures
        $sqlTotalCars = "SELECT COUNT(*) as totalCars FROM cars";
        $stmtTotalCars = $db->query($sqlTotalCars);
        $resultTotalCars = $stmtTotalCars->fetch(PDO::FETCH_ASSOC);
        $totalCars = $resultTotalCars['totalCars'];

        // Afficher le nombre total de voitures
        echo "<p>Il y a {$totalCars} voitures dans la base de données.</p>";
    } catch (PDOException $e) {
        echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
    }
    ?>
</div>





<hr><br>
<div class="card">
    <div class="card-body">
        <?php
        include '../apps/opening/admin.php';
        ?>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Données pour le camembert des commentaires approuvés
        const approvedData = {
            labels: <?php echo json_encode($labelsApproved); ?>,
            datasets: [{
                data: <?php echo json_encode($dataApproved); ?>,
                backgroundColor: <?php echo json_encode($colorsApproved); ?>,
                hoverOffset: 4
            }]
        };

        // Données pour le camembert des commentaires non approuvés
        const pendingData = {
            labels: <?php echo json_encode($labelsPending); ?>,
            datasets: [{
                data: <?php echo json_encode($dataPending); ?>,
                backgroundColor: <?php echo json_encode($colorsPending); ?>,
                hoverOffset: 4
            }]
        };

        // Configuration pour les camemberts
        const chartConfig = {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                }
            }
        };

        // Création des camemberts
        var approvedCtx = document.getElementById('approvedCommentChart').getContext('2d');
        new Chart(approvedCtx, {
            type: 'pie',
            data: approvedData,
            options: {
                ...chartConfig,
                title: {
                    ...chartConfig.title,
                    text: 'Répartition des commentaires approuvés par nombre d\'étoiles'
                }
            }
        });

        var pendingCtx = document.getElementById('pendingCommentChart').getContext('2d');
        new Chart(pendingCtx, {
            type: 'pie',
            data: pendingData,
            options: {
                ...chartConfig,
                title: {
                    ...chartConfig.title,
                    text: 'Répartition des commentaires non approuvés par nombre d\'étoiles'
                }
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
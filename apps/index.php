<?php
// Inclure l'en-tête
include('header.php');
?>


<?php
// Inclure le fichier de configuration
require_once 'config.php';

// Récupérer les avis approuvés de la base de données
$query = "SELECT * FROM avis_clients WHERE approved = 1 ORDER BY id DESC";
$result = $db->query($query);
$reviews = $result->fetchAll(PDO::FETCH_ASSOC);

// Pagination
$perPage = 5; // Nombre d'avis par page
$totalReviews = count($reviews);
$totalPages = ceil($totalReviews / $perPage); // Nombre total de pages

// Récupérer le numéro de page actuel
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Limiter les avis affichés à la page actuelle
$offset = ($page - 1) * $perPage;
$reviewsPerPage = array_slice($reviews, $offset, $perPage);

?>

<form action="apps/testimonial/submit_review.php" method="post">
    <!-- Votre formulaire de soumission d'avis -->
</form>

<?php foreach ($reviewsPerPage as $review) : ?>
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($review['nom']) ?></h5>
            <p class="card-text"><?= htmlspecialchars($review['commentaire']) ?></p>
            <p class="card-text">
                <small class="text-muted"><?= str_repeat('★', $review['note']) ?></small>
            </p>
        </div>
    </div>
<?php endforeach; ?>

<!-- Afficher la pagination -->
<div class="d-flex justify-content-center">
    <ul class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</div>


<?php
// Inclure le pied de page
include('footer.php');
?>

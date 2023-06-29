<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garage V. Parrot</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <h1>Gestion des avis clients</h1>
    
    <?php

// Inclure le fichier de configuration
require_once 'config.php';



// Récupérer tous les avis de la base de données
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Récupérer le numéro de la page à partir des paramètres d'URL
$perPage = 5; // Nombre d'avis à afficher par page
$offset = ($page - 1) * $perPage; // Calculer l'offset pour la requête SQL

$query = "SELECT * FROM avis_clients ORDER BY id DESC LIMIT $offset, $perPage";
$result = $db->query($query);
$reviews = $result->fetchAll(PDO::FETCH_ASSOC);

?>


<?php foreach ($reviews as $review) : ?>
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($review['nom']) ?></h5>
            <p class="card-text"><?= htmlspecialchars($review['commentaire']) ?></p>
            <p class="card-text">
                <small class="text-muted"><?= str_repeat('★', $review['note']) ?></small>
            </p>
            <a href="approve_review.php?id=<?= $review['id'] ?>" class="btn btn-success">Approuver</a>
            <a href="delete_review.php?id=<?= $review['id'] ?>" class="btn btn-danger">Supprimer</a>
        </div>
    </div>
<?php endforeach; ?>

<?php
// Compter le nombre total d'avis dans la base de données
$totalReviews = $db->query("SELECT COUNT(*) as count FROM avis_clients")->fetchColumn();
$totalPages = ceil($totalReviews / $perPage); // Calculer le nombre total de pages nécessaires

// Afficher les liens vers les différentes pages
echo '<nav aria-label="Pagination">';
echo '<ul class="pagination justify-content-center">';
for ($i = 1; $i <= $totalPages; $i++) {
    echo '<li class="page-item' . ($i == $page ? ' active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
}
echo '</ul>';
echo '</nav>';
?>
<hr>


<h2>Ajouter un nouvel avis</h2>

<form action="submit_review.php" method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Nom</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="comment" class="form-label">Commentaire</label>
        <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="rating" class="form-label">Note</label>
        <select class="form-select" id="rating" name="rating" required>
            <option selected>Choisir...</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>


</body>

</html>

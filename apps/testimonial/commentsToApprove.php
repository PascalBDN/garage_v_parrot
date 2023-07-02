<?php

session_start();

// Vérifier si l'utilisateur est connecté et a le rôle d'administrateur
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo '<script>alert("Vous devez être connecté pour accéder à cette page.");</script>';
    echo '<script>window.location.href = "../../admin/index.php";</script>';
    exit;
}
include ('header.php');
?>
<body>
    <h1>Gestion des avis clients</h1>
    
    <?php

    // Inclure le fichier de configuration
    require_once 'config.php';

    // Récupérer tous les avis non approuvés de la base de données
    $query = "SELECT * FROM avis_clients WHERE approved = 0 ORDER BY id DESC";
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

    <?php if (count($reviews) == 0) : ?>
        <div class="alert alert-primary" role="alert">
            Aucun avis à approuver pour le moment.
        </div>
    <?php endif; ?>

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


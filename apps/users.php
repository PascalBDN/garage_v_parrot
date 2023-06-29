<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirigez l'utilisateur vers la page de connexion
    exit();
}

// Vérifiez si l'utilisateur est un administrateur
if ($_SESSION['role'] != 'admin') {
    die('Accès refusé'); // Affichez un message d'erreur
}

// Connectez-vous à la base de données
$db = new PDO('mysql:host=localhost;dbname=gparrot', 'root', 'root');

// Récupérez tous les utilisateurs depuis la base de données
$query = $db->query('SELECT * FROM users WHERE role = "staff"');
$users = $query->fetchAll();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Liste des utilisateurs</title>
</head>
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
        <a class="navbar-brand" href="../admin/admin.php">Administration</a>
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
                    <a class="nav-link" href="logout.php">Déconnexion</a>
                </li>
                
            </ul>
           
        </div>
    </div>
</nav>
<body>
    <h1>Liste des utilisateurs</h1>
    <?php foreach ($users as $user): ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nom d'utilisateur : <?php echo $user['username']; ?></h5>
            <form method="post" action="delete_user.php">
                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
        </div>
    </div>
    <br>
<?php endforeach; ?>

<hr>
    <div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title">Ajouter un nouveau membre du personnel</h5>
        <form method="post" action="create_staff.php">
            <div class="form-group mt-4">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group mt-4">
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-4">Créer</button>
        </form>
    </div>
</div>


</body>
</html>


<?php


session_start();

// Vérifier si l'utilisateur est connecté et a le rôle d'administrateur
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo '<script>alert("Vous devez être connecté pour accéder à cette page.");</script>';
    echo '<script>window.location.href = "../admin/index.php";</script>';
    exit;
}


// Connectez-vous à la base de données
$db = new PDO('mysql:host=localhost;dbname=gparrot', 'root', 'root');

// Récupérez tous les utilisateurs depuis la base de données
$query = $db->query('SELECT id, username, email FROM users WHERE role = "staff"');
$users = $query->fetchAll();
?>


<?php include ('header.php'); ?>
<body>
    <h1>Liste des utilisateurs</h1>
    <?php foreach ($users as $user): ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nom d'utilisateur : <?php echo $user['username']; ?></h5>
                <p class="card-text">Email : <?php echo $user['email']; ?></p>
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
                <div class="form-group mt-4">
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Créer</button>
            </form>
        </div>
    </div>

</body>
</html>

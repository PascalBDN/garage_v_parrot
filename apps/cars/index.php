<?php

$dsn = 'mysql:host=localhost;dbname=gparrot';
$pdo = new PDO($dsn, 'admin', 'pass');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare("SELECT * FROM cars ORDER BY id DESC");
$stmt->execute();

$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Liste des véhicules</title>
</head>
<header>
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../../admin/admin.php">Administration</a>
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
</header>
<body>

    
    <h3>Tabeau des véhicules</h3>

    <a href="create_car.php" class="btn btn-success">Ajouter un nouveau véhicule</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Images</th>
                <th scope="col">Modèle</th>
                <th scope="col">prix</th>
                <th scope="col">Année</th>
                <th scope="col">Energie</th>
                <th scope="col">Kilométrage</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($cars as $key => $car): ?>
            <tr>
                <th scope="row"><?php echo ++$key; ?></th>
                <td>
                    <img src="<?php echo $car['img']; ?>" alt="Voiture d'occasion" style="width: 80px;">
                </td>
                <td><?php echo $car['modele']; ?></td>
                <td><?php echo $car['prix']; ?></td>
                <td><?php echo $car['annee']; ?></td>
                <td><?php echo $car['energie']; ?></td>
                <td><?php echo $car['kilometrage']; ?></td>
                <td><?php echo $car['description']; ?></td>
                
                <td>
                    <div class="btn-group" role="group" aria-label="Actions">
                        <a href="update.php?id=<?php echo $car['id'] ?>" type="button" class="btn btn-sm btn-outline-primary rounded">Modification</a>
                        <form action="delete.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $car['id'] ?>">
    <button type="submit" name="confirm_delete" class="btn btn-sm btn-outline-danger ms-2 rounded" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce véhicule ?')">Supprimer</button>
</form>

                    </div>
                </td>


            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

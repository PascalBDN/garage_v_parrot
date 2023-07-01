<?php

$dsn = 'mysql:host=localhost;dbname=gparrot';
$pdo = new PDO($dsn, 'admin', 'pass');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare("SELECT * FROM cars ORDER BY id DESC");
$stmt->execute();

$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
include ('header.php')
?>
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

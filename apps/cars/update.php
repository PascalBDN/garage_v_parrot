<?php
// Établir la connexion à la base de données MySQL
$dsn = 'mysql:host=localhost;dbname=gparrot';
$pdo = new PDO($dsn, 'admin', 'pass');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['id'] ?? null;

if (!$id) {
    header('location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM cars WHERE id = :id");
$stmt->bindValue(':id', $id);
$stmt->execute();

$car = $stmt->fetch(PDO::FETCH_ASSOC);

$imgPath = $car['img'];
$modele = $car['modele'];
$prix = $car['prix'];
$annee = $car['annee'];
$energie = $car['energie'];
$kilometrage = $car['kilometrage'];
$description = $car['description'];
$securite = !empty($car['securite']) ? explode(',', $car['securite']) : [];
$places = !empty($car['places']) ? explode(',', $car['places']) : [];

// Vérifier que les champs sont bien complétés
$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $modele = $_POST['modele'];
    $prix = $_POST['prix'];
    $annee = $_POST['annee'];
    $energie = $_POST['energie'];
    $kilometrage = $_POST['kilometrage'];
    $description = $_POST['description'];

    $img = $_FILES['img'];

    // Validation des champs obligatoires
    if (empty($modele)) {
        $erreurs[] = 'Modèle obligatoire';
    }

    if (empty($prix)) {
        $erreurs[] = 'Prix obligatoire';
    }

    if (empty($annee)) {
        $erreurs[] = 'Année obligatoire';
    }

    if (empty($kilometrage)) {
        $erreurs[] = 'Kilométrage obligatoire';
    }

    if (empty($description)) {
        $erreurs[] = 'Description obligatoire';
    }

    // Si aucune erreur de validation n'est détectée
    if (empty($erreurs)) {
        try {
            $imgPath = $car['img']; // Conserver le chemin d'image existant si aucun fichier n'est téléchargé

            if (!empty($img['name'])) {
                // Si un nouveau fichier est téléchargé, le traiter
                $extension = pathinfo($img['name'], PATHINFO_EXTENSION);
                $uniqueName = pathinfo($img['name'], PATHINFO_FILENAME) . '_' . uniqid('', true) . '.' . $extension;
                $imgPath = 'images/' . $uniqueName;
            
                // Supprimer l'ancienne photo
                if (!empty($car['img'])) {
                    unlink($car['img']);
                }
            
                move_uploaded_file($img['tmp_name'], $imgPath);
            }

            $stmt = $pdo->prepare("UPDATE cars SET img = :img, modele = :modele, prix = :prix, annee = :annee, energie = :energie, kilometrage = :kilometrage, description = :description, securite = :securite, places = :places WHERE id = :id");
            $stmt->bindValue(':img', $imgPath);
            $stmt->bindValue(':modele', $modele);
            $stmt->bindValue(':prix', $prix);
            $stmt->bindValue(':annee', $annee);
            $stmt->bindValue(':energie', $energie);
            $stmt->bindValue(':kilometrage', $kilometrage);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':securite', implode(',', $_POST['securite']));
            $stmt->bindValue(':places', implode(',', $_POST['places']));
            $stmt->bindValue(':id', $id);

            $stmt->execute();
        } catch (PDOException $e) {
            $erreurs[] = 'Erreur lors de la modification du véhicule : ' . $e->getMessage();
        }
        header('location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="app.css">
    <title>Modifier un véhicule</title>
</head>

<body>
    <p>
        <a href="index.php" class="btn btn-secondary">Liste des véhicules</a>
    </p>
    <h3>Modification d'un véhicule / Modèle : "<?php echo $car['modele'] ?>"</h3>

    <form method="post" enctype="multipart/form-data">
        <?php if (!empty($erreurs)) : ?>
            <div class="alert alert-danger">
                <?php foreach ($erreurs as $erreur) : ?>
                    <p><?php echo $erreur; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="mb-3">
            <label class="form-label">Image</label><br>
            <?php if ($imgPath): ?>
                <p><img src="<?php echo $imgPath ?>" alt="Voiture occasion" style="width: 80px;"></p><br>
            <?php endif; ?>
            <input type="file" name="img">
        </div>
        <div class="mb-3">
            <label class="form-label">Modèle</label><br>
            <input type="text" class="form-control" name="modele" value="<?php echo $modele ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Prix</label><br>
            <input type="number" class="form-control" name="prix" value="<?php echo $prix ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Année</label><br>
            <input type="number" class="form-control" name="annee" value="<?php echo $annee ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Énergie</label><br>
            <select class="form-select" name="energie">
                <option value="essence" <?php if ($energie == 'essence') echo 'selected'; ?>>Essence</option>
                <option value="diesel" <?php if ($energie == 'diesel') echo 'selected'; ?>>Diesel</option>
                <option value="electrique" <?php if ($energie == 'electrique') echo 'selected'; ?>>Électrique</option>
                <option value="hybride" <?php if ($energie == 'hybride') echo 'selected'; ?>>Hybride</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Kilométrage</label><br>
            <input type="number" class="form-control" name="kilometrage" value="<?php echo $kilometrage ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label><br>
            <input type="text" class="form-control" name="description" value="<?php echo $description ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Sécurité</label><br>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="securite[]" value="ABS" <?php if (in_array('ABS', $securite)) echo 'checked'; ?>>
                <label class="form-check-label">ABS</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="securite[]" value="Airbags" <?php if (in_array('Airbags', $securite)) echo 'checked'; ?>>
                <label class="form-check-label">Airbags</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="securite[]" value="Antidémarrage" <?php if (in_array('Antidémarrage', $securite)) echo 'checked'; ?>>
                <label class="form-check-label">Antidémarrage</label>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Nombre de places</label><br>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="places[]" value="2" <?php if (in_array('2', $places)) echo 'checked'; ?>>
                <label class="form-check-label">2 places</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="places[]" value="4" <?php if (in_array('4', $places)) echo 'checked'; ?>>
                <label class="form-check-label">4 places</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="places[]" value="5" <?php if (in_array('5', $places)) echo 'checked'; ?>>
                <label class="form-check-label">5 places</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Modifier le véhicule</button>
    </form>
</body>

</html>




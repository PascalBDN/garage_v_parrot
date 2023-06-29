<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Connexion à la base de données
    $dsn = 'mysql:host=localhost;dbname=gparrot';
    $pdo = new PDO($dsn, 'admin', 'pass');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si le formulaire a été soumis avec confirmation
    if (isset($_POST['confirm_delete'])) {
        // Récupérer le chemin de l'image associée au véhicule
        $stmt = $pdo->prepare("SELECT img FROM cars WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $car = $stmt->fetch(PDO::FETCH_ASSOC);
        $imagePath = $car['img'];

        // Supprimer l'image du serveur
        if ($imagePath && file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Suppression du véhicule
        $stmt = $pdo->prepare("DELETE FROM cars WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Redirection vers la liste des véhicules après la suppression
        header("Location: index.php");
        exit();
    }
}
?>



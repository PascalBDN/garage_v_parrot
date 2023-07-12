<?php
// Code de connexion à la base de données
include('includes/config.php');

// Récupérer l'identifiant du véhicule depuis la requête GET
$carId = $_GET['id'] ?? null;

if (!$carId) {
    die('Identifiant du véhicule manquant');
}

try {
    // Requête SQL pour récupérer les détails du véhicule
    $sql = "SELECT * FROM cars WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $carId);
    $stmt->execute();
    $car = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si le véhicule existe
    if (!$car) {
        die('Véhicule non trouvé');
    }

    // Afficher les détails du véhicule
    echo '<div class="modal-body">';
    echo '<img src="apps/cars/' . $car['img'] . '" alt="Voiture d\'occasion" style="max-width: 100%;">';
    echo '<h5 class="modal-title">' . $car['modele'] . '</h5>';
    echo '<p>Prix : ' . $car['prix'] . '€</p>';
    echo '<p>Année de mise en circulation : ' . $car['annee'] . '</p>';
    echo '<p>Energie : ' . $car['energie'] . '</p>';
    echo '<p>Kilométrage : ' . $car['kilometrage'] . ' km</p>';
    echo '<p>Description : ' . $car['description'] . '</p>';
    echo '<p>Sécurité : ' . $car['securite'] . '</p>';
    echo '<p>Nombre de places : ' . $car['places'] . '</p>';
    echo '<p>Options : ' . $car['options_list'] . '</p>';
    echo '</div>';
} catch (PDOException $e) {
    die("Erreur lors de la récupération des détails du véhicule : " . $e->getMessage());
}
?>

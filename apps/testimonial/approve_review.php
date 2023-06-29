<?php

// Inclure le fichier de configuration
require_once 'config.php';

// Vérifier si la connexion à la base de données est établie
if (!$db) {
    // Gérer l'erreur ou rediriger l'utilisateur vers une page d'erreur appropriée
    // ...

    // Arrêter l'exécution du script
    exit;
}

// Récupérer l'ID de l'avis
$id = $_GET['id'];

// Vérifier si l'ID est valide (par exemple, un entier positif)
if (!is_numeric($id) || $id <= 0) {
    // Gérer l'erreur ou rediriger l'utilisateur vers une page d'erreur appropriée
    // ...

    // Arrêter l'exécution du script
    exit;
}

// Préparer la requête SQL avec une instruction préparée
$query = "UPDATE avis_clients SET approved = 1 WHERE id = :id";
$stmt = $db->prepare($query);

// Attribuer la valeur de l'ID à la variable de la requête préparée
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

// Exécuter la requête préparée
$stmt->execute();

// Rediriger l'utilisateur vers la page d'administration
header('Location: admin.php');
exit;

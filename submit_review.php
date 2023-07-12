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
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Inclure le fichier de configuration
require_once 'includes/config.php';

// Récupérer les données du formulaire
$name = $_POST['name'];
$comment = $_POST['comment'];
$rating = $_POST['rating'];

// Nettoyer les données
$name = $db->quote($name);
$comment = $db->quote($comment);
$rating = (int) $rating;

// Insérer les données dans la base de données
$query = "INSERT INTO avis_clients (nom, commentaire, note) VALUES ($name, $comment, $rating)";
$db->exec($query);

//Rediriger l'utilisateur vers la page d'accueil
header('Location: index.php');
exit;

<?php
require 'vendor\autoload.php';

// Chargement des variables d'environnement à partir du fichier .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/', '.env');
$dotenv->load();

// Récupération des informations de connexion à la base de données depuis les variables d'environnement
$host = $_ENV['DB_HOST']; // Adresse du serveur MySQL
$dbname = $_ENV['DB_NAME']; // Nom de la base de données    
$username = $_ENV['DB_USER']; // Nom d'utilisateur MySQL   
$password = $_ENV['DB_PASSWORD']; // Mot de passe MySQL


try {
    // Connexion à la base de données
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Configuration supplémentaire
    // ...

} catch (PDOException $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}


<?php
session_start();

// Vérifier si l'utilisateur est connecté et a le rôle d'administrateur
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo '<script>alert("Vous devez être connecté en tant qu\'administrateur pour accéder à cette page.");</script>';
    echo '<script>window.location.href = "../admin/index.php";</script>';
    exit;
}

// Vérifier si l'ID de l'utilisateur est présent dans la requête POST
if (!isset($_POST['user_id'])) {
    echo '<script>alert("ID de l\'utilisateur manquant.");</script>';
    echo '<script>window.location.href = "index.php";</script>';
    exit;
}

// Récupérer l'ID de l'utilisateur depuis la requête POST
$user_id = $_POST['user_id'];

// Connectez-vous à la base de données
$db = new PDO('mysql:host=localhost;dbname=gparrot', 'root', 'root');

// Supprimer l'utilisateur de la base de données
$deleteQuery = $db->prepare('DELETE FROM users WHERE id = :user_id');
$deleteQuery->bindParam(':user_id', $user_id);

if ($deleteQuery->execute()) {
    echo '<script>alert("Utilisateur supprimé avec succès.");</script>';
    echo '<script>window.location.href = "users.php";</script>';
    exit;
} else {
    echo '<script>alert("Une erreur s\'est produite lors de la suppression de l\'utilisateur.");</script>';
    echo '<script>window.location.href = "index.php";</script>';
    exit;
}
?>

<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirigez l'utilisateur vers la page de connexion
    exit();
}

// Vérifiez si l'utilisateur est un administrateur
if ($_SESSION['role'] != 'admin') {
    die('Accès refusé'); // Affichez un message d'erreur
}

// Connectez-vous à la base de données
$db = new PDO('mysql:host=localhost;dbname=gparrot', 'root', 'root');

// Vérifiez si l'ID de l'utilisateur à supprimer a été envoyé via POST
if (isset($_POST['user_id'])) {
    // Récupérez l'ID de l'utilisateur à supprimer
    $user_id = $_POST['user_id'];

    // Supprimez l'utilisateur de la base de données
    $delete = $db->prepare('DELETE FROM users WHERE id = :user_id');
    $delete->execute(['user_id' => $user_id]);

    // Redirigez vers la page "users.php" avec un message de succès
    $_SESSION['success_message'] = "L'utilisateur a été supprimé avec succès.";
    header('Location: users.php');
    exit();
} else {
    // Si aucun ID utilisateur n'a été fourni, redirigez vers la page "users.php" avec un message d'erreur
    $_SESSION['error_message'] = "Une erreur s'est produite lors de la suppression de l'utilisateur.";
    header('Location: users.php');
    exit();
}
?>





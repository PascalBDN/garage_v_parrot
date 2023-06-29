<?php
// Récupérez les informations du formulaire
$username = $_POST['username'];
$password = $_POST['password'];

// Connectez-vous à la base de données
$db = new PDO('mysql:host=localhost;dbname=gparrot', 'root', 'root');

// Récupérez l'utilisateur de la base de données
$query = $db->prepare('SELECT * FROM users WHERE username = :username');
$query->execute(['username' => $username]);
$user = $query->fetch();

// Vérifiez le mot de passe
if ($user && password_verify($password, $user['password'])) {
    // Le mot de passe est correct. Démarrer une session et stocker les informations de l'utilisateur dans la session.
    session_start();
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    
    // Redirigez l'utilisateur en fonction de son rôle
    if ($_SESSION['role'] == 'admin') {
        header('Location: admin.php'); // Redirigez l'administrateur vers la page d'accueil de l'admin
        exit();
    } else if ($_SESSION['role'] == 'staff') {
        header('Location: staff.php'); // Redirigez le personnel vers la page d'accueil du personnel
        exit();
    }
} else {
    // Le mot de passe est incorrect. Afficher un message d'erreur.
    echo "Nom d'utilisateur ou mot de passe incorrect";
}
?>


<?php
// Récupérez les informations du formulaire
$email = $_POST['email'];
$password = $_POST['password'];

// Connectez-vous à la base de données
$db = new PDO('mysql:host=localhost;dbname=gparrot', 'root', 'root');

// Récupérez l'utilisateur de la base de données en utilisant l'e-mail
$query = $db->prepare('SELECT * FROM users WHERE email = :email');
$query->execute(['email' => $email]);
$user = $query->fetch();

// Vérifiez le mot de passe
if ($user && hash('sha256', $password) == $user['password']) {
    // Le mot de passe est correct. Démarrer une session et stocker les informations de l'utilisateur dans la session.
    session_start();
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];
    
    // Redirigez l'utilisateur en fonction de son rôle
    if ($_SESSION['role'] == 'admin') {
        header('Location: apps/admin.php'); // Redirigez l'administrateur vers la page d'accueil de l'admin
    } else if ($_SESSION['role'] == 'staff') {
        header('Location: apps/staff.php'); // Redirigez le personnel vers la page d'accueil du personnel
    }
} else {
    // Le mot de passe est incorrect. Afficher un message d'erreur.
    echo "Email ou mot de passe incorrect";
}
?>



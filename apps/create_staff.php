<?php
// Connectez-vous à la base de données
$db = new PDO('mysql:host=localhost;dbname=gparrot', 'root', 'root');

// Vérifiez si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez les valeurs du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Effectuez les validations nécessaires sur les valeurs reçues
    
    // Hash du mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // Insérez le nouveau membre du personnel dans la base de données
    $query = $db->prepare('INSERT INTO users (username, password, role) VALUES (?, ?, ?)');
    $query->execute([$username, $hashedPassword, 'staff']);
    
    // Redirigez l'utilisateur vers la page de liste des utilisateurs
    header('Location: users.php');
    exit();
}
?>



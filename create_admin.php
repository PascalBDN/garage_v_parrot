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
    
    // Insérez le nouvel administrateur dans la base de données
    $query = $db->prepare('INSERT INTO users (username, password, role) VALUES (?, ?, ?)');
    $query->execute([$username, $hashedPassword, 'admin']);
    
    // Redirigez l'utilisateur vers la page de liste des utilisateurs
    header('Location: users.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Créer un nouvel administrateur</title>
</head>
<body>
    <h1>Créer un nouvel administrateur</h1>
    
    <form method="POST" action="create_admin.php">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required><br>
        
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required><br>
        
        <input type="submit" value="Créer administrateur">
    </form>
</body>
</html>

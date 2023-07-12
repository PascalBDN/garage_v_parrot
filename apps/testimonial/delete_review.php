<?php

// Inclure le fichier de configuration
require_once '../../includes/config.php';

// Récupérer l'ID de l'avis
$id = $_GET['id'];

// Supprimer l'avis de la base de données
$query = "DELETE FROM avis_clients WHERE id = $id";
$db->exec($query);

// Rediriger l'utilisateur vers la page d'administration
header('Location: admin.php');
exit;

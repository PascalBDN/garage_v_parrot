<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $sujet = $_POST['sujet'] ?? '';
    $message = $_POST['message'] ?? '';

    // Vérifier que les champs requis sont renseignés
    if (!empty($nom) && !empty($email) && !empty($sujet) && !empty($message)) {
        // Construction du corps de l'e-mail
        $corpsEmail = "Nom : $nom\n";
        $corpsEmail .= "Adresse e-mail : $email\n";
        $corpsEmail .= "Message :\n$message";

        // Adresse e-mail du destinataire
        $destinataire = 'patrick.beaudemoulin@protonmail.com'; // Remplacez par votre adresse e-mail

        // En-têtes de l'e-mail
        $headers = "From: $nom <$email>\r\n";
        $headers .= "Reply-To: $email\r\n";

        // Envoyer l'e-mail
        if (mail($destinataire, $sujet, $corpsEmail, $headers)) {
            // Afficher une alerte et rediriger vers parc_occasion.php
            echo '<script>alert("Votre e-mail a été envoyé avec succès."); window.location = "parc_occasions.php";</script>';
        } else {
            // Afficher une alerte et rediriger vers parc_occasion.php
            echo '<script>alert("Une erreur est survenue lors de l\'envoi de l\'e-mail."); window.location = "parc_occasions.php";</script>';
        }
    } else {
        // Afficher une alerte et rediriger vers parc_occasion.php
        echo '<script>alert("Veuillez remplir tous les champs du formulaire."); window.location = "parc_occasions.php";</script>';
    }
} else {
    // Afficher une alerte et rediriger vers parc_occasion.php
    echo '<script>alert("Méthode non autorisée."); window.location = "parc_occasion.php";</script>';
}
?>

<?php
include('config.php');

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

if(isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "SELECT description FROM cars WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo $row['description'];
    } else {
        echo "Aucune description trouvée pour ce véhicule.";
    }
} else {
    echo "Aucun ID de véhicule fourni.";
}

mysqli_close($conn);
?>

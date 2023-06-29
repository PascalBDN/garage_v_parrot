<?php
// Inclure l'en-tête
include('header.php');
include('navbar.php');
?>

<body>

    <!-- Modal -->
    <div class="modal fade" id="carModal" tabindex="-1" role="dialog" aria-labelledby="carModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="carModalLabel">Détails du véhicule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Les détails du véhicule seront insérés ici -->
                </div>
            </div>
        </div>
    </div>

    <?php
    // Code de connexion à la base de données
    include('config.php');

    try {
        // Connexion à la base de données via PDO
        $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

        // Requête SQL pour récupérer les valeurs minimales et maximales de la table "cars"
        $sql = "SELECT MIN(prix) AS min_prix, MAX(prix) AS max_prix, MIN(kilometrage) AS min_kilometrage, MAX(kilometrage) AS max_kilometrage, MIN(annee) AS min_annee, MAX(annee) AS max_annee FROM cars";
        $stmt = $db->query($sql);
        $minMaxValues = $stmt->fetch(PDO::FETCH_ASSOC);

        // Requête SQL pour récupérer tous les enregistrements de la table "cars"
        $sqlCars = "SELECT * FROM cars";
        $stmtCars = $db->query($sqlCars);
        $cars = $stmtCars->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
    ?>

    <div class="container">
        <div class="row mt-4">
            <h2 class="col-12">Nos voitures</h2>

            <div class="col-md-4 mt-4">
                <label for="prixRange" class="form-label">Prix :</label>
                <input type="text" id="prixRange" name="prixRange" />
            </div>

            <div class="col-md-4 mt-4">
                <label for="kilometrageRange" class="form-label">Kilométrage :</label>
                <input type="text" id="kilometrageRange" name="kilometrageRange" />
            </div>

            <div class="col-md-4 mt-4">
                <label for="anneeRange" class="form-label">Année :</label>
                <input type="text" id="anneeRange" name="anneeRange" />
            </div>

            <!-- Liste des voitures -->
            <div id="carList" class="col-12 row mt-4">
                <?php foreach ($cars as $car) : ?>
                <div class="col-sm-6 col-md-4 mt-4 mt-4">
                    <div class="card">
                        <img src="apps/cars/<?php echo $car['img']; ?>" class="card-img-top rounded-3"
                            alt="Voiture d'occasion" style="height: 200px">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $car['modele']; ?></h5>
                            <p class="card-text">Prix : <?php echo $car['prix']; ?>€</p>
                            <p>Année de mise en circulation : <?php echo $car['annee']; ?></p>
                            <p>Kilométrage : <?php echo $car['kilometrage']; ?> km</p>
                            <a href="#" class="btn btn-sm btn-primary open-modal" data-bs-toggle="modal"
                                data-bs-target="#carModal" data-id="<?php echo $car['id']; ?>">Détails
                            </a>
                            <a href="contact.php?subject=Contact%20-%20<?php echo $car['modele']; ?>%20(<?php echo $car['annee']; ?>)" class="btn btn-sm btn-primary" data-id="<?php echo $car['modele']; ?>">Contactez Nous</a>

                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    

    <?php
// Inclure le pied de page
include('footer.php');
?>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JavaScript and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ion.rangeSlider JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>

    <script>
        $(document).ready(function () {
            // Écouteur d'événement pour le clic sur le lien "Lire la suite"
            $('.open-modal').click(function (e) {
                e.preventDefault();

                // Récupérer l'identifiant du véhicule à partir de l'attribut data-id
                var carId = $(this).data('id');

                // Requête AJAX pour récupérer les détails du véhicule
                $.ajax({
                    url: 'get_car_details.php', // Chemin vers le script PHP qui récupère les détails du véhicule
                    type: 'GET',
                    data: {
                        id: carId
                    },
                    success: function (response) {
                        // Insérer les détails du véhicule dans la fenêtre modale
                        $('.modal-body').html(response);
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });

            // Configurer les barres de plage avec fourchettes (intervalle)
            $('#prixRange').ionRangeSlider({
                type: 'double',
                min: <?php echo $minMaxValues['min_prix']; ?>,
                max: <?php echo $minMaxValues['max_prix']; ?>,
                from: <?php echo $minMaxValues['min_prix']; ?>,
                to: <?php echo $minMaxValues['max_prix']; ?>,
                step: 1000,
                grid: true,
                grid_num: 10,
                postfix: ' €'
            });

            $('#kilometrageRange').ionRangeSlider({
                type: 'double',
                min: <?php echo $minMaxValues['min_kilometrage']; ?>,
                max: <?php echo $minMaxValues['max_kilometrage']; ?>,
                from: <?php echo $minMaxValues['min_kilometrage']; ?>,
                to: <?php echo $minMaxValues['max_kilometrage']; ?>,
                step: 1000,
                grid: true,
                grid_num: 10,
                postfix: ' km'
            });

            $('#anneeRange').ionRangeSlider({
                type: 'double',
                min: <?php echo $minMaxValues['min_annee']; ?>,
                max: <?php echo $minMaxValues['max_annee']; ?>,
                from: <?php echo $minMaxValues['min_annee']; ?>,
                to: <?php echo $minMaxValues['max_annee']; ?>,
                step: 1,
                grid: true,
                grid_num: 10
            });

            // Écouteur d'événement pour le changement des barres de plage
            $('#prixRange, #kilometrageRange, #anneeRange').on('change', function () {
                filterCars();
            });

            // Fonction de filtrage des voitures
            function filterCars() {
                var prixRange = $('#prixRange').val().split(';');
                var prixMin = parseFloat(prixRange[0]);
                var prixMax = parseFloat(prixRange[1]);

                var kilometrageRange = $('#kilometrageRange').val().split(';');
                var kilometrageMin = parseFloat(kilometrageRange[0]);
                var kilometrageMax = parseFloat(kilometrageRange[1]);

                var anneeRange = $('#anneeRange').val().split(';');
                var anneeMin = parseInt(anneeRange[0]);
                var anneeMax = parseInt(anneeRange[1]);

                // Filtrer les voitures en fonction des valeurs des barres de plage
                var filteredCars = <?php echo json_encode($cars); ?>.filter(function (car) {
                    return car.prix >= prixMin &&
                        car.prix <= prixMax &&
                        car.kilometrage >= kilometrageMin &&
                        car.kilometrage <= kilometrageMax &&
                        car.annee >= anneeMin &&
                        car.annee <= anneeMax;
                });

                // Mettre à jour la liste des voitures filtrées
                var carListHtml = '';
                filteredCars.forEach(function (car) {
                    carListHtml += '<div class="col-3 mt-4">';
                    carListHtml += '<div class="card">';
                    carListHtml += '<img src="apps/cars/' + car.img + '" class="card-img-top rounded-3" alt="Voiture d\'occasion" style="height: 200px">';
                    carListHtml += '<div class="card-body">';
                    carListHtml += '<h5 class="card-title">' + car.modele + '</h5>';
                    carListHtml += '<p class="card-text">Prix : ' + car.prix + '€</p>';
                    carListHtml += '<p>Année de mise en circulation : ' + car.annee + '</p>';
                    carListHtml += '<p>Kilométrage : ' + car.kilometrage + ' km</p>';
                    carListHtml += '<a href="#" class="btn btn-primary open-modal" data-bs-toggle="modal" data-bs-target="#carModal" data-id="' + car.id + '">Lire la suite...</a>';
                    carListHtml += '</div></div></div>';
                });

                $('#carList').html(carListHtml);
            }
        });
    </script>
    

</body>

</html>




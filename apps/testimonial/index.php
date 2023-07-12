<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garage V. Parrot</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<form action="submit_review.php" method="post">
    <div class="mb-3 mx-4">
        <label for="name" class="form-label">Nom</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3 mx-4">
        <label for="comment" class="form-label">Commentaire</label>
        <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
    </div>
    <div class="mb-3 mx-4">
        <label for="rating" class="form-label">Note</label>
        <select class="form-select" id="rating" name="rating" required>
            <option selected>Choisir...</option>
            <option value="1">1</option> 
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary mx-4">Soumettre</button>
</form>

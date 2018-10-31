<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/app.css">
    <title>Espace</title>
</head>
<body>
    <main class="container">
        <header>
            <button class="btn btn-primary btnSign" id="add"><span class="glyphicon glyphicon-plus"></button>
        </header>

        <div id="boxInsert">
            <h3 class="text-info">Ajouter un produit</h3>
            <form data-url="../admin/insert.php">
                <div class="form-group">
                    <input type="text" name="name" class="form-control col-4" placeholder="Saisir le nom du produit">
                </div>

                <div class="form-group">
                    <input type="number" name="price" step="0.01" min="1" class="form-control col-4" placeholder="Saisir le prix du produit">
                </div>

                 <div class="form-group">
                    <input type="number" name="quantite" step="1" class="form-control col-4" placeholder="Saisir la quantité">
                </div>

                <div class="form-group">
                    <textarea name="description" id="" cols="55" rows="10" placeholder="Saisir la description du produit"></textarea>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-info col-2" value="ajouter">
                </div>
            </form>
        </div>
        <div id="productList">
            <h3>Liste de produits disponible et des quantités en stock</h3>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="../js/app.js"></script>
</body>
</html>
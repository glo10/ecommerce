<?php
    session_start();
    if(isset($_SESSION['email'])){
        header('location:accueil.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/app.css">
    <title>Inscription</title>
</head>
<body>
    <main class="container">
        <form action="sign_up.php" class="form-horizontal" method="POST">

            <div class="form-group">
                <input type="email" name="email" class="form-control col-4" placeholder="Saisir votre email">
            </div>

            <div class="form-group">
                <input type="password" name="mdp" class="form-control col-4" placeholder="Saisir votre mot de passe">
            </div>

            <div class="form-group">
                <input type="password" name="mdpConfirm" class="form-control col-4" placeholder="Confirmer le mot de passe">
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-success col-2" value="Inscription" >
            </div>

        </form>
    </main>
</body>
</html>
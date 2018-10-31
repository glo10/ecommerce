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
    <title>Espace</title>
</head>
<body>
    <main class="container">

        <header>
            <button class="btn btn-primary btnSign" id="client">Client</button>
            <button class="btn btn-primary btnSign" id="admin">Administrateur</button>
        </header>

        <div id="boxSignIn">
            <h3 class="text-info">Connexion</h3>
            <p id="userMsg"></p>
            <form data-url="bdd/sign_in.php">
                <div class="form-group">
                    <input type="hidden" name="table">
                    <input type="email" name="email" class="form-control col-4" placeholder="Saisir votre email">
                </div>

                <div class="form-group">
                    <input type="password" name="mdp" class="form-control col-4" placeholder="Saisir votre mot de passe">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success col-2" value="connexion">
                    <button id="btnSignUp" class="btn btn-info col-2">S'inscrire</button>
                </div>
            </form>
        </div>

        <div id="boxSignUp">
            <h3 class="text-info">Inscription</h3>
            <form data-url="bdd/sign_up.php">
                <div class="form-group">
                    <input type="text" name="lastName" class="form-control col-4" placeholder="Saisir votre nom">
                </div>

                <div class="form-group">
                    <input type="text" name="firstName" class="form-control col-4" placeholder="Saisir votre prénom">
                </div>

                <div class="form-group">
                    <input type="email" name="email" class="form-control col-4" placeholder="Saisir votre email">
                </div>

                <div class="form-group">
                    <input type="number" name="old" step="1" min="10" class="form-control col-4" placeholder="Saisir votre age">
                </div>

                 <div class="form-group">
                    <input type="password" name="mdp" class="form-control col-4" placeholder="Saisir votre mot de passe">
                </div>

                <div class="form-group">
                    <input type="password" name="mdpConfirm" class="form-control col-4" placeholder="Confirmer votre mot de passe">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-info col-2" value="S'inscrire"  data-action="1">
                </div>
            </form>
        </div>
        
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="js/app.js"></script>
</body>
</html>
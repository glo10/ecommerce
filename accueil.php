<?php
    session_start();

    if(empty($_SESSION['email'])){
        header('location:index.php');
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
    <title>Accueil</title>
</head>
<body>
    <div class="container">
        <header>
            <nav>
                <a href="#" class="btn btn-default">link 1</a>
                <a href="#" class="btn btn-default">link 2</a>
                <a href="#" class="btn btn-default">link 3</a>
                <a href="#" class="btn btn-default">link 4</a>
                <a href="#" class="btn btn-default">link 5</a>
            </nav>
            <div>
                <span class="glyphicon glyphicon-user"></span>
                <span><?= $_SESSION['nom'].' '.$_SESSION['prenom']?></span>
                <a class="btn btn-primary" href="deconnexion.php"><span class="glyphicon glyphicon-off"></a>
            </div>
        </header>
        <div>
            <p class="text-primary">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Beatae obcaecati esse quo molestias tempore itaque distinctio non, maiores dignissimos blanditiis ut assumenda, ea aut architecto aperiam est voluptatem error exercitationem.
            </p>
            <p class="text-info">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Beatae obcaecati esse quo molestias tempore itaque distinctio non, maiores dignissimos blanditiis ut assumenda, ea aut architecto aperiam est voluptatem error exercitationem.
            </p>
            <p class="text-success">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Beatae obcaecati esse quo molestias tempore itaque distinctio non, maiores dignissimos blanditiis ut assumenda, ea aut architecto aperiam est voluptatem error exercitationem.
            </p>
            <p class="text-warning">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Beatae obcaecati esse quo molestias tempore itaque distinctio non, maiores dignissimos blanditiis ut assumenda, ea aut architecto aperiam est voluptatem error exercitationem.
            </p>
            <p class="text-danger">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Beatae obcaecati esse quo molestias tempore itaque distinctio non, maiores dignissimos blanditiis ut assumenda, ea aut architecto aperiam est voluptatem error exercitationem.
            </p>
        </div>
    </div>
</body>
</html>
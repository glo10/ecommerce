<?php
    if(
        isset($_POST['lastName'])   && 
        !empty($_POST['lastName'])  && 
        isset($_POST['firstName'])  && 
        !empty($_POST['firstName']) &&
        isset($_POST['email'])      && 
        !empty($_POST['email'])     && 
        isset($_POST['old'])        && 
        !empty($_POST['old'])       &&
        isset($_POST['mdp'])        && 
        !empty($_POST['mdp'])       &&
        isset($_POST['mdpConfirm']) && 
        !empty($_POST['mdpConfirm'])
    ){
        require_once 'bdd_connect.php';
        array_map('htmlspecialchars', $_POST);
        $request = 'INSERT INTO membre(nom,prenom,age,email,mdp)
                    VALUES(:nom,:prenom,:age,:email,:mdp)';
        $mdp = password_hash($_POST['mdp'],PASSWORD_BCRYPT);
        $insert = $pdo->prepare($request);
        $insert->bindParam(':nom',$_POST['lastName']);
        $insert->bindParam(':prenom',$_POST['firstName']);
        $insert->bindParam(':age',$_POST['old']);
        $insert->bindParam(':email',$_POST['email']);
        $insert->bindParam(':mdp',$mdp);
        $insert->execute();
        echo 'inscription';
    }
    else
    {
        echo 'Les données saisis sont incorrectes.';
    }
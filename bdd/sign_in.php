<?php
    session_start();
    if(
        isset($_POST['email'])  &&
        !empty($_POST['email']) &&
        isset($_POST['mdp'])    &&
        !empty($_POST['mdp'])   &&
        isset($_POST['table'])  &&
        !empty($_POST['table'])
    ){
        require_once 'bdd_connect.php';
        array_map('htmlspecialchars', $_POST);
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $table = $_POST["table"];

        $request = 'SELECT *
                    FROM '.$table.'
                    WHERE email_'.$table.'=?';

        $select = $pdo->prepare($request);
        $select->bindValue(1,$email);
        if($select->execute()){
            $result = $select->fetch(PDO::FETCH_ASSOC);
            if(password_verify($mdp,$result['mdp_'.$table]))
            {
              $_SESSION['email'] = $result['email_'.$table];
              if($table === 'admin'){
                $_SESSION['role'] = 'ADMIN';
                echo 'admin';
              }
              else if($table === 'client'){
                $_SESSION['role'] = 'CLIENT';
                echo 'client';
              }

            }
            else
            {
               echo 'La combinaison email/mot de passe n\'est pas correcte';
            }
        }
        else{
          echo 'requete non executé';
        }
    }
    else
    {
        echo 'données incomplètes';
    }

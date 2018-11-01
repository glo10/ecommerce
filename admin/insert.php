<?php
    session_start();
    if(!isset($_SESSION['role']) && $_SESSION['role'] != 'ADMIN')
      header('location:../index.php?acces=false');
    if(
        isset($_POST['name'])           &&
        !empty($_POST['name'])          &&
        isset($_POST['price'])          &&
        !empty($_POST['price'])         &&
        isset($_POST['description'])    &&
        !empty($_POST['description'])   &&
        isset($_POST['quantite'])       &&
        !empty($_POST['quantite'])
    ){
        require_once '../bdd/bdd_connect.php';
        array_map('htmlspecialchars', $_POST);

        $pdo->beginTransaction();

        $reqProduit = 'INSERT INTO produit(
                                        nom_produit,
                                        prix_produit,
                                        description_produit
                                )
                    VALUES(
                                        :nom_produit,
                                        :prix_produit,
                                        :description_produit
                    )';

        $insertProduit = $pdo->prepare($reqProduit);
        $insertProduit->bindParam(':nom_produit',$_POST['name']);
        $insertProduit->bindParam(':prix_produit',$_POST['price']);
        $insertProduit->bindParam(':description_produit',$_POST['description']);

        if($insertProduit->execute()){
            $idProduit = $pdo->lastInsertId();

            $reqGestion = 'INSERT INTO gestion(
                                            email_admin,
                                            id_produit,
                                            stock
                                        )
                                    VALUES(
                                            :email_admin,
                                            :id_produit,
                                            :stock
                                    )';
            $insertGestion = $pdo->prepare($reqGestion);
            $insertGestion->bindParam(':email_admin',$_SESSION['email']);
            $insertGestion->bindParam(':id_produit',$idProduit);
            $insertGestion->bindParam(':stock',$_POST['quantite']);

            if($insertGestion->execute()){
                $pdo->commit();
                echo 'ajout';
            }
        }
        else{
            $pdo->rollback();
            echo 'Erreur d\'exécution de la requête';
        }
    }
    else
    {
        echo 'Les données saisis sont incorrectes.';
    }
